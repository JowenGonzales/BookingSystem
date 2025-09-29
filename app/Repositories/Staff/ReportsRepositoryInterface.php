<?php

namespace App\Repositories\Staff;

use App\Models\Booking;
use Illuminate\Support\Collection;

interface ReportsRepositoryInterface
{

    public function getBookings(array $array) : ?Collection;

}
