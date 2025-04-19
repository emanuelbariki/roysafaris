<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = [
            'A', 'AC', 'AJ', 'C', 'J', 'CJ',
            'AA', 'ACC', 'AAJ', 'CC', 'JJ', 'CCJ',
            'AAA', 'ACC', 'AJJ', 'CCC', 'JJJ', 'CJJ'
        ];
        $name = [
            'single', 'double', 'tripplet', 
            'single', 'double', 'tripplet',
            'single', 'double', 'tripplet',
            'single', 'double', 'tripplet', 
            'single', 'double', 'tripplet',
            'single', 'double', 'tripplet',

        ];
        $i = 0;
        foreach ($roomTypes as $type) {
            DB::table('rooms')->insert([
                'name'   => $name[$i],
                'room_type'   => $type,
                'total_rooms' => rand(5, 20),        // Example: 5 to 20 rooms
                'total_pax'   => rand(1, 6),          // Example: max 6 pax
                'price'       => rand(5000, 20000),   // Example: 5000 to 20000
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
            $i++;
        }
    }
}