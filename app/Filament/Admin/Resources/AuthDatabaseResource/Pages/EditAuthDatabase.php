<?php

namespace App\Filament\Admin\Resources\AuthDatabaseResource\Pages;

use App\Filament\Admin\Resources\AuthDatabaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAuthDatabase extends EditRecord
{
    protected static string $resource = AuthDatabaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}