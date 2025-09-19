<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnalyticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users if none exist
        User::factory(10)->create();

        // Create 50 bookings
        Booking::factory(50)->create()->each(function ($booking) {
            // Randomly generate 0-2 payments per booking
            $paymentCount = rand(0, 2);

            for ($i = 0; $i < $paymentCount; $i++) {
                Payment::factory()->create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                    'payment_method' => $booking->payment_method,
                    'amount' => $booking->amount,
                ]);
            }
        });
    }
}
