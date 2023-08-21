<?php

namespace App\Filament\Admin\Pages\Realms;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

trait RealmFormSchema
{
    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label(__('labels.name'))
                ->required()
                ->minLength(1)
                ->maxLength(255),
            Repeater::make('databases')
                ->label(str(__('labels.database'))->plural())
                ->relationship('databases')
                ->schema([
                    TextInput::make('type')
                        ->label(__('labels.type'))
                        ->disabled(),
                    Select::make('database_credential_id')
                        ->label(__('labels.credential'))
                        ->relationship('databaseCredential', 'name')
                        ->createOptionForm([
                            TextInput::make('name'),
                        ]),
                    TextInput::make('name')
                        ->label(__('labels.name'))
                        ->minLength(1)
                        ->maxLength(255),
                ])
                ->addable(false)
                ->deletable(false),
        ];
    }
}
