<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RealmDatabaseTypes: string implements HasLabel
{
    case CHARACTERS = 'characters';
    case WORLD = 'world';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    /**
     * @return RealmDatabaseTypes[]
     */
    public static function getGameDatabases(): array
    {
        return [
            self::CHARACTERS,
            self::WORLD,
        ];
    }
}
