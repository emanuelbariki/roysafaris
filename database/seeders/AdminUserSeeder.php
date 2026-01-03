<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Adjust this if your User model is in a different namespace

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or get the Admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Give the Admin role all permissions
//        $adminRole->syncPermissions(Permission::all());

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'], // Change as needed
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Change for production
                'email_verified_at' => now(),
                'role_id' => $adminRole->id,
            ]
        );

        // Assign role to the user
        // $admin->assignRole($adminRole);
    }
}
