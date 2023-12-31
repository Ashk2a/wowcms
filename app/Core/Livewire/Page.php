<?php

namespace App\Core\Livewire;

use Closure;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

abstract class Page extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $layout = 'components.layout.base';

    protected static string $view;

    protected static ?string $title = null;

    public static ?Closure $reportValidationErrorUsing = null;

    protected ?string $maxContentWidth = null;

    public static string $formActionsAlignment = 'start';

    public static bool $formActionsAreSticky = false;

    public static bool $hasInlineLabels = false;

    public function render(): View
    {
        return view(static::$view, $this->getViewData())
            ->layout(static::$layout, [
                'livewire' => $this,
                'maxContentWidth' => $this->getMaxContentWidth(),
                ...$this->getLayoutData(),
            ]);
    }

    public function getHeading(): string|Htmlable
    {
        return $this->heading ?? $this->getTitle();
    }

    public function getSubheading(): string|Htmlable|null
    {
        return $this->subheading;
    }

    public function getTitle(): string|Htmlable
    {
        return static::$title ?? (string) str(class_basename(static::class))
            ->kebab()
            ->replace('-', ' ')
            ->title();
    }

    public function getMaxContentWidth(): ?string
    {
        return $this->maxContentWidth;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getLayoutData(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        return [];
    }

    protected function onValidationError(ValidationException $exception): void
    {
        if (!static::$reportValidationErrorUsing) {
            return;
        }

        (static::$reportValidationErrorUsing)($exception);
    }

    public function getFormActionsAlignment(): string
    {
        return static::$formActionsAlignment;
    }

    public function areFormActionsSticky(): bool
    {
        return static::$formActionsAreSticky;
    }

    public function hasInlineLabels(): bool
    {
        return static::$hasInlineLabels;
    }

    public static function formActionsAlignment(string $alignment): void
    {
        static::$formActionsAlignment = $alignment;
    }
}
