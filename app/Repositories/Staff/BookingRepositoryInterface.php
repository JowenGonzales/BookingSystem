<?php

namespace App\Repositories\Staff;

use App\Models\Booking;
use Illuminate\Support\Collection;

interface BookingRepositoryInterface
{

    public function create(array $data): Booking;
    public function list(array $filters = []);
    public function findById(int $id): ?Booking;
    public function updateStatus(Booking $booking, string $status): Booking;
    public function getBookingsBetween(string $from, string $to) : Collection;

}
