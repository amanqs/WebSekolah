<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSchoolSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Sekolah';

    protected static ?string $title = 'Pengaturan Identitas & Tampilan Sekolah';

    protected static ?string $navigationGroup = 'Sistem & Pengaturan';

    protected static ?int $navigationSort = 1;

    protected static string $settings = GeneralSettings::class;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pengaturan')
                    ->tabs([
                        Tabs\Tab::make('Identitas & Branding')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('school_name')
                                        ->label('Nama Sekolah')
                                        ->required()
                                        ->placeholder('Contoh: SMA Negeri 1 Prestasi Bangsa'),
                                    TextInput::make('npsn')
                                        ->label('NPSN')
                                        ->required()
                                        ->numeric()
                                        ->placeholder('Contoh: 20109988'),
                                    Select::make('school_level')
                                        ->label('Jenjang Sekolah')
                                        ->options([
                                            'SD' => 'SD / MI (Sekolah Dasar)',
                                            'SMP' => 'SMP / MTs (Sekolah Menengah Pertama)',
                                            'SMA' => 'SMA / MA (Sekolah Menengah Atas)',
                                            'SMK' => 'SMK (Sekolah Menengah Kejuruan)',
                                            'SLB' => 'SLB (Sekolah Luar Biasa)',
                                        ])
                                        ->required(),
                                ]),

                                TextInput::make('tagline')
                                    ->label('Motto / Tagline Sekolah')
                                    ->required()
                                    ->placeholder('Contoh: Unggul dalam Prestasi, Santun dalam Berpekerti'),

                                Section::make('Akreditasi & Kurikulum')
                                    ->description('Informasi akreditasi resmi dan kurikulum pembelajaran yang ditampilkan pada website')
                                    ->collapsible()
                                    ->schema([
                                        Grid::make(3)->schema([
                                            Select::make('accreditation')
                                                ->label('Status Akreditasi')
                                                ->options([
                                                    'A (Unggul)' => 'Terakreditasi A (Unggul)',
                                                    'B (Baik)' => 'Terakreditasi B (Baik)',
                                                    'C (Cukup)' => 'Terakreditasi C (Cukup)',
                                                    'Terakreditasi' => 'Terakreditasi',
                                                    'Belum Terakreditasi' => 'Belum Terakreditasi',
                                                ])
                                                ->required(),
                                            TextInput::make('accreditation_body')
                                                ->label('Badan / Lembaga Akreditasi')
                                                ->placeholder('BAN-S/M')
                                                ->default('BAN-S/M'),
                                            TextInput::make('curriculum')
                                                ->label('Kurikulum yang Diterapkan')
                                                ->placeholder('Kurikulum Merdeka')
                                                ->default('Kurikulum Merdeka'),
                                        ]),
                                    ]),

                                Grid::make(3)->schema([
                                    FileUpload::make('logo_light')
                                        ->label('Logo Utama (Light Mode)')
                                        ->image()
                                        ->directory('branding'),
                                    FileUpload::make('logo_dark')
                                        ->label('Logo Dark Mode')
                                        ->image()
                                        ->directory('branding'),
                                    FileUpload::make('favicon')
                                        ->label('Favicon (.ico / .png)')
                                        ->image()
                                        ->directory('branding'),
                                ]),

                                Section::make('Sambutan Kepala Sekolah')
                                    ->description('Tampil di halaman depan website')
                                    ->collapsible()
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('principal_name')
                                                ->label('Nama Kepala Sekolah & Gelar')
                                                ->placeholder('Drs. H. Mulyadi, M.Pd.'),
                                            TextInput::make('principal_nip')
                                                ->label('NIP Kepala Sekolah')
                                                ->placeholder('19740512 199903 1 002'),
                                        ]),
                                        FileUpload::make('principal_photo')
                                            ->label('Foto Resmi Kepala Sekolah')
                                            ->image()
                                            ->directory('principal'),
                                        RichEditor::make('principal_speech')
                                            ->label('Teks Sambutan Kepala Sekolah')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Tabs\Tab::make('Tema & Warna (Color Palette)')
                            ->icon('heroicon-o-swatch')
                            ->schema([
                                Section::make('Kustomisasi Palet Warna Frontend')
                                    ->description('Warna ini secara otomatis disuntikkan ke CSS variable Tailwind (--color-primary, --color-secondary, --color-accent) tanpa merubah kode.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            ColorPicker::make('primary_color')
                                                ->label('Primary Color (Warna Utama)')
                                                ->helperText('Digunakan untuk navbar, tombol utama, judul section, dan aksen dominan.')
                                                ->required(),
                                            ColorPicker::make('secondary_color')
                                                ->label('Secondary Color (Warna Sekunder)')
                                                ->helperText('Digunakan untuk badge, aksen pelengkap, dan tombol sekunder.')
                                                ->required(),
                                            ColorPicker::make('accent_color')
                                                ->label('Accent Color (Warna Penegas/Highlight)')
                                                ->helperText('Digunakan untuk elemen bintang, highlight penting, dan badge promosi.')
                                                ->required(),
                                        ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Kontak & Lokasi')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('phone')
                                        ->label('Nomor Telepon Kantor')
                                        ->tel()
                                        ->placeholder('(021) 7890123'),
                                    TextInput::make('whatsapp')
                                        ->label('Nomor WhatsApp Resmi (Interaktif)')
                                        ->helperText('Gunakan awalan 62 tanpa tanda + atau 0, contoh: 6281234567890')
                                        ->placeholder('6281234567890'),
                                ]),
                                TextInput::make('email')
                                    ->label('Email Resmi Sekolah')
                                    ->email()
                                    ->placeholder('info@sekolah.sch.id'),
                                Textarea::make('address')
                                    ->label('Alamat Lengkap Sekolah')
                                    ->rows(3)
                                    ->placeholder('Jl. Pendidikan No. 45, Kecamatan ...'),
                                Textarea::make('maps_embed')
                                    ->label('Kode Embed Google Maps (iframe)')
                                    ->helperText('Salin tag <iframe> dari Google Maps Share / Embed Map.')
                                    ->rows(4),
                            ]),

                        Tabs\Tab::make('Media Sosial')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('facebook_url')
                                        ->label('Facebook URL')
                                        ->url()
                                        ->placeholder('https://facebook.com/...'),
                                    TextInput::make('instagram_url')
                                        ->label('Instagram URL')
                                        ->url()
                                        ->placeholder('https://instagram.com/...'),
                                    TextInput::make('youtube_url')
                                        ->label('YouTube Channel URL')
                                        ->url()
                                        ->placeholder('https://youtube.com/@...'),
                                    TextInput::make('tiktok_url')
                                        ->label('TikTok URL')
                                        ->url()
                                        ->placeholder('https://tiktok.com/@...'),
                                ]),
                            ]),

                        Tabs\Tab::make('Data & Statistik Sekolah')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('Statistik Peserta Didik & Fasilitas Sekolah')
                                    ->description('Angka-angka ini tampil secara dinamis pada bilah statistik (*Counter Animation*) di halaman beranda.')
                                    ->schema([
                                        Grid::make(4)->schema([
                                            TextInput::make('total_students')
                                                ->label('Jumlah Siswa Aktif')
                                                ->numeric()
                                                ->placeholder('Contoh: 240')
                                                ->helperText('Jumlah total peserta didik saat ini.'),
                                            TextInput::make('total_teachers')
                                                ->label('Jumlah Guru (Pendidik)')
                                                ->numeric()
                                                ->placeholder('Otomatis jika kosong')
                                                ->helperText('Biarkan kosong untuk menghitung otomatis dari menu Guru & Staf.'),
                                            TextInput::make('total_classes')
                                                ->label('Jumlah Rombel / Ruang Kelas')
                                                ->numeric()
                                                ->placeholder('Contoh: 12')
                                                ->helperText('Jumlah rombongan belajar aktif.'),
                                            TextInput::make('total_alumni')
                                                ->label('Estimasi Total Alumni')
                                                ->numeric()
                                                ->placeholder('Contoh: 450')
                                                ->helperText('Jumlah lulusan sekolah yang telah lulus.'),
                                        ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Tata Letak Beranda (Section Toggles)')
                            ->icon('heroicon-o-adjustments-horizontal')
                            ->schema([
                                Section::make('Sakelar Komponen Beranda (Homepage Modularity)')
                                    ->description('Administrator dapat menyembunyikan atau menampilkan bagian halaman depan dengan satu sentuhan klik.')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            Toggle::make('enable_hero_slider')
                                                ->label('Hero Slider & Banner Utama')
                                                ->default(true),
                                            Toggle::make('enable_principal_speech')
                                                ->label('Sambutan Kepala Sekolah')
                                                ->default(true),
                                            Toggle::make('enable_school_stats')
                                                ->label('Statistik Sekolah (Siswa, Guru, dll.)')
                                                ->default(true),
                                            Toggle::make('enable_latest_posts')
                                                ->label('Berita & Artikel Terbaru')
                                                ->default(true),
                                            Toggle::make('enable_extracurriculars')
                                                ->label('Galeri Ekstrakurikuler')
                                                ->default(true),
                                            Toggle::make('enable_gallery')
                                                ->label('Galeri Foto & Video')
                                                ->default(true),
                                            Toggle::make('enable_testimonials')
                                                ->label('Testimoni Alumni & Wali Murid')
                                                ->default(true),
                                            Toggle::make('enable_faq')
                                                ->label('Tanya Jawab (FAQ)')
                                                ->default(true),
                                        ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Pengaturan Modul PPDB & Kelulusan')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                Section::make('Modul PPDB Online')
                                    ->schema([
                                        Toggle::make('ppdb_is_active')
                                            ->label('Buka Pendaftaran PPDB Online')
                                            ->helperText('Jika nonaktif, formulir akan menampilkan pengumuman bahwa pendaftaran ditutup.'),
                                        Grid::make(3)->schema([
                                            TextInput::make('ppdb_academic_year')
                                                ->label('Tahun Ajaran PPDB')
                                                ->placeholder('2026/2027'),
                                            DatePicker::make('ppdb_start_date')
                                                ->label('Tanggal Buka'),
                                            DatePicker::make('ppdb_end_date')
                                                ->label('Tanggal Tutup'),
                                        ]),
                                        Textarea::make('ppdb_announcement')
                                            ->label('Pengumuman / Catatan PPDB')
                                            ->rows(2),
                                    ]),

                                Section::make('Modul Kelulusan / Cek NISN')
                                    ->schema([
                                        Toggle::make('graduation_is_active')
                                            ->label('Aktifkan Portal Pengumuman Kelulusan'),
                                        Grid::make(2)->schema([
                                            TextInput::make('graduation_academic_year')
                                                ->label('Tahun Ajaran Kelulusan')
                                                ->placeholder('2025/2026'),
                                            DateTimePicker::make('graduation_announcement_datetime')
                                                ->label('Waktu Rilis Pengumuman (Hitung Mundur)'),
                                        ]),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

