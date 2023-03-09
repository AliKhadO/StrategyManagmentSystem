<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
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
            'type' => fake()->numberBetween(0, 1),
            'timeframe_start_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'timeframe_end_date' => fake()->dateTimeBetween('+1 week', '+2 week'),
            'actual_end_date' => fake()->dateTimeBetween('+1 week', '+3 week'),
            'created_by_id' => User::inRandomOrder()->first()->id,
            'goal_id' => Goal::inRandomOrder()->first()->id,
            'assigned_to_id' => User::inRandomOrder()->first()->id
        ];
    }
}
