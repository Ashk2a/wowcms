<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RealmGameDatabaseTypes: string implements HasLabel
{
    case CHARACTERS = 'characters';
    case WORLD = 'world';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
