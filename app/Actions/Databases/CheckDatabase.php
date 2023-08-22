<?php

namespace App\Actions\Databases;

use App\Actions\Databases\Concerns\PDOBuilder;

class CheckDatabase
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
