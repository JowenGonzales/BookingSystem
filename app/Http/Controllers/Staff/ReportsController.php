<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\Staff\ReportsService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    //

    protected $analyticsService;
    public function __construct(ReportsService $analyticService)
    {
        $this->analyticsService = $analyticService;
    }

    public function analytics(Request $request)
    {
        $from = $request->date_from ?? now()->format('Y-m-d');
        $to = $request->date_to ?? now()->format('Y-m-d');

        $analytics = $this->analyticsService->generate($from, $to);

        return view('staff.reports.analytics', $analytics);
    }

    


}
