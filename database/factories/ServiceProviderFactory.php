<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $providerTypes = ['Tour Operator', 'Hotel', 'Lodge', 'Transport Company', 'Safari Company', 'Restaurant'];
        $billToOptions = ['Client', 'Agent', 'Direct', 'Corporate'];

        return [
            'name' => fake()->company(),
            'type' => fake()->randomElement($providerTypes),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'address' => fake()->streetAddress(),
            'city_id' => fake()->numberBetween(1, 50),
            'country_id' => fake()->numberBetween(1, 50),
            'bill_to' => fake()->randomElement($billToOptions),
            'voucher_copies' => 3,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
