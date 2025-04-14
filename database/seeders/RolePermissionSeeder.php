<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'create user',
            'edit user',
            'delete user',
            'view user',
            'assign roles',

            'view tour',
            'create tour',
            'edit tour',
            'delete tour',
            'publish/unpublish packages',

            'view bookings',
            'create bookings',
            'edit bookings',
            'cancel bookings',
            'confirm bookings',

            'view vehicles',
            'add vehicle',
            'assign vehicle to tour',

            'view guides/drivers',
            'assign guide/driver to tour',
            'update guide/driver availability',

            'view payments',
            'confirm payments',
            'issue refunds',
            'generate invoice',
            'view reports',

            'view inquiries',
            'reply inquiries',

            'manage settings',
            'manage permissions',
            'manage roles',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role: Admin (All permissions)
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(Permission::all());

        // Role: Tourist
        $tourist = Role::firstOrCreate(['name' => 'Tourist']);
        $tourist->syncPermissions([
            'view tour',
            'create bookings',
            'view bookings',
            'cancel bookings',
            'view payments',
            'view inquiries',
            'reply inquiries',
        ]);

        // Role: Manager
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->syncPermissions([
            'view user',
            'view tour',
            'create tour',
            'edit tour',
            'delete tour',
            'publish/unpublish packages',
            'view bookings',
            'confirm bookings',
            'view vehicles',
            'add vehicle',
            'assign vehicle to tour',
            'view guides/drivers',
            'assign guide/driver to tour',
            'update guide/driver availability',
            'view payments',
            'view reports',
        ]);

        // Role: Driver
        $driver = Role::firstOrCreate(['name' => 'Driver']);
        $driver->syncPermissions([
            'view vehicles',
            'view tour',
            'view bookings',
        ]);

        // Role: Customer Support
        $support = Role::firstOrCreate(['name' => 'Customer Support']);
        $support->syncPermissions([
            'view user',
            'view bookings',
            'edit bookings',
            'cancel bookings',
            'view inquiries',
            'reply inquiries',
        ]);

        // Role: Accountant
        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $accountant->syncPermissions([
            'view payments',
            'confirm payments',
            'issue refunds',
            'generate invoice',
            'view reports',
        ]);
    }
}
