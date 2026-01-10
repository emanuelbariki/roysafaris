<?php

namespace Tests\Feature;

use App\Models\SystemModule;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SystemModuleTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_list_system_modules(): void
    {
        SystemModule::factory()->create(['slug' => 'users']);
        SystemModule::factory()->create(['slug' => 'bookings']);

        $response = $this->actingAs($this->user)
            ->get(route('system-modules.index'));

        $response->assertStatus(200);
        $response->assertViewHas('modules');

        // Check the view data contains the modules
        $modules = $response->viewData('modules');
        $this->assertCount(2, $modules);
        $this->assertTrue($modules->contains('slug', 'users'));
        $this->assertTrue($modules->contains('slug', 'bookings'));
    }

    public function test_can_create_system_module(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('system-modules.store'), [
                'slug' => 'test_module',
            ]);

        $response->assertRedirect(route('system-modules.index'));
        $this->assertDatabaseHas('system_modules', [
            'slug' => 'test_module',
        ]);
    }

    public function test_cannot_create_duplicate_module_slug(): void
    {
        SystemModule::factory()->create(['slug' => 'users']);

        $response = $this->actingAs($this->user)
            ->post(route('system-modules.store'), [
                'slug' => 'users',
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_can_update_system_module(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'old_slug']);

        $response = $this->actingAs($this->user)
            ->put(route('system-modules.update', $module), [
                'slug' => 'new_slug',
            ]);

        $response->assertRedirect(route('system-modules.index'));
        $this->assertDatabaseHas('system_modules', [
            'id' => $module->id,
            'slug' => 'new_slug',
        ]);
    }

    public function test_cannot_update_module_to_duplicate_slug(): void
    {
        SystemModule::factory()->create(['slug' => 'users']);
        $module = SystemModule::factory()->create(['slug' => 'bookings']);

        $response = $this->actingAs($this->user)
            ->put(route('system-modules.update', $module), [
                'slug' => 'users',
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_can_delete_module_without_permissions(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'test_module']);

        $response = $this->actingAs($this->user)
            ->delete(route('system-modules.destroy', $module));

        $response->assertRedirect(route('system-modules.index'));
        $this->assertDatabaseMissing('system_modules', [
            'id' => $module->id,
        ]);
    }

    public function test_cannot_delete_module_with_permissions(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.view',
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('system-modules.destroy', $module));

        $response->assertRedirect(route('system-modules.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('system_modules', [
            'id' => $module->id,
        ]);
    }

    public function test_validation_requires_slug(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('system-modules.store'), [
                'slug' => '',
            ]);

        $response->assertSessionHasErrors(['slug']);
    }

    public function test_slug_must_follow_regex_pattern(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('system-modules.store'), [
                'slug' => 'Invalid Slug!',
            ]);

        $response->assertSessionHasErrors(['slug']);
    }

    public function test_modules_index_shows_permission_count(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        Permission::factory()->create(['system_module_id' => $module->id, 'ability' => 'users.view']);
        Permission::factory()->create(['system_module_id' => $module->id, 'ability' => 'users.create']);

        $response = $this->actingAs($this->user)
            ->get(route('system-modules.index'));

        $response->assertStatus(200);
        $response->assertViewHas('modules');

        // Check that permissions_count is included in the view data
        $modules = $response->viewData('modules');
        $moduleWithCount = $modules->firstWhere('slug', 'users');
        $this->assertEquals(2, $moduleWithCount->permissions_count);
    }
}
