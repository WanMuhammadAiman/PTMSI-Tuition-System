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

}
