<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arrivalDate = fake()->dateTimeBetween('+1 day', '+1 month');
        $departureDate = (clone $arrivalDate)->modify('+'.fake()->numberBetween(1, 7).' days');

        // Get all nationality enum values
        $nationalityValues = array_column(\App\Enums\Nationality::cases(), 'value');

        return [
            'ref' => 'REF-' . fake()->unique()->numberBetween(1000, 9999),
            'group_name' => fake()->company() . ' Group',
            'nationality' => fake()->randomElement($nationalityValues),
            'remarks' => fake()->sentence(),
            'file_owner' => (string) fake()->randomNumber(3),
            'channel_id' => \App\Models\Channel::factory(),
            'agent_code' => (string) fake()->randomNumber(3),
            'booking_code' => str_pad(fake()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT) . '/' . now()->format('m/Y'),
            'arrival_date' => $arrivalDate->format('Y-m-d H:i:s'),
            'pickup_details' => (string) fake()->randomNumber(3),
            'departure_date' => $departureDate->format('Y-m-d H:i:s'),
            'drop_details' => (string) fake()->randomNumber(3),
            'adults' => fake()->numberBetween(1, 10),
            'children' => fake()->numberBetween(0, 5),
            'infants' => fake()->numberBetween(0, 3),
            'rooms' => fake()->numberBetween(1, 5),
            'services' => json_encode(fake()->randomElements(['accommodation', 'flight', 'transfers', 'restaurant', 'balloon', 'mountain', 'vehicle hire', 'activities'], fake()->numberBetween(1, 4))),
            'notes' => fake()->paragraph(),
        ];
    }
}
