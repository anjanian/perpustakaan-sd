<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Auth\Login;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PustakawanPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('pustakawan')
            ->path('pustakawan')
            ->login(Login::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Pustakawan/Resources'), for: 'App\\Filament\\Pustakawan\\Resources')
            ->discoverPages(in: app_path('Filament/Pustakawan/Pages'), for: 'App\\Filament\\Pustakawan\\Pages')
            ->discoverWidgets(in: app_path('Filament/Pustakawan/Widgets'), for: 'App\\Filament\\Pustakawan\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->routes(function () {
                // Load route-file pustakawan (tanpa prefix — Filament akan otomatis prefix ->path('pustakawan'))
                require base_path('routes/pustakawan.php');
            })
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                // tetap gunakan role check di sini juga (opsional, karena route group di routes/pustakawan.php juga pakai role)
                'role:pustakawan',
            ]);
    }
}
