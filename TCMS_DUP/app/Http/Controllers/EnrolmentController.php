<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrolment;
use App\Models\Subject;


class EnrolmentController extends Controller
{
    /**
     * Display the subject enrolment form.
     */
    public function index()
    {
        $user = auth()->user();
    
        // Determine academic level and class level from user profile
        $academicLevel = strtolower($user->level); // 'primary' or 'secondary'
        $classLevel = $academicLevel === 'primary'
            ? (int) filter_var($user->standard, FILTER_SANITIZE_NUMBER_INT)
            : (int) filter_var($user->form, FILTER_SANITIZE_NUMBER_INT);
    
        // Get subject list based on level
        $subjects = $this->getSubjectsForLevel($academicLevel, $classLevel);
    
        // Get the subject_ids the user has already enrolled in
        $selectedSubjects = $user->enrolments->pluck('subject_id')->toArray();

        //dd($academicLevel, $classLevel, $subjects);
    
        return view('student.enrolment', [
            'academicLevel' => $academicLevel,
            'classLevel' => $classLevel,
            'subjects' => $subjects,
            'selectedSubjects' => $selectedSubjects, // ✅ This enables pre-checking
        ]);
    }
    

    /**
     * Get subjects based on academic level and class level.
     */
    protected function getSubjectsForLevel($academicLevel, $classLevel)
{
    return Subject::where('level', $academicLevel)
        ->where('class_level', $classLevel)
        ->get();
}

public function store(Request $request)
{
    $user = auth()->user();

    // Get selected subject IDs or empty array if none were checked
    $subjectIds = $request->input('subjects', []);

    // Remove all current enrolments
    $user->enrolments()->delete();

    // If subjects are selected, re-create them
    if (!empty($subjectIds)) {
        foreach ($subjectIds as $subjectId) {
            Enrolment::create([
                'user_id' => $user->id,
                'subject_id' => $subjectId,
                'class_id' => 0, // optional, keep if used
                'enrolmentDate' => now(),
            ]);
        }

        return redirect()->route('student.dashboard')->with('status', 'Subjects updated successfully!');
    }

    // If no subjects selected (all removed), redirect with appropriate message
    return redirect()->route('student.dashboard')->with('status', 'All subjects have been removed.');
}

}
