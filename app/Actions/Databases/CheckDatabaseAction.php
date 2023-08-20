<?php

namespace App\Actions\Databases;

use Illuminate\Support\Facades\DB;
use PDO;
use Throwable;

class CheckDatabaseAction
{
    public function __invoke(string $connectionName): bool
    {
        $databaseConnection = config('database.connections.' . $connectionName);
        $tmpDatabaseConnection = $databaseConnection;

        $tmpDatabaseConnection['options'][PDO::ATTR_TIMEOUT] = 1;

        config()->set('database.connections.' . $connectionName, $tmpDatabaseConnection);

        DB::purge($connectionName);

        try {
            DB::connection($connectionName)->getPdo();

            return true;
        } catch (Throwable) {
            return false;
        } finally {
            config()->set('database.connections.' . $connectionName, $databaseConnection);

            DB::purge($connectionName);
        }
    }
}
