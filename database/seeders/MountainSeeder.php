<?php

namespace Database\Seeders;

use App\Models\Mountain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MountainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mountains = [
            ['name' => 'Mount Kilimanjaro', 'code' => 'KILI', 'country_id' => 'TZ', 'city_id' => 'JRO', 'status' => 'active'],
            ['name' => 'Mount Meru', 'code' => 'MERU', 'country_id' => 'TZ', 'city_id' => 'ARU', 'status' => 'active'],
            ['name' => 'Mount Ol Doinyo Lengai', 'code' => 'LENGAI', 'country_id' => 'TZ', 'city_id' => 'ARU', 'status' => 'active'],
            ['name' => 'Mount Rungwe', 'code' => 'RUNGWE', 'country_id' => 'TZ', 'city_id' => 'MWA', 'status' => 'active'],
            ['name' => 'Mount Hanang', 'code' => 'HANANG', 'country_id' => 'TZ', 'city_id' => 'ARU', 'status' => 'active'],
        ];

        foreach ($mountains as $mountain) {
            Mountain::firstOrCreate(
                ['code' => $mountain['code']],
                [
                    'name' => $mountain['name'],
                    'country_id' => $mountain['country_id'],
                    'city_id' => $mountain['city_id'],
                    'status' => $mountain['status'],
                ]
            );
        }
    }
}
