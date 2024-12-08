<?php

namespace Database\Factories;

use App\Models\Farm;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FarmFactory extends Factory
{
    protected $model = Farm::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'location' => $this->faker->address,
            'size' => $this->faker->numberBetween(10, 1000),
            'description' => $this->faker->paragraph
        ];
    }
} 