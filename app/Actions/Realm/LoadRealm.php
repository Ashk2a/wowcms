<?php

namespace App\Actions\Realm;

use App\Actions\Database\LoadDatabase;
use App\Models\Realm;

class LoadRealm
{
    public function __construct(private readonly LoadDatabase $loadDatabase)
    {
    }

    public function __invoke(Realm $realm): void
    {
        foreach ($realm->gameDatabases as $realmDatabase) {
            ($this->loadDatabase)(
                $realmDatabase->type->value,
                $realmDatabase->databaseCredential->host,
                $realmDatabase->databaseCredential->port,
                $realmDatabase->databaseCredential->username,
                $realmDatabase->databaseCredential->password,
                $realmDatabase->database
            );
        }
    }
}
