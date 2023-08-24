<?php

namespace App\Core\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;

trait HasSideTemplateForm
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema(self::mainForm())
                    ->columnSpan(['lg' => fn (?Model $record) => null === $record ? 3 : 2]),
                Forms\Components\Group::make()
                    ->schema(self::sideForm())
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function mainForm(): array
    {
        return [];
    }

    public static function sideForm(): array
    {
        return [];
    }
}
