<?php

namespace App\Filament\Admin\Resources\AccountResource\RelationManagers;

use App\Filament\Admin\Resources\CharacterResource;
use App\Models\Game\Character\Character;
use App\Tables\Columns\DateColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CharactersRelationManager extends RelationManager
{
    use HasTabs;

    protected static string $relationship = 'characters';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('guid')
                    ->label(__('labels.guid')),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('race')
                    ->size(25)
                    ->getStateUsing(fn (Character $record) => theme_vite_url(
                        sprintf(
                            CharacterResource::IMAGE_RACE_PATH,
                            $record->race,
                            $record->gender
                        )
                    )),
                Tables\Columns\ImageColumn::make('class')
                    ->size(25)
                    ->getStateUsing(fn (Character $record) => theme_vite_url(
                        sprintf(
                            CharacterResource::IMAGE_CLASS_PATH,
                            $record->class,
                        )
                    )),
                Tables\Columns\TextColumn::make('level'),
                DateColumn::make('creation_date')
                    ->formatDateState()
                    ->showTooltip(),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([])
            ->emptyStateActions([]);
    }
}
