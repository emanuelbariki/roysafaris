<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\SystemModule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->user = User::factory()->create();
    }

    public function test_can_list_permissions_grouped_by_module(): void
    {
        // Create modules
        $module1 = SystemModule::factory()->create(['slug' => 'users']);
        $module2 = SystemModule::factory()->create(['slug' => 'roles']);

        // Create permissions
        Permission::factory()->create([
            'system_module_id' => $module1->id,
            'ability' => 'users.create',
        ]);

        Permission::factory()->create([
            'system_module_id' => $module2->id,
            'ability' => 'roles.view',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('permissions.index'));

        $response->assertStatus(200);
        $response->assertViewHas('permissions');
        $response->assertViewHas('modules');

        // Check the view data contains the permissions and modules
        $modules = $response->viewData('modules');
        $permissions = $response->viewData('permissions');

        $this->assertCount(2, $modules);
        $this->assertCount(2, $permissions);
        $this->assertTrue($permissions->contains('ability', 'users.create'));
        $this->assertTrue($permissions->contains('ability', 'roles.view'));
    }

    public function test_can_create_permission(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);

        $response = $this->actingAs($this->user)
            ->post(route('permissions.store'), [
                'system_module_id' => $module->id,
                'ability' => 'users.delete',
                'description' => 'Delete users',
            ]);

        $response->assertRedirect(route('permissions.index'));
        $this->assertDatabaseHas('permissions', [
            'ability' => 'users.delete',
            'system_module_id' => $module->id,
        ]);
    }

    public function test_cannot_create_duplicate_permission_ability(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);

        Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('permissions.store'), [
                'system_module_id' => $module->id,
                'ability' => 'users.view',
                'description' => 'Duplicate',
            ]);

        $response->assertSessionHasErrors('ability');
    }

    public function test_can_view_create_permission_page(): void
    {
        SystemModule::factory()->create(['slug' => 'users']);

        $response = $this->actingAs($this->user)
            ->get(route('permissions.create'));

        $response->assertStatus(200);
        $response->assertViewHas('modules');
    }

    public function test_can_edit_permission(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.edit',
            'description' => 'Edit users',
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('permissions.update', $permission), [
                'system_module_id' => $module->id,
                'ability' => 'users.update',
                'description' => 'Update users',
            ]);

        $response->assertRedirect(route('permissions.index'));
        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'ability' => 'users.update',
            'description' => 'Update users',
        ]);
    }

    public function test_can_view_edit_permission_page(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('permissions.edit', $permission));

        $response->assertStatus(200);
        $response->assertViewHas('permission');
        $response->assertSee('users.view');
    }

    public function test_can_delete_permission_not_assigned_to_role(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.delete',
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('permissions.destroy', $permission));

        $response->assertRedirect(route('permissions.index'));
        $this->assertDatabaseMissing('permissions', [
            'id' => $permission->id,
        ]);
    }

    public function test_cannot_delete_permission_assigned_to_role(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.delete',
        ]);

        // Create a role and attach permission
        $role = \App\Models\Role::factory()->create();
        $role->permissions()->attach($permission->id);

        $response = $this->actingAs($this->user)
            ->delete(route('permissions.destroy', $permission));

        $response->assertRedirect(route('permissions.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
        ]);
    }

    public function test_validation_requires_module_and_ability(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('permissions.store'), [
                'description' => 'Test permission',
            ]);

        $response->assertSessionHasErrors(['system_module_id', 'ability']);
    }
}
