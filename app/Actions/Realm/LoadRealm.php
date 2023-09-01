<?php

namespace App\Actions\Realm;

use App\Actions\Database\LoadDatabase;
use App\Models\Realm;

readonly class LoadRealm
{
    public function __construct(private LoadDatabase $loadDatabase)
    {
    }

    public function __invoke(Realm $realm): void
    {
        $authDatabase = $realm->authDatabase;

        ($this->loadDatabase)(
            'auth',
            $authDatabase->databaseCredential->host,
            $authDatabase->databaseCredential->port,
            $authDatabase->databaseCredential->username,
            $authDatabase->databaseCredential->password,
            $authDatabase->database
        );

        foreach ($realm->gameDatabases as $gameDatabase) {
            ($this->loadDatabase)(
                $gameDatabase->type->value,
                $gameDatabase->databaseCredential->host,
                $gameDatabase->databaseCredential->port,
                $gameDatabase->databaseCredential->username,
                $gameDatabase->databaseCredential->password,
                $gameDatabase->database
            );
        }
    }
}
