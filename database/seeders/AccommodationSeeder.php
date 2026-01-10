<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\HotelChain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create accommodation types
        $lodgeType = AccommodationType::firstOrCreate(['name' => 'Luxury Lodge']);
        $campType = AccommodationType::firstOrCreate(['name' => 'Tented Camp']);

        // Get hotel chains
        $elewana = HotelChain::where('code', 'ELEWANA')->first();
        $serena = HotelChain::where('code', 'SERENA')->first();
        $andbeyond = HotelChain::where('code', 'ANDBEYOND')->first();
        $asilia = HotelChain::where('code', 'ASILIA')->first();
        $nomad = HotelChain::where('code', 'NOMAD')->first();

        $accommodations = [
            [
                'name' => 'The Manor at Ngorongoro',
                'code' => 'NMANOR',
                'hotel_chain_id' => $elewana?->id,
                'accommodations_type_id' => $lodgeType->id,
                'address' => 'Ngorongoro Conservation Area',
                'city' => 'Karatu',
                'country' => 'Tanzania',
                'phone' => '+255 784 333 000',
                'email' => 'manor@elewana.com',
                'website' => 'https://elewana.com/manor-at-ngorongoro',
                'balloon_pickup' => 'yes',
                'voucher_copies' => '3',
                'pay_to' => 'hotel',
                'billing_ccy' => 'USD',
                'coordinates' => '-3.1667, 35.6167',
                'status' => 'active',
            ],
            [
                'name' => 'Ngorongoro Serena Safari Lodge',
                'code' => 'NSERENA',
                'hotel_chain_id' => $serena?->id,
                'accommodations_type_id' => $lodgeType->id,
                'address' => 'Ngorongoro Crater Rim',
                'city' => 'Ngorongoro',
                'country' => 'Tanzania',
                'phone' => '+255 784 333 001',
                'email' => 'ngorongoro@serenahotels.com',
                'website' => 'https://serenahotels.com/ngorongoro',
                'balloon_pickup' => 'no',
                'voucher_copies' => '3',
                'pay_to' => 'hotel',
                'billing_ccy' => 'USD',
                'coordinates' => '-3.0833, 35.6167',
                'status' => 'active',
            ],
            [
                'name' => 'Ngorongoro Crater Lodge',
                'code' => 'NCRATER',
                'hotel_chain_id' => $andbeyond?->id,
                'accommodations_type_id' => $lodgeType->id,
                'address' => 'Ngorongoro Crater Rim',
                'city' => 'Ngorongoro',
                'country' => 'Tanzania',
                'phone' => '+255 784 333 002',
                'email' => 'ngorongoro@andbeyond.com',
                'website' => 'https://andbeyond.com/ngorongoro-crater-lodge',
                'balloon_pickup' => 'yes',
                'voucher_copies' => '3',
                'pay_to' => 'hotel',
                'billing_ccy' => 'USD',
                'coordinates' => '-3.0833, 35.6167',
                'status' => 'active',
            ],
            [
                'name' => 'Serengeti Under Canvas',
                'code' => 'SUC',
                'hotel_chain_id' => $andbeyond?->id,
                'accommodations_type_id' => $campType->id,
                'address' => 'Serengeti National Park',
                'city' => 'Serengeti',
                'country' => 'Tanzania',
                'phone' => '+255 784 333 003',
                'email' => 'undercanvas@andbeyond.com',
                'website' => 'https://andbeyond.com/serengeti-under-canvas',
                'balloon_pickup' => 'yes',
                'voucher_copies' => '3',
                'pay_to' => 'chain',
                'billing_ccy' => 'USD',
                'coordinates' => '-2.3333, 35.0000',
                'status' => 'active',
            ],
            [
                'name' => 'Sayari Camp',
                'code' => 'SAYARI',
                'hotel_chain_id' => $asilia?->id,
                'accommodations_type_id' => $campType->id,
                'address' => 'Northern Serengeti',
                'city' => 'Serengeti',
                'country' => 'Tanzania',
                'phone' => '+255 784 333 004',
                'email' => 'sayari@asiliaafrica.com',
                'website' => 'https://asiliaafrica.com/sayari',
                'balloon_pickup' => 'yes',
                'voucher_copies' => '3',
                'pay_to' => 'hotel',
                'billing_ccy' => 'USD',
                'coordinates' => '-1.9167, 35.0000',
                'status' => 'active',
            ],
        ];

        foreach ($accommodations as $accommodation) {
            Accommodation::firstOrCreate(
                ['code' => $accommodation['code']],
                $accommodation
            );
        }
    }
}
