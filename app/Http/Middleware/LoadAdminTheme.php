<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Hexadog\ThemesManager\Facades\ThemesManager;
use Illuminate\Http\Request;

class LoadAdminTheme
{
    public function handle(Request $request, \Closure $next)
    {
        // Do not load theme if API request or App is running in console
        if ($request->expectsJson() || app()->runningInConsole()) {
            return $next($request);
        }

        ThemesManager::set('wowcms/admin');

        return $next($request);
    }
}
