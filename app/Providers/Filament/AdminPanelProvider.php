<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Pages\Realms\CreateRealm;
use App\Filament\Admin\Pages\Realms\EditRealm;
use App\Models\Realm;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->darkMode(false)
            ->tenant(Realm::class, 'id')
            ->tenantRegistration(CreateRealm::class)
            ->tenantProfile(EditRealm::class)
            ->renderHook(
                'panels::head.end',
                fn (): string => Blade::render("@themeVite('resources/css/app.css')")
            )
            ->navigationItems([
                NavigationItem::make()
                    ->label(fn () => __('labels.leave_admin'))
                    ->icon('heroicon-o-chevron-left')
                    ->url('/'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(fn () => __('labels.app')),
                NavigationGroup::make()
                    ->label(fn () => str(__('labels.game'))),
                NavigationGroup::make()
                    ->label(fn () => str(__('labels.setting'))->plural()),
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                'theme:wowcms/admin', // TODO: change that when theme can be manage via database
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
