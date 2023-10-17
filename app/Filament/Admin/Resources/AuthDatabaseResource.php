<?php

namespace App\Filament\Admin\Resources;

use App\Actions\Database\HasAvailableDatabase;
use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Enums\Emulators;
use App\Filament\Admin\Resources\AuthDatabaseResource\Pages;
use App\Models\AuthDatabase;
use App\Models\DatabaseCredential;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Exceptions\Halt;
use Filament\Tables;
use Filament\Tables\Table;

class AuthDatabaseResource extends Resource
{
    use HasSideTemplateForm;
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

    public static function mainFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('labels.name'))
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\Select::make('emulator')
                        ->label(__('labels.emulator'))
                        ->required()
                        ->default(Emulators::AZEROTHCORE)
                        ->options(Emulators::class),
                ]),
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Select::make('database_credential_id')
                        ->label(__('labels.database_credential'))
                        ->preload()
                        ->relationship('databaseCredential', 'name')
                        ->createOptionForm([
                            Forms\Components\Grid::make()->schema(DatabaseCredentialResource::formSchema()),
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('database')
                        ->label(__('labels.database'))
                        ->minLength(1)
                        ->maxLength(255)
                        ->required(),
                ])
                ->beforeStateDehydrated(function (array $state) {
                    $databaseCredential = DatabaseCredential::find($state['database_credential_id']);
                    $databaseName = $state['database'] ?? null;

                    $isAvailable = !is_null($databaseCredential) && !is_null($databaseName)
                        ? resolve(HasAvailableDatabase::class)(
                            $databaseCredential->host,
                            $databaseCredential->port,
                            $databaseCredential->username,
                            $databaseCredential->password,
                            $state['database'],
                        )
                        : false;

                    if (!$isAvailable) {
                        Notification::make()
                            ->danger()
                            ->title(__('titles.unavailable_database_credential_with_database', [
                                'database_credential_name' => $databaseCredential?->name,
                                'database_name' => $databaseName,
                            ]))
                            ->send();

                        throw new Halt();
                    }
                })
                ->columns(['xl' => 2]),
        ];
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
