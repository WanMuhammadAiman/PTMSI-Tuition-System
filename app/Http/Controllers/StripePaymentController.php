<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Session;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Payment;
use App\Models\Enrolment;





class StripePaymentController extends Controller
{
   public function stripe()
{
    $user = auth()->user();

    // 🔒 Lock-in billing subjects as of the 7th
    $billingCutoff = now()->startOfMonth()->addDays(7);

    $billedSubjects = Enrolment::where('user_id', $user->id)
        ->whereDate('created_at', '<=', $billingCutoff)
        ->get();

    if ($billedSubjects->isEmpty()) {
        return redirect()->route('student.dashboard')->with('error', 'No subjects available for billing. Please enrol before the 7th.');
    }

    $subjectCount = $billedSubjects->count();
    $pricePerSubject = 50;
    $totalAmount = $subjectCount * $pricePerSubject;

    return view('student.payment', compact('subjectCount', 'pricePerSubject', 'totalAmount', 'billingCutoff'));
}


    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create([
            "amount" => 5000, // RM 50 = 5000 cents
            "currency" => "myr",
            "source" => $request->stripeToken,
            "description" => "Tuition Fee Payment"
        ]);

        Session::flash('success', 'Payment successful!');

        return redirect()->route('payment.success');
    }

   public function createCheckoutSession(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $user = auth()->user();
    $today = now();

    // ✅ BLOCK if payment already made this month
    $alreadyPaid = Payment::where('user_id', $user->id)
        ->whereMonth('paymentDate', $today->month)
        ->whereYear('paymentDate', $today->year)
        ->exists();

    if ($alreadyPaid) {
        return redirect()->route('student.dashboard')
            ->with('error', 'You have already made a payment for this month.');
    }

    // ✅ Determine user type
    $billingCutoff = $today->copy()->startOfMonth()->addDays(7);

    $hasPastEnrolment = Enrolment::where('user_id', $user->id)
        ->whereDate('created_at', '<', $today->copy()->startOfMonth())
        ->exists();

    $isNewUser = !$hasPastEnrolment;

    // ✅ Get billed subjects — apply cutoff only to existing users
    $billedSubjects = Enrolment::where('user_id', $user->id)
        ->when(!$isNewUser, function ($query) use ($billingCutoff) {
            $query->whereDate('created_at', '<=', $billingCutoff);
        })
        ->get();

    if ($billedSubjects->isEmpty()) {
        return redirect()->route('student.dashboard')
            ->with('error', 'No subjects found for billing.');
    }

    $subjectCount = $billedSubjects->count();
    $pricePerSubject = 50;
    $amount = $subjectCount * $pricePerSubject;

    // ✅ Half price for new users enrolling in week 3 or later
    if ($isNewUser && $today->day > 14) {
        $amount = $amount / 2;
    }

    // ✅ Proceed to Stripe Checkout
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'myr',
                'unit_amount' => $amount * 100, // Stripe uses cents
                'product_data' => [
                    'name' => 'Tuition Fee Payment',
                ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'customer_email' => $user->email,
        'success_url' => route('stripe.success') . '?amount=' . $amount,
        'cancel_url' => route('student.payment'),
        'metadata' => [
            'user_id' => $user->id,
            'subject_count' => $subjectCount,
            'amount' => $amount,
        ],
    ]);

    return redirect($session->url);
}


    

// public function viewReceipt()
// {
//     $user = auth()->user();

//     // Get the most recent payment (or adjust based on your structure)
//     $latestPayment = Payment::where('user_id', $user->id)
//                             ->latest()
//                             ->first();

//     return view('student.receipt', compact('latestPayment'));
// }


public function handleSuccess(Request $request)
{
    $user = auth()->user();
    $amount = $request->query('amount'); // retrieve from URL query string

    $payment = Payment::create([
        'user_id' => $user->id,
        'amount' => $amount,
        'paymentDate' => now(),
        'transactionID' => uniqid('txn_'),
        'paymentStatus' => true,
    ]);

    return view('student.success', ['receipt_id' => $payment->id]); // ✅ Now works
}






}
