<?php

return [
    'routing' => [
        'enabled' => true,
        'prefix' => 'pages',
    ],

    'layouts' => [
        'namespace' => 'App\\Filament\\Fabricator\\Layouts',
        'path' => app_path('Filament/Fabricator/Layouts'),
        'register' => [
            //
        ],
    ],

    'page-blocks' => [
        'namespace' => 'App\\Filament\\Fabricator\\PageBlocks',
        'path' => app_path('Filament/Fabricator/PageBlocks'),
        'register' => [
            //
        ],
    ],

    'middleware' => [
        Illuminate\Cookie\Middleware\EncryptCookies::class,
        Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        Illuminate\Session\Middleware\StartSession::class,
        App\Http\Middleware\LoadAppTheme::class,
        Illuminate\View\Middleware\ShareErrorsFromSession::class,
        Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'page-model' => Z3d0X\FilamentFabricator\Models\Page::class,

    'page-resource' => App\Filament\Admin\Resources\PageResource::class,

    'enable-view-page' => false,

    'table_name' => 'pages',
];
