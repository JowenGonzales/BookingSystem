<?php

namespace App\Services\Staff;

use App\Models\Booking;
use App\Repositories\Staff\EloquentBookingRepository;
use App\Repositories\Staff\ReportsRepositoryInterface;
use Illuminate\Support\Carbon;

class ReportsService
{
    protected $bookingRepository;
    public function __construct(EloquentBookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }


    public function generate(string $from, string $to): array
    {
        $bookings = $this->bookingRepository->getBookingsBetween($from, $to);

        $totalBookings = $bookings->count();
        $bookingsByStatus = $bookings->groupBy('status')->map->count();
        $cashRevenue = $bookings->where('is_paid', true)
            ->where('payment_method', 'cash')
            ->sum('amount');
        $unpaidBookings = $bookings->filter(fn($b) => $b->payments->isEmpty())->count();
        $paymentConversion = $totalBookings
            ? round(($totalBookings - $unpaidBookings) / $totalBookings * 100, 2)
            : 0;

        $chartDates = collect(range(strtotime($from), strtotime($to), 86400))
            ->map(fn($d) => date('M d', $d));

        $bookingsPerDay = $chartDates->map(
            fn($date) => $bookings->filter(
                fn($b) => Carbon::parse($b->booking_date)->format('M d') == $date
            )->count()
        );

        $dates = collect(range(strtotime($from), strtotime($to), 86400))
            ->map(fn($d) => date('Y-m-d', $d));

        $revenuePerDay = $this->getRevenuePerDay($from, $to, $bookings);


        $topServices = $bookings->groupBy('service_name')->map->count()
            ->sortDesc()->take(10);

        return [
            'totalBookings'   => $totalBookings,
            'bookingsByStatus'=> $bookingsByStatus,
            'cashRevenue'     => $cashRevenue,
            'unpaidBookings'  => $unpaidBookings,
            'paymentConversion' => $paymentConversion,
            'chartDates'      => $chartDates,
            'bookingsPerDay'  => $bookingsPerDay,
            'revenuePerDay'   => $revenuePerDay,
            'topServices'     => $topServices,
        ];
    }

    private function getRevenuePerDay($from, $to, $bookings)
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
                    Carbon::parse($p->paid_at) &&
                    Carbon::parse($p->paid_at)->toDateString() == $date
                )
                ->sum('amount');


            $revenuePerDay[] = $totalForDate;

        }

        return collect($revenuePerDay);
    }


}
