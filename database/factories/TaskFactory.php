<?php

namespace Database\Factories;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(), //fake()->name(),
            'description' => fake()->text(), //fake()->unique()->safeEmail()
            'status' => fake()->numberBetween(0, 2),
            'plan_id' => Plan::inRandomOrder()->first()->id,
            'actual_end_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'created_by_id' => User::inRandomOrder()->first()->id,
            'assigned_to_id' => User::inRandomOrder()->first()->id
        ];
    }
}
