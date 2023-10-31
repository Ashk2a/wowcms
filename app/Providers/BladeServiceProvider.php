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
        Blade::directive('themeVite', static function ($expression) {
            return "<?php echo theme_vite_html($expression); ?>";
        });

        Blade::directive('themeViteUrl', static function ($expression) {
            return "<?php echo theme_vite_url($expression); ?>";
        });

        Blade::directive('themeVitePath', static function ($expression) {
            return "<?php echo theme_vite_path($expression); ?>";
        });
    }
}
