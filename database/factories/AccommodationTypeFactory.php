<?php

namespace Database\Factories;

use App\Models\AccommodationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<AccommodationType>
 */
class AccommodationTypeFactory extends Factory
{
    protected $model = AccommodationType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $types = [
            'Luxury Lodge',
            'Tented Camp',
            'Budget Camp',
            'Hotel',
            'Resort',
            'Safari Lodge',
            'Permanent Tent',
            'Mobile Camp',
        ];

        return [
            'name' => fake()->unique()->randomElement($types) . ' ' . fake()->randomNumber(4),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
