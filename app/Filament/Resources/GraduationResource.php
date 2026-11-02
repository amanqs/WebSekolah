<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GraduationResource\Pages;
use App\Models\Graduation;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GraduationResource extends Resource
{
    protected static ?string $model = Graduation::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = 'Database Kelulusan Siswa';

    protected static ?string $navigationGroup = 'Modul Kelulusan';

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
                        TextInput::make('academic_year')
                            ->label('Tahun Ajaran')
                            ->default('2025/2026')
                            ->required(),
                        TextInput::make('nisn')
                            ->label('NISN (10 Digit)')
                            ->required()
                            ->maxLength(10),
                        TextInput::make('exam_number')
                            ->label('Nomor Peserta Ujian')
                            ->placeholder('01-001-045-8'),
                    ]),
                    Grid::make(3)->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap Siswa')
                            ->required(),
                        TextInput::make('class_name')
                            ->label('Kelas / Rombel')
                            ->placeholder('XII MIPA 1 / XII TBSM')
                            ->required(),
                        DatePicker::make('birth_date')
                            ->label('Tanggal Lahir Siswa'),
                    ]),
                    Grid::make(2)->schema([
                        Select::make('status')
                            ->label('Status Kelulusan')
                            ->options([
                                'lulus' => 'LULUS',
                                'tidak_lulus' => 'TIDAK LULUS',
                                'tertunda' => 'DITUNDA / HUBUNGI SEKOLAH',
                            ])
                            ->default('lulus')
                            ->required(),
                        TextInput::make('average_score')
                            ->label('Nilai Akhir Rata-rata')
                            ->numeric(),
                    ]),
                    Textarea::make('note')
                        ->label('Catatan Kelulusan / Pesan Khusus')
                        ->rows(3)
                        ->placeholder('Selamat atas kelulusan Anda! Pengambilan SKL dapat dilakukan mulai tanggal...'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nisn')->label('NISN')->searchable()->weight('bold'),
                TextColumn::make('name')->label('Nama Siswa')->searchable()->sortable(),
                TextColumn::make('class_name')->label('Kelas')->badge()->color('info'),
                TextColumn::make('academic_year')->label('Tahun Ajaran'),
                TextColumn::make('status')->label('Status')->badge()->color(fn (string $state): string => match ($state) {
                    'lulus' => 'success',
                    'tidak_lulus' => 'danger',
                    'tertunda' => 'warning',
                    default => 'gray',
                }),
                TextColumn::make('average_score')->label('Nilai Rata-rata')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'lulus' => 'Lulus',
                        'tidak_lulus' => 'Tidak Lulus',
                        'tertunda' => 'Ditunda',
                    ]),
                Tables\Filters\SelectFilter::make('academic_year')
                    ->options([
                        '2025/2026' => '2025/2026',
                        '2026/2027' => '2026/2027',
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
            'index' => Pages\ManageGraduations::route('/'),
        ];
    }
}

