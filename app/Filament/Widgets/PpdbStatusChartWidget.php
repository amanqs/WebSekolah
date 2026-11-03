<?php

namespace App\Filament\Widgets;

use App\Models\PpdbRegistration;
use Filament\Widgets\ChartWidget;

class PpdbStatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Statistik Status Seleksi PPDB';

    protected static ?int $sort = 3;

    protected static ?string $maxHeight = '260px';

    protected function getData(): array
    {
        $pending = PpdbRegistration::where('status', 'pending')->count();
        $verified = PpdbRegistration::where('status', 'verified')->count();
        $accepted = PpdbRegistration::where('status', 'accepted')->count();
        $rejected = PpdbRegistration::where('status', 'rejected')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Calon Siswa',
                    'data' => [$pending, $verified, $accepted, $rejected],
                    'backgroundColor' => [
                        '#F59E0B', // Amber
                        '#0284C7', // Sky Blue
                        '#10B981', // Emerald Green
                        '#EF4444', // Rose Red
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => ['Menunggu Verifikasi', 'Terverifikasi (Tahap Seleksi)', 'Diterima (Lolos)', 'Tidak Lolos'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

