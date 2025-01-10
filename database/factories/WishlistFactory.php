<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
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
            'priority' => fake()->numberBetween(0, 10),
            'title' => fake()->words(2, true),
            'url' => fake()->url(),
            'cost' => fake()->numberBetween(10, 1000),
            'purchased' => 0,
        ];
    }
}
