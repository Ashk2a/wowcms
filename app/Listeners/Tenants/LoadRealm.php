<?php

namespace App\Listeners\Tenants;

use App\Actions\Realms;
use App\Models\Realm;
use Filament\Events\TenantSet;

class LoadRealm
{
    public function __construct(private Realms\LoadDatabasesAction $action)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(TenantSet $event): void
    {
        /** @var Realm $realm */
        $realm = $event->getTenant();

        ($this->action)($realm);
    }
}
