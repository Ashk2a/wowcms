<?php

namespace Database\Seeders;

use App\Models\Game\Auth\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'nickname' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $account = Account::query()->first();

        if ($account) {
            $user->userAccounts()->create([
                'account_id' => $account->id,
            ]);
        }
    }
}
