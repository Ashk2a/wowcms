<?php

namespace App\Providers;

use App\Listeners\SetCurrentRealm;
use Filament\Events\TenantSet;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        TenantSet::class => [
            SetCurrentRealm::class,
        ]
    ];
}
