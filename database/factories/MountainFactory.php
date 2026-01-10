<?php

namespace Database\Factories;

use App\Models\Mountain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Mountain>
 */
class MountainFactory extends Factory
{
    protected $model = Mountain::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $mountains = [
            'Mount Kilimanjaro',
            'Mount Meru',
            'Mount Ol Doinyo Lengai',
            'Mount Rungwe',
            'Mount Hanang',
            'Mount Kitumbeine',
        ];

        return [
            'name' => fake()->unique()->randomElement($mountains) . ' ' . fake()->randomNumber(4),
            'code' => fake()->unique()->bothify('MT####'),
            'country_id' => 'TZ', // Tanzania
            'city_id' => fake()->randomElement(['ARU', 'JRO', 'DAR', 'MWA']),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
