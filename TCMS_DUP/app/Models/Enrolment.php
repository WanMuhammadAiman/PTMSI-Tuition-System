<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'class_id',
        'enrolmentDate',
    ];

    public function subject()
{
    return $this->belongsTo(Subject::class);
}


}
