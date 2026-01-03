<?php

use App\Models\FleetType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    // Start a transaction before each test
    DB::beginTransaction();

    // Create or get a user for authentication
    $user = User::first();

    if (! $user) {
        // Create a role first if needed
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

        // Create a user with the required role_id
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
    // Rollback the transaction after each test
    DB::rollBack();
});

it('can display fleet types index page', function () {
    $response = $this->get(route('fleettypes.index'));

    $response->assertStatus(200);
});

it('can create a fleet type', function () {
    $response = $this->post(route('fleettypes.store'), [
        'name' => 'Test Fleet Type',
        'status' => 'active',
    ]);

    $response->assertRedirect(route('fleettypes.index'));

    $this->assertDatabaseHas('fleet_types', [
        'name' => 'Test Fleet Type',
        'status' => 'active',
    ]);
});

it('can update a fleet type with unique name validation', function () {
    // Create two fleet types
    $fleetType1 = FleetType::create([
        'name' => 'Original Fleet Type 1',
        'status' => 'active',
    ]);

    $fleetType2 = FleetType::create([
        'name' => 'Original Fleet Type 2',
        'status' => 'active',
    ]);

    // Update fleet type 1 with its own name (should pass)
    $response = $this->put(route('fleettypes.update', $fleetType1), [
        'name' => 'Original Fleet Type 1',
        'status' => 'inactive',
    ]);

    $response->assertRedirect(route('fleettypes.index'));

    $this->assertDatabaseHas('fleet_types', [
        'id' => $fleetType1->id,
        'name' => 'Original Fleet Type 1',
        'status' => 'inactive',
    ]);
});

it('cannot update a fleet type with duplicate name from another record', function () {
    // Create two fleet types
    $fleetType1 = FleetType::create([
        'name' => 'Fleet Type A',
        'status' => 'active',
    ]);

    $fleetType2 = FleetType::create([
        'name' => 'Fleet Type B',
        'status' => 'active',
    ]);

    // Try to update fleet type 2 with fleet type 1's name (should fail)
    $response = $this->put(route('fleettypes.update', $fleetType2), [
        'name' => 'Fleet Type A',
        'status' => 'active',
    ]);

    $response->assertSessionHasErrors(['name']);

    $this->assertDatabaseHas('fleet_types', [
        'id' => $fleetType2->id,
        'name' => 'Fleet Type B',
    ]);
});

it('validates required fields when creating fleet type', function () {
    $response = $this->post(route('fleettypes.store'), [
        'name' => '',
        'status' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'status']);
});

it('validates status field accepts only valid values', function () {
    $response = $this->post(route('fleettypes.store'), [
        'name' => 'Test Fleet Type',
        'status' => 'invalid_status',
    ]);

    $response->assertSessionHasErrors(['status']);
});

it('can delete a fleet type', function () {
    $fleetType = FleetType::create([
        'name' => 'Fleet Type To Delete',
        'status' => 'active',
    ]);

    $response = $this->delete(route('fleettypes.destroy', $fleetType));

    $response->assertRedirect(route('fleettypes.index'));

    $this->assertDatabaseMissing('fleet_types', [
        'id' => $fleetType->id,
    ]);
});

it('can update a fleet type with new unique name', function () {
    $fleetType1 = FleetType::create([
        'name' => 'Old Name',
        'status' => 'active',
    ]);

    $fleetType2 = FleetType::create([
        'name' => 'Other Fleet Type',
        'status' => 'active',
    ]);

    // Update fleet type 1 with a completely new name
    $response = $this->put(route('fleettypes.update', $fleetType1), [
        'name' => 'New Unique Name',
        'status' => 'inactive',
    ]);

    $response->assertRedirect(route('fleettypes.index'));

    $this->assertDatabaseHas('fleet_types', [
        'id' => $fleetType1->id,
        'name' => 'New Unique Name',
        'status' => 'inactive',
    ]);
});

