<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Booking;

class NoDoubleBookingSystemWide implements Rule
{
    protected $serviceName;

    public function __construct($serviceName)
    {
        $this->serviceName = $serviceName;
    }

    public function passes($attribute, $value)
    {
        // System-wide: check if ANY user already booked the same service at the same date/time
        return !Booking::where('service_name', $this->serviceName)
            ->where('booking_date', $value)
            ->exists();
    }

    public function message()
    {
        return 'This service is already booked for the selected time slot.';
    }
}
