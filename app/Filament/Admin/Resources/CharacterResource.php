<?php

namespace App\Filament\Admin\Resources;

use App\Core\Filament\Resources\HasSideTemplateForm;
use App\Core\Filament\Resources\SharedTenantResource;
use App\Filament\Admin\Resources\CharacterResource\Pages;
use App\Models\Game\Character\Character;
use App\Tables\Columns\DateColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CharacterResource extends Resource
{
    use HasSideTemplateForm;
    use SharedTenantResource;

    public const IMAGE_RACE_PATH = 'resources/images/races/%s-%s.png';

    public const IMAGE_CLASS_PATH = 'resources/images/classes/%s.png';

    //##################################################################################################################
    // ATTRIBUTES
    //##################################################################################################################

    protected static ?string $model = Character::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    //##################################################################################################################
    // FORM
    //##################################################################################################################

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    //##################################################################################################################
    // TABLE
    //##################################################################################################################

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('guid')
                    ->label(__('labels.guid'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('authAccount.username')
                    ->label(__('labels.account'))
                    ->icon('heroicon-o-user')
                    ->color('primary')
                    ->url(fn (Character $record) => AccountResource::getUrl('edit', ['record' => $record->authAccount])),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('race')
                    ->size(25)
                    ->getStateUsing(fn (Character $record) => theme_vite_url(
                        sprintf(
                            self::IMAGE_RACE_PATH,
                            $record->race,
                            $record->gender
                        )
                    )),
                Tables\Columns\ImageColumn::make('class')
                    ->size(25)
                    ->getStateUsing(fn (Character $record) => theme_vite_url(
                        sprintf(
                            self::IMAGE_CLASS_PATH,
                            $record->class,
                        )
                    )),
                Tables\Columns\TextColumn::make('level'),
                DateColumn::make('creation_date')
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
            //
        ];
    }

    //##################################################################################################################
    // PAGES
    //##################################################################################################################

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }

    //##################################################################################################################
    // PERMISSIONS
    //##################################################################################################################

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
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
        return Character::query()
            ->with([
                'authAccount',
            ]);
    }
}
