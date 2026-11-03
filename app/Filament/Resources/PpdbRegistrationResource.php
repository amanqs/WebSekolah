<?php

namespace App\Filament\Resources;

use App\Exports\PpdbExport;
use App\Filament\Resources\PpdbRegistrationResource\Pages;
use App\Models\PpdbRegistration;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;

class PpdbRegistrationResource extends Resource
{
    protected static ?string $model = PpdbRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Pendaftar PPDB';

    protected static ?string $navigationGroup = 'Layanan PPDB & Kelulusan';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Admin PPDB', 'Admin Web']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Registrasi')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('registration_number')
                                ->label('Nomor Registrasi')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('academic_year')
                                ->label('Tahun Ajaran')
                                ->required(),
                            Select::make('status')
                                ->label('Status Verifikasi')
                                ->options([
                                    'pending' => 'Menunggu Verifikasi',
                                    'verified' => 'Terverifikasi (Lanjut Seleksi)',
                                    'accepted' => 'DITERIMA (LOLOS)',
                                    'rejected' => 'TIDAK LOLOS',
                                ])
                                ->required(),
                        ]),
                        Textarea::make('admin_notes')
                            ->label('Catatan Tim Seleksi / Verifikator')
                            ->rows(2)
                            ->placeholder('Tuliskan catatan kelengkapan berkas atau petunjuk daftar ulang...'),
                    ]),

                Section::make('1. Data Diri Calon Siswa')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('full_name')->label('Nama Lengkap')->required(),
                            TextInput::make('nisn')->label('NISN (10 Digit)')->required()->maxLength(10),
                            TextInput::make('nik')->label('NIK (KTP/KIA)')->maxLength(16),
                        ]),
                        Grid::make(3)->schema([
                            Select::make('gender')
                                ->label('Jenis Kelamin')
                                ->options(['L' => 'Laki-Laki', 'P' => 'Perempuan'])
                                ->required(),
                            TextInput::make('birth_place')->label('Tempat Lahir')->required(),
                            DatePicker::make('birth_date')->label('Tanggal Lahir')->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('religion')->label('Agama')->required(),
                            TextInput::make('phone_number')->label('No. WhatsApp / HP Calon Siswa')->required(),
                        ]),
                        Textarea::make('address')->label('Alamat Domisili Lengkap')->rows(2)->required(),
                    ]),

                Section::make('2. Data Orang Tua / Wali')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('father_name')->label('Nama Ayah Kandung')->required(),
                            TextInput::make('father_occupation')->label('Pekerjaan Ayah'),
                            TextInput::make('mother_name')->label('Nama Ibu Kandung')->required(),
                            TextInput::make('mother_occupation')->label('Pekerjaan Ibu'),
                            TextInput::make('parent_income')->label('Penghasilan Orang Tua / Bulan'),
                            TextInput::make('parent_phone')->label('No. WhatsApp / HP Orang Tua')->required(),
                        ]),
                    ]),

                Section::make('3. Data Asal Sekolah & Nilai')
                    ->collapsible()
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('previous_school_name')->label('Nama Asal Sekolah')->required(),
                            TextInput::make('average_score')->label('Nilai Rata-rata Rapor / Ujian')->numeric(),
                            TextInput::make('chosen_major')->label('Peminatan / Jurusan Pilihan'),
                        ]),
                        Textarea::make('previous_school_address')->label('Alamat Asal Sekolah')->rows(2),
                    ]),

                Section::make('4. Berkas Persyaratan')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('file_photo')->label('Pas Foto 3x4')->directory('ppdb/photos')->image(),
                            FileUpload::make('file_kk')->label('Kartu Keluarga (PDF/JPG)')->directory('ppdb/kk'),
                            FileUpload::make('file_birth_certificate')->label('Akta Kelahiran (PDF/JPG)')->directory('ppdb/akta'),
                            FileUpload::make('file_report_or_diploma')->label('Ijazah / SKL / Rapor (PDF/JPG)')->directory('ppdb/berkas'),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')->label('No. Registrasi')->searchable()->weight('bold')->copyable(),
                TextColumn::make('full_name')->label('Nama Siswa')->searchable()->sortable(),
                TextColumn::make('nisn')->label('NISN')->searchable(),
                TextColumn::make('previous_school_name')->label('Sekolah Asal')->searchable()->limit(25),
                TextColumn::make('average_score')->label('Nilai')->sortable(),
                TextColumn::make('status')->label('Status')->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'verified' => 'info',
                    'accepted' => 'success',
                    'rejected' => 'danger',
                    default => 'gray',
                }),
                TextColumn::make('created_at')->label('Waktu Daftar')->date('d M Y H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Terverifikasi (Tahap Seleksi)',
                        'accepted' => 'DITERIMA (LOLOS)',
                        'rejected' => 'TIDAK LOLOS',
                    ]),
                Tables\Filters\SelectFilter::make('gender')
                    ->options(['L' => 'Laki-Laki', 'P' => 'Perempuan']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('print_card')
                    ->label('Cetak Kartu')
                    ->icon('heroicon-o-printer')
                    ->color('secondary')
                    ->url(fn (PpdbRegistration $record): string => route('ppdb.print-card', $record->registration_number))
                    ->openUrlInNewTab(),
                Action::make('quick_status')
                    ->label('Ubah Status')
                    ->icon('heroicon-o-check-badge')
                    ->color('primary')
                    ->form([
                        Select::make('status')
                            ->label('Status Baru')
                            ->options([
                                'pending' => 'Menunggu Verifikasi',
                                'verified' => 'Terverifikasi (Lanjut Seleksi)',
                                'accepted' => 'DITERIMA (LOLOS)',
                                'rejected' => 'TIDAK LOLOS',
                            ])
                            ->required(),
                        Textarea::make('admin_notes')
                            ->label('Catatan Keputusan')
                            ->rows(3),
                    ])
                    ->action(function (PpdbRegistration $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                            'admin_notes' => $data['admin_notes'] ?? $record->admin_notes,
                        ]);
                    }),
            ])
            ->headerActions([
                Action::make('export_excel')
                    ->label('Ekspor ke Excel (.xlsx)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(fn () => Excel::download(new PpdbExport, 'data-pendaftar-ppdb-' . date('Y-m-d') . '.xlsx')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPpdbRegistrations::route('/'),
            'create' => Pages\CreatePpdbRegistration::route('/create'),
            'view' => Pages\ViewPpdbRegistration::route('/{record}'),
            'edit' => Pages\EditPpdbRegistration::route('/{record}/edit'),
        ];
    }
}

