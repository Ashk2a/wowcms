<?php

namespace Database\Seeders;

use App\Models\Realm;
use Illuminate\Database\Seeder;

class RealmSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Realm::factory(5)->create();
    }
}
