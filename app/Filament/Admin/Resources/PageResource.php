<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\SharedTenantResource;
use Z3d0X\FilamentFabricator\Resources\PageResource as BasePageResource;

class PageResource extends BasePageResource
{
    use SharedTenantResource;

    //##################################################################################################################
    // PAGES
    //##################################################################################################################

    public static function getPages(): array
    {
        return array_filter([
            'index' => BasePageResource\Pages\ListPages::route('/'),
            'create' => PageResource\Pages\CreatePage::route('/create'),
            'edit' => PageResource\Pages\EditPage::route('/{record}/edit'),
            'view' => config('filament-fabricator.enable-view-page')
                ? BasePageResource\Pages\ViewPage::route('/{record}')
                : null,
        ]);
    }

    //##################################################################################################################
    // NAVIGATION
    //##################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return __('labels.app');
    }
}
