<?php

namespace App\Filament\Pustakawan\Resources\BukuResource\Pages;

use App\Filament\Pustakawan\Resources\BukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuku extends ListRecords
{
    protected static string $resource = BukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus'),
            Actions\Action::make('scanBuku')
                ->label('Scan Buku')
                ->icon('heroicon-o-qr-code')
                // ->url(route('scan-qr-buku'))
                ->url('/pustakawan/scan-qr-buku')
                ->color('warning'),
        ];
    }
}
