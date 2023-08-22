<?php

namespace App\Filament\Admin\Pages\Realms;

use App\Enums\RealmDatabaseTypes;
use App\Models\Realm;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class CreateRealm extends RegisterTenant
{
    use RealmFormSchema;

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

    public function form(Form $form): Form
    {
        return $form->schema($this->getFormContent(true));
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    protected function handleRegistration(array $data): Realm
    {
        return Realm::create($data);
    }
}
