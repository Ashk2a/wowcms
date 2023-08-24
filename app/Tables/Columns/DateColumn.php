<?php

namespace App\Tables\Columns;

use Carbon\CarbonInterface;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class DateColumn extends TextColumn
{
    public function formatDateState(bool $withDiffForHuman = true): self
    {
        $this->getStateUsing(fn (Model $model) => $this->formatDate($model->{$this->getName()}, $withDiffForHuman));

        return $this;
    }

    public function showTooltip(bool $withDiffForHuman = false): self
    {
        $this->tooltip(fn (Model $model) => $this->formatDate($model->{$this->getName()}, $withDiffForHuman));

        return $this;
    }

    protected function formatDate(?CarbonInterface $date, bool $withDiffForHuman = false): ?string
    {
        if (null === $date) {
            return null;
        }

        return $withDiffForHuman ? $date->diffForHumans() : $date;
    }
}
