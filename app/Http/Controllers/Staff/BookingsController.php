<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CodeHelper;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Repositories\BookingRepository;
use App\Repositories\Staff\EloquentBookingRepository;
use App\Rules\NoDoubleBooking;
use App\Services\Staff\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    //
    protected $service;
    protected $repo;

    public function __construct(BookingService $service, EloquentBookingRepository $repo)
    {
        $this->service = $service;
        $this->repo = $repo;
    }

    public function createBooking()
    {
        return view('staff.bookings.create_booking');

    }

    public function storeBooking(StoreBookingRequest $request)
    {
        $booking = $this->service->createBooking($request->validated(), Auth::id());
        session()->flash('success' , 'Successfully Created Booking');

        return redirect()->route('staff.bookings.viewbooking' , $booking->id);
    }

    public function allBookings(Request $request)
    {
        $filters = $request->only(['date_from' , 'date_to', 'status', 'payment_state']);
        $bookings = $this->repo->list($filters);

        return view('staff.bookings.all_bookings', compact('bookings'));
    }

    public function viewBooking(Booking $booking)
    {
        return view('staff.bookings.view_booking' , [
            'booking' => $booking,
        ]);
    }
    public function updateStatus(Request $request, Booking $booking)
    {

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);
        $this->service->updateStatus($booking, $request->status);

        return back()->with('success' , 'Booking status updated successfully!');
    }

}
