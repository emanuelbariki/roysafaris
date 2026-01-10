<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use App\Models\SystemModule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_belongs_to_many_permissions(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission1 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);
        $permission2 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.create',
        ]);

        $role = Role::factory()->create();
        $role->permissions()->attach([$permission1->id, $permission2->id]);

        $this->assertCount(2, $role->permissions);
        $this->assertTrue($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));
    }

    public function test_role_has_many_users(): void
    {
        $role = Role::factory()->create(['name' => 'Admin']);

        $user1 = User::factory()->create(['role_id' => $role->id]);
        $user2 = User::factory()->create(['role_id' => $role->id]);

        $this->assertCount(2, $role->users);
        $this->assertTrue($role->users->contains($user1));
        $this->assertTrue($role->users->contains($user2));
    }

    public function test_sync_permissions_method(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission1 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);
        $permission2 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.create',
        ]);
        $permission3 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.edit',
        ]);

        $role = Role::factory()->create();
        $role->syncPermissions([$permission1->id, $permission2->id]);

        $this->assertCount(2, $role->permissions);
        $this->assertTrue($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));

        // Sync with different permissions
        $role->syncPermissions([$permission2->id, $permission3->id]);

        $role->refresh();
        $this->assertCount(2, $role->permissions);
        $this->assertFalse($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));
        $this->assertTrue($role->permissions->contains($permission3));
    }

    public function test_attach_permissions_method(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission1 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);
        $permission2 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.create',
        ]);

        $role = Role::factory()->create();
        $role->attachPermissions([$permission1->id]);

        $this->assertCount(1, $role->permissions);

        $role->attachPermissions([$permission2->id]);

        $role->refresh();
        $this->assertCount(2, $role->permissions);
        $this->assertTrue($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));
    }

    public function test_detach_permissions_method(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission1 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);
        $permission2 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.create',
        ]);

        $role = Role::factory()->create();
        $role->permissions()->attach([$permission1->id, $permission2->id]);

        $this->assertCount(2, $role->permissions);

        // Detach specific permission
        $role->detachPermissions([$permission1->id]);

        $role->refresh();
        $this->assertCount(1, $role->permissions);
        $this->assertFalse($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));

        // Detach all permissions
        $role->detachPermissions();

        $role->refresh();
        $this->assertCount(0, $role->permissions);
    }

    public function test_search_scope_filters_by_name_or_description(): void
    {
        $role1 = Role::factory()->create([
            'name' => 'Administrator',
            'description' => 'Full system access',
        ]);

        $role2 = Role::factory()->create([
            'name' => 'Manager',
            'description' => 'Limited access',
        ]);

        $role3 = Role::factory()->create([
            'name' => 'Editor',
            'description' => 'Can edit content',
        ]);

        // Search by name
        $results = Role::search('admin')->get();
        $this->assertCount(1, $results);
        $this->assertTrue($results->contains($role1));

        // Search by description
        $results = Role::search('content')->get();
        $this->assertCount(1, $results);
        $this->assertTrue($results->contains($role3));

        // Search with no results
        $results = Role::search('nonexistent')->get();
        $this->assertCount(0, $results);
    }

    public function test_role_fillable_attributes(): void
    {
        $role = new Role([
            'name' => 'Custom Role',
            'description' => 'Custom role description',
        ]);

        $this->assertEquals('Custom Role', $role->name);
        $this->assertEquals('Custom role description', $role->description);
    }
}
