<?php

namespace Database\Factories;

use App\Models\DatabaseCredential;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DatabaseCredential>
 */
class DatabaseCredentialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word() . fake()->numberBetween(1, 100),
            'host' => fake()->localIpv4(),
            'port' => fake()->numberBetween(3000, 4000),
            'username' => fake()->userName(),
            'password' => fake()->password(),
        ];
    }
}
