<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference_code',
        'service_name',
        'booking_date',
        'status',
        'payment_method',
        'notes',
        'amount',
        'is_paid',
        'paid_at',
    ];
    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
