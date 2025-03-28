<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(2),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'status' => 'Pending', // Always set to Pending
            'user_id' => User::pluck('id')->random(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
    }
}
