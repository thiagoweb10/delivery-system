<?php

namespace Database\Factories;

use App\Models\DeliveryStatus;
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
        $fakerBR = \Faker\Factory::create('pt_BR');

        return [
            'tracking_code' => strtoupper($this->faker->bothify('TRK-#####')),
            'order_id' => random_int(100000, 999999),
            'delivery_status_id' => DeliveryStatus::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement(['standard', 'express', 'same_day']),
            'pickup_address' => $fakerBR->address(),
            'delivery_address' => $fakerBR->address(),
            'notes' => $this->faker->dateTimeBetween('now', '+10 days'),
            'delivered_at' => $this->faker->optional()->dateTimeBetween('-5 days', 'now'),
        ];
    }
}
