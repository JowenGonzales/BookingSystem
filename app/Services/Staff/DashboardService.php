<?php

namespace App\Services\Staff;


use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getStats()
    {
        return [
            'totalBookings' => Booking::count(),
            'bookingsByStatus' => Booking::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status'),
            'totalRevenue' => Booking::where('is_paid', true)->sum('amount'),
            'todayBookings' => Booking::whereDate('booking_date', Carbon::today())->count(),
            'unpaidBookings' => Booking::where('is_paid', false)->count(),
        ];
    }
}

