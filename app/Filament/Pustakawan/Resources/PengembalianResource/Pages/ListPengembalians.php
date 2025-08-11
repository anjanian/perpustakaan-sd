<?php

namespace App\Filament\Pustakawan\Resources\PengembalianResource\Pages;

use App\Filament\Pustakawan\Resources\PengembalianResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListPengembalian extends ListRecords
{
    protected static string $resource = PengembalianResource::class;

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
                ->url(fn() => '/export/pengembalian?' . http_build_query(request()->query()))
                ->openUrlInNewTab(),
        ];
    }
}
