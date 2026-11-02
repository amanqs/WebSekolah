<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationLabel = 'Hero Slider';

    protected static ?string $navigationGroup = 'Tampilan & Konten';

    protected static ?int $navigationSort = 1;

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
                        ->label('Judul Utama Banner')
                        ->required()
                        ->placeholder('Contoh: Selamat Datang di SMAN 1 Prestasi Bangsa'),
                    Textarea::make('subtitle')
                        ->label('Sub-judul / Keterangan Singkat')
                        ->rows(2)
                        ->placeholder('Mendidik calon pemimpin masa depan yang berwawasan luas...'),
                    FileUpload::make('image')
                        ->label('Gambar Banner (Rekomendasi: 1920x800 px)')
                        ->image()
                        ->directory('hero-slides')
                        ->required(),
                    Grid::make(2)->schema([
                        TextInput::make('cta_text')
                            ->label('Teks Tombol Aksi Utama (CTA 1)')
                            ->placeholder('Daftar PPDB Sekarang'),
                        TextInput::make('cta_url')
                            ->label('Tautan Tombol Utama')
                            ->placeholder('/ppdb'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('secondary_cta_text')
                            ->label('Teks Tombol Sekunder (CTA 2)')
                            ->placeholder('Profil Sekolah'),
                        TextInput::make('secondary_cta_url')
                            ->label('Tautan Tombol Sekunder')
                            ->placeholder('/halaman/profil-sekolah'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('order')
                            ->label('Urutan Slide')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Tayangkan Slide')
                            ->default(true),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')->label('#')->sortable(),
                ImageColumn::make('image')->label('Banner')->circular(false)->height(50),
                TextColumn::make('title')->label('Judul')->searchable()->weight('bold'),
                TextColumn::make('cta_text')->label('Tombol CTA')->badge()->color('success'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHeroSlides::route('/'),
        ];
    }
}

