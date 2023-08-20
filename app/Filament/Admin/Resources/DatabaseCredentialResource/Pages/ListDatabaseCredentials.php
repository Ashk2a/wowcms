<?php

namespace App\Filament\Admin\Resources\DatabaseCredentialResource\Pages;

use App\Filament\Admin\Resources\DatabaseCredentialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatabaseCredentials extends ListRecords
{
    protected static string $resource = DatabaseCredentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
