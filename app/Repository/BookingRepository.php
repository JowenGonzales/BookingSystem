<?php

namespace App\Repository;

use App\Models\Booking;

class BookingRepository
{
    public function getCalendarEvents()
    {
        return Booking::with('user:id,name')
            ->select('id', 'booking_date', 'status', 'user_id')
            ->get()
            ->map(function ($booking) {
                return [
                    'title' => $booking->user->name . ' (' . ucfirst($booking->status) . ')',
                    'start' => $booking->booking_date,
                    'url'   => route('staff.bookings.viewbooking', $booking->id),
                ];
            });
    }
}
