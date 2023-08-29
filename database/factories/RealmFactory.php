<?php

namespace Database\Factories;

use App\Enums\RealmGameDatabaseTypes;
use App\Models\AuthDatabase;
use App\Models\GameDatabase;
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
            'auth_database_id' => AuthDatabase::factory(),
        ];
    }

    public function configure(): self
    {
        return $this
            ->afterCreating(function (Realm $realm) {
                $databaseCredential = $realm->authDatabase->databaseCredential;

                $realm->gameDatabases()->createMany(
                    collect(RealmGameDatabaseTypes::cases())
                        ->map(fn (RealmGameDatabaseTypes $type) => (
                            GameDatabase::factory()
                                ->make([
                                    'database_credential_id' => $databaseCredential,
                                    'type' => $type,
                                ])
                                ->toArray()
                        ))
                );
            });
    }
}
