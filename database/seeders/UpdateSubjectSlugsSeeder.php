<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Subject;

class UpdateSubjectSlugsSeeder extends Seeder
{
    public function run()
    {
        Subject::all()->each(function ($subject) {
            $subject->slug = Str::slug($subject->name);
            $subject->save();
        });
    }
}

