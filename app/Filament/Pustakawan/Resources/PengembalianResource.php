<?php
namespace App\Filament\Pustakawan\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Peminjaman;
use Filament\Tables\Table;
use App\Models\Pengembalian;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Pustakawan\Resources\PengembalianResource\Pages;
use Carbon\Carbon; // Import Carbon for date calculations

class PengembalianResource extends Resource
{
    protected static ?string $model = Pengembalian::class;

    public static function getModelLabel(): string
    {
        return 'Pengembalian';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pengembalian';
    }

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $recordTitleAttribute = 'pengembalian.peminjaman.anggota.nama';

    protected static ?string $navigationLabel = 'Pengembalian';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $slug = 'pengembalian';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('peminjaman_id')
                    ->label('Peminjaman')
                    ->relationship('peminjaman', 'id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->anggota->nama . ' - ' . $record->buku->judul)
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $peminjaman = Peminjaman::find($state);
                            if ($peminjaman) {
                                $set('tanggal_kembali', $peminjaman->tanggal_kembali);
                                // Set tanggal_pengembalian to current date by default when peminjaman_id is selected
                                $set('tanggal_pengembalian', now()->format('Y-m-d'));

                                // Calculate denda immediately if tanggal_pengembalian is after tanggal_kembali
                                $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);
                                $tanggalPengembalian = Carbon::parse(now()->format('Y-m-d')); // Use Carbon for the current date

                                if ($tanggalPengembalian->greaterThan($tanggalKembali)) {
                                    $selisihHari = $tanggalPengembalian->diffInDays($tanggalKembali);
                                    $dendaPerHari = 1000; // Example: Rp 1000 per day
                                    $totalDenda = $selisihHari * $dendaPerHari;
                                    $set('denda', $totalDenda);
                                    $set('status', 'Terlambat');
                                } else {
                                    $set('denda', 0);
                                    $set('status', 'Dikembalikan');
                                }
                            }
                        }
                    }),
                Forms\Components\DatePicker::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->readonly()
                    ->reactive(),
                Forms\Components\DatePicker::make('tanggal_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->live() // Make it live to recalculate denda if changed manually
                    ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                        $peminjamanId = $get('peminjaman_id');
                        if ($peminjamanId && $state) {
                            $peminjaman = Peminjaman::find($peminjamanId);
                            if ($peminjaman) {
                                $tanggalKembali = Carbon::parse($peminjaman->tanggal_kembali);
                                $tanggalPengembalian = Carbon::parse($state);

                                if ($tanggalPengembalian->greaterThan($tanggalKembali)) {
                                    $selisihHari = $tanggalPengembalian->diffInDays($tanggalKembali);
                                    $dendaPerHari = 1000; // Example: Rp 1000 per day
                                    $totalDenda = $selisihHari * $dendaPerHari;
                                    $set('denda', $totalDenda);
                                    $set('status', 'Terlambat');
                                } else {
                                    $set('denda', 0);
                                    $set('status', 'Dikembalikan');
                                }
                            }
                        }
                    }),
                Forms\Components\Select::make('status')
                    ->options([
                        'Dikembalikan' => 'Dikembalikan',
                        'Terlambat'    => 'Terlambat',
                        'Hilang'       => 'Hilang',
                        'Rusak'        => 'Rusak',
                    ])
                    ->default('Dikembalikan')
                    ->required()
                    ->reactive(),
                Forms\Components\TextInput::make('denda')
                    ->label('Denda')
                    ->prefix('Rp ')
                    ->numeric()
                    ->visible(fn($get) => $get('status') !== 'Dikembalikan')
                    ->required(fn($get) => $get('status') !== 'Dikembalikan')
                    ->readOnly(fn($get) => $get('status') === 'Dikembalikan' || $get('status') === 'Terlambat'),
                Forms\Components\Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('peminjaman.anggota.nama')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peminjaman.anggota.nis') // NEW: Added NIS
                    ->label('NIS')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peminjaman.anggota.kelas.nama') // NEW: Added Kelas
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peminjaman.buku.judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peminjaman.tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Dikembalikan'                    => 'success',
                        'Terlambat'                       => 'warning',
                        'Hilang'                          => 'danger',
                        'Rusak'                           => 'warning',
                        default                           => 'gray',
                    }),
                Tables\Columns\TextColumn::make('denda')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal_dari')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Tanggal Pengembalian Mulai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_dari'], fn($q) => $q->whereDate('tanggal_pengembalian', '>=', $data['tanggal_dari']));
                    }),
                Tables\Filters\Filter::make('tanggal_sampai')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Pengembalian Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_sampai'], fn($q) => $q->whereDate('tanggal_pengembalian', '<=', $data['tanggal_sampai']));
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Dikembalikan' => 'Dikembalikan',
                        'Terlambat'    => 'Terlambat',
                        'Hilang'       => 'Hilang',
                        'Rusak'        => 'Rusak',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengembalian::route('/'),
        ];
    }
}