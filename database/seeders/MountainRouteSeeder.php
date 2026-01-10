<?php

namespace Database\Seeders;

use App\Models\Mountain;
use App\Models\MountainRoute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MountainRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Mount Kilimanjaro
        $kilimanjaro = Mountain::where('code', 'KILI')->first();
        if (!$kilimanjaro) {
            $this->command->warn('Mount Kilimanjaro not found. Please run MountainSeeder first.');
            return;
        }

        $routes = [
            [
                'name' => 'Marangu Route',
                'code' => 'MARANGU',
                'description' => 'The most popular and easiest route up Kilimanjaro, often called the "Coca-Cola Route".',
                'mountain_id' => $kilimanjaro->id,
                'min_days' => '5',
                'max_days' => '6',
                'status' => 'active',
            ],
            [
                'name' => 'Machame Route',
                'code' => 'MACHAME',
                'description' => 'A scenic and challenging route, often called the "Whiskey Route".',
                'mountain_id' => $kilimanjaro->id,
                'min_days' => '6',
                'max_days' => '7',
                'status' => 'active',
            ],
            [
                'name' => 'Lemosho Route',
                'code' => 'LEMOSHO',
                'description' => 'A beautiful, remote and less-traveled route with high success rates.',
                'mountain_id' => $kilimanjaro->id,
                'min_days' => '7',
                'max_days' => '8',
                'status' => 'active',
            ],
            [
                'name' => 'Rongai Route',
                'code' => 'RONGAI',
                'description' => 'The only route that approaches from the north, near the Kenyan border.',
                'mountain_id' => $kilimanjaro->id,
                'min_days' => '6',
                'max_days' => '7',
                'status' => 'active',
            ],
            [
                'name' => 'Northern Circuit',
                'code' => 'NORTHERN',
                'description' => 'The longest route with fantastic views and high success rates.',
                'mountain_id' => $kilimanjaro->id,
                'min_days' => '8',
                'max_days' => '9',
                'status' => 'active',
            ],
        ];

        foreach ($routes as $route) {
            MountainRoute::firstOrCreate(
                ['code' => $route['code']],
                [
                    'name' => $route['name'],
                    'description' => $route['description'],
                    'mountain_id' => $route['mountain_id'],
                    'min_days' => $route['min_days'],
                    'max_days' => $route['max_days'],
                    'status' => $route['status'],
                ]
            );
        }
    }
}
