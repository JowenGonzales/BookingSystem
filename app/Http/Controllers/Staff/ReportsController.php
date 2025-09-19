<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    //

    public function analytics(Request $request)
    {
        // The range date from the form
        $from = $request->date_from ?? now()->format('Y-m-d');
        $to = $request->date_to ?? now()->format('Y-m-d');


        $bookings = $this->getBookings($from, $to);

        $totalBookings = $bookings->count();
        $bookingsByStatus = $this->getBookingsByStatus($bookings);
        $cashRevenue = $this->getCashRevenue($bookings);
        $unpaidBookings = $this->getUnpaidBookingsCount($bookings);
        $paymentConversion = $this->getPaymentConversion($totalBookings, $unpaidBookings);

        // Chart data
        $chartDates = $this->getChartDates($from, $to);
        $bookingsPerDay = $this->getBookingsPerDay($bookings, $chartDates);
        $revenuePerDay = $this->getRevenuePerDay($bookings, $from, $to);


        $topServices = $this->getTopServices($bookings);

        return view('staff.reports.analytics' , [
           'totalBookings' => $totalBookings,
           'bookingsByStatus' => $bookingsByStatus,
           'cashRevenue' => $cashRevenue,
           'unpaidBookings' => $unpaidBookings,
           'paymentConversion' => $paymentConversion,

           'chartDates' => $chartDates,
           'bookingsPerDay' => $bookingsPerDay,
           'revenuePerDay' => $revenuePerDay,
           'topServices' => $topServices,
        ]);

    }

    /* ----------------- Private Helper Methods ----------------- */

    // This retrieves the data by the given range based on the parameters

    private function getBookings($from, $to)
    {
        return Booking::with('payments', 'user')
            ->whereDate('booking_date', '>=', $from)
            ->whereDate('booking_date', '<=', $to)
            ->get();
    }


    private function getBookingsByStatus($bookings)
    {
        return $bookings->groupBy('status')->map->count();
    }

    private function getCashRevenue($bookings)
    {
        return $bookings->where('is_paid', true)->where('payment_method' , 'cash')->sum('amount');
    }

    private function getUnpaidBookingsCount($bookings)
    {
        return $bookings->filter(fn($b) => $b->payments->isEmpty())->count();
    }

    private function getPaymentConversion($total, $unpaid)
    {
        return $total ? round(($total - $unpaid) / $total * 100, 2) : 0;
    }

    // This method creates a date range $from to $to
    private function getChartDates($from, $to)
    {
        return collect(range(strtotime($from), strtotime($to), 86400))
            ->map(fn($d) => date('M d', $d));
    }


    // Gets the range of Dates and compare if it matched to the bookings with the given date
    private function getBookingsPerDay($bookings, $chartDates)
    {
        return $chartDates->map(fn($date) =>
        $bookings->filter(fn($b) => \Carbon\Carbon::parse($b->booking_date)->format('M d') == $date)->count()
        );
    }


    // Gets the range of Dates and compare if it matched to the revenue with the given date
    private function getRevenuePerDay($bookings, $from, $to)
    {
        $dates = collect(range(strtotime($from), strtotime($to), 86400))
            ->map(fn($d) => date('Y-m-d', $d));

        $revenuePerDay = [];

        foreach ($dates as $date) {
            $totalForDate = 0;

                // Sum all cash payments for this booking on this date
                $totalForDate += $bookings
                    ->filter(fn($p) =>
                        $p->is_paid &&
                        $p->paid_at &&
                        Carbon::parse($p->paid_at)->toDateString() == $date
                    )
                    ->sum('amount');

            $revenuePerDay[] = $totalForDate;
        }

        return collect($revenuePerDay);
    }


    private function getTopServices($bookings)
    {
        return $bookings->groupBy('service_name')->map->count()->sortDesc()->take(10);
    }


}
