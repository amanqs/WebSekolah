<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Galeri Foto & Video';

    protected static ?string $navigationGroup = 'Tampilan & Konten Website';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label('Judul Dokumentasi')
                        ->required()
                        ->placeholder('Contoh: Upacara Hari Kemerdekaan RI Ke-81'),
                    Grid::make(2)->schema([
                        Select::make('type')
                            ->label('Tipe Media')
                            ->options([
                                'photo' => 'Foto (Unggah Gambar)',
                                'video' => 'Video (YouTube URL)',
                            ])
                            ->default('photo')
                            ->reactive()
                            ->required(),
                        TextInput::make('album')
                            ->label('Nama Album / Kategori')
                            ->default('Kegiatan Sekolah')
                            ->required(),
                    ]),
                    FileUpload::make('media_path')
                        ->label('Berkas Foto')
                        ->image()
                        ->directory('gallery')
                        ->visible(fn ($get) => $get('type') === 'photo'),
                    TextInput::make('youtube_url')
                        ->label('Link YouTube Video')
                        ->url()
                        ->placeholder('https://www.youtube.com/watch?v=...')
                        ->visible(fn ($get) => $get('type') === 'video'),
                    Textarea::make('description')
                        ->label('Keterangan Singkat')
                        ->rows(2),
                    Grid::make(2)->schema([
                        Toggle::make('is_featured')
                            ->label('Tampilkan di Sorotan Beranda')
                            ->default(false),
                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail_url')->label('Pratinjau')->circular(false)->width(70)->height(50),
                TextColumn::make('title')->label('Judul')->searchable()->weight('bold'),
                TextColumn::make('album')->label('Album')->badge()->color('info'),
                TextColumn::make('type')->label('Format')->badge()->color(fn (string $state) => match ($state) {
                    'photo' => 'success',
                    'video' => 'danger',
                    default => 'gray',
                }),
                ToggleColumn::make('is_featured')->label('Sorotan'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'photo' => 'Foto',
                        'video' => 'Video',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGalleries::route('/'),
        ];
    }
}

