<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\RealmlistResource\Pages;
use App\Models\Game\Auth\Realmlist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RealmlistResource extends Resource
{
    use SharedTenantResource;
    use HasSideTemplateForm;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    protected static ?string $model = Realmlist::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

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
                        ->maxLength(32),
                ]),
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('address')
                        ->label(__('labels.address'))
                        ->default('127.0.0.1')
                        ->required()
                        ->ip()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('port')
                        ->label(__('labels.port'))
                        ->default('8085')
                        ->required()
                        ->integer()
                        ->minValue(1)
                        ->maxValue(65535),
                    Forms\Components\TextInput::make('localAddress')
                        ->label(__('labels.local_address'))
                        ->default('127.0.0.1')
                        ->required()
                        ->ip()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('localSubnetMask')
                        ->label(__('labels.local_subnet_mask'))
                        ->default('255.255.255.0')
                        ->required()
                        ->ip()
                        ->maxLength(255),
                ])
                ->columns(['xl' => 2]),
        ];
    }

    public static function sideFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('allowedSecurityLevel')
                        ->label(__('labels.allowed_security_level'))
                        ->default('0')
                        ->required()
                        ->integer()
                        ->minValue(0),
                    Forms\Components\TextInput::make('gamebuild')
                        ->label(__('labels.game_build'))
                        ->default(12340)
                        ->required()
                        ->integer()
                        ->minValue(0),
                ]),
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label(__('labels.icon'))
                        ->default(0)
                        ->required()
                        ->integer()
                        ->minValue(0),
                    Forms\Components\TextInput::make('flag')
                        ->label(__('labels.flag'))
                        ->default(0)
                        ->required()
                        ->integer()
                        ->minValue(0),
                    Forms\Components\TextInput::make('timezone')
                        ->label(__('labels.timezone'))
                        ->default(1)
                        ->required()
                        ->integer()
                        ->minValue(0),
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('labels.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('labels.address')),
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
            'index' => Pages\ListRealmlists::route('/'),
            'create' => Pages\CreateRealmlist::route('/create'),
            'edit' => Pages\EditRealmlist::route('/{record}/edit'),
        ];
    }

    //###################################################################################################################
    // NAVIGATION
    //###################################################################################################################

    public static function getNavigationGroup(): ?string
    {
        return __('labels.game');
    }
}
