<?php

namespace App\Tables\Columns;

use Carbon\CarbonInterface;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    protected function formatDate(null|CarbonInterface|string $date, bool $withDiffForHuman = false): ?string
    {
        if (null === $date) {
            return null;
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return $withDiffForHuman ? $date->diffForHumans() : $date;
    }
}
