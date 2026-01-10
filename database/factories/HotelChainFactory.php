<?php

namespace Database\Factories;

use App\Models\HotelChain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<HotelChain>
 */
class HotelChainFactory extends Factory
{
    protected $model = HotelChain::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'code' => fake()->unique()->bothify('HC####'),
            'email' => fake()->optional()->companyEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'bank_name' => fake()->optional()->randomElement([
                'CRDB Bank Plc',
                'NMB Bank Plc',
                'NBC Limited',
                'Stanbic Bank',
                'KCB Bank Tanzania',
            ]),
            'bank_no' => fake()->optional()->bankAccountNumber(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
