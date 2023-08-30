<?php

namespace App\Core\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;

trait HasSideTemplateForm
{
    public static function form(Form $form): Form
    {
        return $form->schema(self::formSchema());
    }

    public static function formSchema(): Closure
    {
        return function (?Model $record): array {
            $mainForm = self::mainFormSchema();
            $sideForm = self::sideFormSchema();

            $hideSideForm = [] === $sideForm || (null === $record && self::hideSideFormOnCreate());

            return [
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema($mainForm)
                            ->columnSpan([
                                'lg' => 2,
                            ]),
                        Forms\Components\Group::make()
                            ->schema($sideForm)
                            ->hidden($hideSideForm)
                            ->columnSpan(1),
                    ])
                    ->columns($hideSideForm ? 2 : 3),
            ];
        };
    }

    public static function mainFormSchema(): array
    {
        return [];
    }

    public static function sideFormSchema(): array
    {
        return [];
    }

    public static function hideSideFormOnCreate(): bool
    {
        return false;
    }
}
