<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Enrolment;
use Carbon\Carbon;
use App\Models\Material;


class StudentDashboardController extends Controller
{
  public function index()
{
    $user = Auth::user();

    $hasCompletedProfile = $user->hasCompleteProfile();

    $hasEnrolments = $hasCompletedProfile
        ? Enrolment::where('user_id', $user->id)->exists()
        : false;

    $todayClasses = [];

    // Get today's classes (already working)
    if ($hasEnrolments) {
        $today = Carbon::now()->format('l'); // e.g., 'Monday'

        $todayClasses = Enrolment::with('subject')
            ->where('user_id', $user->id)
            ->whereHas('subject', function ($query) use ($today) {
                $query->where('day', $today);
            })
            ->get()
            ->pluck('subject');
    }

    // ✅ Payment status logic
    $currentMonth = now()->month;
    $currentYear = now()->year;

    $hasPaid = \App\Models\Payment::where('user_id', $user->id)
        ->whereYear('paymentDate', $currentYear)
        ->whereMonth('paymentDate', $currentMonth)
        ->where('paymentStatus', 1)
        ->exists();

    $paymentStatus = $hasPaid ? 'Paid' : 'Unpaid';

    // ✅ NEW PART: Retrieve enrolled subjects first
    $enrolledSubjects = Enrolment::where('user_id', $user->id)
        ->pluck('subject_id');

    // ✅ Then only get materials related to these enrolled subjects
    $recentMaterials = Material::whereIn('subject_id', $enrolledSubjects)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

    return view('student.dashboard', compact(
        'hasCompletedProfile',
        'hasEnrolments',
        'todayClasses',
        'paymentStatus',
        'recentMaterials'
    ));
}



    public function dashboard()
{
    $user = auth()->user();

    // Check if the user's profile is complete
    $hasCompletedProfile = $user->hasCompleteProfile();

    // Check if user has enrolments only if profile is complete
    $hasEnrolments = $hasCompletedProfile
        ? \App\Models\Enrolment::where('user_id', $user->id)->exists()
        : false;

    return view('student.dashboard', compact('hasEnrolments', 'hasCompletedProfile'));
}

public function timetable()
{
    $user = auth()->user();

    // Get subjects the user is enrolled in
    $subjects = \App\Models\Enrolment::with('subject')
        ->where('user_id', $user->id)
        ->get()
        ->map(fn($enrolment) => $enrolment->subject);

       // dd($subjects); 

    return view('student.timetable', compact('subjects'));
}



}
