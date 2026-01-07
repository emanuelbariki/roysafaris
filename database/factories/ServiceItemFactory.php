<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceItem>
 */
class ServiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Lunch Boxes',
                'Breakfast Boxes',
                'Dinner Boxes',
                'Snack Packs',
                'Bottled Water',
                'Soft Drinks',
                'Picnic Hampers',
                'BBQ Equipment',
                'Camping Gear',
                'Sleeping Bags',
                'Tents',
                'Folding Chairs',
                'Cool Boxes',
                'First Aid Kit',
                'Binoculars',
                'Camera Tripod',
                'Flashlight',
                'Sunscreen',
                'Insect Repellent',
                'Hiking Poles',
            ]),
            'category' => fake()->randomElement(['food', 'gear', 'essentials']),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
