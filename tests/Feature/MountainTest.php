<?php

use App\Models\Mountain;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SystemModule;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

beforeEach(function () {
    // Get or create system module
    $systemModule = SystemModule::firstOrCreate(['slug' => 'mountains']);

    // Get or create permissions with system_module_id
    $viewPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'view::mountain'
    ], ['description' => 'View mountains']);

    $createPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'create::mountain'
    ], ['description' => 'Create mountains']);

    $editPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'edit::mountain'
    ], ['description' => 'Edit mountains']);

    $deletePermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'delete::mountain'
    ], ['description' => 'Delete mountains']);

    // Get or create admin role and attach permissions
    $adminRole = Role::firstOrCreate(['name' => 'Admin']);
    $adminRole->permissions()->syncWithoutDetaching([
        $viewPermission->id,
        $createPermission->id,
        $editPermission->id,
        $deletePermission->id,
    ]);

    // Create user with admin role (using role_id)
    $user = User::factory()->create(['role_id' => $adminRole->id]);
    actingAs($user);
});

test('can view mountains index', function () {
    $mountains = Mountain::factory()->count(3)->create();

    get(route('mountains.index'))
        ->assertStatus(200)
        ->assertSee($mountains->first()->name);
});

test('can create mountain', function () {
    $mountainData = [
        'name' => 'Mount Kilimanjaro',
        'code' => 'MK001',
        'country_id' => 'TZ',
        'city_id' => 'JRO',
        'status' => 'active',
    ];

    post(route('mountains.store'), $mountainData)
        ->assertRedirect(route('mountains.index'));

    assertDatabaseHas('mountains', [
        'name' => 'Mount Kilimanjaro',
        'code' => 'MK001',
        'country_id' => 'TZ',
    ]);
});

test('can update mountain', function () {
    $mountain = Mountain::factory()->create();

    $updateData = [
        'name' => 'Mount Kilimanjaro Updated',
        'code' => 'MK001',
        'country_id' => 'KE',
        'city_id' => 'NBO',
        'status' => 'inactive',
    ];

    patch(route('mountains.update', ['mountain' => $mountain->id]), $updateData)
        ->assertRedirect(route('mountains.index'));

    expect($mountain->fresh())
        ->name->toBe('Mount Kilimanjaro Updated')
        ->country_id->toBe('KE')
        ->status->toBe('inactive');
});

test('can delete mountain', function () {
    $mountain = Mountain::factory()->create();

    delete(route('mountains.destroy', ['mountain' => $mountain->id]))
        ->assertRedirect(route('mountains.index'));

    expect(Mountain::find($mountain->id))->toBeNull();
});

test('validates required fields on create', function () {
    post(route('mountains.store'), [])
        ->assertSessionHasErrors(['name']);
});

test('validates unique code on create', function () {
    Mountain::factory()->create(['code' => 'MT001']);

    post(route('mountains.store'), [
        'name' => 'Test Mountain',
        'code' => 'MT001',
    ])->assertSessionHasErrors(['code']);
});

test('auto-generates code if not provided', function () {
    Mountain::factory()->create(['id' => 1, 'code' => '0001']);

    post(route('mountains.store'), [
        'name' => 'Mount Test',
        'code' => '',
    ])->assertRedirect(route('mountains.index'));

    $newMountain = Mountain::where('name', 'Mount Test')->first();
    expect($newMountain)->code->toBe('0002');
});

test('can store mountain with optional fields', function () {
    $mountainData = [
        'name' => 'Mount Meru',
        'code' => 'MM002',
        'country_id' => null,
        'city_id' => null,
        'status' => null,
    ];

    post(route('mountains.store'), $mountainData)
        ->assertRedirect(route('mountains.index'));

    assertDatabaseHas('mountains', [
        'name' => 'Mount Meru',
        'code' => 'MM002',
    ]);
});

test('validates max string lengths', function () {
    post(route('mountains.store'), [
        'name' => str_repeat('a', 256),
        'code' => str_repeat('b', 256),
    ])->assertSessionHasErrors(['name', 'code']);
});
