<?php

namespace App\Filament\Resources\PengembalianResource\Pages;

use App\Filament\Resources\PengembalianResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Route;

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
                // ->url(fn(): ?string => Route::has('export.pengembalian')
                //     ? route('export.pengembalian', request()->query())
                //     : null)
                ->url(fn() => '/export/pengembalian?' . http_build_query(request()->query()))
                ->openUrlInNewTab(),
        ];
    }
}
