<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'subject',       
        'file_path',
        'file_type',
    ];
    

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    

}
