<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
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

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Guru & Tenaga Kependidikan';

    protected static ?string $navigationGroup = 'Civitas Akademika';

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
                    Grid::make(3)->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap & Gelar')
                            ->required()
                            ->placeholder('Contoh: Siti Rahmawati, S.Pd., M.Hum.'),
                        TextInput::make('nip')
                            ->label('NIP (Nomor Induk Pegawai)')
                            ->placeholder('19820315 200501 2 003'),
                        TextInput::make('nuptk')
                            ->label('NUPTK')
                            ->placeholder('Opsional'),
                    ]),
                    Grid::make(3)->schema([
                        TextInput::make('position')
                            ->label('Jabatan')
                            ->required()
                            ->placeholder('Contoh: Guru Matematika / Waka Kesiswaan'),
                        TextInput::make('subject')
                            ->label('Mata Pelajaran yang Diampu')
                            ->placeholder('Contoh: Matematika Peminatan'),
                        Select::make('type')
                            ->label('Kategori Tenaga Kerja')
                            ->options([
                                'guru' => 'Tenaga Pendidik (Guru)',
                                'tendik' => 'Tenaga Kependidikan (TU/Staff/Laboran)',
                            ])
                            ->default('guru')
                            ->required(),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email(),
                        TextInput::make('phone')
                            ->label('Nomor Telepon/WA'),
                    ]),
                    FileUpload::make('photo')
                        ->label('Pas Foto Formal')
                        ->image()
                        ->directory('teachers')
                        ->imageEditor(),
                    Textarea::make('bio')
                        ->label('Profil Singkat / Riwayat Pendidikan')
                        ->rows(3),
                    Grid::make(2)->schema([
                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
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
                TextColumn::make('order')->label('#')->sortable(),
                ImageColumn::make('photo')->label('Foto')->circular(),
                TextColumn::make('name')->label('Nama Pegawai')->searchable()->weight('bold'),
                TextColumn::make('position')->label('Jabatan')->badge()->color('info'),
                TextColumn::make('subject')->label('Mapel')->placeholder('-'),
                TextColumn::make('type')->label('Tipe')->badge()->color(fn (string $state) => match ($state) {
                    'guru' => 'primary',
                    'tendik' => 'secondary',
                    default => 'gray',
                }),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'guru' => 'Guru',
                        'tendik' => 'Tendik / Staff',
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
            'index' => Pages\ManageTeachers::route('/'),
        ];
    }
}

