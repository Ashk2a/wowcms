<?php

namespace App\Actions\Databases;

use App\Actions\Databases\Concerns\PDOBuilder;
use Illuminate\Support\Arr;
use PDO;

class GetDatabaseSchema
{
    use PDOBuilder;

    private const INTERNAL_DATABASES = ['information_schema', 'performance_schema', 'mysql', 'sys'];

    public function __invoke(
        string $host,
        int $port,
        string $username,
        string $password
    ): array {
        $pdo = $this->buildPDO(
            $host,
            $port,
            $username,
            $password
        );

        if (null === $pdo) {
            return [];
        }

        return Arr::except(
            $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN),
            self::INTERNAL_DATABASES
        );
    }
}
