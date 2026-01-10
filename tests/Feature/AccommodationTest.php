<?php

use App\Models\Accommodation;
use App\Models\AccommodationType;
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
use function Pest\Laravel\put;

beforeEach(function () {
    // Get or create system module
    $systemModule = SystemModule::firstOrCreate(['slug' => 'accommodations']);

    // Get or create permissions with system_module_id
    $viewPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'view::accommodation'
    ], ['description' => 'View accommodations']);

    $createPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'create::accommodation'
    ], ['description' => 'Create accommodations']);

    $editPermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'edit::accommodation'
    ], ['description' => 'Edit accommodations']);

    $deletePermission = Permission::firstOrCreate([
        'system_module_id' => $systemModule->id,
        'ability' => 'delete::accommodation'
    ], ['description' => 'Delete accommodations']);

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

test('can view accommodations index', function () {
    $accommodations = Accommodation::factory()->count(3)->create();

    get(route('accommodations.index'))
        ->assertStatus(200)
        ->assertSee($accommodations->first()->name);
});

test('can create accommodation', function () {
    $hotelChain = HotelChain::factory()->create();
    $accommodationType = AccommodationType::factory()->create();

    $accommodationData = [
        'name' => 'Serengeti Safari Lodge',
        'code' => 'SSL001',
        'hotel_chain_id' => $hotelChain->id,
        'accommodations_type_id' => $accommodationType->id,
        'address' => 'Serengeti National Park',
        'city' => 'Arusha',
        'country' => 'Tanzania',
        'phone' => '+255123456789',
        'email' => 'info@serengetisafari.com',
        'website' => 'https://serengetisafari.com',
        'pay_to' => 'hotel',
        'billing_ccy' => 'USD',
        'status' => 'active',
    ];

    post(route('accommodations.store'), $accommodationData)
        ->assertRedirect(route('accommodations.index'));

    assertDatabaseHas('accommodations', [
        'name' => 'Serengeti Safari Lodge',
        'code' => 'SSL001',
    ]);
});

test('can update accommodation', function () {
    $accommodation = Accommodation::factory()->create();
    $hotelChain = HotelChain::factory()->create();
    $accommodationType = AccommodationType::factory()->create();

    $updateData = [
        'name' => 'Serengeti Safari Lodge Updated',
        'code' => 'SSL001',
        'hotel_chain_id' => $hotelChain->id,
        'accommodations_type_id' => $accommodationType->id,
        'address' => 'Serengeti National Park',
        'city' => 'Arusha',
        'country' => 'Tanzania',
        'phone' => '+255987654321',
        'email' => 'updated@serengetisafari.com',
        'website' => 'https://serengetisafari-updated.com',
        'pay_to' => 'chain',
        'billing_ccy' => 'EUR',
        'status' => 'inactive',
    ];

    put(route('accommodations.update', ['accommodation' => $accommodation->id]), $updateData)
        ->assertRedirect(route('accommodations.index'));

    expect($accommodation->fresh())
        ->name->toBe('Serengeti Safari Lodge Updated')
        ->email->toBe('updated@serengetisafari.com')
        ->status->toBe('inactive');
});

test('can delete accommodation', function () {
    $accommodation = Accommodation::factory()->create();

    delete(route('accommodations.destroy', ['accommodation' => $accommodation->id]))
        ->assertRedirect(route('accommodations.index'));

    expect(Accommodation::find($accommodation->id))->toBeNull();
});

test('validates required fields on create', function () {
    post(route('accommodations.store'), [])
        ->assertSessionHasErrors(['name']);
});

test('validates unique code on create', function () {
    Accommodation::factory()->create(['code' => 'UNIQUE01']);

    post(route('accommodations.store'), [
        'name' => 'Test Accommodation',
        'code' => 'UNIQUE01',
    ])->assertSessionHasErrors(['code']);
});

test('auto-generates code if not provided', function () {
    Accommodation::factory()->create(['id' => 1, 'code' => '0001']);

    post(route('accommodations.store'), [
        'name' => 'Test Accommodation',
        'code' => '',
    ])->assertRedirect(route('accommodations.index'));

    $newAccommodation = Accommodation::where('name', 'Test Accommodation')->first();
    expect($newAccommodation)->code->toBe('0002');
});

test('validates email format', function () {
    post(route('accommodations.store'), [
        'name' => 'Test Accommodation',
        'code' => 'TEST01',
        'email' => 'invalid-email',
    ])->assertSessionHasErrors(['email']);
});

test('validates website url format', function () {
    post(route('accommodations.store'), [
        'name' => 'Test Accommodation',
        'code' => 'TEST01',
        'website' => 'not-a-url',
    ])->assertSessionHasErrors(['website']);
});

test('validates pay_to field', function () {
    post(route('accommodations.store'), [
        'name' => 'Test Accommodation',
        'code' => 'TEST01',
        'pay_to' => 'invalid',
    ])->assertSessionHasErrors(['pay_to']);
});

test('can create accommodation without optional fields', function () {
    $accommodationData = [
        'name' => 'Basic Lodge',
        'code' => 'BL001',
        'hotel_chain_id' => null,
        'accommodations_type_id' => null,
        'address' => null,
        'city' => null,
        'country' => null,
        'phone' => null,
        'email' => null,
        'website' => null,
        'status' => null,
    ];

    post(route('accommodations.store'), $accommodationData)
        ->assertRedirect(route('accommodations.index'));

    assertDatabaseHas('accommodations', [
        'name' => 'Basic Lodge',
        'code' => 'BL001',
    ]);
});

test('sets default voucher_copies to 3', function () {
    post(route('accommodations.store'), [
        'name' => 'Test Lodge',
        'code' => 'TL001',
    ])->assertRedirect(route('accommodations.index'));

    $accommodation = Accommodation::where('name', 'Test Lodge')->first();
    expect($accommodation)->voucher_copies->toBe('3');
});

test('accommodation belongs to hotel chain', function () {
    $hotelChain = HotelChain::factory()->create(['name' => 'Serengeti Hotels']);
    $accommodation = Accommodation::factory()->for($hotelChain)->create();

    expect($accommodation->hotelChain->name)->toBe('Serengeti Hotels');
});

test('accommodation belongs to accommodation type', function () {
    $accommodationType = AccommodationType::factory()->create(['name' => 'Luxury Lodge']);
    $accommodation = Accommodation::factory()->for($accommodationType, 'accommodationType')->create();

    expect($accommodation->accommodationType->name)->toBe('Luxury Lodge');
});
