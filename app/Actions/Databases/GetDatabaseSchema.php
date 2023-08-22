<?php

namespace App\Actions\Databases;

use Illuminate\Support\Arr;
use PDO;

class GetDatabaseSchema
{
    private const INTERNAL_DATABASES = ['information_schema', 'performance_schema', 'mysql', 'sys'];

    public function __construct(private readonly GetPDOInstance $getPDOInstance)
    {
    }

    public function __invoke(
        string $host,
        int $port,
        string $username,
        string $password
    ): ?array {
        $pdo = ($this->getPDOInstance)(
            $host,
            $port,
            $username,
            $password
        );

        if (null === $pdo) {
            return null;
        }

        return Arr::except(
            $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN),
            self::INTERNAL_DATABASES
        );
    }
}
