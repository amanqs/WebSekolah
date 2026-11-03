<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\PpdbRegistration;
use App\Models\Teacher;
use App\Settings\GeneralSettings;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $settings = app(GeneralSettings::class);
        $totalPpdb = PpdbRegistration::count();
        $pendingPpdb = PpdbRegistration::where('status', 'pending')->count();
        $totalTeachers = Teacher::active()->count();
        $totalPosts = Post::published()->count();

        return [
            Stat::make('Pendaftar PPDB Online', $totalPpdb)
                ->description($pendingPpdb > 0 ? "{$pendingPpdb} pendaftar butuh verifikasi" : 'Semua berkas terverifikasi')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([2, 5, 9, 14, 20, 28, max($totalPpdb, 30)])
                ->color($pendingPpdb > 0 ? 'warning' : 'success'),

            Stat::make('Status Portal PPDB', $settings->ppdb_is_active ? 'DIBUKA' : 'DITUTUP')
                ->description('Tahun Ajaran ' . ($settings->ppdb_academic_year ?? '2026/2027'))
                ->descriptionIcon($settings->ppdb_is_active ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle')
                ->chart($settings->ppdb_is_active ? [1, 1, 1, 1, 1, 1, 1] : [0, 0, 0, 0, 0, 0, 0])
                ->color($settings->ppdb_is_active ? 'success' : 'danger'),

            Stat::make('Guru & Tendik Aktif', $totalTeachers)
                ->description('Total civitas pengajar aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([15, 18, 20, 22, 24, 25, $totalTeachers])
                ->color('info'),

            Stat::make('Berita & Pengumuman', $totalPosts)
                ->description('Warta sekolah terbit')
                ->descriptionIcon('heroicon-m-newspaper')
                ->chart([3, 5, 4, 7, 6, 8, max($totalPosts, 10)])
                ->color('primary'),
        ];
    }
}
