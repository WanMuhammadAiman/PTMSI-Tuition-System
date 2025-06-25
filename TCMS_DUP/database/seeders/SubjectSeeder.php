<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [];

        // Primary: Standard 1 to 6
        foreach (range(1, 6) as $standard) {
            $subjects = array_merge($subjects, [
                ['name' => 'BAHASA MALAYSIA', 'day' => 'Monday', 'time' => '5:00 PM', 'level' => 'primary', 'class_level' => $standard],
                ['name' => 'SCIENCE', 'day' => 'Tuesday', 'time' => '6:00 PM', 'level' => 'primary', 'class_level' => $standard],
                ['name' => 'MATHEMATICS', 'day' => 'Wednesday', 'time' => '5:00 PM', 'level' => 'primary', 'class_level' => $standard],
                ['name' => 'BAHASA TAMIL', 'day' => 'Thursday', 'time' => '6:00 PM', 'level' => 'primary', 'class_level' => $standard],
                ['name' => 'ENGLISH', 'day' => 'Wednesday', 'time' => '6:00 PM', 'level' => 'primary', 'class_level' => $standard],
            ]);
        }

         // Secondary: Form 3 
        $subjects = array_merge($subjects, [
            ['name' => 'BM (PT3)', 'day' => 'Monday', 'time' => '6:00PM–7:15PM', 'level' => 'secondary', 'class_level' => 3],
            ['name' => 'SAINS (PT3)', 'day' => 'Monday', 'time' => '7:15PM–8:30PM', 'level' => 'secondary', 'class_level' => 3],
            ['name' => 'SEJARAH (PT3)', 'day' => 'Tuesday', 'time' => '6:00PM–7:15PM', 'level' => 'secondary', 'class_level' => 3],
            ['name' => 'MATEMATIK (PT3)', 'day' => 'Wednesday', 'time' => '6:00PM–7:15PM', 'level' => 'secondary', 'class_level' => 3],
            ['name' => 'ENGLISH (PT3)', 'day' => 'Thursday', 'time' => '6:00PM–7:15PM', 'level' => 'secondary', 'class_level' => 3],
        ]);

        // Secondary: Form 1 to 2
        foreach ([1, 2] as $form) {
            $subjects = array_merge($subjects, [
                ['name' => 'BI (F1/F2)', 'day' => 'Monday', 'time' => '8:00PM–9:15PM', 'level' => 'secondary', 'class_level' => $form],
                ['name' => 'SEJARAH (F1/F2)', 'day' => 'Tuesday', 'time' => '8:00PM–9:15PM', 'level' => 'secondary', 'class_level' => $form],
                ['name' => 'MATHS (F1/F2)', 'day' => 'Wednesday', 'time' => '7:45PM–9:00PM', 'level' => 'secondary', 'class_level' => $form],
                ['name' => 'BM (F1/F2)', 'day' => 'Wednesday', 'time' => '9:00PM–10:15PM', 'level' => 'secondary', 'class_level' => $form],
                ['name' => 'GEOGRAFI (F1/F2/F3)', 'day' => 'Thursday', 'time' => '7:45PM–9:00PM', 'level' => 'secondary', 'class_level' => $form],
                ['name' => 'SAINS (F1/F2)', 'day' => 'Thursday', 'time' => '9:00PM–10:15PM', 'level' => 'secondary', 'class_level' => $form],
            ]);
        }

        // F4 & F5 shared SPM subjects
        $spmSubjects = [
            ['name' => 'KIMIA (SPM)', 'day' => 'Monday', 'time' => '6:00PM–7:15PM'],
            ['name' => 'BM (SPM)', 'day' => 'Monday', 'time' => '7:15PM–8:30PM'],
            ['name' => 'SAINS (SPM)', 'day' => 'Monday', 'time' => '8:30PM–9:45PM'],
            ['name' => 'BIOLOGI (SPM)', 'day' => 'Tuesday', 'time' => '6:00PM–7:15PM'],
            ['name' => 'FIZIK (SPM)', 'day' => 'Tuesday', 'time' => '7:15PM–8:30PM'],
            ['name' => 'MATEMATIK (SPM)', 'day' => 'Thursday', 'time' => '6:00PM–7:15PM'],
            ['name' => 'MATEMATIK TAMBAH (SPM)', 'day' => 'Thursday', 'time' => '7:30PM–8:45PM'],
        ];

        foreach ([4, 5] as $form) {
            foreach ($spmSubjects as $spm) {
                $subjects[] = [
                    'name' => $spm['name'],
                    'day' => $spm['day'],
                    'time' => $spm['time'],
                    'level' => 'secondary',
                    'class_level' => $form,
                ];
            }
        }

        // Form 4-only
        $subjects = array_merge($subjects, [
            ['name' => 'ENGLISH (F4)', 'day' => 'Wednesday', 'time' => '6:00PM–7:15PM', 'level' => 'secondary', 'class_level' => 4],
            ['name' => 'SEJARAH (F4)', 'day' => 'Wednesday', 'time' => '7:30PM–8:45PM', 'level' => 'secondary', 'class_level' => 4],
        ]);

        // Form 5-only
        $subjects = array_merge($subjects, [
            ['name' => 'ENGLISH (F5)', 'day' => 'Wednesday', 'time' => '7:30PM–8:45PM', 'level' => 'secondary', 'class_level' => 5],
            ['name' => 'SEJARAH (F5)', 'day' => 'Wednesday', 'time' => '6:00PM–7:15PM', 'level' => 'secondary', 'class_level' => 5],
        ]);

        // Insert into database
        foreach ($subjects as $subject) {
            Subject::create($subject);
    }
}
}