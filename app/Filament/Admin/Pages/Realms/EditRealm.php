<?php

namespace App\Filament\Admin\Pages\Realms;

use Filament\Pages\Tenancy\EditTenantProfile;

class EditRealm extends EditTenantProfile
{
    use RealmFormSchema;

    protected static bool $isCreatePage = false;

    public static function getLabel(): string
    {
        return __('titles.edit_realm');
    }
}
