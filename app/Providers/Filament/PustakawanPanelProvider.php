<?php

namespace App\Providers\Filament;

use App\Http\Controllers\ExportPdfController;
use App\Livewire\QrBukuPage;
use App\Livewire\ScanQrBukuPage;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\StatistikOverview;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Support\Facades\Route;

class PustakawanPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('pustakawan')
            ->path('pustakawan')
            ->authGuard('pustakawan')
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
            ->viteTheme('resources/css/filament/admin/theme.css')
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
                StartSession::class.':pustakawan', // Session khusus pustakawan
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
