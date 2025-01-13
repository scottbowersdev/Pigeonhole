<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutgoingsRecurring>
 */
class OutgoingsRecurringFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'day' => fake()->numberBetween(0, 31),
            'title' => fake()->words(2, true),
            'cost' => fake()->numberBetween(10, 600)
        ];
    }
}
