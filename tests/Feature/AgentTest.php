<?php

use App\Models\Agent;
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

test('can create an agent', function () {
    $agentData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+1234567890',
        'address' => '123 Main St',
    ];

    post(route('agents.store'), $agentData)
        ->assertRedirect(route('agents.index'))
        ->assertSessionHas('success', 'Agent created successfully.');

    assertDatabaseHas('agents', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

test('cannot create agent without required fields', function () {
    post(route('agents.store'), [])
        ->assertSessionHasErrors(['name', 'email']);
});

test('cannot create agent with invalid email', function () {
    $agentData = [
        'name' => 'John Doe',
        'email' => 'not-an-email',
        'phone' => '+1234567890',
    ];

    post(route('agents.store'), $agentData)
        ->assertSessionHasErrors(['email']);
});

test('cannot create agent with duplicate email', function () {
    Agent::factory()->create(['email' => 'john@example.com']);

    $agentData = [
        'name' => 'Jane Doe',
        'email' => 'john@example.com',
        'phone' => '+1234567890',
    ];

    post(route('agents.store'), $agentData)
        ->assertSessionHasErrors(['email']);
});

test('can update an agent', function () {
    $agent = Agent::factory()->create();

    $updatedData = [
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'phone' => '+0987654321',
        'address' => '456 Oak Ave',
    ];

    put(route('agents.update', $agent), $updatedData)
        ->assertRedirect(route('agents.index'))
        ->assertSessionHas('success', 'Agent updated successfully.');

    assertDatabaseHas('agents', [
        'id' => $agent->id,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'phone' => '+0987654321',
        'address' => '456 Oak Ave',
    ]);
});

test('cannot update agent with invalid email', function () {
    $agent = Agent::factory()->create();

    $updatedData = [
        'name' => 'Jane Smith',
        'email' => 'invalid-email',
        'phone' => '+0987654321',
    ];

    put(route('agents.update', $agent), $updatedData)
        ->assertSessionHasErrors(['email']);
});

test('cannot update agent with duplicate email', function () {
    $agent1 = Agent::factory()->create(['email' => 'agent1@example.com']);
    $agent2 = Agent::factory()->create(['email' => 'agent2@example.com']);

    $updatedData = [
        'name' => 'Updated Agent',
        'email' => 'agent1@example.com',
        'phone' => '+0987654321',
    ];

    put(route('agents.update', $agent2), $updatedData)
        ->assertSessionHasErrors(['email']);
});

test('phone number is optional when creating agent', function () {
    $agentData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ];

    post(route('agents.store'), $agentData)
        ->assertRedirect(route('agents.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('agents', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

test('address is optional when creating agent', function () {
    $agentData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+1234567890',
    ];

    post(route('agents.store'), $agentData)
        ->assertRedirect(route('agents.index'))
        ->assertSessionHas('success');

    assertDatabaseHas('agents', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

test('can soft delete an agent', function () {
    $agent = Agent::factory()->create();

    delete(route('agents.destroy', $agent))
        ->assertRedirect(route('agents.index'))
        ->assertSessionHas('success', 'Agent deleted successfully.');

    $this->assertDatabaseHas('agents', [
        'id' => $agent->id,
    ]);

    $this->assertNotNull(Agent::withTrashed()->find($agent->id)->deleted_at);
});

test('deleted agents are not retrieved by default queries', function () {
    $agent = Agent::factory()->create();

    delete(route('agents.destroy', $agent));

    $agents = Agent::all();

    expect($agents)->not->toContain($agent);

    $agentWithTrashed = Agent::withTrashed()->find($agent->id);

    expect($agentWithTrashed)->not->toBeNull();
});
