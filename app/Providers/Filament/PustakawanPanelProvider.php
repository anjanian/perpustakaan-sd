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
            ->authGuard('pustakawan') // guard khusus pustakawan
            ->darkMode(true)
            ->favicon(asset('logo.jpg'))
            ->login(\App\Filament\Pustakawan\Pages\Auth\Login::class)
            ->spa()
            ->font('Poppins')
            ->brandLogo(fn () => view('logo'))
            ->profile()
            ->maxContentWidth('full')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->sidebarWidth('18rem')
            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('5rem')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css') // pake tema sama
            ->discoverResources(in: app_path('Filament/Pustakawan/Resources'), for: 'App\\Filament\\Pustakawan\\Resources')
            ->discoverPages(in: app_path('Filament/Pustakawan/Pages'), for: 'App\\Filament\\Pustakawan\\Pages')
            ->discoverWidgets(in: app_path('Filament/Pustakawan/Widgets'), for: 'App\\Filament\\Pustakawan\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                \App\Filament\Pustakawan\Widgets\StatistikOverview::class,
            ])
            ->routes(function () {
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
                'role:pustakawan',
            ]);
    }
}
