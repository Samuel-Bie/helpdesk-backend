<?php

namespace Database\Factories;

use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(), // Example for generating image URLs
            'category_id' => TicketCategory::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['open', 'closed', 'in progress', 'on hold']),
            'priority' => $this->faker->randomElement(['high', 'medium', 'low']),
            'feedback_notes' => $this->faker->paragraph,
            'creator_user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
