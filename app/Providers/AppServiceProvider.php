<?php

namespace App\Providers;

use App\Actions\Realm\LoadRealm;
use App\Services\RealmManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RealmManager::class, fn (Application $application) => new RealmManager(
            $application->make(LoadRealm::class),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
