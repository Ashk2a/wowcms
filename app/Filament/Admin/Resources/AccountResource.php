<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\AccountResource\Pages;
use App\Forms\Components\DatePlaceholder;
use App\Models\Game\Auth\Account;
use App\Services\RealmManager;
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
    use SharedTenantResource;
    use HasSideTemplateForm;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    protected static ?string $model = Account::class;

    protected static ?string $recordTitleAttribute = 'username';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    //###################################################################################################################
    // FORM
    //###################################################################################################################

    public static function mainForm(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('username')
                        ->label(__('labels.username')),
                ]),
        ];
    }

    public static function sideForm(): array
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

    //###################################################################################################################
    // TABLE
    //###################################################################################################################

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('labels.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('userAccount.user.email')
                    ->label(__('labels.user'))
                    ->icon('heroicon-o-user')
                    ->url(
                        fn (Account $account) => ($account->userAccount
                            ? UserResource::getUrl('edit', ['record' => $account->userAccount->user])
                            : null
                        ),
                        true
                    )
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('username')
                    ->label(__('labels.username')),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }

    //###################################################################################################################
    // PERMISSIONS
    //###################################################################################################################

    public static function canViewAny(): bool
    {
        return null !== resolve(RealmManager::class)->getCurrent()?->auth_database_id;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    //###################################################################################################################
    // NAVIGATION
    //###################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return __('labels.game');
    }

    //###################################################################################################################
    // QUERY
    //###################################################################################################################

    public static function getEloquentQuery(): Builder
    {
        return Account::query()
            ->with('userAccount.user');
    }
}
