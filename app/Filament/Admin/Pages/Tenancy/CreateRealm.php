<?php

namespace App\Filament\Admin\Pages\Tenancy;

use App\Models\Realm;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class CreateRealm extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Add a new realm';
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
