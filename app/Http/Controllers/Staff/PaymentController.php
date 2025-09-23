<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'booking_id'     => 'required|exists:bookings,id',
            'amount'         => 'required|numeric|min:1',
            'receipt_number' => 'nullable|string|max:255',
            'paid_at'        => 'required|date',
            'notes'          => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Create payment record
        $payment = Payment::create([
            'booking_id'     => $booking->id,
            'user_id'        => Auth::id(), // staff/admin who marked it
            'payment_method' => 'cash',
            'amount'         => $request->amount,
            'notes'          => $request->notes,
            'status'         => 'confirmed',
        ]);

        $booking->update([
            'is_paid' => true,
        ]);

        session()->flash('success', 'Payment submitted successfully! Please wait for confirmation.');
        return back();
    }
}
