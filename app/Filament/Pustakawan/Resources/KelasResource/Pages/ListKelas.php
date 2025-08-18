<?php

namespace App\Filament\Pustakawan\Resources\KelasResource\Pages;

use App\Filament\Pustakawan\Resources\KelasResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListKelas extends ListRecords
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
