<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

protected $fillable = ['name', 'day', 'time', 'level', 'class_level'];

public function enrolments()
{
    return $this->hasMany(Enrolment::class);
}

public function materials()
{
    return $this->hasMany(Material::class);
}

protected static function booted()
{
    static::saving(function ($subject) {
        if (empty($subject->slug)) {
            $base = Str::slug($subject->name);
            $slug = $base;
            $count = 1;
            while (Subject::where('slug', $slug)->where('id', '!=', $subject->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            $subject->slug = $slug;
        }
    });
}


}
