<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Filament\Admin\Resources\DatabaseCredentialResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

trait RealmFormSchema
{
    public function getFormSchema(): array
    {
        return [
            Checkbox::make('is_visible')
                ->label(__('labels.is_visible'))
                ->default(true),
            Grid::make()
                ->schema([
                    TextInput::make('name')
                        ->label(__('labels.name'))
                        ->required()
                        ->minLength(1)
                        ->maxLength(255),
                    TextInput::make('priority')
                        ->label(__('labels.priority'))
                        ->required()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(255)
                        ->integer(),
                ]),
            Repeater::make('databases')
                ->label(str(__('labels.database'))->plural())
                ->relationship('databases')
                ->itemLabel(fn (array $state) => str($state['type'])->ucfirst())
                ->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('type')
                                ->label(__('labels.type'))
                                ->required()
                                ->hidden(),
                            Select::make('database_credential_id')
                                ->label(__('labels.credential'))
                                ->searchable()
                                ->preload()
                                ->relationship('databaseCredential', 'name')
                                ->createOptionForm([
                                    Grid::make()->schema(DatabaseCredentialResource::getFormSchema()),
                                ])
                                ->required(),
                            TextInput::make('name')
                                ->label(__('labels.name'))
                                ->minLength(1)
                                ->maxLength(255)
                                ->required(),
                        ]),
                ])
                ->addable(false)
                ->deletable(false),
        ];
    }
}
