<?php

use App\Models\Booking;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Permission;
use App\Models\PickupDropoffPoint;
use App\Models\ServiceProvider;
use App\Models\Role;
use App\Models\SystemModule;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function () {
    DB::beginTransaction();

    $user = User::first();

    if (! $user) {
        $role = Role::first();

        if (! $role) {
            $role = Role::create([
                'name' => 'Admin',
                'description' => 'Administrator role',
            ]);
        }

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);
    }

    // Grant all booking permissions to the user's role
    $bookingPermissions = Permission::where('ability', 'like', '%booking%')->pluck('id');

    if ($bookingPermissions->isNotEmpty()) {
        $user->role->permissions()->syncWithoutDetaching($bookingPermissions);
    } else {
        // Create a system module for bookings first
        $module = SystemModule::firstOrCreate(
            ['slug' => 'bookings']
        );

        // Create permissions if they don't exist
        $permissions = [
            ['ability' => 'view::booking', 'description' => 'View Bookings'],
            ['ability' => 'create::booking', 'description' => 'Create Booking'],
            ['ability' => 'edit::booking', 'description' => 'Edit Booking'],
            ['ability' => 'delete::booking', 'description' => 'Delete Booking'],
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(
                ['ability' => $permission['ability']],
                ['description' => $permission['description'], 'system_module_id' => $module->id]
            );
            $user->role->permissions()->syncWithoutDetaching([$perm->id]);
        }
    }

    $this->actingAs($user);
});

afterEach(function () {
    DB::rollBack();
});

test('can create a booking with valid data', function () {
    $channel = Channel::factory()->create();

    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'nationality' => 'TZ', // Tanzania
        'remarks' => 'Test remarks',
        'file_owner' => (string) auth()->id(),
        'channel_id' => $channel->id,
        'agent_code' => null,
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'pickup_details' => '1',
        'departure_date' => now()->addDays(5)->toDateString(),
        'drop_details' => '2',
        'adults' => 2,
        'children' => 1,
        'infants' => 0,
        'rooms' => 1,
        'services' => ['accommodation', 'transfers'],
        'notes' => 'Test notes for booking',
    ];

    post(route('bookings.store'), $bookingData)
        ->assertRedirect(route('bookings.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('bookings', [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'nationality' => 'TZ',
        'booking_code' => '001/01/2025',
        'adults' => 2,
        'children' => 1,
    ]);
});

test('requires group name to create booking', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => '', // Empty group name
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'departure_date' => now()->addDays(5)->toDateString(),
        'services' => ['accommodation'],
    ];

    post(route('bookings.store'), $bookingData)
        ->assertSessionHasErrors('group_name');

    assertDatabaseCount('bookings', 0);
});

test('requires booking code to create booking', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'booking_code' => '', // Empty booking code
        'arrival_date' => now()->addDays(1)->toDateString(),
        'departure_date' => now()->addDays(5)->toDateString(),
        'services' => ['accommodation'],
    ];

    post(route('bookings.store'), $bookingData)
        ->assertSessionHasErrors('booking_code');

    assertDatabaseCount('bookings', 0);
});

test('requires at least one service', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'departure_date' => now()->addDays(5)->toDateString(),
        'services' => [], // No services selected
    ];

    post(route('bookings.store'), $bookingData)
        ->assertSessionHasErrors('services');

    assertDatabaseCount('bookings', 0);
});

test('requires departure date after or equal to arrival date', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(5)->toDateString(),
        'departure_date' => now()->addDays(1)->toDateString(), // Before arrival
        'services' => ['accommodation'],
    ];

    post(route('bookings.store'), $bookingData)
        ->assertSessionHasErrors('departure_date');

    assertDatabaseCount('bookings', 0);
});

test('validates channel exists', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'channel_id' => 999, // Non-existent channel
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'departure_date' => now()->addDays(5)->toDateString(),
        'services' => ['accommodation'],
    ];

    post(route('bookings.store'), $bookingData)
        ->assertSessionHasErrors('channel_id');

    assertDatabaseCount('bookings', 0);
});

test('validates services are valid options', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'departure_date' => now()->addDays(5)->toDateString(),
        'services' => ['invalid_service'], // Invalid service
    ];

    post(route('bookings.store'), $bookingData)
        ->assertSessionHasErrors(['services.0']);

    assertDatabaseCount('bookings', 0);
});

test('can update an existing booking', function () {
    $channel = Channel::factory()->create();

    $booking = Booking::factory()->create([
        'group_name' => 'Original Group',
        'channel_id' => $channel->id,
        'adults' => 2,
        'services' => json_encode(['accommodation']),
    ]);

    $updateData = [
        'ref' => 'UPDATED-REF',
        'group_name' => 'Updated Group',
        'nationality' => 'KE', // Kenya
        'remarks' => 'Updated remarks',
        'file_owner' => (string) auth()->id(),
        'channel_id' => $channel->id,
        'booking_code' => '002/01/2025',
        'arrival_date' => now()->addDays(2)->toDateString(),
        'pickup_details' => '1',
        'departure_date' => now()->addDays(6)->toDateString(),
        'drop_details' => '2',
        'adults' => 4,
        'children' => 2,
        'infants' => 1,
        'rooms' => 2,
        'services' => ['accommodation', 'transfers', 'restaurant'],
        'notes' => 'Updated notes',
    ];

    put(route('bookings.update', $booking), $updateData)
        ->assertRedirect(route('bookings.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('bookings', [
        'id' => $booking->id,
        'ref' => 'UPDATED-REF',
        'group_name' => 'Updated Group',
        'adults' => 4,
        'children' => 2,
        'infants' => 1,
        'rooms' => 2,
    ]);
});

test('validates on update with invalid data', function () {
    $booking = Booking::factory()->create([
        'group_name' => 'Original Group',
    ]);

    $updateData = [
        'group_name' => '', // Empty group name should fail validation
        'booking_code' => '002/01/2025',
        'arrival_date' => now()->addDays(2)->toDateString(),
        'departure_date' => now()->addDays(6)->toDateString(),
        'services' => ['accommodation'],
    ];

    put(route('bookings.update', $booking), $updateData)
        ->assertSessionHasErrors('group_name');

    // Verify data wasn't changed
    assertDatabaseHas('bookings', [
        'id' => $booking->id,
        'group_name' => 'Original Group',
    ]);
});

test('validates departure date on update', function () {
    $booking = Booking::factory()->create([
        'arrival_date' => now()->addDays(10)->toDateString(),
        'departure_date' => now()->addDays(15)->toDateString(),
    ]);

    $updateData = [
        'group_name' => 'Updated Group',
        'booking_code' => '002/01/2025',
        'arrival_date' => now()->addDays(20)->toDateString(),
        'departure_date' => now()->addDays(15)->toDateString(), // Before arrival
        'services' => ['accommodation'],
    ];

    put(route('bookings.update', $booking), $updateData)
        ->assertSessionHasErrors('departure_date');
});

test('validates services on update', function () {
    $booking = Booking::factory()->create([
        'group_name' => 'Original Group',
    ]);

    $updateData = [
        'group_name' => 'Updated Group',
        'booking_code' => '002/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'departure_date' => now()->addDays(5)->toDateString(),
        'services' => [], // Empty services should fail
    ];

    put(route('bookings.update', $booking), $updateData)
        ->assertSessionHasErrors('services');
});

test('stores booking with null channel and agent', function () {
    $bookingData = [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'nationality' => 'UG', // Uganda
        'channel_id' => null, // Channel is nullable
        'agent_code' => null, // Agent is nullable
        'booking_code' => '001/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'pickup_details' => '1',
        'departure_date' => now()->addDays(5)->toDateString(),
        'drop_details' => '2',
        'services' => ['accommodation'],
    ];

    post(route('bookings.store'), $bookingData)
        ->assertRedirect(route('bookings.index'));

    assertDatabaseHas('bookings', [
        'ref' => 'REF-123',
        'group_name' => 'Test Group',
        'channel_id' => null,
        'agent_code' => null,
    ]);
});

test('stores booking with all optional fields', function () {
    $channel = Channel::factory()->create();

    $bookingData = [
        'ref' => 'REF-456',
        'group_name' => 'Complete Test Group',
        'nationality' => 'RW', // Rwanda
        'remarks' => 'Special requirements',
        'file_owner' => (string) auth()->id(),
        'channel_id' => $channel->id,
        'agent_code' => '123',
        'booking_code' => '003/01/2025',
        'arrival_date' => now()->addDays(1)->toDateString(),
        'pickup_details' => '1',
        'departure_date' => now()->addDays(5)->toDateString(),
        'drop_details' => '2',
        'adults' => 5,
        'children' => 3,
        'infants' => 2,
        'rooms' => 3,
        'services' => ['accommodation', 'flight', 'transfers', 'restaurant'],
        'notes' => 'Detailed notes for this booking',
    ];

    post(route('bookings.store'), $bookingData)
        ->assertRedirect(route('bookings.index'));

    assertDatabaseHas('bookings', [
        'ref' => 'REF-456',
        'group_name' => 'Complete Test Group',
        'adults' => 5,
        'children' => 3,
        'infants' => 2,
        'rooms' => 3,
        'notes' => 'Detailed notes for this booking',
    ]);
});
