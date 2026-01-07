<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activities = [
            'Game Drive Safari',
            'Mountain Hiking',
            'Cultural Tour',
            'Bird Watching',
            'Hot Air Balloon',
            'Boat Safari',
            'Walking Safari',
            'Photography Tour',
        ];

        $name = fake()->unique()->randomElement($activities);
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $endDate = fake()->dateTimeBetween($startDate, '+1 week');

        return [
            'activity_code' => fake()->unique()->numerify('ACT-####'),
            'name' => $name,
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 50, 500),
            'location' => fake()->city().', '.fake()->country(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
    }
}
