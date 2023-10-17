<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Actions\Database\HasAvailableDatabase;
use App\Enums\RealmDatabaseTypes;
use App\Filament\Admin\Resources\DatabaseCredentialResource;
use App\Forms\Components\DatePlaceholder;
use App\Models\DatabaseCredential;
use App\Models\Realm;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;

trait RealmFormSchema
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('labels.name'))
                                    ->required()
                                    ->minLength(1)
                                    ->maxLength(255),
                                Select::make('realmlist_id')
                                    ->label(__('labels.realmlist'))
                                    ->reactive()
                                    ->relationship('realmlist', 'name')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                            ])
                            ->columns(2),
                        $this->getDatabasesRepeater(),
                    ])
                    ->columnSpan(['lg' => fn (?Model $record) => null === $record ? 3 : 2]),
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                DatePlaceholder::make('created_at')
                                    ->label(__('labels.created_at'))
                                    ->showDate(),
                                DatePlaceholder::make('updated_at')
                                    ->label(__('labels.updated_at'))
                                    ->showDate(),
                            ]),
                        Section::make()
                            ->schema([
                                Toggle::make('is_visible')
                                    ->label(__('labels.visible'))
                                    ->default(true),
                                TextInput::make('priority')
                                    ->label(__('labels.priority'))
                                    ->default(0)
                                    ->required()
                                    ->minValue(0)
                                    ->maxValue(255)
                                    ->integer(),
                            ]),
                    ])
                    ->columnSpan(1)
                    ->hidden(fn (?Realm $record) => null === $record),
            ])
            ->columns(3);
    }

    private function getDatabasesRepeater(): Repeater
    {
        return Repeater::make('gameDatabases')
            ->hiddenLabel(true)
            ->relationship('gameDatabases')
            ->itemLabel(fn (array $state) => match ($state['type']) {
                RealmDatabaseTypes::WORLD->value => __('labels.world_database'),
                RealmDatabaseTypes::CHARACTERS->value => __('labels.characters_database'),
                default => null,
            })
            ->schema([
                Grid::make()
                    ->schema([
                        TextInput::make('type')
                            ->label(__('labels.type'))
                            ->required()
                            ->hidden(),
                        Select::make('database_credential_id')
                            ->label(__('labels.database_credential'))
                            ->preload()
                            ->relationship('databaseCredential', 'name')
                            ->createOptionForm([
                                Grid::make()->schema(DatabaseCredentialResource::formSchema()),
                            ])
                            ->required(),
                        TextInput::make('database')
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
            ])
            ->addable(false)
            ->deletable(false);
    }
}
