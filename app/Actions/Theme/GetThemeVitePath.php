<?php

namespace App\Actions\Theme;

use Exception;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Illuminate\Foundation\Vite;

readonly class GetThemeVitePath
{
    public function __construct(private Vite $vite)
    {
    }

    public function __invoke(
        string $asset,
        string $buildDirectory = 'build',
        string $hotFilePath = 'hot'
    ): string {
        $currentTheme = ThemesManager::current();
        $realBuildDirectory = $currentTheme?->getAssetsPath($buildDirectory) ?? $buildDirectory;
        $realHotFilePath = $currentTheme?->getAssetsPath($hotFilePath) ?? $hotFilePath;

        try {
            return $this->vite
                ->useHotFile($realHotFilePath)
                ->asset($asset, $realBuildDirectory);
        } catch (Exception $e) {
            return '';
        }
    }
}
