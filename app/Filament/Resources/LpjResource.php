<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LpjResource\Pages;
use App\Models\Lpj;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LpjResource extends Resource
{
    protected static ?string $model = Lpj::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationLabel = 'Laporan Pertanggungjawaban (LPJ)';

    protected static ?string $modelLabel = 'Laporan Pertanggungjawaban';

    protected static ?string $pluralModelLabel = 'Laporan Pertanggungjawaban (LPJ)';

    protected static ?string $navigationGroup = 'Publikasi & Dokumen';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Laporan Pertanggungjawaban')->schema([
                    TextInput::make('title')
                        ->label('Judul Laporan Pertanggungjawaban (LPJ)')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->placeholder('Contoh: LPJ Penggunaan Dana BOS Reguler Tahap I Tahun 2026'),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required(),

                    Grid::make(3)->schema([
                        Select::make('category')
                            ->label('Jenis / Sumber Dana LPJ')
                            ->options([
                                'Dana BOS / BOSP' => 'Dana BOS / BOSP Reguler & Kinerja',
                                'Komite Sekolah' => 'Dana Komite & Sumbangan Masyarakat',
                                'Kegiatan Kesiswaan' => 'LPJ Kegiatan Kesiswaan & OSIS',
                                'Bantuan Pemerintah / DAK' => 'Bantuan Pemerintah / DAK Fisik & Non-Fisik',
                                'Sarana & Prasarana' => 'Pengadaan & Perawatan Sarpras',
                                'Lainnya' => 'Laporan Pertanggungjawaban Lainnya',
                            ])
                            ->default('Dana BOS / BOSP')
                            ->required(),

                        TextInput::make('fiscal_year')
                            ->label('Tahun Anggaran')
                            ->placeholder('2026')
                            ->default(date('Y'))
                            ->required(),

                        FileUpload::make('file_path')
                            ->label('Berkas LPJ (PDF, Excel, Word)')
                            ->directory('lpj')
                            ->preserveFilenames()
                            ->required(),
                    ]),

                    Textarea::make('description')
                        ->label('Keterangan / Ringkasan Realisasi')
                        ->placeholder('Tuliskan ringkasan realisasi penggunaan anggaran atau tujuan laporan...')
                        ->rows(3),

                    Toggle::make('is_active')
                        ->label('Publikasikan untuk Transparansi Publik')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul LPJ')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('category')
                    ->label('Jenis LPJ')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('fiscal_year')
                    ->label('Tahun')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('download_count')
                    ->label('Total Unduh')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Diupload')
                    ->date('d M Y')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLpjs::route('/'),
        ];
    }
}

