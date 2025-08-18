<?php

namespace App\Filament\Pustakawan\Resources\KategoriResource\Pages;

use App\Filament\Pustakawan\Resources\KategoriResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListKategoris extends ListRecords
{
    protected static string $resource = KategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
