<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatistikOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Anggota', Anggota::count())
                ->description('Jumlah anggota terdaftar')
                ->icon('heroicon-o-user-group')
                ->color('info')
                ->chart([2, 4, 5, 3, 6, 8, 7]),
            Stat::make('Total Buku', Buku::count())
                ->description('Jumlah buku tersedia')
                ->icon('heroicon-o-book-open')
                ->color('success')
                ->chart([5, 5, 6, 6, 7, 7, 9]),
            Stat::make('Total Peminjaman', Peminjaman::count())
                ->description('Jumlah buku dipinjam')
                ->icon('heroicon-o-arrow-up-on-square')
                ->color('warning')
                ->chart([3, 5, 2, 6, 8, 6, 4]),
            Stat::make('Total Pengembalian', Pengembalian::count())
                ->description('Jumlah buku dikembalikan')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('danger')
                ->chart([1, 2, 3, 4, 3, 2, 5]),
        ];
    }
}
