<?php
namespace App\Filament\Resources\PengembalianResource\Pages;

use Filament\Actions;
use App\Models\Peminjaman;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PengembalianResource;

class ListPengembalians extends ListRecords
{
    protected static string $resource = PengembalianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus')
                ->action(function (array $data) {
                    $peminjaman = Peminjaman::findOrFail($data['id']);

                    $peminjaman->update([
                        'status'               => $data['status'],
                        'denda'                => isset($data['denda']) ? $data['denda'] : 0,
                        'tanggal_pengembalian' => $data['tanggal_pengembalian'],
                    ]);

                    Notification::make()
                        ->title('Pengembalian berhasil dicatat.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
