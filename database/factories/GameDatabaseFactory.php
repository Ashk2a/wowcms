<?php

namespace Database\Factories;

use App\Models\DatabaseCredential;
use App\Models\GameDatabase;
use App\Models\Realm;
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
            'realm_id' => Realm::factory(),
            'database_credential_id' => DatabaseCredential::factory(),
            'database' => $this->faker->word,
        ];
    }
}
