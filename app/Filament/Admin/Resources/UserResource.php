<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use App\Tables\Columns\DateColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    use SharedTenantResource;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Tables\Columns\TextColumn::make('nickname')
                    ->label(__('labels.nickname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('labels.email'))
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
