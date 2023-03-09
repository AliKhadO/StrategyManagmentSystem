<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
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
            'timeframe_start_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'timeframe_end_date' => fake()->dateTimeBetween('+1 week', '+2 week'),
            'actual_end_date' => fake()->dateTimeBetween('+1 week', '+3 week'),
            'created_by_id' => User::inRandomOrder()->first()->id,
            'department_id' => Department::inRandomOrder()->first()->id
        ];
    }
}
