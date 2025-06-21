<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LockSubjectsForMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
{
    $today = now();
    $monthToLock = $today->format('Y-m'); // e.g., 2025-07

    $students = User::where('role', 'student')->get();

    foreach ($students as $student) {
        $enrolment = Enrolment::where('user_id', $student->id)
            ->whereNull('locked_for_month')
            ->first();

        if ($enrolment) {
            $enrolment->locked_for_month = $today;
            $enrolment->save();
        }
    }

    $this->info("Subjects locked for all students for {$monthToLock}");
}

}
