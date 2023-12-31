<?php

namespace App\Core\Models\Traits;

use App\Enums\RealmDatabaseTypes;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait InteractsWithDatabases
{
    public function setAppConnection(): self
    {
        return $this->setConnection('app');
    }

    public function setAuthConnection(): self
    {
        return $this->setConnection('auth');
    }

    public function setCharactersConnection(): self
    {
        return $this->setConnection(RealmDatabaseTypes::CHARACTERS->value);
    }

    public function setWorldConnection(): self
    {
        return $this->setConnection(RealmDatabaseTypes::WORLD->value);
    }
}
