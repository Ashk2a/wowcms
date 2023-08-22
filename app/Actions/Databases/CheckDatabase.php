<?php

namespace App\Actions\Databases;

class CheckDatabase
{
    public function __construct(private readonly GetPDOInstance $getPDOInstance)
    {
    }

    public function __invoke(
        string $host,
        int $port,
        string $username,
        string $password,
        string $databaseName = null
    ): bool {
        return (bool) ($this->getPDOInstance)(
            $host,
            $port,
            $username,
            $password,
            $databaseName
        );
    }
}
