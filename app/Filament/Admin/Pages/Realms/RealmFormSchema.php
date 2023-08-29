<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Actions\DatabaseCredential\CheckDatabaseCredential;
use App\Filament\Admin\Resources\DatabaseCredentialResource;
use App\Forms\Components\DatePlaceholder;
use App\Models\DatabaseCredential;
use App\Models\Realm;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
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
                                Select::make('auth_database_id')
                                    ->label(__('labels.auth_database'))
                                    ->relationship('authDatabase', 'name'),
                                /*Select::make('realmlist_id')
                                    ->label(__('labels.realmlist'))
                                    ->relationship('realmlist', 'name')
                                    ->required()
                                    ->unique(ignoreRecord: true),*/
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
            ->itemLabel(fn (array $state) => __('labels.database') . ' ' . $state['type'])
            ->schema([
                Grid::make()
                    ->schema([
                        TextInput::make('type')
                            ->label(__('labels.type'))
                            ->required()
                            ->hidden(),
                        Select::make('database_credential_id')
                            ->label(__('labels.credential'))
                            ->searchable()
                            ->preload()
                            ->relationship('databaseCredential', 'name')
                            ->createOptionForm([
                                Grid::make()->schema(DatabaseCredentialResource::getFormSchema()),
                            ])
                            ->required(),
                        TextInput::make('database')
                            ->label(__('labels.database'))
                            ->suffixAction(function () {
                                return Action::make('checkDatabase')
                                    ->icon('heroicon-m-arrow-path')
                                    ->action(function (TextInput $component, ?string $state, callable $get) {
                                        $targetStatePath = str($component->getStatePath(false))
                                            ->replace('database', 'database_credential_id')
                                            ->value();

                                        $databaseCredential = DatabaseCredential::find($get($targetStatePath));

                                        if (null === $databaseCredential) {
                                            self::notifyDatabaseState(false);

                                            return false;
                                        }

                                        $connectionState = app(CheckDatabaseCredential::class)(
                                            $databaseCredential,
                                            $state
                                        );

                                        self::notifyDatabaseState($connectionState);

                                        return $connectionState;
                                    });
                            })
                            ->minLength(1)
                            ->maxLength(255)
                            ->required(),
                    ])
                    ->columns(['xl' => 2]),
            ])
            ->addable(false)
            ->deletable(false);
    }

    private static function notifyDatabaseState(bool $isValid): void
    {
        $notification = Notification::make()->title(
            __($isValid ? 'titles.valid_database_connection' : 'titles.invalid_database_connection')
        );

        if ($isValid) {
            $notification->success();
        } else {
            $notification->danger();
        }

        $notification->send();
    }
}
