<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrolment;
use App\Models\Subject;
use App\Models\User;



class EnrolmentController extends Controller
{
    /**
     * Display the subject enrolment form.
     */
    public function index()
{

   // dd('This is the correct controller method');

    $user = auth()->user();

    $academicLevel = strtolower($user->level);
    $classLevel = $academicLevel === 'primary'
        ? (int) filter_var($user->standard, FILTER_SANITIZE_NUMBER_INT)
        : (int) filter_var($user->form, FILTER_SANITIZE_NUMBER_INT);

    // Get subject list by level + class
    $allSubjects = Subject::where('level', $academicLevel)
        ->where('class_level', $classLevel)
        ->get();

    // ✅ Get real-time enrolled subject IDs
    $enrolledSubjectIds = Enrolment::where('user_id', $user->id)
        ->pluck('subject_id')
        ->toArray();

    // ✅ Split into enrolled and available (filter from DB)
    $enrolledSubjects = $allSubjects->whereIn('id', $enrolledSubjectIds);
    $availableSubjects = $allSubjects->whereNotIn('id', $enrolledSubjectIds);

    return view('student.enrolment', compact(
        'academicLevel',
        'classLevel',
        'enrolledSubjects',
        'availableSubjects'
    ));
}
    




    protected function getSubjectsForLevel($academicLevel, $classLevel)
    {
        return \App\Models\Subject::where('level', $academicLevel)
            ->where('class_level', $classLevel)
            ->get();
    }
    
public function store(Request $request)
{
    $user = auth()->user();
    $currentDay = now()->day;

    // ✅ Check if student has any enrolments *BEFORE* deleting
    $hasEnrolledBefore = Enrolment::where('user_id', $user->id)->exists();

    // 🔒 Block edits after 7th if user has enrolled before
    if ($currentDay > 7 && $hasEnrolledBefore) {
        return redirect()->back()->with('error', 'Subject editing is only allowed from the 1st to the 7th of each month. Your changes were not saved.');
    }

    // ✅ Only now delete and re-add
    $subjectIds = $request->input('subjects', []);
    $user->enrolments()->delete();

    if (!empty($subjectIds)) {
        foreach ($subjectIds as $subjectId) {
            Enrolment::create([
                'user_id' => $user->id,
                'subject_id' => $subjectId,
                'class_id' => 0,
                'enrolmentDate' => now(),
            ]);
        }

        return redirect()->route('student.dashboard')->with('status', 'Subjects updated successfully!');
    }

    return redirect()->route('student.dashboard')->with('status', 'All subjects have been removed.');
}



}
