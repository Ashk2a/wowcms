<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class DateColumn extends TextColumn
{
    public function formatDate(bool $withDiffForHuman = true): self
    {
        $this->getStateUsing(fn (Model $model) => $withDiffForHuman ? $model->{$this->getName()}->diffForHumans() : $model->{$this->getName()});

        return $this;
    }

    public function showTooltip(bool $withDiffForHuman = false): self
    {
        $this->tooltip(fn (Model $model) => $withDiffForHuman ? $model->{$this->getName()}->diffForHumans() : $model->{$this->getName()});

        return $this;
    }
}
