<?php

namespace Database\Factories;

use App\Models\GameDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GameDatabase>
 */
class GameDatabaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'database' => $this->faker->word,
        ];
    }
}
