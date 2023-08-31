<?php

namespace App\Livewire\Pages\Auth;

use App\Core\Livewire\Page;
use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * @property Form $form
 */
class Login extends Page
{
    use InteractsWithFormActions;
    use WithRateLimiting;

    protected static string $layout = 'components.layouts.base';

    protected static string $view = 'pages.auth.login';

    public ?array $data = [];

    public function mount(): void
    {
        if (auth()->check()) {
            redirect()->intended(route('home'));
        }

        $this->form->fill();
    }

    public function authenticate(): null|RedirectResponse|Redirector
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/login.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/login.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();
        $userId = $data['user_id'];

        if (!empty($userId)) {
            auth()->loginUsingId($userId, true);
        } elseif (!auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label(__('labels.user'))
                    ->reactive()
                    ->options(User::all()->pluck('email', 'id'))
                    ->default(app()->isLocal() ? User::first()?->id : null)
                    ->hidden(!app()->isLocal()),
                Group::make()
                    ->schema([
                        TextInput::make('email')
                            ->label(__('filament-panels::pages/auth/login.form.email.label'))
                            ->email()
                            ->required()
                            ->autocomplete()
                            ->autofocus()
                            ->extraInputAttributes(['tabindex' => 1]),
                        TextInput::make('password')
                            ->label(__('filament-panels::pages/auth/login.form.password.label'))
                            ->password()
                            ->autocomplete('current-password')
                            ->required()
                            ->extraInputAttributes(['tabindex' => 2]),
                        Checkbox::make('remember')
                            ->label(__('filament-panels::pages/auth/login.form.remember.label')),
                    ])
                    ->hidden(fn (callable $get) => !empty($get('user_id'))),
            ])
            ->statePath('data');
    }

    public function getTitle(): string|Htmlable
    {
        return 'Login';
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('authenticate')
                ->label(__('filament-panels::pages/auth/login.form.actions.authenticate.label'))
                ->submit('authenticate'),
        ];
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
    }
}
