<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AnggotaResource\Pages;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    public static function getModelLabel(): string
    {
        return 'Anggota';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Anggota';
    }

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Anggota';

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $slug = 'anggota';

    protected static ?int $navigationSort = 4;

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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas.nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelas_id')
                    ->relationship('kelas', 'nama')
                    ->label('Kelas'),
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
            'index'  => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit'   => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }
}
