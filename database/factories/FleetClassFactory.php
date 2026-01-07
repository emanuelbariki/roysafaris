<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FleetClass>
 */
class FleetClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classes = ['Economy', 'Business', 'First Class', 'VIP', 'Luxury', 'Standard'];

        return [
            'name' => fake()->unique()->randomElement($classes),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
