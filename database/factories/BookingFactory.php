<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booking::class;

    public function definition()
    {
        $status = $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']);
        $paymentMethod = $this->faker->randomElement(['cash']);
        $booking_date = $this->faker->dateTimeBetween('-30 days', 'now');
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'reference_code' => strtoupper(Str::random(8)),
            'service_name' => $this->faker->randomElement(['Haircut', 'Hair Coloring', 'Manicure', 'Pedicure']),
            'booking_date' => $booking_date,
            'status' => $status,
            'payment_method' => $paymentMethod,
            'amount' => $this->faker->numberBetween(500, 5000),
            'notes' => $this->faker->optional()->sentence(),
            'is_paid' => $status === 'completed' ? 1 : 0,
            'paid_at' => $booking_date,
        ];
    }
}
