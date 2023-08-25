<?php

namespace App\Filament\Admin\Resources\RealmlistResource\Pages;

use App\Filament\Admin\Resources\RealmlistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRealmlist extends EditRecord
{
    protected static string $resource = RealmlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
