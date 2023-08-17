<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    private const DEFAULT_PASSWORD = 'password';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nickname' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make(self::DEFAULT_PASSWORD),
            'remember_token' => Str::random(10),
        ];
    }
}
