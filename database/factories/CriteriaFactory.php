<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Criteria>
 */
class CriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'completed' => fake()->boolean(),
            'complete_percent' => fake()->numberBetween(0,100),
            'from'=>fake()->dateTimeBetween('-1 week', '+1 week'),
            'to'=>fake()->dateTimeBetween('-1 week', '+1 week'),
            'task_id' => Task::inRandomOrder()->first()->id,
        ];
    }
}
