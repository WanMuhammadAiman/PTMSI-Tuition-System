<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'ic',
        'level',
        'standard',
        'form',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if the user's profile is complete.
     *
     * @return bool
     */
    public function hasCompleteProfile()
    {
        return $this->phone &&
               $this->address &&
               $this->ic &&
               $this->level &&
               ($this->standard || $this->form);
    }

    public function enrolments()
{
    return $this->hasMany(Enrolment::class);
}

// public function payments()
// {
//     return $this->hasMany(Payment::class);
// }

public function subject()
{
    return $this->belongsTo(Subject::class);
}


}
