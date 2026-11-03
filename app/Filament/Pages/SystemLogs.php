<?php

namespace App\Filament\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SystemLogs extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Log & Error Server';

    protected static ?string $title = 'Pemeriksa Catatan Sistem & Error Log';

    protected static ?string $navigationGroup = 'Developer & Sistem';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.system-logs';

    public string $filterLevel = 'ALL';

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }

    /**
     * Dapatkan Metadata Berkas Log
     */
    public function getLogFileInfo(): array
    {
        $logPath = storage_path('logs/laravel.log');

        if (! File::exists($logPath)) {
            return [
                'exists' => false,
                'path' => $logPath,
                'size' => '0 B',
                'modified' => 'Belum ada catatan log',
                'line_count' => 0,
            ];
        }

        $size = File::size($logPath);
        $modified = date('d M Y, H:i:s', File::lastModified($logPath));

        return [
            'exists' => true,
            'path' => $logPath,
            'size' => $this->formatBytes($size),
            'modified' => $modified,
            'line_count' => count(file($logPath)),
        ];
    }

    /**
     * Baca entri log terbaru
     */
    public function getRecentLogs(): array
    {
        $logPath = storage_path('logs/laravel.log');

        if (! File::exists($logPath)) {
            return [];
        }

        $lines = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($lines)) {
            return [];
        }

        // Ambil maksimal 200 baris terakhir
        $recentLines = array_slice($lines, -200);
        $recentLines = array_reverse($recentLines);

        $parsedLogs = [];
        $pattern = '/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] ([a-zA-Z0-9_-]+)\.([A-Z]+): (.*)$/';

        foreach ($recentLines as $line) {
            if (preg_match($pattern, $line, $matches)) {
                $level = strtoupper($matches[3]);

                if ($this->filterLevel !== 'ALL' && $this->filterLevel !== $level) {
                    continue;
                }

                $parsedLogs[] = [
                    'timestamp' => $matches[1],
                    'env' => $matches[2],
                    'level' => $level,
                    'message' => $matches[4],
                    'raw' => $line,
                ];
            } else {
                // Baris trace lanjutan
                if ($this->filterLevel === 'ALL' && ! empty($parsedLogs)) {
                    $parsedLogs[count($parsedLogs) - 1]['message'] .= "\n" . $line;
                }
            }

            if (count($parsedLogs) >= 60) {
                break;
            }
        }

        return $parsedLogs;
    }

    /**
     * Filter Level Log
     */
    public function setFilter(string $level): void
    {
        $this->filterLevel = $level;
    }

    /**
     * Kosongkan File Log
     */
    public function clearLog(): void
    {
        $logPath = storage_path('logs/laravel.log');

        try {
            if (File::exists($logPath)) {
                File::put($logPath, '');
            }

            Notification::make()
                ->title('File Log Berhasil Dikosongkan')
                ->body('Seluruh riwayat catatan lama telah dibersihkan.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Gagal Mengosongkan Log')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Download Berkas Asli laravel.log
     */
    public function downloadLog(): ?BinaryFileResponse
    {
        $logPath = storage_path('logs/laravel.log');

        if (! File::exists($logPath)) {
            Notification::make()
                ->title('Berkas Log Belum Ada')
                ->warning()
                ->send();

            return null;
        }

        return response()->download($logPath, 'laravel_' . date('Y-m-d_His') . '.log');
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
