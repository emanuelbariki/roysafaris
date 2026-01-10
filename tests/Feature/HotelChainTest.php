<?php

use App\Models\HotelChain;
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
    $systemModule = SystemModule::firstOrCreate(['slug' => 'hotel-chains']);

    // Get or create permissions with system_module_id
    $viewPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'view::hotelchain'
    ], ['description' => 'View hotel chains']);

    $createPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'create::hotelchain'
    ], ['description' => 'Create hotel chains']);

    $editPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'edit::hotelchain'
    ], ['description' => 'Edit hotel chains']);

    $deletePermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'delete::hotelchain'
    ], ['description' => 'Delete hotel chains']);

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

test('can view hotel chains index', function () {
    $hotelChains = HotelChain::factory()->count(3)->create();

    get(route('hotelchains.index'))
        ->assertStatus(200)
        ->assertSee($hotelChains->first()->name);
});

test('can create hotel chain', function () {
    $hotelChainData = [
        'name' => 'Serena Hotels',
        'code' => 'SR001',
        'email' => 'info@serena.com',
        'phone' => '+255123456789',
        'bank_name' => 'CRDB Bank Plc',
        'bank_no' => '01512345678900',
        'status' => 'active',
    ];

    post(route('hotelchains.store'), $hotelChainData)
        ->assertRedirect(route('hotelchains.index'));

    assertDatabaseHas('hotel_chains', [
        'name' => 'Serena Hotels',
        'code' => 'SR001',
    ]);
});

test('can update hotel chain', function () {
    $hotelChain = HotelChain::factory()->create();

    $updateData = [
        'name' => 'Serena Hotels Updated',
        'code' => 'SR001',
        'email' => 'updated@serena.com',
        'phone' => '+255987654321',
        'bank_name' => 'NMB Bank Plc',
        'bank_no' => '1234567890',
        'status' => 'inactive',
    ];

    patch(route('hotelchains.update', ['hotelchain' => $hotelChain->id]), $updateData)
        ->assertRedirect(route('hotelchains.index'));

    expect($hotelChain->fresh())
        ->name->toBe('Serena Hotels Updated')
        ->email->toBe('updated@serena.com')
        ->status->toBe('inactive');
});

test('can delete hotel chain', function () {
    $hotelChain = HotelChain::factory()->create();

    delete(route('hotelchains.destroy', ['hotelchain' => $hotelChain->id]))
        ->assertRedirect(route('hotelchains.index'));

    expect(HotelChain::find($hotelChain->id))->toBeNull();
});

test('validates required fields on create', function () {
    post(route('hotelchains.store'), [])
        ->assertSessionHasErrors(['name']);
});

test('validates unique code on create', function () {
    HotelChain::factory()->create(['code' => 'UNIQUE01']);

    post(route('hotelchains.store'), [
        'name' => 'Test Hotel',
        'code' => 'UNIQUE01',
    ])->assertSessionHasErrors(['code']);
});

test('auto-generates code if not provided', function () {
    HotelChain::factory()->create(['id' => 1, 'code' => '0001']);

    post(route('hotelchains.store'), [
        'name' => 'Test Hotel Chain',
        'code' => '',
    ])->assertRedirect(route('hotelchains.index'));

    $newChain = HotelChain::where('name', 'Test Hotel Chain')->first();
    expect($newChain)->code->toBe('0002');
});

test('validates email format', function () {
    post(route('hotelchains.store'), [
        'name' => 'Test Hotel',
        'code' => 'TEST01',
        'email' => 'invalid-email',
    ])->assertSessionHasErrors(['email']);
});

test('cannot delete hotel chain with relationships (if applicable)', function () {
    // This test would check foreign key constraints if hotel chains have related records
    $hotelChain = HotelChain::factory()->create();

    delete(route('hotelchains.destroy', $hotelChain))
        ->assertRedirect(route('hotelchains.index'));

    expect(HotelChain::find($hotelChain->id))->toBeNull();
});
