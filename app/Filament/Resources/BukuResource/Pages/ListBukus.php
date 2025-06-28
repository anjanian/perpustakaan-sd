<?php
namespace App\Filament\Resources\BukuResource\Pages;

use App\Filament\Resources\BukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBukus extends ListRecords
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
                ->url(route('scan-qr-buku'))
                ->color('warning'),
        ];
    }
}
