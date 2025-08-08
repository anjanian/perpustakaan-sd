<?php

namespace App\Filament\Pustakawan\Resources;

use App\Filament\Pustakawan\Resources\PeminjamanResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\DateColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;


class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Peminjaman';
    protected static ?string $pluralModelLabel = 'Peminjaman';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('siswa_id')
                ->label('Nama Siswa')
                ->relationship('siswa', 'nama')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('tanggal_pinjam')
                ->label('Tanggal Pinjam')
                ->required(),

            Forms\Components\DatePicker::make('tanggal_kembali')
                ->label('Tanggal Kembali')
                ->nullable(),

            Forms\Components\Hidden::make('user_id')
                ->default(Auth::id()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')->label('Nama Siswa'),
                Tables\Columns\TextColumn::make('tanggal_pinjam')->label('Tanggal Pinjam')->date('d-m-Y'),
                Tables\Columns\TextColumn::make('tanggal_kembali')->label('Tanggal Kembali'),
                Tables\Columns\TextColumn::make('user.name')->label('Petugas'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjaman::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
