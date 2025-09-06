<?php

namespace App\Filament\Resources\PeminjamanResource\Pages;

use App\Filament\Resources\PeminjamanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Route;

class ListPeminjaman extends ListRecords
{
    protected static string $resource = PeminjamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus'),

            Action::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->color('danger')
                // ->url(fn(): ?string => Route::has('export.peminjaman')
                //     ? route('export.peminjaman', request()->query())
                //     : null)
                ->url(fn() => '/admin/export/peminjaman?' . http_build_query(request()->query()))
                ->openUrlInNewTab(),
        ];
    }
}
