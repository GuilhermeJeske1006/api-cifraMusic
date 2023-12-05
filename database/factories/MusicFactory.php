<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'singer_id' => fake()->numberBetween(1, 10),
            'note_id' => fake()->numberBetween(1, 25),
            'bpm' => fake()->randomNumber(2),
            'rhythm_id' => fake()->numberBetween(1, 10),
            'lyrics' => fake()->randomHtml(),
            'created_by' => fake()->numberBetween(1, 10),
        ];
    }
}
