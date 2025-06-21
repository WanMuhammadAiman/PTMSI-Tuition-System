<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrolment;
use App\Models\Payment;

class PaymentController extends Controller
{
public function index()
{
    $user = auth()->user();
    $today = now();
    $billingCutoff = $today->copy()->startOfMonth()->addDays(7);

    // Get all this month's enrolments for this user
    $enrolments = Enrolment::where('user_id', $user->id)->get();

    // 🔍 Check if user has enrolment history BEFORE this month (existing user)
    $hasPastEnrolment = Enrolment::where('user_id', $user->id)
        ->whereDate('created_at', '<', $today->copy()->startOfMonth())
        ->exists();

    // 🧠 Determine if this is the FIRST time user is enrolling
    $isNewUser = !$hasPastEnrolment;

    // ⛔ Existing users cannot pay from 1st–7th
    if ($today->day <= 7 && !$isNewUser) {
        return redirect()->route('student.dashboard')
            ->with('error', 'Payments are not allowed from the 1st to the 7th. Please edit your subjects during this time.');
    }

    // ✅ Billed subjects depend on user type
    $billedSubjects = Enrolment::where('user_id', $user->id)
        ->when(!$isNewUser, fn($q) => $q->whereDate('created_at', '<=', $billingCutoff)) // existing users = freeze count at 7th
        ->get();

    if ($billedSubjects->isEmpty()) {
        return redirect()->route('student.dashboard')
            ->with('error', 'No subjects available for billing.');
    }

    // 💰 Pricing Logic
    $subjectCount = $billedSubjects->count();
    $pricePerSubject = 50;
    $totalAmount = $subjectCount * $pricePerSubject;

    // 🔥 Half price for new users joining in week 3 or 4
    if ($isNewUser && $today->day > 14) {
        $totalAmount = $totalAmount / 2;
    }

    // ✅ Check if already paid this month
    $alreadyPaid = Payment::where('user_id', $user->id)
        ->whereMonth('paymentDate', $today->month)
        ->whereYear('paymentDate', $today->year)
        ->exists();

    return view('student.payment', compact(
        'subjectCount',
        'pricePerSubject',
        'totalAmount',
        'billingCutoff',
        'alreadyPaid'
    ));
}

    public function process(Request $request)
    {
        $amount = $request->input('amount');

        // Simulate success for now
        return redirect()->route('student.dashboard')->with('status', "Payment of RM{$amount} successful.");
    }

    public function viewReceipt($id)
{
    $user = auth()->user();

    $payment = Payment::where('id', $id)
                      ->where('user_id', $user->id)
                      ->first();

    if (!$payment) {
        return redirect()->back()->with('error', 'Payment not found.');
    }

    $subjectCount = Enrolment::where('user_id', $user->id)->count();
    $payment->subject_count = $subjectCount;

    return view('student.receipt', ['latestPayment' => $payment]);
}


public function viewHistory()
{
    $user = auth()->user();
    $payments = Payment::where('user_id', $user->id)
                       ->orderBy('paymentDate', 'desc')
                       ->get();

    return view('student.payment-history', compact('payments'));
}


    
}
