<?php

namespace App\Actions\Databases\Concerns;

use PDO;
use Throwable;

trait PDOBuilder
{
    protected function buildPDO(
        string $host,
        int $port,
        string $username,
        string $password,
        string $databaseName = null
    ): ?PDO {
        $dsn = "mysql:host={$host};port={$port}";

        if (null !== $databaseName) {
            $dsn .= ";dbname={$databaseName}";
        }

        try {
            return new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_TIMEOUT => 1,
                ]
            );
        } catch (Throwable $e) {
            return null;
        }
    }
}
