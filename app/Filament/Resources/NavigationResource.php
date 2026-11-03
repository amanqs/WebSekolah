<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationResource\Pages;
use App\Models\Navigation;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';

    protected static ?string $navigationLabel = 'Navigasi Menu';

    protected static ?string $navigationGroup = 'Konfigurasi & Pengguna';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Label Menu')
                            ->required()
                            ->placeholder('Contoh: Profil Sekolah'),
                        Select::make('parent_id')
                            ->label('Induk Menu (Dropdown Parent)')
                            ->options(fn () => Navigation::whereNull('parent_id')->pluck('title', 'id'))
                            ->searchable()
                            ->placeholder('Pilih jika ini adalah sub-menu (anak)'),
                    ]),
                    Grid::make(3)->schema([
                        TextInput::make('url')
                            ->label('Custom URL')
                            ->placeholder('/profil atau https://...')
                            ->helperText('Kosongkan jika menggunakan Route Name'),
                        TextInput::make('route_name')
                            ->label('Route Name (Internal)')
                            ->placeholder('posts.index, ppdb.index, etc.'),
                        Select::make('target')
                            ->label('Target Pembukaan')
                            ->options([
                                '_self' => 'Buka di Tab yang Sama (_self)',
                                '_blank' => 'Buka di Tab Baru (_blank)',
                            ])
                            ->default('_self')
                            ->required(),
                    ]),
                    Grid::make(3)->schema([
                        Select::make('type')
                            ->label('Penempatan Menu')
                            ->options([
                                'header' => 'Header Navbar (Navigasi Atas)',
                                'footer' => 'Footer Links (Tautan Bawah)',
                            ])
                            ->default('header')
                            ->required(),
                        TextInput::make('order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Nama Menu')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('parent.title')
                    ->label('Sub Dari (Parent)')
                    ->badge()
                    ->color('info')
                    ->placeholder('- Top Level -'),
                TextColumn::make('type')
                    ->label('Lokasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'header' => 'primary',
                        'footer' => 'gray',
                    }),
                TextColumn::make('resolved_url')
                    ->label('Tautan Target')
                    ->limit(30),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'header' => 'Header Navbar',
                        'footer' => 'Footer Links',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNavigations::route('/'),
        ];
    }
}

