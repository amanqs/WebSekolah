<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
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

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Agenda & Kegiatan';

    protected static ?string $navigationGroup = 'Publikasi & Dokumen';

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
                        ->label('Nama Kegiatan / Agenda')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->placeholder('Contoh: Asesmen Nasional Berbasis Komputer (ANBK) 2026'),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required(),
                    Grid::make(3)->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai'),
                        TextInput::make('time')
                            ->label('Waktu Kegiatan')
                            ->placeholder('07:30 - Selesai WIB'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('location')
                            ->label('Lokasi / Ruangan')
                            ->placeholder('Laboratorium Komputer 1 & 2'),
                        TextInput::make('organizer')
                            ->label('Penyelenggara')
                            ->placeholder('Tim ANBK & Kurikulum'),
                    ]),
                    Textarea::make('description')
                        ->label('Deskripsi / Petunjuk Kegiatan')
                        ->rows(3),
                    Toggle::make('is_active')
                        ->label('Publikasikan Agenda')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Kegiatan')->searchable()->weight('bold'),
                TextColumn::make('start_date')->label('Mulai')->date('d M Y')->sortable(),
                TextColumn::make('end_date')->label('Selesai')->date('d M Y')->placeholder('-'),
                TextColumn::make('location')->label('Lokasi')->badge()->color('info'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('start_date', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAgendas::route('/'),
        ];
    }
}

