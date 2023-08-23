<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Actions\DatabaseCredential\CheckDatabaseCredential;
use App\Filament\Admin\Resources\DatabaseCredentialResource;
use App\Models\DatabaseCredential;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

trait RealmFormSchema
{
    protected static function notifyDatabaseState(bool $isValid): void
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

    public function getFormContent(bool $isCreate): array
    {
        return [
            Checkbox::make('is_visible')
                ->label(__('labels.is_visible'))
                ->default(true),
            Grid::make()
                ->columns([
                    'lg' => $isCreate ? 1 : 2,
                ])
                ->schema([
                    TextInput::make('name')
                        ->label(__('labels.name'))
                        ->required()
                        ->minLength(1)
                        ->maxLength(255),
                    TextInput::make('priority')
                        ->label(__('labels.priority'))
                        ->required()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(255)
                        ->integer(),
                ]),
            Repeater::make('databases')
                ->label(str(__('labels.database'))->plural())
                ->relationship('databases')
                ->itemLabel(fn (array $state) => str($state['type'])->ucfirst())
                ->schema([
                    Grid::make()
                        ->columns([
                            'lg' => $isCreate ? 1 : 2,
                        ])
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
                            TextInput::make('name')
                                ->label(__('labels.name'))
                                ->suffixAction(function () {
                                    return Action::make('copyCostToPrice')
                                        ->icon('heroicon-m-arrow-path')
                                        ->action(function (TextInput $component, ?string $state, callable $get) {
                                            $targetStatePath = str($component->getStatePath(false))
                                                ->replace('name', 'database_credential_id')
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
                        ]),
                ])
                ->addable(false)
                ->deletable(false),
        ];
    }
}
