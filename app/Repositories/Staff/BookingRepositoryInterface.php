<?php

namespace App\Repositories\Staff;

use App\Models\Booking;

interface BookingRepositoryInterface
{

    public function create(array $data): Booking;
    public function list(array $filters = []);
    public function findById(int $id): ?Booking;
    public function updateStatus(Booking $booking, string $status): Booking;

}
