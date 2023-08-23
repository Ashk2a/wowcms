<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RealmDatabaseTypes: string implements HasLabel
{
    case AUTH = 'auth';
    case CHARACTERS = 'characters';
    case WORLD = 'world';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
