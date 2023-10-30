<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('themeVite', function ($expression) {
            return "<?php echo resolve(\App\Actions\Theme\LoadThemeAssetFromVite::class)($expression); ?>";
        });
    }
}
