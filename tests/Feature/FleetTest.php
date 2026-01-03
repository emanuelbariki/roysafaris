<?php

use App\Models\Fleet;
use App\Models\FleetClass;
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

it('can display fleets index page', function () {
    $response = $this->get(route('fleets.index'));

    $response->assertStatus(200);
});

it('can create a fleet', function () {
    // Create fleet type and class first
    $fleetType = FleetType::create([
        'name' => 'SUV',
        'status' => 'active',
    ]);

    $fleetClass = FleetClass::create([
        'name' => 'Economy',
        'status' => 'active',
    ]);

    $response = $this->post(route('fleets.store'), [
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'fleet_type_id' => $fleetType->id,
        'fleet_class_id' => $fleetClass->id,
        'seats' => 7,
        'purchase_date' => '2024-01-01',
        'mileage' => '50000',
        'status' => 'active',
        'fleet_status' => 'active',
    ]);

    $response->assertRedirect(route('fleets.index'));

    $this->assertDatabaseHas('fleets', [
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'seats' => 7,
    ]);
});

it('can update a fleet', function () {
    // Create related data
    $fleetType = FleetType::create([
        'name' => 'SUV',
        'status' => 'active',
    ]);

    $fleetClass = FleetClass::create([
        'name' => 'Economy',
        'status' => 'active',
    ]);

    $fleet = Fleet::create([
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'fleet_type_id' => $fleetType->id,
        'fleet_class_id' => $fleetClass->id,
        'seats' => 7,
        'purchase_date' => '2024-01-01',
        'mileage' => '50000',
        'status' => 'active',
        'fleet_status' => 'active',
    ]);

    $response = $this->put(route('fleets.update', $fleet), [
        'make_model' => 'Toyota Land Cruiser Updated',
        'reg_no' => 'XYZ-789',
        'fleet_type_id' => $fleetType->id,
        'fleet_class_id' => $fleetClass->id,
        'seats' => 8,
        'purchase_date' => '2024-02-01',
        'mileage' => '60000',
        'status' => 'inactive',
    ]);

    $response->assertRedirect(route('fleets.index'));

    $this->assertDatabaseHas('fleets', [
        'id' => $fleet->id,
        'make_model' => 'Toyota Land Cruiser Updated',
        'reg_no' => 'XYZ-789',
        'seats' => 8,
        'status' => 'inactive',
    ]);
});

it('validates required fields when creating fleet', function () {
    $response = $this->post(route('fleets.store'), [
        'make_model' => '',
        'reg_no' => '',
        'seats' => '',
        'purchase_date' => '',
        'mileage' => '',
    ]);

    $response->assertSessionHasErrors(['make_model', 'reg_no', 'seats', 'purchase_date', 'mileage']);
});

it('validates fleet_type_id and fleet_class_id are required', function () {
    $response = $this->post(route('fleets.store'), [
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'seats' => 7,
        'purchase_date' => '2024-01-01',
        'mileage' => '50000',
        'fleet_type_id' => '',
        'fleet_class_id' => '',
    ]);

    $response->assertSessionHasErrors(['fleet_type_id', 'fleet_class_id']);
});

it('validates status accepts only valid values', function () {
    $fleetType = FleetType::create([
        'name' => 'SUV',
        'status' => 'active',
    ]);

    $fleetClass = FleetClass::create([
        'name' => 'Economy',
        'status' => 'active',
    ]);

    $response = $this->post(route('fleets.store'), [
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'fleet_type_id' => $fleetType->id,
        'fleet_class_id' => $fleetClass->id,
        'seats' => 7,
        'purchase_date' => '2024-01-01',
        'mileage' => '50000',
        'status' => 'invalid_status',
    ]);

    $response->assertSessionHasErrors(['status']);
});

it('can delete a fleet', function () {
    $fleetType = FleetType::create([
        'name' => 'SUV',
        'status' => 'active',
    ]);

    $fleetClass = FleetClass::create([
        'name' => 'Economy',
        'status' => 'active',
    ]);

    $fleet = Fleet::create([
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'fleet_type_id' => $fleetType->id,
        'fleet_class_id' => $fleetClass->id,
        'seats' => 7,
        'purchase_date' => '2024-01-01',
        'mileage' => '50000',
        'status' => 'active',
        'fleet_status' => 'active',
    ]);

    $response = $this->delete(route('fleets.destroy', $fleet));

    $response->assertRedirect(route('fleets.index'));

    $this->assertDatabaseMissing('fleets', [
        'id' => $fleet->id,
    ]);
});

it('keeps modal open on validation errors when creating fleet', function () {
    $response = $this->post(route('fleets.store'), [
        'make_model' => '',
        'reg_no' => '',
    ]);

    $response->assertRedirect(route('fleets.index'))
        ->assertSessionHasErrors(['make_model', 'reg_no']);
});

it('keeps modal open on validation errors when updating fleet', function () {
    $fleetType = FleetType::create([
        'name' => 'SUV',
        'status' => 'active',
    ]);

    $fleetClass = FleetClass::create([
        'name' => 'Economy',
        'status' => 'active',
    ]);

    $fleet = Fleet::create([
        'make_model' => 'Toyota Land Cruiser',
        'reg_no' => 'ABC-123',
        'fleet_type_id' => $fleetType->id,
        'fleet_class_id' => $fleetClass->id,
        'seats' => 7,
        'purchase_date' => '2024-01-01',
        'mileage' => '50000',
        'status' => 'active',
        'fleet_status' => 'active',
    ]);

    $response = $this->put(route('fleets.update', $fleet), [
        'make_model' => '',
        'reg_no' => '',
        'fleet_type_id' => '',
        'fleet_class_id' => '',
        'seats' => '',
        'purchase_date' => '',
        'mileage' => '',
    ]);

    $response->assertRedirect(route('fleets.index'))
        ->assertSessionHasErrors(['make_model', 'reg_no', 'fleet_type_id', 'fleet_class_id', 'seats', 'purchase_date', 'mileage']);
});
