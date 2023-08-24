<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\Model;

class DatePlaceholder extends Placeholder
{
    public function showDate(): self
    {
        return $this
            ->content(fn (?Model $record) => $record?->{$this->getName()}?->format('Y-m-d H:i:s') ?? '-')
            ->hint(fn (?Model $record) => $record?->{$this->getName()}?->diffForHumans());
    }
}
