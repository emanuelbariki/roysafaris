<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get channels
        $direct = Channel::where('code', 'DIRECT')->first();
        $ota = Channel::where('code', 'OTA')->first();
        $ta = Channel::where('code', 'TA')->first();

        if (!$direct || !$ota || !$ta) {
            $this->command->warn('Channels not found. Please run ChannelSeeder first.');
            return;
        }

        $bookings = [
            [
                'ref' => 'REF-2024-001',
                'group_name' => 'Smith Family Safari',
                'nationality' => 'US',
                'remarks' => 'Celebrating 25th anniversary',
                'file_owner' => '1',
                'channel_id' => $direct->id,
                'agent_code' => '001',
                'booking_code' => '001/01/2024',
                'arrival_date' => now()->addDays(30)->format('Y-m-d H:i:s'),
                'departure_date' => now()->addDays(37)->format('Y-m-d H:i:s'),
                'pickup_details' => 'Airport pickup required',
                'drop_details' => 'Airport drop off',
                'adults' => 2,
                'children' => 2,
                'infants' => 0,
                'rooms' => 2,
                'services' => json_encode(['accommodation', 'transfers', 'balloon']),
                'notes' => 'Vegetarian meals required',
            ],
            [
                'ref' => 'REF-2024-002',
                'group_name' => 'Müller Group',
                'nationality' => 'DE',
                'remarks' => 'Honeymoon couple',
                'file_owner' => '1',
                'channel_id' => $ota->id,
                'agent_code' => '002',
                'booking_code' => '002/01/2024',
                'arrival_date' => now()->addDays(45)->format('Y-m-d H:i:s'),
                'departure_date' => now()->addDays(52)->format('Y-m-d H:i:s'),
                'pickup_details' => 'Hotel pickup',
                'drop_details' => 'Hotel drop off',
                'adults' => 2,
                'children' => 0,
                'infants' => 0,
                'rooms' => 1,
                'services' => json_encode(['accommodation', 'flight', 'mountain']),
                'notes' => 'German speaking guide required',
            ],
            [
                'ref' => 'REF-2024-003',
                'group_name' => 'Tanaka Corporate Retreat',
                'nationality' => 'JP',
                'remarks' => 'Corporate team building',
                'file_owner' => '1',
                'channel_id' => $ta->id,
                'agent_code' => '003',
                'booking_code' => '003/01/2024',
                'arrival_date' => now()->addDays(60)->format('Y-m-d H:i:s'),
                'departure_date' => now()->addDays(67)->format('Y-m-d H:i:s'),
                'pickup_details' => 'Airport - group transfer',
                'drop_details' => 'Airport - group transfer',
                'adults' => 8,
                'children' => 0,
                'infants' => 0,
                'rooms' => 4,
                'services' => json_encode(['accommodation', 'transfers', 'activities', 'restaurant']),
                'notes' => 'Special dietary requirements for 2 members',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::firstOrCreate(
                ['ref' => $booking['ref']],
                $booking
            );
        }
    }
}
