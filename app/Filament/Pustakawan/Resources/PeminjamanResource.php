<?php
namespace App\Filament\Pustakawan\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $recordTitleAttribute = 'anggota.nama';

    protected static ?string $navigationLabel = 'Peminjaman';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $slug = 'peminjaman';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('anggota_id')
                    ->relationship('anggota', 'nama')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Anggota'),
                Forms\Components\Select::make('buku_id')
                    ->relationship('buku', 'judul')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Buku'),
                Forms\Components\DatePicker::make('tanggal_pinjam')
                    ->default(now())
                    ->label('Tanggal Pinjam')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anggota.nama')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('anggota.nis') // NEW: Added NIS
                    ->label('NIS')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('anggota.kelas.nama') // NEW: Added Kelas
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('buku.judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali')
                    ->date('d F Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal_dari')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Tanggal Pinjam Mulai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_dari'], fn($q) => $q->whereDate('tanggal_pinjam', '>=', $data['tanggal_dari']));
                    }),
                Tables\Filters\Filter::make('tanggal_sampai')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Pinjam Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_sampai'], fn($q) => $q->whereDate('tanggal_pinjam', '<=', $data['tanggal_sampai']));
                    }),
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
            'index' => Pages\ListPeminjaman::route('/'),
        ];
    }
}