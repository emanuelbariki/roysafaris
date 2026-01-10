<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PickupDropoffPoint>
 */
class PickupDropoffPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Airport', 'City Center', 'Hotel District', 'Bus Station', 'Train Station']) . ' - ' . fake()->city(),
            'code' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'country_id' => fake()->numberBetween(1, 100),
            'city_id' => fake()->numberBetween(1, 50),
            'cordinates' => fake()->latitude() . ',' . fake()->longitude(),
            'transport_mode' => fake()->randomElement(['road', 'air', 'rail']),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
