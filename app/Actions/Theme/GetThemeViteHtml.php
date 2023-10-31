<?php

namespace App\Actions\Theme;

use Exception;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Illuminate\Foundation\Vite;

readonly class GetThemeViteHtml
{
    public function __construct(private Vite $vite)
    {
    }

    public function __invoke(
        array|string $entrypoints,
        string $buildDirectory = 'build',
        string $hotFilePath = 'hot'
    ): string {
        $entrypoints = is_string($entrypoints) ? explode(',', $entrypoints) : $entrypoints;
        $currentTheme = ThemesManager::current();
        $realBuildDirectory = $currentTheme?->getAssetsPath($buildDirectory) ?? $buildDirectory;
        $realHotFilePath = $currentTheme?->getAssetsPath($hotFilePath) ?? $hotFilePath;

        try {
            return $this->vite
                ->useHotFile($realHotFilePath)
                ->__invoke($entrypoints, $realBuildDirectory)
                ->toHtml();
        } catch (Exception) {
            return '';
        }
    }
}
