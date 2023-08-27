<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Realm\LoadRealm;
use App\Models\Realm;

class RealmManager
{
    private ?Realm $currentRealm = null;

    public function __construct(private readonly LoadRealm $loadRealm)
    {
    }

    public function setCurrent(Realm $realm): void
    {
        $this->currentRealm = $realm;
        ($this->loadRealm)($realm);
    }

    public function each(callable $callback): void
    {
        foreach (Realm::all() as $realm) {
            $this->setCurrent($realm);

            $callback($realm);
        }
    }

    public function getCurrent(): ?Realm
    {
        return $this->currentRealm;
    }
}
