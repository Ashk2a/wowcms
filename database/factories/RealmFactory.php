<?php

namespace Database\Factories;

use App\Enums\RealmDatabaseTypes;
use App\Models\DatabaseCredential;
use App\Models\Realm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Realm>
 */
class RealmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'slug' => str($name)->slug(),
            'name' => $name,
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Realm $realm) {
            $databaseCredentials = DatabaseCredential::factory()->create();

            foreach (RealmDatabaseTypes::cases() as $realmDatabaseType) {
                $realm->databases()->create([
                    'type' => $realmDatabaseType,
                    'name' => fake()->word(),
                    'database_credential_id' => $databaseCredentials->id,
                ]);
            }
        });
    }
}
