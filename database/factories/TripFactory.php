<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Fleet;
use App\Models\TripType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+30 days');
        $endDate = fake()->dateTimeBetween($startDate, '+7 days');

        return [
            'trip_type_id' => TripType::factory(),
            'driver_id' => Driver::factory(),
            'fleet_id' => Fleet::factory(),
            'no_passengers' => fake()->numberBetween(1, 25),
            'trip_name' => fake()->sentence(3).' Trip',
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'trip_status' => fake()->randomElement(['Scheduled', 'Ongoing', 'Completed']),
            'status' => fake()->randomElement(['active', 'inactive']),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
