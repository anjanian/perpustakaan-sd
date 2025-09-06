<?php

namespace App\Filament\Pustakawan\Resources\PeminjamanResource\Pages;

use App\Filament\Pustakawan\Resources\PeminjamanResource;
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
                ->url(fn() => '/pustakawan/export/peminjaman?' . http_build_query(request()->query()))
                ->openUrlInNewTab(),
        ];
    }
}
