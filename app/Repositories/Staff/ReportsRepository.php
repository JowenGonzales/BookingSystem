<?php

namespace App\Repositories\Staff;

use App\Models\Booking;
use Illuminate\Support\Collection;

class ReportsRepository implements ReportsRepositoryInterface
{


    public function getBookings(array $array): ?Collection
    {
        // TODO: Implement getBookings() method.
        return Booking::with('payments', 'user')
            ->whereDate('booking_date', '>=', $array['from'])
            ->whereDate('booking_date', '<=', $array['to'])
            ->get();
    }
}
