<?php

use App\Models\Lodge;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\delete;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function () {
    DB::beginTransaction();

    $user = User::first();

    if (! $user) {
        $role = DB::table('roles')->first();

        if (! $role) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'Admin',
                'description' => 'Administrator role',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $roleId = $role->id;
        }

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roleId,
        ]);
    }

    $this->actingAs($user);
});

afterEach(function () {
    DB::rollBack();
});

test('can create a lodge', function () {
    $lodgeData = [
        'name' => 'Mountain View Lodge',
        'location' => 'Arusha, Tanzania',
        'phone' => '+1234567890',
        'email' => 'info@mountainview.com',
        'description' => 'A beautiful lodge with mountain views.',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success', 'Lodge created successfully.');

    assertDatabaseHas('lodges', [
        'name' => 'Mountain View Lodge',
        'email' => 'info@mountainview.com',
    ]);
});

test('cannot create lodge without required name', function () {
    post(route('lodges.store'), [])
        ->assertSessionHasErrors(['name']);
});

test('cannot create lodge with invalid email', function () {
    $lodgeData = [
        'name' => 'Test Lodge',
        'email' => 'not-an-email',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertSessionHasErrors(['email']);
});

test('cannot create lodge with duplicate email', function () {
    Lodge::factory()->create(['email' => 'lodge@example.com']);

    $lodgeData = [
        'name' => 'Another Lodge',
        'email' => 'lodge@example.com',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertSessionHasErrors(['email']);
});

test('can update a lodge', function () {
    $lodge = Lodge::factory()->create();

    $updatedData = [
        'name' => 'Updated Lodge Name',
        'location' => 'New Location, Kenya',
        'phone' => '+0987654321',
        'email' => 'updated@example.com',
        'description' => 'Updated description.',
    ];

    put(route('lodges.update', $lodge), $updatedData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success', 'Lodge updated successfully.');

    assertDatabaseHas('lodges', [
        'id' => $lodge->id,
        'name' => 'Updated Lodge Name',
        'email' => 'updated@example.com',
    ]);
});

test('cannot update lodge with invalid email', function () {
    $lodge = Lodge::factory()->create();

    $updatedData = [
        'name' => 'Updated Lodge',
        'email' => 'invalid-email',
    ];

    put(route('lodges.update', $lodge), $updatedData)
        ->assertSessionHasErrors(['email']);
});

test('cannot update lodge with duplicate email', function () {
    $lodge1 = Lodge::factory()->create(['email' => 'lodge1@example.com']);
    $lodge2 = Lodge::factory()->create(['email' => 'lodge2@example.com']);

    $updatedData = [
        'name' => 'Updated Lodge',
        'email' => 'lodge1@example.com',
    ];

    put(route('lodges.update', $lodge2), $updatedData)
        ->assertSessionHasErrors(['email']);
});

test('location is optional when creating lodge', function () {
    $lodgeData = [
        'name' => 'Safari Lodge',
        'email' => 'safari@example.com',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('lodges', [
        'name' => 'Safari Lodge',
        'email' => 'safari@example.com',
    ]);
});

test('phone is optional when creating lodge', function () {
    $lodgeData = [
        'name' => 'Beach Lodge',
        'email' => 'beach@example.com',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('lodges', [
        'name' => 'Beach Lodge',
        'email' => 'beach@example.com',
    ]);
});

test('email is optional when creating lodge', function () {
    $lodgeData = [
        'name' => 'Forest Lodge',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('lodges', [
        'name' => 'Forest Lodge',
    ]);
});

test('can soft delete a lodge', function () {
    $lodge = Lodge::factory()->create();

    delete(route('lodges.destroy', $lodge))
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success', 'Lodge deleted successfully.');

    $this->assertDatabaseHas('lodges', [
        'id' => $lodge->id,
    ]);

    $this->assertNotNull(Lodge::withTrashed()->find($lodge->id)->deleted_at);
});

test('deleted lodges are not retrieved by default queries', function () {
    $lodge = Lodge::factory()->create();

    delete(route('lodges.destroy', $lodge));

    $lodges = Lodge::all();

    expect($lodges)->not->toContain($lodge);

    $lodgeWithTrashed = Lodge::withTrashed()->find($lodge->id);

    expect($lodgeWithTrashed)->not->toBeNull();
});

test('can update lodge keeping same email', function () {
    $lodge = Lodge::factory()->create(['email' => 'lodge@example.com']);

    $updatedData = [
        'name' => 'Same Email Lodge',
        'email' => 'lodge@example.com',
    ];

    put(route('lodges.update', $lodge), $updatedData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('lodges', [
        'id' => $lodge->id,
        'name' => 'Same Email Lodge',
        'email' => 'lodge@example.com',
    ]);
});

test('can create lodge with all fields', function () {
    $lodgeData = [
        'name' => 'Luxury Safari Lodge',
        'location' => 'Serengeti, Tanzania',
        'phone' => '+255123456789',
        'email' => 'luxury@safari.com',
        'description' => 'A premium lodge in the heart of Serengeti.',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('lodges', [
        'name' => 'Luxury Safari Lodge',
        'location' => 'Serengeti, Tanzania',
        'email' => 'luxury@safari.com',
    ]);
});

test('description is optional when creating lodge', function () {
    $lodgeData = [
        'name' => 'Simple Lodge',
        'email' => 'simple@example.com',
    ];

    post(route('lodges.store'), $lodgeData)
        ->assertRedirect(route('lodges.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('lodges', [
        'name' => 'Simple Lodge',
        'email' => 'simple@example.com',
    ]);
});
