<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Adjust this if your User model is in a different namespace
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or get the Admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Give the Admin role all permissions
        $adminRole->syncPermissions(Permission::all());

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'], // Change as needed
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Change for production
            ]
        );

        // Assign role to the user
        $admin->assignRole($adminRole);
    }
}
