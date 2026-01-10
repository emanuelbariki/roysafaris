<?php

namespace Database\Seeders;

use App\Models\HotelChain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelChainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chains = [
            [
                'name' => 'Elewana Collection',
                'code' => 'ELEWANA',
                'email' => 'reservations@elewana.com',
                'phone' => '+255 768 980 000',
                'bank_name' => 'CRDB Bank Plc',
                'bank_no' => '0150123456789',
                'status' => 'active',
            ],
            [
                'name' => 'Serena Hotels',
                'code' => 'SERENA',
                'email' => 'bookings@serenahotels.com',
                'phone' => '+255 768 980 012',
                'bank_name' => 'NMB Bank Plc',
                'bank_no' => '0210123456789',
                'status' => 'active',
            ],
            [
                'name' => 'AndBeyond',
                'code' => 'ANDBEYOND',
                'email' => 'reservations@andbeyond.com',
                'phone' => '+255 768 980 034',
                'bank_name' => 'Stanbic Bank',
                'bank_no' => '0310123456789',
                'status' => 'active',
            ],
            [
                'name' => 'Asilia Africa',
                'code' => 'ASILIA',
                'email' => 'bookings@asiliaafrica.com',
                'phone' => '+255 768 980 056',
                'bank_name' => 'KCB Bank Tanzania',
                'bank_no' => '0410123456789',
                'status' => 'active',
            ],
            [
                'name' => 'Nomad Tanzania',
                'code' => 'NOMAD',
                'email' => 'info@nomadtanzania.com',
                'phone' => '+255 768 980 078',
                'bank_name' => 'NBC Limited',
                'bank_no' => '0510123456789',
                'status' => 'active',
            ],
        ];

        foreach ($chains as $chain) {
            HotelChain::firstOrCreate(
                ['code' => $chain['code']],
                [
                    'name' => $chain['name'],
                    'email' => $chain['email'],
                    'phone' => $chain['phone'],
                    'bank_name' => $chain['bank_name'],
                    'bank_no' => $chain['bank_no'],
                    'status' => $chain['status'],
                ]
            );
        }
    }
}
