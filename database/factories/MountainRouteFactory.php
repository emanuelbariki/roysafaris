<?php

namespace Database\Factories;

use App\Models\Mountain;
use App\Models\MountainRoute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<MountainRoute>
 */
class MountainRouteFactory extends Factory
{
    protected $model = MountainRoute::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'code' => fake()->unique()->bothify('RT####'),
            'description' => fake()->paragraph(),
            'mountain_id' => Mountain::factory(),
            'min_days' => fake()->numberBetween(1, 5),
            'max_days' => fake()->numberBetween(6, 14),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
