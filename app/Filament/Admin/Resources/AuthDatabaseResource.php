<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\AuthDatabaseResource\Pages;
use App\Models\AuthDatabase;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AuthDatabaseResource extends Resource
{
    use SharedTenantResource;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    protected static ?string $model = AuthDatabase::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    //###################################################################################################################
    // FORM
    //###################################################################################################################

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    //###################################################################################################################
    // TABLE
    //###################################################################################################################

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('labels.id')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('labels.name')),
                Tables\Columns\TextColumn::make('database_credential_name')
                    ->label(__('labels.database_credential'))
                    ->getStateUsing(fn (AuthDatabase $authDatabase) => $authDatabase->databaseCredential->name)
                    ->icon('heroicon-o-circle-stack')
                    ->url(fn (AuthDatabase $authDatabase) => DatabaseCredentialResource::getUrl('edit', ['record' => $authDatabase->database_credential_id]))
                    ->openUrlInNewTab(),
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

    //###################################################################################################################
    // RELATIONS
    //###################################################################################################################

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    //###################################################################################################################
    // PAGES
    //###################################################################################################################

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthDatabases::route('/'),
            'create' => Pages\CreateAuthDatabase::route('/create'),
            'edit' => Pages\EditAuthDatabase::route('/{record}/edit'),
        ];
    }

    //###################################################################################################################
    // NAVIGATION
    //###################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return str(__('labels.setting'))->plural();
    }
}
