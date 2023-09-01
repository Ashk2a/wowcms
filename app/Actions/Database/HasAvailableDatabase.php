<?php

namespace App\Actions\Database;

use App\Actions\Database\Concerns\PDOBuilder;

class HasAvailableDatabase
{
    use PDOBuilder;

    public function __invoke(
        string $host,
        int $port,
        string $username,
        string $password,
        string $databaseName = null
    ): bool {
        return (bool) $this->buildPDO(
            $host,
            $port,
            $username,
            $password,
            $databaseName
        );
    }
}
