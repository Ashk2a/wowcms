<?php

namespace App\Actions\DatabaseCredential;

use App\Actions\Database\CheckDatabase;
use App\Models\DatabaseCredential;

class CheckDatabaseCredential
{
    public function __construct(private readonly CheckDatabase $checkDatabase)
    {
    }

    public function __invoke(DatabaseCredential $databaseCredential, ?string $databaseName): bool
    {
        return ($this->checkDatabase)(
            $databaseCredential->host,
            $databaseCredential->port,
            $databaseCredential->username,
            $databaseCredential->password,
            $databaseName,
        );
    }
}
