<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $currencies = [
            ['name' => 'US Dollar', 'code' => 'USD', 'base' => 'yes', 'rate' => '1.00'],
            ['name' => 'Euro', 'code' => 'EUR', 'base' => 'no', 'rate' => '0.92'],
            ['name' => 'British Pound', 'code' => 'GBP', 'base' => 'no', 'rate' => '0.79'],
            ['name' => 'Tanzanian Shilling', 'code' => 'TZS', 'base' => 'no', 'rate' => '2500.00'],
            ['name' => 'Kenyan Shilling', 'code' => 'KES', 'base' => 'no', 'rate' => '153.00'],
            ['name' => 'Ugandan Shilling', 'code' => 'UGX', 'base' => 'no', 'rate' => '3800.00'],
            ['name' => 'Rwandan Franc', 'code' => 'RWF', 'base' => 'no', 'rate' => '1250.00'],
        ];

        $currency = fake()->unique()->randomElement($currencies);

        return [
            'name' => $currency['name'],
            'code' => $currency['code'],
            'base' => $currency['base'],
            'rate' => $currency['rate'],
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
