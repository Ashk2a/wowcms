<?php

namespace Database\Factories;

use App\Enums\Emulators;
use App\Models\AuthDatabase;
use App\Models\DatabaseCredential;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AuthDatabase>
 */
class AuthDatabaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'emulator' => Emulators::AZEROTHCORE,
            'database_credential_id' => DatabaseCredential::factory(),
            'database' => $this->faker->word,
        ];
    }
}
