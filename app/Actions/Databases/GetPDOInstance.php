<?php

namespace App\Actions\Databases;

use PDO;
use Throwable;

class GetPDOInstance
{
    public function __invoke(
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
