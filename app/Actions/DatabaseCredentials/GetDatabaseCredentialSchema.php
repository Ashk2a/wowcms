<?php

namespace App\Actions\DatabaseCredentials;

use App\Actions\Databases\GetDatabaseSchema;
use App\Models\DatabaseCredential;

class GetDatabaseCredentialSchema
{
    public function __construct(private readonly GetDatabaseSchema $getDatabaseSchema)
    {
    }

    public function __invoke(DatabaseCredential $databaseCredential): array
    {
        return ($this->getDatabaseSchema)(
            $databaseCredential->host,
            $databaseCredential->port,
            $databaseCredential->username,
            $databaseCredential->password
        );
    }
}
