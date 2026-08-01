<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $user = User::query()->select('id')->inRandomOrder()->first();

        return [
            'user_id'       => $user->id,
            'name'          => fake()->words(3, true),
            'description'   => fake()->paragraph(),
            'status'        => fake()->randomElement(['active','completed','archived']),
        ];
    }
}
