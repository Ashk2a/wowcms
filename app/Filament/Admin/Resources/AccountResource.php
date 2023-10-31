<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\AccountResource\Pages;
use App\Filament\Admin\Resources\AccountResource\RelationManagers\CharactersRelationManager;
use App\Forms\Components\DatePlaceholder;
use App\Models\Game\Auth\Account;
use App\Tables\Columns\DateColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccountResource extends Resource
{
    use HasSideTemplateForm;
    use SharedTenantResource;

    //##################################################################################################################
    // ATTRIBUTES
    //##################################################################################################################

    protected static ?string $model = Account::class;

    protected static ?string $recordTitleAttribute = 'username';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    //##################################################################################################################
    // FORM
    //##################################################################################################################

    public static function mainFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('username')
                        ->label(__('labels.username')),
                ]),
        ];
    }

    public static function sideFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    DatePlaceholder::make('joindate')
                        ->label(__('labels.created_at'))
                        ->showDate(),
                    DatePlaceholder::make('last_login')
                        ->label(__('labels.last_login'))
                        ->showDate(),
                ]),
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Toggle::make('online')
                        ->label(__('labels.online'))
                        ->disabled(),
                    Forms\Components\Toggle::make('locked')
                        ->label(__('labels.locked')),
                ]),
        ];
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
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('labels.user'))
                    ->icon('heroicon-o-user')
                    ->color('primary')
                    ->url(
                        fn (Account $account) => ($account->user
                            ? UserResource::getUrl('edit', ['record' => $account->user])
                            : null
                        ),
                    ),
                Tables\Columns\TextColumn::make('username')
                    ->label(__('labels.username')),
                Tables\Columns\TextColumn::make('characters_count')
                    ->label(__('labels.characters_count')),
                DateColumn::make('last_login')
                    ->label(__('labels.last_login'))
                    ->formatDateState()
                    ->showTooltip(),
                DateColumn::make('joindate')
                    ->label(__('labels.created_at'))
                    ->formatDateState()
                    ->showTooltip(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->emptyStateActions([]);
    }

    //##################################################################################################################
    // RELATIONS
    //##################################################################################################################

    public static function getRelations(): array
    {
        return [
            CharactersRelationManager::class,
        ];
    }

    //##################################################################################################################
    // PAGES
    //##################################################################################################################

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }

    //##################################################################################################################
    // PERMISSIONS
    //##################################################################################################################

    public static function canCreate(): bool
    {
        return false;
    }

    //##################################################################################################################
    // NAVIGATION
    //##################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return __('labels.game');
    }

    //##################################################################################################################
    // QUERY
    //##################################################################################################################

    public static function getEloquentQuery(): Builder
    {
        return Account::query()
            ->with([
                'user',
            ])
            ->withCount([
                'characters',
            ]);
    }
}
