<?php

namespace App\Actions\Databases;

use Illuminate\Support\Facades\DB;

class LoadDatabaseAction
{
    public function __invoke(array $databaseConnection, string $connectionName): void
    {
        $databaseConfigKey = 'database.connections.' . $connectionName;
        $currentDatabaseConnection = config($databaseConfigKey);
        $newDatabaseConnection = array_merge($currentDatabaseConnection, $databaseConnection);

        if (0 === strcmp(json_encode($currentDatabaseConnection), json_encode($newDatabaseConnection))) {
            return;
        }

        config()->set($databaseConfigKey, $newDatabaseConnection);

        DB::purge($connectionName);
    }
}
