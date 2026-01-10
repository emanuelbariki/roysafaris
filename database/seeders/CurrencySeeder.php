<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'US Dollar', 'code' => 'USD', 'base' => 'yes', 'rate' => '1.00', 'status' => 'active'],
            ['name' => 'Euro', 'code' => 'EUR', 'base' => 'no', 'rate' => '0.92', 'status' => 'active'],
            ['name' => 'British Pound', 'code' => 'GBP', 'base' => 'no', 'rate' => '0.79', 'status' => 'active'],
            ['name' => 'Tanzanian Shilling', 'code' => 'TZS', 'base' => 'no', 'rate' => '2500.00', 'status' => 'active'],
            ['name' => 'Kenyan Shilling', 'code' => 'KES', 'base' => 'no', 'rate' => '153.00', 'status' => 'active'],
            ['name' => 'Ugandan Shilling', 'code' => 'UGX', 'base' => 'no', 'rate' => '3800.00', 'status' => 'active'],
            ['name' => 'Rwandan Franc', 'code' => 'RWF', 'base' => 'no', 'rate' => '1250.00', 'status' => 'active'],
        ];

        foreach ($currencies as $currency) {
            Currency::firstOrCreate(
                ['code' => $currency['code']],
                [
                    'name' => $currency['name'],
                    'base' => $currency['base'],
                    'rate' => $currency['rate'],
                    'status' => $currency['status'],
                ]
            );
        }
    }
}
