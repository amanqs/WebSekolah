<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Berita & Pengumuman';

    protected static ?string $navigationGroup = 'Portal Berita & Publikasi';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    // Main column (span 2)
                    Section::make('Konten Berita')
                        ->schema([
                            TextInput::make('title')
                                ->label('Judul Berita')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->placeholder('Contoh: Prestasi Membanggakan Siswa di Olimpiade Sains'),
                            TextInput::make('slug')
                                ->label('Slug URL')
                                ->required()
                                ->unique(Post::class, 'slug', ignoreRecord: true),
                            Textarea::make('excerpt')
                                ->label('Ringkasan / Kutipan')
                                ->rows(3)
                                ->placeholder('Ringkasan singkat yang memikat untuk cuplikan berita...'),
                            RichEditor::make('content')
                                ->label('Isi Lengkap Berita')
                                ->required()
                                ->fileAttachmentsDirectory('posts/attachments'),
                        ])->columnSpan(2),

                    // Sidebar column (span 1)
                    Section::make('Publikasi & Meta')
                        ->schema([
                            FileUpload::make('featured_image')
                                ->label('Gambar Utama')
                                ->image()
                                ->directory('posts')
                                ->imageEditor(),
                            Select::make('category_id')
                                ->label('Kategori')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->createOptionForm([
                                    TextInput::make('name')->required(),
                                    TextInput::make('slug')->required(),
                                ]),
                            Select::make('tags')
                                ->label('Tag / Topik')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->preload(),
                            DateTimePicker::make('published_at')
                                ->label('Waktu Publikasi')
                                ->default(now())
                                ->required(),
                            Toggle::make('is_published')
                                ->label('Terbitkan Berita')
                                ->default(true),
                            Section::make('Optimasi SEO (Google & Medsos)')
                                ->collapsed()
                                ->schema([
                                    TextInput::make('meta_title')->label('Meta Title SEO'),
                                    Textarea::make('meta_description')->label('Meta Description')->rows(2),
                                ]),
                            Select::make('user_id')
                                ->label('Penulis')
                                ->relationship('user', 'name')
                                ->default(auth()->id())
                                ->required(),
                        ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')->label('Foto')->circular(false)->width(70)->height(50),
                TextColumn::make('title')->label('Judul')->searchable()->sortable()->weight('bold')->limit(45),
                TextColumn::make('category.name')->label('Kategori')->badge()->color('info'),
                TextColumn::make('view_count')->label('Dilihat')->badge()->color('gray')->sortable(),
                TextColumn::make('published_at')->label('Tanggal')->date('d M Y')->sortable(),
                ToggleColumn::make('is_published')->label('Tayang'),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

