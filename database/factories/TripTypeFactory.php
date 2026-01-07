<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripType>
 */
class TripTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Safari Package',
            'Adventure Tour',
            'Cultural Experience',
            'Beach Holiday',
            'Mountain Expedition',
            'Wildlife Photography',
            'Bird Watching',
            'Hiking Safari',
            'Camping Trip',
            'Luxury Safari',
        ];

        return [
            'name' => fake()->unique()->randomElement($types),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
