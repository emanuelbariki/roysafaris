<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DriverType>
 */
class DriverTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Safari Driver', 'Transfer Driver', 'VIP Driver', 'Tour Guide', 'Private Chauffeur'];

        return [
            'name' => fake()->unique()->randomElement($types),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
