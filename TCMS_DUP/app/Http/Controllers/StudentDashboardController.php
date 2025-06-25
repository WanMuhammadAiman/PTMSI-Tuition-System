<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Enrolment;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if the user's profile is complete
        $hasCompletedProfile = $user->hasCompleteProfile();

        // Determine if the user has any enrolments
        $hasEnrolments = $hasCompletedProfile
            ? Enrolment::where('user_id', $user->id)->exists()
            : false;

        return view('student.dashboard', compact('hasEnrolments', 'hasCompletedProfile'));
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
