<?php

namespace App\Filament\Pustakawan\Resources;

use App\Filament\Pustakawan\Resources\AnggotaResource\Pages;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Anggota')
                    ->schema([
                        Forms\Components\TextInput::make('nis')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('kelas_id')
                            ->relationship('kelas', 'nama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Kelas'),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nis')
                    ->label('NIS')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin'),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelas_id')
                    ->relationship('kelas', 'nama')
                    ->label('Kelas'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit' => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }
}
