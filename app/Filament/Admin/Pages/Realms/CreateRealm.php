<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Enums\RealmGameDatabaseTypes;
use App\Models\Realm;
use Filament\Pages\Tenancy\RegisterTenant;

class CreateRealm extends RegisterTenant
{
    use RealmFormSchema;

    protected static bool $isCreatePage = true;

    public static function getLabel(): string
    {
        return __('titles.create_new_realm');
    }

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'gameDatabases' => collect(RealmGameDatabaseTypes::cases())
                ->map(fn (RealmGameDatabaseTypes $realmDatabaseType) => [
                    'database' => '',
                    'database_credential_id' => null,
                    'type' => $realmDatabaseType->value,
                ]),
        ]);
    }

    protected function handleRegistration(array $data): Realm
    {
        return Realm::create($data);
    }
}
