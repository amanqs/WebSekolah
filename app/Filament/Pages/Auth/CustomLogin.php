<?php

namespace App\Filament\Pages\Auth;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.custom-login';

    public function getHeading(): string|Htmlable
    {
        return 'Masuk ke Panel Administrasi';
    }

    public function getSubheading(): string|Htmlable|null
    {
        $schoolName = app(GeneralSettings::class)->school_name ?? 'Website Sekolah';
        return "Portal Pengelolaan Terpadu — {$schoolName}";
    }

    /**
     * Data akun demonstrasi / pengembangan
     *
     * @return array<string, array<string, string>>
     */
    public function getDemoAccounts(): array
    {
        return [
            'developer' => [
                'role' => 'Developer / Super Admin',
                'name' => 'Super Administrator',
                'email' => 'admin@sekolah.sch.id',
                'password' => 'password',
                'icon' => 'heroicon-m-wrench-screwdriver',
                'badge' => 'Akses Penuh',
                'badge_color' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300',
                'desc' => 'Akses seluruh menu sistem, maintenance server, database, dan pengaturan sekolah.',
            ],
            'admin_web' => [
                'role' => 'Admin Web & Konten',
                'name' => 'Admin Pengelola Web',
                'email' => 'adminweb@sekolah.sch.id',
                'password' => 'password',
                'icon' => 'heroicon-m-globe-alt',
                'badge' => 'Konten Publik',
                'badge_color' => 'bg-sky-100 text-sky-800 dark:bg-sky-900/50 dark:text-sky-300',
                'desc' => 'Pengelolaan berita, galeri foto, ekstrakurikuler, dokumen LPJ, dan buku nonteks.',
            ],
            'admin_ppdb' => [
                'role' => 'Panitia PPDB',
                'name' => 'Panitia Penerimaan Siswa',
                'email' => 'ppdb@sekolah.sch.id',
                'password' => 'password',
                'icon' => 'heroicon-m-academic-cap',
                'badge' => 'PPDB Online',
                'badge_color' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300',
                'desc' => 'Verifikasi berkas, cetak bukti formulir, dan penetapan status kelulusan peserta.',
            ],
        ];
    }

    /**
     * Isi kredensial ke input tanpa langsung submit
     */
    public function fillCredentials(string $accountKey): void
    {
        $accounts = $this->getDemoAccounts();

        if (! isset($accounts[$accountKey])) {
            return;
        }

        $account = $accounts[$accountKey];

        $this->form->fill([
            'email' => $account['email'],
            'password' => $account['password'],
            'remember' => true,
        ]);

        Notification::make()
            ->title("Kredensial {$account['role']} Diterapkan")
            ->body("Email: {$account['email']} (Klik tombol Masuk untuk melanjutkan)")
            ->success()
            ->duration(3000)
            ->send();
    }

    /**
     * 1-Klik Login instan untuk developer / admin
     */
    public function quickLogin(string $accountKey): ?LoginResponse
    {
        $accounts = $this->getDemoAccounts();

        if (! isset($accounts[$accountKey])) {
            return null;
        }

        $account = $accounts[$accountKey];

        $this->form->fill([
            'email' => $account['email'],
            'password' => $account['password'],
            'remember' => true,
        ]);

        Notification::make()
            ->title("Autentikasi Cepat: {$account['role']}")
            ->success()
            ->duration(2000)
            ->send();

        return $this->authenticate();
    }

    /**
     * Informasi status sistem untuk footer login
     */
    public function getSystemMetadata(): array
    {
        return [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'environment' => app()->environment(),
            'server_os' => PHP_OS_FAMILY,
            'db_driver' => config('database.default'),
            'school_name' => app(GeneralSettings::class)->school_name ?? 'SLB Negeri Grobogan',
            'logo' => app(GeneralSettings::class)->logo_light,
        ];
    }
}
