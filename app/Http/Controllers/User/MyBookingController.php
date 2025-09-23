<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CodeHelper;
use App\Models\Booking;
use App\Models\User;
use App\Rules\NoDoubleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MyBookingController extends Controller
{
    //



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


        return redirect()->route('user.mybooking.managebookings.viewbooking' , $newBooking->id);

    }

    public function manageBookings()
    {
        $bookings = User::find(Auth::id())->bookings;
        return view('users.my_bookings.managebookings' , [
           'bookings' => $bookings,
        ]);
    }

    public function createBooking()
    {
        return view('users.my_bookings.create_booking');
    }

    public function viewBooking($id)
    {
        $booking = Booking::find($id);
        return view('users.my_bookings.view_booking' , [
            'booking' => $booking,
        ]);
    }

    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Prevent editing if booking is confirmed (or cancelled, etc.)
        if (in_array($booking->status, ['confirmed', 'approved', 'rejected', 'cancelled'])) {

            session()->flash('error' , 'You cannot edit this booking once it is ' . ucfirst($booking->status) . '.');
            return back();
        }

        return view('users.my_bookings.edit_booking', [
            'booking' => $booking,
        ]);
    }


    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'service_name' => 'required|string|max:255',
            'booking_date' => [
                'required',
                'date',
                'after:now',
                new NoDoubleBooking($request->service_name, $booking->id),
            ],
            'notes'        => 'nullable|string',
            'status'       => 'in:pending,cancelled',
        ]);

        $booking->update([
            'service_name' => $request->service_name,
            'booking_date' => $request->booking_date,
            'notes'        => $request->notes,
            'status'       => $request->status,
        ]);

        return redirect()->route('user.mybooking.managebookings.viewbooking', $booking->id)
            ->with('success', 'Booking updated successfully!');
    }



}
