<?php

namespace App\Filament\Pages;

use App\Models\BukuNonTeks;
use App\Models\Download;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\Lpj;
use App\Models\Post;
use App\Models\PpdbRegistration;
use App\Models\Teacher;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SystemMaintenance extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationLabel = 'Maintenance & Server';

    protected static ?string $title = 'Pusat Kontrol Sistem & Maintenance Server';

    protected static ?string $navigationGroup = 'Developer & Maintenance';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.system-maintenance';

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }

    /**
     * Data Informasi Server & PHP
     */
    public function getServerInfo(): array
    {
        $dbVersion = 'Unknown';
        try {
            $dbVersion = DB::select('select version() as v')[0]->v ?? 'Unknown';
        } catch (\Throwable $e) {
            $dbVersion = 'Error: ' . $e->getMessage();
        }

        return [
            'php_version' => PHP_VERSION,
            'php_sapi' => PHP_SAPI,
            'laravel_version' => app()->version(),
            'server_os' => PHP_OS . ' (' . PHP_OS_FAMILY . ')',
            'server_ip' => request()->server('SERVER_ADDR', '127.0.0.1'),
            'server_time' => now()->format('d M Y, H:i:s T'),
            'timezone' => config('app.timezone', 'Asia/Jakarta'),
            'db_driver' => config('database.default'),
            'db_name' => config('database.connections.' . config('database.default') . '.database'),
            'db_version' => $dbVersion,
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time') . 's',
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'environment' => app()->environment(),
            'debug_mode' => config('app.debug') ? 'Aktif (Development)' : 'Nonaktif (Production)',
        ];
    }

    /**
     * Status Ekstensi Kunci PHP
     */
    public function getExtensionsStatus(): array
    {
        $extensions = [
            'pdo_mysql' => 'Koneksi Database MySQL',
            'gd' => 'Manipulasi Gambar & Foto (GD Library)',
            'fileinfo' => 'Validasi Tipe Berkas Dokumen & MIME',
            'zip' => 'Kompresi & Ekstraksi Arsip Zip',
            'intl' => 'Format Tanggal & Lokalisasi Indonesia',
            'mbstring' => 'Pemrosesan Karakter Multi-byte',
            'curl' => 'Koneksi API & HTTP Client Eksternal',
            'openssl' => 'Enkripsi Data & Komunikasi Aman HTTPS',
            'bcmath' => 'Perhitungan Matematika Presisi Tinggi',
        ];

        $status = [];
        foreach ($extensions as $ext => $label) {
            $status[$ext] = [
                'name' => $ext,
                'label' => $label,
                'loaded' => extension_loaded($ext),
            ];
        }

        return $status;
    }

    /**
     * Statistik Penggunaan Storage & Berkas Unggahan
     */
    public function getStorageStats(): array
    {
        $publicDiskPath = storage_path('app/public');
        $totalBytes = 0;
        $totalFiles = 0;

        if (File::exists($publicDiskPath)) {
            $files = File::allFiles($publicDiskPath);
            $totalFiles = count($files);
            foreach ($files as $file) {
                $totalBytes += $file->getSize();
            }
        }

        $formattedSize = $this->formatBytes($totalBytes);

        return [
            'path' => $publicDiskPath,
            'total_files' => $totalFiles,
            'total_size' => $formattedSize,
            'link_exists' => File::exists(public_path('storage')),
        ];
    }

    /**
     * Statistik Total Data Database
     */
    public function getDatabaseStats(): array
    {
        return [
            'users' => User::count(),
            'posts' => Post::count(),
            'teachers' => Teacher::count(),
            'ppdb' => PpdbRegistration::count(),
            'lpj' => Lpj::count(),
            'buku' => BukuNonTeks::count(),
            'gallery' => Gallery::count(),
            'downloads' => Download::count(),
            'extracurriculars' => Extracurricular::count(),
        ];
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    // ==========================================
    // AKSI CEPAT MAINTENANCE & OPTIMALISASI
    // ==========================================

    /**
     * Bersihkan Seluruh Cache (optimize:clear)
     */
    public function clearAllCache(): void
    {
        try {
            Artisan::call('optimize:clear');
            $output = Artisan::output();

            Notification::make()
                ->title('Seluruh Cache Berhasil Dibersihkan')
                ->body('Cache konfigurasi, rute, view, dan event telah disegarkan.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal Membersihkan Cache')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Cache Konfigurasi & Route (config:cache, route:cache)
     */
    public function optimizeCache(): void
    {
        try {
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');

            Notification::make()
                ->title('Aplikasi Berhasil Dioptimasi')
                ->body('Konfigurasi, rute, dan template Blade telah dicache untuk kecepatan maksimal.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal Mengoptimasi Aplikasi')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Buat/Perbaiki Symbolic Link Storage
     */
    public function repairStorageLink(): void
    {
        try {
            $linkPath = public_path('storage');
            if (File::exists($linkPath) && is_link($linkPath)) {
                // Remove broken link if any
                @unlink($linkPath);
            }

            Artisan::call('storage:link');

            Notification::make()
                ->title('Tautan Storage Berhasil Dibuat')
                ->body('Folder public/storage sekarang terhubung langsung ke storage/app/public.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal Menautkan Storage')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Bersihkan Cache Blade Template (view:clear)
     */
    public function clearViewCache(): void
    {
        try {
            Artisan::call('view:clear');

            Notification::make()
                ->title('Cache View Blade Dibersihkan')
                ->body('Semua kompilasi template Blade telah dihapus dan akan dirender ulang.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal Membersihkan Cache View')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Download Backup Database SQL Langsung dari Browser
     */
    public function downloadDatabaseBackup(): ?BinaryFileResponse
    {
        try {
            $dbName = config('database.connections.' . config('database.default') . '.database');
            $fileName = 'backup_' . $dbName . '_' . date('Y-m-d_His') . '.sql';
            $backupDir = storage_path('app/backups');

            if (! File::exists($backupDir)) {
                File::makeDirectory($backupDir, 0755, true);
            }

            $filePath = $backupDir . '/' . $fileName;

            // Generate clean SQL dump using PDO
            $sqlContent = $this->generateSqlDump();
            File::put($filePath, $sqlContent);

            Notification::make()
                ->title('Backup Database Siap')
                ->body("File {$fileName} berhasil digenerate dan sedang diunduh.")
                ->success()
                ->send();

            return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal Membuat Backup Database')
                ->body($e->getMessage())
                ->danger()
                ->send();

            return null;
        }
    }

    /**
     * Engine SQL Dumper Mandiri Berbasis PDO (Bekerja di Windows & Linux)
     */
    private function generateSqlDump(): string
    {
        $dbName = config('database.connections.' . config('database.default') . '.database');
        $pdo = DB::connection()->getPdo();

        $output = "-- ===========================================================\n";
        $output .= "-- DATABASE BACKUP: " . $dbName . "\n";
        $output .= "-- Generated at: " . date('Y-m-d H:i:s') . "\n";
        $output .= "-- System: " . (app(\App\Settings\GeneralSettings::class)->school_name ?? 'CMS Sekolah') . "\n";
        $output .= "-- ===========================================================\n\n";
        $output .= "SET FOREIGN_KEY_CHECKS=0;\n";
        $output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
        $output .= "SET NAMES utf8mb4;\n\n";

        $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            // Drop Table
            $output .= "-- --------------------------------------------------------\n";
            $output .= "-- Struktur Tabel: `{$table}`\n";
            $output .= "-- --------------------------------------------------------\n";
            $output .= "DROP TABLE IF EXISTS `{$table}`;\n";

            // Create Table
            $createTable = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(\PDO::FETCH_ASSOC);
            $output .= $createTable['Create Table'] . ";\n\n";

            // Data Dump
            $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(\PDO::FETCH_ASSOC);
            if (! empty($rows)) {
                $output .= "-- Dumping data untuk tabel `{$table}`\n";

                $columns = array_keys($rows[0]);
                $escapedColumns = array_map(fn ($col) => "`{$col}`", $columns);
                $columnsList = implode(', ', $escapedColumns);

                $rowValues = [];
                foreach ($rows as $row) {
                    $values = [];
                    foreach ($row as $val) {
                        if ($val === null) {
                            $values[] = 'NULL';
                        } else {
                            $values[] = $pdo->quote($val);
                        }
                    }
                    $rowValues[] = '(' . implode(', ', $values) . ')';
                }

                // Chunk inserts by 50 to prevent packet size overflow
                $chunks = array_chunk($rowValues, 50);
                foreach ($chunks as $chunk) {
                    $output .= "INSERT INTO `{$table}` ({$columnsList}) VALUES\n" . implode(",\n", $chunk) . ";\n";
                }
                $output .= "\n";
            }
        }

        $output .= "SET FOREIGN_KEY_CHECKS=1;\n";
        $output .= "-- Selesai diekspor pada: " . date('Y-m-d H:i:s') . "\n";

        return $output;
    }
}

