<?php

declare(strict_types=1);

use App\Actions\Theme\GetThemeViteHtml;
use App\Actions\Theme\GetThemeVitePath;

function theme_vite_html(string $path): string
{
    return resolve(GetThemeViteHtml::class)($path);
}

function theme_vite_path(string $path): string
{
    return resolve(GetThemeVitePath::class)($path);
}

function theme_vite_url(string $path): string
{
    return url(theme_vite_path($path));
}
