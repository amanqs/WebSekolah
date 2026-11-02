<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Halaman Profil Statis';

    protected static ?string $navigationGroup = 'Tampilan & Konten';

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
                        ->label('Judul Halaman')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->placeholder('Contoh: Visi dan Misi, Fasilitas Kampus'),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(Page::class, 'slug', ignoreRecord: true),
                    FileUpload::make('banner_image')
                        ->label('Banner Header Halaman')
                        ->image()
                        ->directory('pages'),
                    RichEditor::make('content')
                        ->label('Isi Konten Halaman')
                        ->required()
                        ->fileAttachmentsDirectory('pages/attachments'),
                    Section::make('Pengaturan SEO')
                        ->collapsed()
                        ->schema([
                            TextInput::make('meta_title')->label('Meta Title SEO'),
                            Textarea::make('meta_description')->label('Meta Description')->rows(2),
                        ]),
                    Toggle::make('is_active')
                        ->label('Status Aktif')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Halaman')->searchable()->weight('bold'),
                TextColumn::make('slug')->label('URL / Slug')->color('gray'),
                TextColumn::make('updated_at')->label('Terakhir Diperbarui')->date('d M Y H:i'),
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
            'index' => Pages\ManagePages::route('/'),
        ];
    }
}

