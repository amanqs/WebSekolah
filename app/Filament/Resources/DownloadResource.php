<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Models\Download;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationLabel = 'Pusat Unduhan';

    protected static ?string $navigationGroup = 'Publikasi & Dokumen';

    protected static ?int $navigationSort = 3;

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
                        ->label('Judul Berkas / Dokumen')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->placeholder('Contoh: Kalender Pendidikan TP 2026/2027'),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required(),
                    Grid::make(2)->schema([
                        Select::make('category')
                            ->label('Kategori Dokumen')
                            ->options([
                                'Formulir' => 'Formulir Administrasi',
                                'Silabus & Kurikulum' => 'Silabus & Kurikulum',
                                'Surat Edaran' => 'Surat Edaran & Kebijakan',
                                'Panduan Akademik' => 'Buku Panduan Akademik',
                                'Modul & E-Book' => 'Modul Belajar & E-Book',
                            ])
                            ->required(),
                        FileUpload::make('file_path')
                            ->label('Berkas Unduhan (PDF, DOCX, XLSX)')
                            ->directory('downloads')
                            ->preserveFilenames()
                            ->required(),
                    ]),
                    Textarea::make('description')
                        ->label('Keterangan Dokumen')
                        ->rows(2),
                    Toggle::make('is_active')
                        ->label('Tersedia untuk Publik')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul Dokumen')->searchable()->weight('bold'),
                TextColumn::make('category')->label('Kategori')->badge()->color('info'),
                TextColumn::make('download_count')->label('Total Unduh')->badge()->color('success')->sortable(),
                TextColumn::make('created_at')->label('Diupload')->date('d M Y'),
                ToggleColumn::make('is_active')->label('Aktif'),
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
            'index' => Pages\ManageDownloads::route('/'),
        ];
    }
}

