<?php

namespace App\Filament\Admin\Resources\DatabaseCredentialResource\Pages;

use App\Filament\Admin\Resources\DatabaseCredentialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatabaseCredential extends EditRecord
{
    protected static string $resource = DatabaseCredentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
