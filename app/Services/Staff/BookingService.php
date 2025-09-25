<?php

namespace App\Services\Staff;

use App\Repositories\BookingRepository;
use App\Repositories\Staff\BookingRepositoryInterface;
use App\Repositories\Staff\EloquentBookingRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingService
{
    protected $repo;
    public function __construct(EloquentBookingRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createBooking(array $data, int $userId)
    {
        return DB::transaction(function () use ($data, $userId) {
            $payload = array_merge($data, [
               'user_id' => $userId,
               'reference_code' => $this->generateBookingCode(),
                'status' => 'pending',
                'payment_method' => 'cash',
            ]);
            return $this->repo->create($payload);
        });
    }

    public function updateStatus($booking, string $status)
    {
        return $this->repo->updateStatus($booking, $status);
    }

    protected function generateBookingCode(): string
    {
        return 'BKG-' . strtoupper(Str::random(8));
    }
}
