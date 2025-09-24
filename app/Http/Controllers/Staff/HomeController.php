<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Repository\BookingRepository;
use App\Services\Staff\DashboardService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $dashboardService;
    protected $bookingRepository;

    public function __construct(DashboardService $dashboardService, BookingRepository $bookingRepository)
    {
        $this->dashboardService = $dashboardService;
        $this->bookingRepository = $bookingRepository;
    }

    public function index()
    {
        $stats = $this->dashboardService->getStats();
        $events = $this->bookingRepository->getCalendarEvents();

        return view('staff.dashboard.dashboard', array_merge($stats, [
            'events' => $events,
        ]));
    }
}

