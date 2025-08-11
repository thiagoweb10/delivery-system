<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tracking_code' => strtoupper($this->faker->bothify('TRK-#####')),
            'status' => $this->faker->randomElement(['pending', 'in_transit', 'delivered', 'cancelled']),
            'type' => $this->faker->randomElement(['standard', 'express', 'same_day']),
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->safeEmail(),
            'customer_phone' => $this->faker->phoneNumber(),
            'pickup_address' => $this->faker->address(),
            'dropoff_address' => $this->faker->address(),
            'expected_date' => $this->faker->dateTimeBetween('now', '+10 days'),
            'delivered_at' => $this->faker->optional()->dateTimeBetween('-5 days', 'now'),
        ];
    }
}
