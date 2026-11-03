<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuNonTeksResource\Pages;
use App\Models\BukuNonTeks;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BukuNonTeksResource extends Resource
{
    protected static ?string $model = BukuNonTeks::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Buku Non-Teks';

    protected static ?string $modelLabel = 'Buku Nonteks';

    protected static ?string $pluralModelLabel = 'Buku Nonteks Pelajaran';

    protected static ?string $navigationGroup = 'Pusat Dokumen & E-Library';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Buku Nonteks')->schema([
                    TextInput::make('title')
                        ->label('Judul Buku Nonteks')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->placeholder('Contoh: Petualangan Sains: Menjelajahi Tata Surya'),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required(),

                    Grid::make(2)->schema([
                        Select::make('category')
                            ->label('Kategori / Klasifikasi Buku')
                            ->options([
                                'Buku Pengayaan Pengetahuan' => 'Buku Pengayaan Pengetahuan',
                                'Buku Pengayaan Kepribadian' => 'Buku Pengayaan Kepribadian & Budi Pekerti',
                                'Buku Pengayaan Keterampilan' => 'Buku Pengayaan Keterampilan & Vokasi',
                                'Buku Cerita & Literasi Siswa' => 'Buku Cerita & Literasi Siswa',
                                'Buku Referensi & Ensiklopedia' => 'Buku Referensi & Ensiklopedia',
                                'Panduan Pendidik' => 'Buku Panduan Pendidik',
                            ])
                            ->default('Buku Pengayaan Pengetahuan')
                            ->required(),

                        TextInput::make('author')
                            ->label('Penulis / Pengarang')
                            ->placeholder('Nama penulis atau tim penyusun'),
                    ]),

                    Grid::make(3)->schema([
                        TextInput::make('publisher')
                            ->label('Penerbit')
                            ->placeholder('Nama penerbit buku'),

                        TextInput::make('published_year')
                            ->label('Tahun Terbit')
                            ->placeholder('Contoh: 2024'),

                        TextInput::make('isbn')
                            ->label('Nomor ISBN (Opsional)')
                            ->placeholder('978-602-xxx-xxx-x'),
                    ]),

                    Grid::make(2)->schema([
                        FileUpload::make('cover_image')
                            ->label('Cover Buku (JPG / PNG / WebP)')
                            ->directory('buku-cover')
                            ->image()
                            ->imageCropAspectRatio('3:4')
                            ->nullable(),

                        FileUpload::make('file_path')
                            ->label('Berkas E-Book (PDF)')
                            ->directory('buku-non-teks')
                            ->preserveFilenames()
                            ->required(),
                    ]),

                    Textarea::make('synopsis')
                        ->label('Sinopsis / Deskripsi Buku')
                        ->placeholder('Ringkasan isi buku nonteks atau target pembaca...')
                        ->rows(3),

                    Toggle::make('is_active')
                        ->label('Tersedia untuk Publik / Siswa')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->square()
                    ->defaultImageUrl(url('images/default-book.png')),

                TextColumn::make('title')
                    ->label('Judul Buku')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),

                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable(),

                TextColumn::make('download_count')
                    ->label('Dibaca')
                    ->badge()
                    ->color('success')
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
            'index' => Pages\ManageBukuNonTeks::route('/'),
        ];
    }
}

