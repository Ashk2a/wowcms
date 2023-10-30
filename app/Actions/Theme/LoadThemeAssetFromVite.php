<?php

namespace App\Actions\Theme;

use Exception;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Illuminate\Foundation\Vite;

readonly class LoadThemeAssetFromVite
{
    public function __construct(private Vite $vite)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(
        string|array $entrypoints,
        string $buildDirectory = 'public/build',
        string $hotFilePath = 'public/hot'
    ): string {
        $entrypoints = is_string($entrypoints) ? explode(',', $entrypoints) : $entrypoints;
        $realBuildDirectory = ThemesManager::current()?->getPath($buildDirectory) ?? $buildDirectory;
        $realHotFilePath = ThemesManager::current()?->getPath($hotFilePath) ?? $hotFilePath;

        return $this->vite
            ->useHotFile($realHotFilePath)
            ->__invoke($entrypoints, $realBuildDirectory)
            ->toHtml();
    }
}
