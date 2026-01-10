<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\SystemModule;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        $module = SystemModule::first() ?? SystemModule::factory()->create();

        return [
            'system_module_id' => $module->id,
            'ability' => fake()->unique()->word() . '.' . fake()->word(),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
