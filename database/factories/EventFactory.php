<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(3),
            'start' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'end' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'places' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'address' => $this->faker->address,
            'price' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
