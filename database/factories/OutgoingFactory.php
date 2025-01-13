<?php

namespace Database\Factories;

use App\Models\Month;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Outgoing>
 */
class OutgoingFactory extends Factory
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
            'month_id' => Month::factory(),
            'recurring' => fake()->boolean(),
            'day' => fake()->numberBetween(1, 31),
            'title' => fake()->words(2, true),
            'cost' => fake()->numberBetween(10, 600),
            'paid' => fake()->boolean()
        ];
    }
}
