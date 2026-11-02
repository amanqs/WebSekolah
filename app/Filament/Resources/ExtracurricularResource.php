<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtracurricularResource\Pages;
use App\Models\Extracurricular;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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

class ExtracurricularResource extends Resource
{
    protected static ?string $model = Extracurricular::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Ekstrakurikuler';

    protected static ?string $navigationGroup = 'Civitas Akademika';

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
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Nama Ekstrakurikuler')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->placeholder('Contoh: Paskibra, Robotik, Futsal'),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required(),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('coach')
                            ->label('Pembina / Pelatih')
                            ->placeholder('Contoh: Bpk. Bambang Pamungkas, S.Pd.'),
                        TextInput::make('schedule')
                            ->label('Jadwal Kegiatan')
                            ->placeholder('Contoh: Sabtu, 08.00 - 11.00 WIB'),
                    ]),
                    FileUpload::make('image')
                        ->label('Foto Dokumentasi Ekstrakurikuler')
                        ->image()
                        ->directory('extracurriculars'),
                    Textarea::make('description')
                        ->label('Deskripsi & Prestasi')
                        ->rows(3),
                    Grid::make(2)->schema([
                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Aktif')
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
                ImageColumn::make('image')->label('Foto')->circular(false)->width(70)->height(50),
                TextColumn::make('name')->label('Ekstrakurikuler')->searchable()->weight('bold'),
                TextColumn::make('coach')->label('Pembina'),
                TextColumn::make('schedule')->label('Jadwal')->badge()->color('warning'),
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
            'index' => Pages\ManageExtracurriculars::route('/'),
        ];
    }
}

