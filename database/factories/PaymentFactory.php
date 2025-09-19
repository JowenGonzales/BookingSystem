<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Payment::class;

    public function definition()
    {
        $booking = Booking::inRandomOrder()->first() ?? Booking::factory()->create();
        $status = $this->faker->randomElement(['pending', 'approved', 'rejected', 'confirmed']);
        $method = $this->faker->randomElement(['cash']);

        return [
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'payment_method' => $method,
            'amount' => $booking->amount,
            'notes' => $this->faker->optional()->sentence(),
            'status' => $status,
        ];
    }
}
