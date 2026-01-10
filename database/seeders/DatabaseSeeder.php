<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Core data
        $this->call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            CountriesSeeder::class,

            // Master data (no dependencies)
            ChannelSeeder::class,
            CurrencySeeder::class,

            // Geography-dependent
            PickupDropoffPointSeeder::class,

            // Mountains and routes
            MountainSeeder::class,
            MountainRouteSeeder::class,

            // Accommodation-related
            HotelChainSeeder::class,
            AccommodationSeeder::class,

            // Bookings (depends on channels)
            BookingSeeder::class,

            // Other seeders
            RoomSeeder::class,
            FleetActivitySeeder::class,
            // EnquirySeeder::class, // Commented out - requires more users
        ]);
    }
}
