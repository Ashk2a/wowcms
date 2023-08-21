<?php

namespace App\Filament\Admin\Pages\Realms;

use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditRealm extends EditTenantProfile
{
    use RealmFormSchema;

    public static function getLabel(): string
    {
        return 'Edit realm';
    }

    public function form(Form $form): Form
    {
        return $form->schema($this->getFormSchema());
    }
}
