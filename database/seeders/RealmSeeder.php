<?php

namespace Database\Seeders;

use App\Enums\RealmDatabaseTypes;
use App\Models\AuthDatabase;
use App\Models\DatabaseCredential;
use App\Models\Realm;
use Illuminate\Database\Seeder;

class RealmSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testingDatabaseRealmConfig = config('dev.testing.databases.realm');

        if ($testingDatabaseRealmConfig['active']) {
            $databaseCredential = DatabaseCredential::factory()->create([
                'name' => 'Test database credential',
                'host' => $testingDatabaseRealmConfig['host'],
                'port' => $testingDatabaseRealmConfig['port'],
                'username' => $testingDatabaseRealmConfig['username'],
                'password' => $testingDatabaseRealmConfig['password'],
            ]);

            $realm = Realm::factory()->create([
                'auth_database_id' => AuthDatabase::factory()->state([
                    'name' => 'Test auth database',
                    'database_credential_id' => $databaseCredential,
                    'database' => $testingDatabaseRealmConfig['databases'][RealmDatabaseTypes::AUTH->value],
                ]),
            ]);

            $realm->gameDatabases()->createMany(
                collect(RealmDatabaseTypes::getGameDatabases())
                    ->map(fn (RealmDatabaseTypes $gameDatabaseType) => [
                        'type' => $gameDatabaseType,
                        'database_credential_id' => $databaseCredential->id,
                        'database' => $testingDatabaseRealmConfig['databases'][$gameDatabaseType->value],
                    ])
            );
        }
    }
}
