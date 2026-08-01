<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        $project = Project::query()->select('id')->inRandomOrder()->first();

        return [
            'project_id'    => $project->id,
            'title'         => fake()->words(3, true),
            'description'   => fake()->paragraph(),
            'status'        => fake()->randomElement(['todo','in_progress','done']),
            'due_date'      => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        ];
    }
}
