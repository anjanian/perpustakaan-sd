<?php

namespace App\Providers\Filament;

use App\Http\Controllers\ExportPdfController;
use App\Livewire\QrBukuPage; // Tambahkan baris ini
use App\Livewire\ScanQrBukuPage; // Tambahkan baris ini
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\StatistikOverview;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Support\Facades\Route;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/')
            ->darkMode(false)
            ->favicon(asset('logo.jpg'))
            ->login()
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
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                StatistikOverview::class,
            ])
            ->routes(function () { // Perbaikan di sini
                Route::get('/scan-qr-buku', ScanQrBukuPage::class)->name('scan-qr-buku');
                Route::get('/buku/{bukuId}/qr-code', QrBukuPage::class)->name('qr-buku');
                Route::get('/export/peminjaman', [ExportPdfController::class, 'peminjamanExport'])->name('export.peminjaman');
                Route::get('/export/pengembalian', [ExportPdfController::class, 'pengembalianExport'])->name('export.pengembalian');
            })
            ->navigationGroups([
                'Master',
                'Transaksi',
            ])
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
            ]);
    }
}
