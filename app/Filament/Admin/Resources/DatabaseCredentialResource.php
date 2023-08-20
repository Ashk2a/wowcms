<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\DatabaseCredentialResource\Pages;
use App\Models\DatabaseCredential;
use App\Tables\Columns\DateColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DatabaseCredentialResource extends Resource
{
    use SharedTenantResource;

    protected static ?string $model = DatabaseCredential::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('host')
                    ->label(__('labels.host'))
                    ->required()
                    ->minLength(1)
                    ->maxLength(255),
                Forms\Components\TextInput::make('port')
                    ->label(__('labels.port'))
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->maxValue(65535),
                Forms\Components\TextInput::make('username')
                    ->label(__('labels.username'))
                    ->required()
                    ->minLength(1)
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label(__('labels.password'))
                    ->nullable()
                    ->password()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('labels.id'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('labels.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label(__('labels.url'))
                    ->searchable(true, fn (Builder $query, string $search) => $query->matchUrl($search)),
                DateColumn::make('created_at')
                    ->label(__('labels.created_at'))
                    ->formatDate()
                    ->showTooltip()
                    ->sortable(),
                DateColumn::make('updated_at')
                    ->label(__('labels.updated_at'))
                    ->formatDate()
                    ->showTooltip()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDatabaseCredentials::route('/'),
            'create' => Pages\CreateDatabaseCredential::route('/create'),
            'edit' => Pages\EditDatabaseCredential::route('/{record}/edit'),
        ];
    }
}