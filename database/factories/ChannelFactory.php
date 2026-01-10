<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $channels = [
            ['name' => 'Direct Booking', 'code' => 'DIRECT'],
            ['name' => 'Online Travel Agency', 'code' => 'OTA'],
            ['name' => 'Travel Agent', 'code' => 'TA'],
            ['name' => 'Tour Operator', 'code' => 'TO'],
            ['name' => 'Corporate', 'code' => 'CORP'],
            ['name' => 'Wholesale', 'code' => 'WHOLE'],
            ['name' => 'Referral', 'code' => 'REF'],
        ];

        $channel = fake()->unique()->randomElement($channels);

        return [
            'name' => $channel['name'] . ' ' . fake()->randomNumber(4),
            'code' => $channel['code'],
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
