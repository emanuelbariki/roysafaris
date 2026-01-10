<?php

namespace Database\Factories;

use App\Models\SystemModule;
use Illuminate\Database\Eloquent\Factories\Factory;

class SystemModuleFactory extends Factory
{
    protected $model = SystemModule::class;

    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(2),
        ];
    }
}
