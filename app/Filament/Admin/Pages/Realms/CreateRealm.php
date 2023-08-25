<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Enums\RealmDatabaseTypes;
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
            'databases' => collect(RealmDatabaseTypes::cases())
                ->map(fn (RealmDatabaseTypes $realmDatabaseType) => [
                    'name' => '',
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
