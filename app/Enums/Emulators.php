<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Emulators: string implements HasLabel
{
    case AZEROTHCORE = 'azerothcore';

    public function getLabel(): ?string
    {
        return str($this->value)
            ->title()
            ->toString();
    }
}
