<?php

namespace App\Actions\Databases;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JsonException;

class LoadDatabase
{
    public function __invoke(
        string $connectionName,
        string $host,
        int $port,
        string $username,
        string $password,
        string $databaseName
    ): void {
        $databaseConfigKey = 'database.connections.' . $connectionName;
        $currentDatabaseConnection = config($databaseConfigKey);
        $newDatabaseConnection = array_merge(
            $currentDatabaseConnection,
            [
                'host' => $host,
                'port' => $port,
                'username' => $username,
                'password' => $password,
                'database' => $databaseName,
            ]
        );

        try {
            $connectionCmp = strcmp(
                json_encode($currentDatabaseConnection, JSON_THROW_ON_ERROR),
                json_encode($newDatabaseConnection, JSON_THROW_ON_ERROR)
            );

            if (0 === $connectionCmp) {
                return;
            }
        } catch (JsonException $e) {
            Log::error('[LoadDatabaseAction] Failed to compare database connections');

            return;
        }

        config()->set($databaseConfigKey, $newDatabaseConnection);

        DB::purge($connectionName);
    }
}
