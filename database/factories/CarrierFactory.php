<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrier>
 */
class CarrierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carrierTypes = ['Tour Operator', 'Travel Agency', 'Safari Company', 'Transport Provider', 'Charter Service'];

        return [
            'name' => fake()->company(),
            'carrier_type' => fake()->randomElement($carrierTypes),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'city_id' => fake()->numberBetween(1, 50),
            'country_id' => fake()->numberBetween(1, 50),
            'voucher_copies' => 3,
            'stauts' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
