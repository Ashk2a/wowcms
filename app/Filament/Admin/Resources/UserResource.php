<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use App\Tables\Columns\DateColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    use HasSideTemplateForm;
    use SharedTenantResource;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'email';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    //###################################################################################################################
    // FORM
    //###################################################################################################################

    public static function mainFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('nickname')
                        ->label(__('labels.nickname'))
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->label(__('labels.email'))
                        ->required()
                        ->email()
                        ->unique(ignoreRecord: true),
                ])
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
                        ->content(fn (User $record): ?string => $record->created_at->diffForHumans()),
                    Forms\Components\Placeholder::make('updated_at')
                        ->label(__('labels.updated_at'))
                        ->content(fn (User $record): ?string => $record->updated_at->diffForHumans()),
                ])
                ->hidden(fn (?User $record) => null === $record),
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
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    //###################################################################################################################
    // PERMISSIONS
    //###################################################################################################################

    public static function canCreate(): bool
    {
        return false;
    }

    //###################################################################################################################
    // NAVIGATION
    //###################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return __('labels.app');
    }
}
