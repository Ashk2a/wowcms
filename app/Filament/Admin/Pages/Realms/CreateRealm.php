<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Enums\RealmDatabaseTypes;
use App\Models\Realm;
use Filament\Pages\Tenancy\RegisterTenant;

class CreateRealm extends RegisterTenant
{
    use RealmFormSchema;

    public static function getLabel(): string
    {
        return __('filament-panels::resources/pages/create-record.title', [
            'label' => __('labels.realm'),
        ]);
    }

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'gameDatabases' => collect(RealmDatabaseTypes::cases())
                ->map(fn (RealmDatabaseTypes $realmDatabaseType) => [
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
