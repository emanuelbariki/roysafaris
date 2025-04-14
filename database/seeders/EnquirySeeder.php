<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\User;

class EnquirySeeder extends Seeder
{
    public function run()
    {
        $countryTZ = Country::where('code', 'TZ')->first()->id;
        $countryKE = Country::where('code', 'KE')->first()->id;
    
        $user1 = User::first()->id; // Assuming the first user is the file owner
        $user2 = User::skip(1)->first()->id;
    
        DB::table('enquiries')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                'mobile' => '0987654321',
                'country_id' => $countryTZ,
                'address' => '123 Main St',
                'city' => 'Anytown',
                'postal_code' => '12345',
                'arrival_date' => '2024-01-20',
                'departure_date' => '2024-01-27',
                'flexible_dates' => 'yes',
                'adults' => 2,
                'children' => 1,
                'infants' => 0,
                'juniors' => 0,
                'special_interests' => 'Wildlife photography',
                'budget_range' => '2000-3000',
                'referral_source' => 'google',
                'comments' => 'Looking forward to the safari!',
                'status' => 'enquiry',
                'user_id' => $user1,
                'draft' => false,
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '2345678901',
                'mobile' => '1098765432',
                'country_id' => $countryKE,
                'address' => '456 High St',
                'city' => 'Othertown',
                'postal_code' => '54321',
                'arrival_date' => '2024-02-15',
                'departure_date' => '2024-02-22',
                'flexible_dates' => 'no',
                'adults' => 1,
                'children' => 2,
                'infants' => 1,
                'juniors' => 0,
                'special_interests' => 'Bird watching',
                'budget_range' => '3000-5000',
                'referral_source' => 'social',
                'comments' => 'Please provide more details about the accommodations.',
                'status' => 'enquiry',
                'user_id' => $user2,
                'draft' => true,
            ],
        ]);
    }
}