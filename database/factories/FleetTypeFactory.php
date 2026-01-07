<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FleetType>
 */
class FleetTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Safari Vehicle', 'Transfer Van', 'Luxury Coach', '4x4 Land Cruiser', 'Mini Bus', 'Sedan'];

        return [
            'name' => fake()->unique()->randomElement($types),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
