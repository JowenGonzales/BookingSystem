<?php

namespace App\Repositories\Staff;

use App\Models\Booking;

class EloquentBookingRepository implements BookingRepositoryInterface
{

    public function create(array $data): Booking
    {
        // TODO: Implement create() method.
        return Booking::create($data);
    }

    public function list(array $filters = [])
    {
        // TODO: Implement list() method.
        $query = Booking::with('user');


        if (!empty($filters['date_from'])) {
        $query->whereDate('booking_date', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('booking_date', '<=', $filters['date_to']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['payment_state'])) {
            $query->where('is_paid', $filters['payment_state'] === 'paid');
        }

        return $query->orderBy('booking_date', 'desc')->get();


    }

    public function findById(int $id): ?Booking
    {
        // TODO: Implement findById() method.
        return Booking::with('user')->find($id);
    }

    public function updateStatus(Booking $booking, string $status): Booking
    {
        // TODO: Implement updateStatus() method.
        $booking->status = $status;
        $booking->save();
        return $booking;
    }
}
