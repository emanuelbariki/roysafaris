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
    /**
     * @return void
     * @throws Throwable
     */
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
            'System Modules' => [
                ['ability' => 'create::module', 'name' => 'Create Module'],
                ['ability' => 'edit::module', 'name' => 'Edit Module'],
                ['ability' => 'delete::module', 'name' => 'Delete Module'],
                ['ability' => 'view::module', 'name' => 'View Module'],
            ],
            'Bookings' => [
                ['ability' => 'view::booking', 'name' => 'View Bookings'],
                ['ability' => 'create::booking', 'name' => 'Create Booking'],
                ['ability' => 'edit::booking', 'name' => 'Edit Booking'],
                ['ability' => 'delete::booking', 'name' => 'Delete Booking'],
            ],
            'Reservations' => [
                ['ability' => 'view::reservation', 'name' => 'View Reservations'],
                ['ability' => 'create::reservation', 'name' => 'Create Reservation'],
                ['ability' => 'edit::reservation', 'name' => 'Edit Reservation'],
                ['ability' => 'delete::reservation', 'name' => 'Delete Reservation'],
            ],
            'Lodges' => [
                ['ability' => 'view::lodge', 'name' => 'View Lodges'],
                ['ability' => 'create::lodge', 'name' => 'Create Lodge'],
                ['ability' => 'edit::lodge', 'name' => 'Edit Lodge'],
                ['ability' => 'delete::lodge', 'name' => 'Delete Lodge'],
            ],
            'Activities' => [
                ['ability' => 'view::activity', 'name' => 'View Activities'],
                ['ability' => 'create::activity', 'name' => 'Create Activity'],
                ['ability' => 'edit::activity', 'name' => 'Edit Activity'],
                ['ability' => 'delete::activity', 'name' => 'Delete Activity'],
            ],
            'Fleets' => [
                ['ability' => 'view::fleet', 'name' => 'View Fleets'],
                ['ability' => 'create::fleet', 'name' => 'Create Fleet'],
                ['ability' => 'edit::fleet', 'name' => 'Edit Fleet'],
                ['ability' => 'delete::fleet', 'name' => 'Delete Fleet'],
            ],
            'Drivers' => [
                ['ability' => 'view::driver', 'name' => 'View Drivers'],
                ['ability' => 'create::driver', 'name' => 'Create Driver'],
                ['ability' => 'edit::driver', 'name' => 'Edit Driver'],
                ['ability' => 'delete::driver', 'name' => 'Delete Driver'],
            ],
            'Enquiries' => [
                ['ability' => 'view::enquiry', 'name' => 'View Enquiries'],
                ['ability' => 'create::enquiry', 'name' => 'Create Enquiry'],
                ['ability' => 'edit::enquiry', 'name' => 'Edit Enquiry'],
                ['ability' => 'delete::enquiry', 'name' => 'Delete Enquiry'],
            ],
            'Agents' => [
                ['ability' => 'view::agent', 'name' => 'View Agents'],
                ['ability' => 'create::agent', 'name' => 'Create Agent'],
                ['ability' => 'edit::agent', 'name' => 'Edit Agent'],
                ['ability' => 'delete::agent', 'name' => 'Delete Agent'],
            ],
            'Currencies' => [
                ['ability' => 'view::currency', 'name' => 'View Currencies'],
                ['ability' => 'create::currency', 'name' => 'Create Currency'],
                ['ability' => 'edit::currency', 'name' => 'Edit Currency'],
                ['ability' => 'delete::currency', 'name' => 'Delete Currency'],
            ],
            'Channels' => [
                ['ability' => 'view::channel', 'name' => 'View Channels'],
                ['ability' => 'create::channel', 'name' => 'Create Channel'],
                ['ability' => 'edit::channel', 'name' => 'Edit Channel'],
                ['ability' => 'delete::channel', 'name' => 'Delete Channel'],
            ],
            'Service Providers' => [
                ['ability' => 'view::service_provider', 'name' => 'View Service Providers'],
                ['ability' => 'create::service_provider', 'name' => 'Create Service Provider'],
                ['ability' => 'edit::service_provider', 'name' => 'Edit Service Provider'],
                ['ability' => 'delete::service_provider', 'name' => 'Delete Service Provider'],
            ],
            'Service Items' => [
                ['ability' => 'view::service_item', 'name' => 'View Service Items'],
                ['ability' => 'create::service_item', 'name' => 'Create Service Item'],
                ['ability' => 'edit::service_item', 'name' => 'Edit Service Item'],
                ['ability' => 'delete::service_item', 'name' => 'Delete Service Item'],
            ],
            'Accommodations' => [
                ['ability' => 'view::accommodation', 'name' => 'View Accommodations'],
                ['ability' => 'create::accommodation', 'name' => 'Create Accommodation'],
                ['ability' => 'edit::accommodation', 'name' => 'Edit Accommodation'],
                ['ability' => 'delete::accommodation', 'name' => 'Delete Accommodation'],
            ],
            'Hotel Chain' => [
                ['ability' => 'view::hotelchain', 'name' => 'View Hotel Chain'],
                ['ability' => 'create::hotelchain', 'name' => 'Create Hotel Chain'],
                ['ability' => 'edit::hotelchain', 'name' => 'Edit Hotel Chain'],
                ['ability' => 'delete::hotelchain', 'name' => 'Delete Hotel Chain'],
            ],
            'Mountains' => [
                ['ability' => 'view::mountain', 'name' => 'View Mountains'],
                ['ability' => 'create::mountain', 'name' => 'Create Mountains'],
                ['ability' => 'edit::mountain', 'name' => 'Edit Mountains'],
                ['ability' => 'delete::mountain', 'name' => 'Delete Mountains'],
            ],
            'Mountain Routes' => [
                ['ability' => 'view::mountainroute', 'name' => 'View Mountain routes'],
                ['ability' => 'create::mountainroute', 'name' => 'Create Mountain route'],
                ['ability' => 'edit::mountainroute', 'name' => 'Edit Mountain route'],
                ['ability' => 'delete::mountainroute', 'name' => 'Delete Mountain route'],
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
