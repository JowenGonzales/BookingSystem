<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'user_id',
        'payment_method',
        'amount',
        'notes',
        'status',
        'paid_at',

    ];


    public function booking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');
    }
}
