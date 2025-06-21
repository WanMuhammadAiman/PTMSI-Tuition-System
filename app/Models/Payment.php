<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'paymentDate',
        'transactionID',
        'receiptID',
        'NotificationID',
        'paymentStatus',
        'user_id', // Add this line
    ];

    public function payments()
{
    return $this->hasMany(Payment::class);
}

}
