<?php

namespace Database\Factories;

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
            'category_id' => $this->faker->numberBetween(1, 5), // Assuming you have ticket categories with IDs 1 to 5
            'status' => $this->faker->randomElement(['open', 'closed', 'in progress', 'on hold']),
            'priority' => $this->faker->randomElement(['high', 'medium', 'low']),
            'feedback_notes' => $this->faker->paragraph,
        ];
    }
}
