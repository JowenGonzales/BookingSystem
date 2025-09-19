<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CodeHelper;
use App\Models\Booking;
use App\Rules\NoDoubleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    //


    public function createBooking()
    {
        return view('staff.bookings.create_booking' , [

        ]);
    }

    public function storeBooking(Request $request)
    {

        $request->validate([
            'service_name' => 'required|string|max:255',
            'scheduled_at' => [
                'required',
                'date',
                'after:now',
                new NoDoubleBooking($request->service_name), // 👈 custom rule
            ],
            'notes' => 'nullable|string',
            'amount' => 'required|numeric|min:1',
        ]);


        $newBooking = Booking::create([
            'user_id' => Auth::id(),
            'reference_code' => CodeHelper::generateBookingCode(),
            'service_name' => $request->input('service_name'),
            'booking_date' => $request->input('scheduled_at'), // match DB column
            'status' => 'pending',
            'payment_method' => 'cash',
            'notes' => $request->input('notes'),
            'amount' => $request->input('amount'),
        ]);




        session()->flash('success' , "Successfully Created Booking");
        return redirect()->route('staff.bookings.viewbooking' , $newBooking->id);

    }



    public function allBookings(Request $request)
    {
        $query = Booking::with('user');

        if ($request->filled('date_from')) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_state')) {
            if ($request->payment_state == 'paid') {
                $query->where('is_paid', true);
            } else {
                $query->where('is_paid', false);
            }
        }

        $bookings = $query->orderBy('booking_date', 'desc')->get();

        return view('staff.bookings.all_bookings' , [
           'bookings' => $bookings,
        ]);
    }

    public function viewBooking($id)
    {
        $booking = Booking::find($id);
        return view('staff.bookings.view_booking' , [
           'booking' => $booking,
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Booking status updated successfully!');

    }

}
