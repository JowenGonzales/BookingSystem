<?php

namespace App\Services\Staff;

use App\Models\Booking;
use App\Repositories\Staff\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    protected $payments;
    public function __construct(PaymentRepositoryInterface $payments)
    {
        $this->payments = $payments;
    }

    public function storePayment(array $data)
    {
        $booking = Booking::findOrFail($data['booking_id']);

        $payment = $this->payments->create([
           'booking_id' => $booking->id,
           'user_id' => Auth::id(),
           'payment_method' => $data['amount'],
           'amount' => $data['amount'],
           'notes' => $data['notes'],
           'status' => 'confirmed',
        ]);

        $booking->update([
           'is_paid' => true,
        ]);

        return $payment;
    }
}
