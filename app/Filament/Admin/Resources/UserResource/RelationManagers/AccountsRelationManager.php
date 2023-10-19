<?php

namespace App\Filament\Admin\Resources\UserResource\RelationManagers;

use App\Filament\Admin\Resources\AccountResource;
use App\Models\UserAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AccountsRelationManager extends RelationManager
{
    use HasTabs;

    protected static string $relationship = 'userAccounts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('account.username')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('account.username')
            ->columns([
                Tables\Columns\TextColumn::make('account.id')
                    ->label(__('labels.id')),
                Tables\Columns\TextColumn::make('account.username')
                    ->label(__('labels.username')),
                Tables\Columns\TextColumn::make('characters_count')
                    ->label(__('labels.characters_count'))
                    ->getStateUsing(fn (UserAccount $record) => $record->account->characters->count()),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (UserAccount $record) => AccountResource::getUrl('edit', ['record' => $record->account])),
            ])
            ->emptyStateActions([]);
    }
}
