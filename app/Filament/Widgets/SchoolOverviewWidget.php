<?php

namespace App\Filament\Widgets;

use App\Models\Download;
use App\Models\Post;
use App\Models\PpdbRegistration;
use App\Models\Teacher;
use App\Settings\GeneralSettings;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $settings = app(GeneralSettings::class);
        $totalPpdb = PpdbRegistration::count();
        $pendingPpdb = PpdbRegistration::where('status', 'pending')->count();
        $totalTeachers = Teacher::active()->count();
        $totalPosts = Post::published()->count();

        return [
            Stat::make('Pendaftar PPDB Online', $totalPpdb)
                ->description($pendingPpdb . ' pendaftar butuh verifikasi')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color($pendingPpdb > 0 ? 'warning' : 'success'),

            Stat::make('Status Portal PPDB', $settings->ppdb_is_active ? 'DIBUKA' : 'DITUTUP')
                ->description('Tahun Ajaran ' . ($settings->ppdb_academic_year ?? '-'))
                ->descriptionIcon($settings->ppdb_is_active ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle')
                ->color($settings->ppdb_is_active ? 'success' : 'danger'),

            Stat::make('Guru & Tendik Aktif', $totalTeachers)
                ->description('Total civitas pengajar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Berita & Artikel Tayang', $totalPosts)
                ->description('Publikasi warta sekolah')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),
        ];
    }
}

