<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Models\Realm;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class CreateRealm extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Create new realm';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    protected function handleRegistration(array $data): Realm
    {
        return Realm::create($data);
    }
}
