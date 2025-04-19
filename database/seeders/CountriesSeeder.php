<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $countries = [
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Tanzania', 'code' => 'TZ'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'Nigeria', 'code' => 'NG'],
        ];

        DB::table('countries')->insert($countries);
    }
}
