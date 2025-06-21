<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SurveyQuestion;

class SurveyQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    

public function run()
{
    $questions = [
        ['Do you enjoy solving math problems?', 'STEM'],
        ['Do you like writing essays or stories?', 'Creative'],
        ['Do you enjoy organizing events?', 'Business'],
        ['Do you enjoy helping others learn?', 'Social'],
        ['Do you like building or repairing things?', 'STEM'],
        ['Do you enjoy drawing or painting?', 'Creative'],
        ['Do you like public speaking?', 'Social'],
        ['Do you enjoy managing money or finances?', 'Business'],
        ['Do you like working in teams?', 'Social'],
        ['Do you enjoy designing graphics or layouts?', 'Creative'],
        ['Do you like programming or coding?', 'STEM'],
        ['Do you enjoy analyzing data?', 'Business'],
        ['Do you like volunteering or counseling?', 'Social'],
        ['Do you enjoy acting or performing?', 'Creative'],
        ['Do you like reading science magazines?', 'STEM'],
        ['Do you enjoy selling things or marketing?', 'Business'],
        ['Do you like conducting experiments?', 'STEM'],
        ['Do you enjoy photography?', 'Creative'],
        ['Do you like leading group activities?', 'Social'],
        ['Do you enjoy coming up with business ideas?', 'Business'],
    ];

    foreach ($questions as [$text, $category]) {
        SurveyQuestion::create([
            'question_text' => $text,
            'category' => $category,
        ]);
    }
}

}
