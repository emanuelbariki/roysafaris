<?php

namespace Database\Factories;

use App\Models\FleetClass;
use App\Models\FleetType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fleet>
 */
class FleetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $makes = ['Toyota', 'Land Rover', 'Mercedes-Benz', 'Ford', 'Nissan', 'Volkswagen'];
        $models = ['Land Cruiser', 'Defender', 'Sprinter', 'Transit', 'Patrol', 'Crafter'];

        return [
            'reg_no' => fake()->unique()->numerify('REG-###-###'),
            'fleet_type_id' => FleetType::factory(),
            'fleet_class_id' => FleetClass::factory(),
            'seats' => fake()->numberBetween(4, 25),
            'fleet_status' => fake()->randomElement(['available', 'in-use', 'maintenance', 'retired']),
            'purchase_date' => fake()->date(),
            'mileage' => fake()->numberBetween(1000, 150000),
            'status' => fake()->randomElement(['active', 'inactive']),
            'make_model' => fake()->randomElement($makes).' '.fake()->randomElement($models),
        ];
    }
}
