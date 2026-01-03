<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\SystemModule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        Role::query()->create([
            'name' => 'admin',
            'description' => 'web'
        ]);


        $modules = [
            'Dashboard' => [
                ['ability' => 'view::dashboard', 'name' => 'View Dashboard'],
                ['ability' => 'dashboard::access', 'name' => 'Access Dashboard'],
            ],
            'Users' => [
                ['ability' => 'create::user', 'name' => 'Create User'],
                ['ability' => 'edit::user', 'name' => 'Edit User'],
                ['ability' => 'delete::user', 'name' => 'Delete User'],
                ['ability' => 'view::user', 'name' => 'View User'],
                ['ability' => 'user::manage', 'name' => 'Manage User'],
            ],
            'Roles' => [
                ['ability' => 'create::role', 'name' => 'Create Role'],
                ['ability' => 'edit::role', 'name' => 'Edit Role'],
                ['ability' => 'delete::role', 'name' => 'Delete Role'],
                ['ability' => 'view::role', 'name' => 'View Role'],
                ['ability' => 'role::manage', 'name' => 'Manage Role'],
            ],
            'Permissions' => [
                ['ability' => 'create::permission', 'name' => 'Create Permission'],
                ['ability' => 'edit::permission', 'name' => 'Edit Permission'],
                ['ability' => 'delete::permission', 'name' => 'Delete Permission'],
                ['ability' => 'view::permission', 'name' => 'View Permission'],
                ['ability' => 'permission::manage', 'name' => 'Manage Permission'],
            ],
        ];

        try {
            DB::beginTransaction();
            foreach ($modules as $moduleName => $permissions) {
                $module = SystemModule::query()->firstOrCreate(
                    [
                        'slug' => strtolower(str_replace(' ', '-', $moduleName))
                    ]
                );

                // Seed permissions for this module
                foreach ($permissions as $permission) {
                    Permission::query()->updateOrCreate(
                        [
                            'ability' => $permission['ability'],
                            'system_module_id' => $module->id,
                        ],
                        [
                            'description' => $permission['name'],
                        ]
                    );
                }
            }

            $permission_ids = Permission::pluck('id');
            $superadmin = Role::query()->where('name', 'admin')->first();
            $superadmin?->permissions()->sync($permission_ids);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Error seeding permissions: ' . $e->getMessage());
        }
    }
}
