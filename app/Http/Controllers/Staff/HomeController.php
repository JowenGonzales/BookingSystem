<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {

        // Total bookings
        $totalBookings = Booking::count();

        // Breakdown by status
        $bookingsByStatus = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status'); // ['pending' => 10, 'confirmed' => 5, ...]

        // Total revenue from cash payments
        $totalRevenue = Booking::where('is_paid', true)

            ->sum('amount');

        // Today's bookings
        $todayBookings = Booking::whereDate('booking_date', Carbon::today())->count();

        // Unpaid bookings
        $unpaidBookings = Booking::where('is_paid', false)->count();


        return view('staff.dashboard.dashboard' , [
            'totalBookings' => $totalBookings,
            'bookingsByStatus' => $bookingsByStatus,
            'totalRevenue' => $totalRevenue,
            'todayBookings' => $todayBookings,
            'unpaidBookings' => $unpaidBookings
        ]);
    }
}
