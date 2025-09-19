<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

// Rule
class NoDoubleBooking implements Rule
{
    protected $serviceName;
    protected $bookingId;

    public function __construct($serviceName, $bookingId = null)
    {
        $this->serviceName = $serviceName;
        $this->bookingId = $bookingId;
    }

    public function passes($attribute, $value)
    {
        return !Booking::where('service_name', $this->serviceName)
            ->where('booking_date', $value)
            ->where('id', '!=', $this->bookingId) // 👈 ignore current booking
            ->exists();
    }

    public function message()
    {
        return 'This service is already booked for the selected time.';
    }
}

