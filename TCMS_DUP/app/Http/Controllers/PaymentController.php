<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrolment;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        // Check if enrolled
        $enrolledSubjects = Enrolment::where('user_id', $user->id)->get();
    
        if ($enrolledSubjects->isEmpty()) {
            return redirect()->route('student.dashboard')->with('error', 'Please enrol in subjects before accessing payments.');
        }
    
        $subjectCount = $enrolledSubjects->count();
        $pricePerSubject = 50;
        $totalAmount = $subjectCount * $pricePerSubject;
    
        return view('student.payment', compact('subjectCount', 'pricePerSubject', 'totalAmount'));
    }

    public function process(Request $request)
{
    $amount = $request->input('amount');

    // Here you would integrate a payment gateway like Stripe or FPX
    // For now, we simulate success

    return redirect()->route('student.dashboard')->with('status', "Payment of RM{$amount} successful.");
}

}

