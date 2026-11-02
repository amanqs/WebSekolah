<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
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

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Testimoni';

    protected static ?string $navigationGroup = 'Tampilan & Konten';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Nama Pemberi Testimoni')
                            ->required()
                            ->placeholder('Ahmad Zaky, S.T.'),
                        TextInput::make('role')
                            ->label('Peran / Latar Belakang')
                            ->required()
                            ->placeholder('Alumni Angkatan 2021 / Wali Murid Kelas X'),
                    ]),
                    FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->directory('testimonials'),
                    Textarea::make('content')
                        ->label('Ulasan / Kutipan Testimoni')
                        ->required()
                        ->rows(3),
                    Grid::make(3)->schema([
                        Select::make('rating')
                            ->label('Rating Bintang')
                            ->options([
                                5 => '⭐⭐⭐⭐⭐ (5 Bintang)',
                                4 => '⭐⭐⭐⭐ (4 Bintang)',
                                3 => '⭐⭐⭐ (3 Bintang)',
                            ])
                            ->default(5)
                            ->required(),
                        TextInput::make('order')->label('Urutan')->numeric()->default(0),
                        Toggle::make('is_active')->label('Tayang')->default(true),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Foto')->circular(),
                TextColumn::make('name')->label('Nama')->weight('bold')->searchable(),
                TextColumn::make('role')->label('Keterangan')->color('gray'),
                TextColumn::make('rating')->label('Bintang')->badge()->color('warning'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTestimonials::route('/'),
        ];
    }
}

