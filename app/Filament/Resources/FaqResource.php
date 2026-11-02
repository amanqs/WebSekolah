<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'Tanya Jawab (FAQ)';

    protected static ?string $navigationGroup = 'Tampilan & Konten';

    protected static ?int $navigationSort = 5;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('question')
                        ->label('Pertanyaan')
                        ->required()
                        ->placeholder('Contoh: Berapa biaya pendaftaran PPDB?'),
                    Textarea::make('answer')
                        ->label('Jawaban Lengkap')
                        ->required()
                        ->rows(4),
                    Grid::make(3)->schema([
                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Umum' => 'Umum',
                                'PPDB' => 'PPDB Online',
                                'Akademik' => 'Akademik & Kurikulum',
                                'Fasilitas' => 'Fasilitas & Asrama',
                            ])
                            ->default('Umum')
                            ->required(),
                        TextInput::make('order')->label('Urutan')->numeric()->default(0),
                        Toggle::make('is_active')->label('Aktif')->default(true),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')->label('#')->sortable(),
                TextColumn::make('question')->label('Pertanyaan')->searchable()->weight('bold')->limit(60),
                TextColumn::make('category')->label('Kategori')->badge()->color('info'),
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
            'index' => Pages\ManageFaqs::route('/'),
        ];
    }
}

