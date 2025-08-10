<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\QrBukuPage;
use App\Livewire\ScanQrBukuPage;
use App\Http\Controllers\ExportPdfController;

/*
|--------------------------------------------------------------------------
| Routes untuk Panel Pustakawan (akan dimuat oleh PustakawanPanelProvider)
|--------------------------------------------------------------------------
|
| Catatan:
| - Jangan beri prefix 'pustakawan' di sini — Filament akan menambahkan prefix
|   panel (->path('pustakawan')) ketika file ini dimuat via PanelProvider->routes(...)
| - Nama route diberi prefix "pustakawan." supaya tidak bentrok dgn admin
|
*/

Route::get('/buku/{bukuId}/qr-code', QrBukuPage::class)->name('pustakawan.qr-buku');
Route::get('/scan-qr-buku', ScanQrBukuPage::class)->name('pustakawan.scan-qr-buku');

Route::middleware(['web', 'auth', 'role:pustakawan'])->group(function () {
    Route::get('/export/peminjaman', [ExportPdfController::class, 'peminjamanExport'])
        ->name('pustakawan.export.peminjaman');

    Route::get('/export/pengembalian', [ExportPdfController::class, 'pengembalianExport'])
        ->name('pustakawan.export.pengembalian');
});
