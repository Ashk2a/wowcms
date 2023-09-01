<?php

declare(strict_types=1);

namespace App\Support\IdeHelper;

use App\Actions\Database\LoadDatabase;
use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Model;

readonly class LoadGameDatabasesHook implements ModelHookInterface
{
    public function __construct(private LoadDatabase $loadDatabase)
    {
    }

    public function run(ModelsCommand $command, Model $model): void
    {
        $testRealmDatabase = config('dev.testing.databases.realm');

        if (false === $testRealmDatabase['active']) {
            throw new \RuntimeException('Test realm database is not active, you cannot run this command.');
        }

        foreach ($testRealmDatabase['databases'] as $connectionName => $databaseName) {
            ($this->loadDatabase)(
                $connectionName,
                $testRealmDatabase['host'],
                (int) $testRealmDatabase['port'],
                $testRealmDatabase['username'],
                $testRealmDatabase['password'],
                $databaseName,
            );
        }
    }
}
