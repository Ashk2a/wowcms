<?php

namespace App\Filament\Admin\Resources;

use App\Actions\Database\HasAvailableDatabase;
use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\DatabaseCredentialResource\Pages;
use App\Models\DatabaseCredential;
use App\Tables\Columns\DateColumn;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Exceptions\Halt;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DatabaseCredentialResource extends Resource
{
    use HasSideTemplateForm;
    use SharedTenantResource;

    //##################################################################################################################
    // ATTRIBUTES
    //##################################################################################################################

    protected static ?string $model = DatabaseCredential::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    //##################################################################################################################
    // FORM
    //##################################################################################################################

    public static function mainFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('labels.name'))
                        ->columnSpan(2)
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                ]),
            Forms\Components\Section::make()
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
                ])
                ->beforeStateDehydrated(function (array $state) {
                    $isAvailable = resolve(HasAvailableDatabase::class)(
                        $state['host'],
                        $state['port'],
                        $state['username'],
                        $state['password'],
                    );

                    if (!$isAvailable) {
                        Notification::make()
                            ->danger()
                            ->title(__('titles.unavailable_database_credential'))
                            ->send();

                        throw new Halt();
                    }
                })
                ->columns(['xl' => 2]),
        ];
    }

    public static function sideFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Placeholder::make('created_at')
                        ->label(__('labels.created_at'))
                        ->content(fn (DatabaseCredential $record): ?string => $record->created_at->diffForHumans()),
                    Forms\Components\Placeholder::make('updated_at')
                        ->label(__('labels.updated_at'))
                        ->content(fn (DatabaseCredential $record): ?string => $record->updated_at->diffForHumans()),
                ])
                ->hidden(fn (?DatabaseCredential $record) => null === $record),
        ];
    }

    public static function hideSideFormOnCreate(): bool
    {
        return true;
    }

    //##################################################################################################################
    // TABLE
    //##################################################################################################################

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
                    ->formatDateState()
                    ->showTooltip()
                    ->sortable(),
                DateColumn::make('updated_at')
                    ->label(__('labels.updated_at'))
                    ->formatDateState()
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

    //##################################################################################################################
    // RELATIONS
    //##################################################################################################################

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    //##################################################################################################################
    // PAGES
    //##################################################################################################################

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDatabaseCredentials::route('/'),
            'create' => Pages\CreateDatabaseCredential::route('/create'),
            'edit' => Pages\EditDatabaseCredential::route('/{record}/edit'),
        ];
    }

    //##################################################################################################################
    // NAVIGATION
    //##################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return str(__('labels.setting'))->plural();
    }
}
