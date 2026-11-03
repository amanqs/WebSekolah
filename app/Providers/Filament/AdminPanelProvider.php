<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->colors([
                'primary' => Color::Blue,
                'secondary' => Color::Sky,
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'info' => Color::Cyan,
                'success' => Color::Emerald,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('19.5rem')
            ->collapsedSidebarWidth('4.5rem')
            ->brandName(fn () => app(\App\Settings\GeneralSettings::class)->school_name ?? 'CMS Sekolah Admin')
            ->brandLogo(function () {
                $settings = app(\App\Settings\GeneralSettings::class);
                $logo = $settings->logo_light ? asset('storage/' . $settings->logo_light) : null;
                $name = e($settings->school_name ?? 'SLB Negeri Grobogan');

                if ($logo) {
                    return new \Illuminate\Support\HtmlString(
                        '<div class="flex items-center gap-2.5 overflow-hidden">' .
                            '<img src="' . $logo . '" alt="' . $name . '" class="h-8 w-auto max-w-[34px] object-contain shrink-0 drop-shadow-sm" />' .
                            '<span class="font-bold text-sm tracking-tight text-gray-950 dark:text-white truncate leading-tight">' . $name . '</span>' .
                        '</div>'
                    );
                }

                return new \Illuminate\Support\HtmlString('<span class="font-bold text-sm tracking-tight text-gray-950 dark:text-white truncate leading-tight">' . $name . '</span>');
            })
            ->darkModeBrandLogo(function () {
                $settings = app(\App\Settings\GeneralSettings::class);
                $logo = ($settings->logo_dark ?? $settings->logo_light) ? asset('storage/' . ($settings->logo_dark ?? $settings->logo_light)) : null;
                $name = e($settings->school_name ?? 'SLB Negeri Grobogan');

                if ($logo) {
                    return new \Illuminate\Support\HtmlString(
                        '<div class="flex items-center gap-2.5 overflow-hidden">' .
                            '<img src="' . $logo . '" alt="' . $name . '" class="h-8 w-auto max-w-[34px] object-contain shrink-0 drop-shadow-sm" />' .
                            '<span class="font-bold text-sm tracking-tight text-white truncate leading-tight">' . $name . '</span>' .
                        '</div>'
                    );
                }

                return new \Illuminate\Support\HtmlString('<span class="font-bold text-sm tracking-tight text-white truncate leading-tight">' . $name . '</span>');
            })
            ->brandLogoHeight('2.5rem')
            ->favicon(fn () => app(\App\Settings\GeneralSettings::class)->favicon ? asset('storage/' . app(\App\Settings\GeneralSettings::class)->favicon) : null)
            ->userMenuItems([
                MenuItem::make()
                    ->label('Lihat Website Publik')
                    ->url(fn () => route('home'))
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->openUrlInNewTab(),
            ])
            ->navigationGroups([
                NavigationGroup::make('Portal Berita & Publikasi')->icon('heroicon-o-newspaper'),
                NavigationGroup::make('Pusat Dokumen & E-Library')->icon('heroicon-o-folder-open'),
                NavigationGroup::make('Layanan PPDB & Kelulusan')->icon('heroicon-o-academic-cap'),
                NavigationGroup::make('Kesiswaan & Pengajar')->icon('heroicon-o-user-group'),
                NavigationGroup::make('Tampilan & Konten Website')->icon('heroicon-o-paint-brush'),
                NavigationGroup::make('Konfigurasi & Pengguna')->icon('heroicon-o-cog-6-tooth'),
                NavigationGroup::make('Developer & Maintenance')->icon('heroicon-o-cpu-chip'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\DeveloperSystemWidget::class,
                \App\Filament\Widgets\AdminQuickActionsWidget::class,
                \App\Filament\Widgets\SchoolOverviewWidget::class,
                \App\Filament\Widgets\PpdbStatusChartWidget::class,
                \App\Filament\Widgets\PostsCategoryChartWidget::class,
                \App\Filament\Widgets\LatestPpdbTableWidget::class,
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
