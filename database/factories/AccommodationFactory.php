<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\HotelChain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Accommodation>
 */
class AccommodationFactory extends Factory
{
    protected $model = Accommodation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->randomElement(['Lodge', 'Hotel', 'Camp', 'Resort']),
            'code' => fake()->unique()->bothify('ACC####'),
            'hotel_chain_id' => HotelChain::factory(),
            'accommodations_type_id' => AccommodationType::factory(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'country' => fake()->randomElement(['Tanzania', 'Kenya', 'Uganda', 'Rwanda']),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'camping_logistics' => fake()->paragraph(),
            'balloon_pickup' => fake()->randomElement(['Yes', 'No', 'Upon Request']),
            'voucher_copies' => (string)fake()->numberBetween(1, 5),
            'pay_to' => fake()->randomElement(['hotel', 'chain']),
            'billing_ccy' => fake()->randomElement(['USD', 'EUR', 'TZS', 'KES']),
            'coordinates' => fake()->latitude() . ',' . fake()->longitude(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
