<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PengembalianResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class PengembalianResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $recordTitleAttribute = 'anggota.nama';

    protected static ?string $navigationLabel = 'Pengembalian';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $slug = 'pengembalian';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id')
                    ->label('Peminjaman')
                    ->options(
                        Peminjaman::with(['anggota', 'buku'])
                            ->where('status', 'Dipinjam')
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => $item->anggota->nama . ' - ' . $item->buku->judul,
                                ];
                            })
                    )
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pengembalian')
                    ->default(now())
                    ->label('Tanggal Pengembalian')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Dikembalikan' => 'Dikembalikan',
                        'Terlambat'    => 'Terlambat',
                        'Hilang'       => 'Hilang',
                    ])
                    ->default('Dikembalikan')
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('denda')
                    ->label('Denda')
                    ->numeric()
                    ->requiredIf('status', ['Terlambat', 'Hilang'])
                    ->visible(fn($get) => in_array($get('status'), ['Terlambat', 'Hilang']))
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Peminjaman::whereNot('status', 'Dipinjam'))
            ->columns([
                Tables\Columns\TextColumn::make('anggota.nama')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('buku.judul')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('denda')
                    ->label('Denda')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Dikembalikan' => 'Dikembalikan',
                        'Terlambat'    => 'Terlambat',
                        'Hilang'       => 'Hilang',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
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
            'index' => Pages\ListPengembalians::route('/'),
        ];
    }
}
