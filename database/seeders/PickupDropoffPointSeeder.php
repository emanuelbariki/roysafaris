<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PickupDropoffPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Clear existing data (optional)
         DB::table('pickup_dropoff_points')->truncate();

         // Define sample location records
         $locations = [
             // Airports
             [
                 'name'            => 'Julius Nyerere International Airport',
                 'code'            => 'DAR',
                 'country_id'      => 1,
                 'city_id'         => null,
                 'cordinates'      => '-6.8781,39.2026',
                 'status'          => 'active',
                 'transport_mode'  => 'air',
                 'created_at'      => now(),
                 'updated_at'      => now(),
             ],
             [
                 'name'            => 'Kilimanjaro International Airport',
                 'code'            => 'JRO',
                 'country_id'      => 1,
                 'city_id'         => null,
                 'cordinates'      => '-3.4294,37.0745',
                 'status'          => 'active',
                 'transport_mode'  => 'air',
                 'created_at'      => now(),
                 'updated_at'      => now(),
             ],
             [
                 'name'            => 'Abeid Amani Karume International Airport',
                 'code'            => 'ZNZ',
                 'country_id'      => 1,
                 'city_id'         => null,
                 'cordinates'      => '-6.2220,39.2249',
                 'status'          => 'active',
                 'transport_mode'  => 'air',
                 'created_at'      => now(),
                 'updated_at'      => now(),
             ],

             // Land Border Crossings
             [
                 'name'            => 'Namanga Border Post',
                 'code'            => 'NMB',
                 'country_id'      => 1,
                 'city_id'         => null,
                 'cordinates'      => '-2.5389,36.7833',
                 'status'          => 'active',
                 'transport_mode'  => 'land',
                 'created_at'      => now(),
                 'updated_at'      => now(),
             ],
             [
                 'name'            => 'Holili Border Post',
                 'code'            => 'HLB',
                 'country_id'      => 1,
                 'city_id'         => null,
                 'cordinates'      => '-3.4016,37.5450',
                 'status'          => 'active',
                 'transport_mode'  => 'land',
                 'created_at'      => now(),
                 'updated_at'      => now(),
             ],
             [
                 'name'            => 'Kasumulu Border Post',
                 'code'            => 'KSB',
                 'country_id'      => 1,
                 'city_id'         => null,
                 'cordinates'      => '-9.6769,33.0260',
                 'status'          => 'active',
                 'transport_mode'  => 'land',
                 'created_at'      => now(),
                 'updated_at'      => now(),
             ],
         ];
 
         // Insert the data into the database
         DB::table('pickup_dropoff_points')->insert($locations);
    }
}
