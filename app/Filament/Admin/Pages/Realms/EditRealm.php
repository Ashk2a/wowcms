<?php

namespace App\Filament\Admin\Pages\Realms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditRealm extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Edit realm';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }
}
