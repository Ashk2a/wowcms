<?php

namespace App\Filament\Admin\Resources\RealmlistResource\Pages;

use App\Filament\Admin\Resources\RealmlistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRealmlists extends ListRecords
{
    protected static string $resource = RealmlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
