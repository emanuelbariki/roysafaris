<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\SystemModule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->user = User::factory()->create();
    }

    public function test_can_list_roles(): void
    {
        Role::factory()->create(['name' => 'Admin']);
        Role::factory()->create(['name' => 'Manager']);

        $response = $this->actingAs($this->user)
            ->get(route('roles.index'));

        $response->assertStatus(200);
        $response->assertViewHas('roles');
        $response->assertSee('Admin');
        $response->assertSee('Manager');
    }

    public function test_can_create_role_with_permissions(): void
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

        $response = $this->actingAs($this->user)
            ->post(route('roles.store'), [
                'name' => 'Editor',
                'description' => 'Can view and create users',
                'permissions' => [$permission1->id, $permission2->id],
            ]);

        $response->assertRedirect(route('roles.index'));

        $this->assertDatabaseHas('roles', [
            'name' => 'Editor',
            'description' => 'Can view and create users',
        ]);

        $role = Role::where('name', 'Editor')->first();
        $this->assertTrue($role->permissions->contains($permission1));
        $this->assertTrue($role->permissions->contains($permission2));
    }

    public function test_can_create_role_without_permissions(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('roles.store'), [
                'name' => 'Viewer',
                'description' => 'Read-only access',
            ]);

        $response->assertRedirect(route('roles.index'));
        $this->assertDatabaseHas('roles', ['name' => 'Viewer']);

        $role = Role::where('name', 'Viewer')->first();
        $this->assertCount(0, $role->permissions);
    }

    public function test_cannot_create_duplicate_role_name(): void
    {
        Role::factory()->create(['name' => 'Admin']);

        $response = $this->actingAs($this->user)
            ->post(route('roles.store'), [
                'name' => 'Admin',
                'description' => 'Duplicate admin',
            ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_can_view_create_role_page(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('roles.create'));

        $response->assertStatus(200);
        $response->assertViewHas('modules');
    }

    public function test_can_edit_role(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission1 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);
        $permission2 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.edit',
        ]);

        $role = Role::factory()->create(['name' => 'Editor']);
        $role->permissions()->attach($permission1->id);

        $response = $this->actingAs($this->user)
            ->put(route('roles.update', $role), [
                'name' => 'Senior Editor',
                'description' => 'Advanced editing capabilities',
                'permissions' => [$permission1->id, $permission2->id],
            ]);

        $response->assertRedirect(route('roles.index'));

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'Senior Editor',
            'description' => 'Advanced editing capabilities',
        ]);

        $role->refresh();
        $this->assertCount(2, $role->permissions);
        $this->assertTrue($role->permissions->contains($permission2));
    }

    public function test_can_view_edit_role_page(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);

        $role = Role::factory()->create(['name' => 'Admin']);
        $role->permissions()->attach($permission->id);

        $response = $this->actingAs($this->user)
            ->get(route('roles.edit', $role));

        $response->assertStatus(200);
        $response->assertViewHas('role');
        $response->assertViewHas('modules');
        $response->assertViewHas('rolePermissionIds');
        $response->assertSee('Admin');
    }

    public function test_can_delete_role_not_assigned_to_user(): void
    {
        $role = Role::factory()->create(['name' => 'Temp Role']);

        $response = $this->actingAs($this->user)
            ->delete(route('roles.destroy', $role));

        $response->assertRedirect(route('roles.index'));
        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }

    public function test_cannot_delete_role_assigned_to_user(): void
    {
        $role = Role::factory()->create(['name' => 'Admin']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($this->user)
            ->delete(route('roles.destroy', $role));

        $response->assertRedirect(route('roles.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
        ]);
    }

    public function test_can_clear_all_permissions_from_role(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission1 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);
        $permission2 = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.edit',
        ]);

        $role = Role::factory()->create(['name' => 'Editor']);
        $role->permissions()->attach([$permission1->id, $permission2->id]);

        $this->assertCount(2, $role->permissions);

        $response = $this->actingAs($this->user)
            ->put(route('roles.update', $role), [
                'name' => 'Editor',
                'description' => 'No permissions',
            ]);

        $response->assertRedirect(route('roles.index'));

        $role->refresh();
        $this->assertCount(0, $role->permissions);
    }

    public function test_validation_requires_unique_role_name(): void
    {
        Role::factory()->create(['name' => 'Admin']);

        $response = $this->actingAs($this->user)
            ->post(route('roles.store'), [
                'description' => 'Test role without name',
            ]);

        $response->assertSessionHasErrors(['name']);
    }
}
