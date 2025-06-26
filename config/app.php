<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'asset_url' => env('ASSET_URL'),
    'timezone' => 'America/Sao_Paulo',
    'locale' => 'pt_BR',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers
         */
        Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        Spatie\Permission\PermissionServiceProvider::class,
        LaravelLegends\PtBrValidator\ValidatorProvider::class,

        /*
         * Application Service Providers
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class, // Descomente se usar broadcasting
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        
        /*
         * Filament Providers (agrupados)
         */
        App\Providers\FilamentServiceProvider::class,
        App\Providers\Filament\AdminPanelProvider::class,
        App\Providers\Filament\AffiliatePanelProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        'Helper' => \App\Helpers\Core::class,
        'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class, // Adicionado para facilitar o uso do JWT
        'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class, // Adicionado para facilitar o uso do JWT
    ])->toArray(),
];