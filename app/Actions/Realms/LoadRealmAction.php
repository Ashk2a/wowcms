<?php

namespace App\Actions\Realms;

use App\Actions\Databases\LoadDatabaseAction;
use App\Models\Realm;

class LoadRealmAction
{
    public function __construct(private readonly LoadDatabaseAction $loadDatabaseAction)
    {
    }

    public function __invoke(Realm $realm): void
    {
        foreach ($realm->databases as $realmDatabase) {
            ($this->loadDatabaseAction)($realmDatabase->getDatabaseConnection(), $realmDatabase->type->value);
        }
    }
}
