<?php

use App\Models\Mountain;
use App\Models\MountainRoute;
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
    $systemModule = SystemModule::firstOrCreate(['slug' => 'mountain-routes']);

    // Get or create permissions with system_module_id
    $viewPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'view::mountainroute'
    ], ['description' => 'View mountain routes']);

    $createPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'create::mountainroute'
    ], ['description' => 'Create mountain routes']);

    $editPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'edit::mountainroute'
    ], ['description' => 'Edit mountain routes']);

    $deletePermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'delete::mountainroute'
    ], ['description' => 'Delete mountain routes']);

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

test('can view mountain routes index', function () {
    $mountain = Mountain::factory()->create();
    $routes = MountainRoute::factory()->count(3)->for($mountain)->create();

    get(route('mountainroutes.index'))
        ->assertStatus(200)
        ->assertSee($routes->first()->name);
});

test('can create mountain route', function () {
    $mountain = Mountain::factory()->create();

    $routeData = [
        'name' => 'Machame Route',
        'code' => 'MR001',
        'description' => 'The most popular route on Kilimanjaro',
        'mountain_id' => $mountain->id,
        'min_days' => '6',
        'max_days' => '8',
        'status' => 'active',
    ];

    post(route('mountainroutes.store'), $routeData)
        ->assertRedirect(route('mountainroutes.index'));

    assertDatabaseHas('mountain_routes', [
        'name' => 'Machame Route',
        'code' => 'MR001',
        'mountain_id' => $mountain->id,
    ]);
});

test('can update mountain route', function () {
    $route = MountainRoute::factory()->create();
    $mountain = Mountain::factory()->create();

    $updateData = [
        'name' => 'Machame Route Updated',
        'code' => 'MR001',
        'description' => 'Updated description',
        'mountain_id' => $mountain->id,
        'min_days' => '7',
        'max_days' => '9',
        'status' => 'inactive',
    ];

    patch(route('mountainroutes.update', ['mountainroute' => $route->id]), $updateData)
        ->assertRedirect(route('mountainroutes.index'));

    expect($route->fresh())
        ->name->toBe('Machame Route Updated')
        ->min_days->toBe('7')
        ->max_days->toBe('9')
        ->status->toBe('inactive');
});

test('can delete mountain route', function () {
    $route = MountainRoute::factory()->create();

    delete(route('mountainroutes.destroy', ['mountainroute' => $route->id]))
        ->assertRedirect(route('mountainroutes.index'));

    expect(MountainRoute::find($route->id))->toBeNull();
});

test('validates required fields on create', function () {
    post(route('mountainroutes.store'), [])
        ->assertSessionHasErrors(['name']);
});

test('validates unique code on create', function () {
    MountainRoute::factory()->create(['code' => 'RT001']);

    post(route('mountainroutes.store'), [
        'name' => 'Test Route',
        'code' => 'RT001',
    ])->assertSessionHasErrors(['code']);
});

test('auto-generates code if not provided', function () {
    MountainRoute::factory()->create(['id' => 1, 'code' => '0001']);

    post(route('mountainroutes.store'), [
        'name' => 'Test Route',
        'code' => '',
    ])->assertRedirect(route('mountainroutes.index'));

    $newRoute = MountainRoute::where('name', 'Test Route')->first();
    expect($newRoute)->code->toBe('0002');
});

test('validates min and max days are numbers', function () {
    $mountain = Mountain::factory()->create();

    post(route('mountainroutes.store'), [
        'name' => 'Test Route',
        'code' => 'RT002',
        'mountain_id' => $mountain->id,
        'min_days' => 'not-a-number',
        'max_days' => 'also-not-a-number',
    ])->assertSessionHasErrors(['min_days', 'max_days']);
});

test('can create route without optional fields', function () {
    $routeData = [
        'name' => 'Marangu Route',
        'code' => 'MR002',
        'description' => null,
        'mountain_id' => null,
        'min_days' => null,
        'max_days' => null,
        'status' => null,
    ];

    post(route('mountainroutes.store'), $routeData)
        ->assertRedirect(route('mountainroutes.index'));

    assertDatabaseHas('mountain_routes', [
        'name' => 'Marangu Route',
        'code' => 'MR002',
    ]);
});

test('validates max string lengths', function () {
    post(route('mountainroutes.store'), [
        'name' => str_repeat('a', 256),
        'code' => str_repeat('b', 256),
        'description' => str_repeat('c', 65536),
    ])->assertSessionHasErrors(['name', 'code', 'description']);
});

test('mountain route belongs to mountain', function () {
    $mountain = Mountain::factory()->create(['name' => 'Mount Kilimanjaro']);
    $route = MountainRoute::factory()->for($mountain)->create();

    expect($route->mountain->name)->toBe('Mount Kilimanjaro');
});
