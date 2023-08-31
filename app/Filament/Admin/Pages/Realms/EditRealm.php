<?php

namespace App\Filament\Admin\Pages\Realms;

use Filament\Pages\Tenancy\EditTenantProfile;

class EditRealm extends EditTenantProfile
{
    use RealmFormSchema;

    protected static ?string $slug = 'edit';

    public static function getLabel(): string
    {
        return __('filament-panels::resources/pages/edit-record.title', [
            'label' => __('labels.realm'),
        ]);
    }
}
