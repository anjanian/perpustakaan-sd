<?php
namespace App\Filament\Resources\BukuResource\Pages;

use App\Filament\Resources\BukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Route;

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
                ->url('/scan-qr-buku')
                ->color('warning'),
        ];
    }
}
