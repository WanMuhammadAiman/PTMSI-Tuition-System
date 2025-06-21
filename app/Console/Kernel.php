<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\Payment;
use App\Mail\PaymentReminder;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
    $today = now();

    //Remove this line to test anytime
   // if ($today->day != 13) return;

    $students = User::where('role', 'student')->get();

    foreach ($students as $student) {
        $hasPaid = Payment::where('user_id', $student->id)
            ->whereMonth('paymentDate', $today->month)
            ->whereYear('paymentDate', $today->year)
            ->exists();

        \Log::info("Checking payment for {$student->name} on " . now());
        \Log::info("Has paid? " . ($hasPaid ? 'Yes' : 'No'));


        if (!$hasPaid) {
            Mail::to($student->email)->send(new PaymentReminder($student->name));
        }
    }
})->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
