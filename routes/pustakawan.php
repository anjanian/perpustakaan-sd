<?php

use App\Http\Controllers\ExportPdfController;
use App\Livewire\QrBukuPage;
use App\Livewire\ScanQrBukuPage;
use Illuminate\Support\Facades\Route;

// QR code
Route::get('/buku/{bukuId}/qr-code', QrBukuPage::class)->name('pustakawan.qr-buku');
Route::get('/scan-qr-buku', ScanQrBukuPage::class)->name('pustakawan.scan-qr-buku');

// Export PDF khusus pustakawan
Route::middleware(['web', 'auth:pustakawan', 'role:pustakawan'])->group(function () {
    Route::get('/export/peminjaman', [ExportPdfController::class, 'peminjamanExport'])
        ->name('export.peminjaman');

    Route::get('/export/pengembalian', [ExportPdfController::class, 'pengembalianExport'])
        ->name('export.pengembalian');
});
