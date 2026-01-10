<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channels = [
            ['name' => 'Direct Booking', 'code' => 'DIRECT', 'status' => 'active'],
            ['name' => 'Online Travel Agency', 'code' => 'OTA', 'status' => 'active'],
            ['name' => 'Travel Agent', 'code' => 'TA', 'status' => 'active'],
            ['name' => 'Tour Operator', 'code' => 'TO', 'status' => 'active'],
            ['name' => 'Corporate', 'code' => 'CORP', 'status' => 'active'],
            ['name' => 'Wholesale', 'code' => 'WHOLE', 'status' => 'active'],
            ['name' => 'Referral', 'code' => 'REF', 'status' => 'active'],
        ];

        foreach ($channels as $channel) {
            Channel::firstOrCreate(
                ['code' => $channel['code']],
                [
                    'name' => $channel['name'],
                    'status' => $channel['status'],
                ]
            );
        }
    }
}
