<?php

namespace App\Filament\Pustakawan\Resources;

use App\Filament\Pustakawan\Resources\BukuResource\Pages;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $recordTitleAttribute = 'judul';

    protected static ?string $navigationLabel = 'Buku';

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $slug = 'buku';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Buku')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('kategori_id')
                            ->relationship('kategori', 'nama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Kategori'),
                        Forms\Components\TextInput::make('penulis')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('penerbit')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tahun')
                            ->minLength(4)
                            ->maxLength(4)
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('jumlah')
                            ->required()
                            ->numeric(),
                        Forms\Components\FileUpload::make('cover')
                            ->label('Cover')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                            ->maxSize(2048)
                            ->directory('buku'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('penulis')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('penerbit')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->relationship('kategori', 'nama')
                    ->label('Kategori'),
                Tables\Filters\TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('qr')
                    ->label('QR')
                    ->color('warning')
                    ->icon('heroicon-o-qr-code')
                    ->url(fn($record) => "/buku/{$record->id}/qr-code")
                    ->openUrlInNewTab(),
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
            'index'  => Pages\ListBuku::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'edit'   => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}
