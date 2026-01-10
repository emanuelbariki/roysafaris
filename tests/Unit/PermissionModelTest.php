<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use App\Models\SystemModule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_belongs_to_system_module(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.create',
        ]);

        $this->assertInstanceOf(SystemModule::class, $permission->systemModule);
        $this->assertEquals($module->id, $permission->systemModule->id);
    }

    public function test_permission_belongs_to_many_roles(): void
    {
        $module = SystemModule::factory()->create(['slug' => 'users']);
        $permission = Permission::factory()->create([
            'system_module_id' => $module->id,
            'ability' => 'users.delete',
        ]);

        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();

        $permission->roles()->attach([$role1->id, $role2->id]);

        $this->assertCount(2, $permission->roles);
        $this->assertTrue($permission->roles->contains($role1));
        $this->assertTrue($permission->roles->contains($role2));
    }

    public function test_scope_by_module_filters_permissions_correctly(): void
    {
        $module1 = SystemModule::factory()->create(['slug' => 'users']);
        $module2 = SystemModule::factory()->create(['slug' => 'roles']);

        $permission1 = Permission::factory()->create([
            'system_module_id' => $module1->id,
            'ability' => 'users.view',
        ]);

        $permission2 = Permission::factory()->create([
            'system_module_id' => $module2->id,
            'ability' => 'roles.view',
        ]);

        $usersPermissions = Permission::byModule($module1->id)->get();

        $this->assertCount(1, $usersPermissions);
        $this->assertTrue($usersPermissions->contains($permission1));
        $this->assertFalse($usersPermissions->contains($permission2));
    }

    public function test_permission_fillable_attributes(): void
    {
        $module = SystemModule::factory()->create();
        $permission = new Permission([
            'system_module_id' => $module->id,
            'ability' => 'test.ability',
            'description' => 'Test description',
        ]);

        $this->assertEquals($module->id, $permission->system_module_id);
        $this->assertEquals('test.ability', $permission->ability);
        $this->assertEquals('Test description', $permission->description);
    }
}
