<?php

use App\Livewire\QrBukuPage;
use App\Livewire\ScanQrBukuPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportPdfController;

Route::get('/buku/{bukuId}/qr-code', QrBukuPage::class)->name('qr-buku');
Route::get('/scan-qr-buku', ScanQrBukuPage::class)->name('scan-qr-buku');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/export/peminjaman', [ExportPdfController::class, 'peminjamanExport'])->name('export.peminjaman');
    Route::get('/export/pengembalian', [ExportPdfController::class, 'pengembalianExport'])->name('export.pengembalian');
});
