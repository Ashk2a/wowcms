<?php

namespace Database\Factories;

use App\Models\AuthDatabase;
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
}
