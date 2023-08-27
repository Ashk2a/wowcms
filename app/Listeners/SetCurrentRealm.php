<?php

namespace App\Listeners;

use App\Models\Realm;
use App\Services\RealmManager;
use Filament\Events\TenantSet;

class SetCurrentRealm
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly RealmManager $realmManager)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(TenantSet $event): void
    {
        /** @var Realm $newRealm */
        $newRealm = $event->getTenant();
        $currentRealm = $this->realmManager->getCurrent();

        if ($currentRealm !== null && $currentRealm->is($newRealm)) {
            return;
        }

        $this->realmManager->setCurrent($newRealm);
    }
}
