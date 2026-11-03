<?php

namespace Tests\Feature;

use App\Models\PpdbRegistration;
use App\Models\User;
use App\Settings\GeneralSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolWebsiteTest extends TestCase
{
    public function test_homepage_is_accessible(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_posts_page_is_accessible(): void
    {
        $response = $this->get('/berita');
        $response->assertStatus(200);
    }

    public function test_teachers_page_is_accessible(): void
    {
        $response = $this->get('/guru-staf');
        $response->assertStatus(200);
    }

    public function test_extracurriculars_page_is_accessible(): void
    {
        $response = $this->get('/ekstrakurikuler');
        $response->assertStatus(200);
    }

    public function test_ppdb_page_is_accessible(): void
    {
        $response = $this->get('/ppdb');
        $response->assertStatus(200);
    }

    public function test_graduation_page_is_accessible(): void
    {
        $response = $this->get('/kelulusan');
        $response->assertStatus(200);
    }

    public function test_admin_login_page_is_accessible(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_admin_can_login_via_filament(): void
    {
        \Livewire\Livewire::test(\Filament\Pages\Auth\Login::class)
            ->fillForm([
                'email' => 'admin@sekolah.sch.id',
                'password' => 'password',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs(User::where('email', 'admin@sekolah.sch.id')->first());
    }

    public function test_agenda_page_is_accessible(): void
    {
        $response = $this->get('/agenda');
        $response->assertStatus(200);
    }

    public function test_gallery_page_is_accessible(): void
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
    }

    public function test_downloads_page_is_accessible(): void
    {
        $response = $this->get('/unduhan');
        $response->assertStatus(200);
    }

    public function test_download_file_action_works(): void
    {
        $download = \App\Models\Download::first();
        if ($download) {
            $response = $this->get('/unduhan/' . $download->slug . '/download');
            $response->assertStatus(200);
        }
    }

    public function test_contact_page_is_accessible(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
    }

    public function test_post_detail_page_is_accessible(): void
    {
        $post = \App\Models\Post::first();
        if ($post) {
            $response = $this->get('/berita/' . $post->slug);
            $response->assertStatus(200);
        }
    }

    public function test_dynamic_profile_page_is_accessible(): void
    {
        $page = \App\Models\Page::first();
        if ($page) {
            $response = $this->get('/halaman/' . $page->slug);
            $response->assertStatus(200);
        }
    }

    public function test_ppdb_pdf_card_generation(): void
    {
        $reg = \App\Models\PpdbRegistration::first();
        if ($reg) {
            $response = $this->get('/ppdb/' . $reg->registration_number . '/cetak-kartu');
            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');
        }
    }

    public function test_super_admin_can_access_filament_dashboard(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_super_admin_can_access_school_settings(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin/manage-school-settings');
        $response->assertStatus(200);
    }

    public function test_super_admin_can_save_school_settings(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $this->actingAs($admin);

        $settings = app(GeneralSettings::class);
        $originalName = $settings->school_name;
        $originalLevel = $settings->school_level;
        $originalTagline = $settings->tagline;
        $originalAddress = $settings->address;
        $originalLogoLight = $settings->logo_light;
        $originalLogoDark = $settings->logo_dark;
        $originalFavicon = $settings->favicon;

        try {
            \Livewire\Livewire::test(\App\Filament\Pages\ManageSchoolSettings::class)
                ->fillForm([
                    'school_name' => 'SLB Negeri Grobogan Test',
                    'npsn' => $settings->npsn ?? '20109988',
                    'school_level' => 'SLB',
                    'tagline' => 'Cerdas, Berkarakter, Berakhlak Mulia',
                    'primary_color' => '#1E3A8A',
                    'secondary_color' => '#0284C7',
                    'accent_color' => '#F59E0B',
                    'phone' => '(021) 7890123',
                    'whatsapp' => '6281234567890',
                    'email' => 'info@sekolah.sch.id',
                    'address' => 'Jl. Pendidikan Karakter No. 100 Jakarta',
                    'ppdb_is_active' => true,
                    'graduation_is_active' => true,
                ])
                ->call('save')
                ->assertHasNoFormErrors();

            $this->assertEquals('SLB Negeri Grobogan Test', app(GeneralSettings::class)->school_name);
        } finally {
            $settings->school_name = $originalName;
            $settings->school_level = $originalLevel;
            $settings->tagline = $originalTagline;
            $settings->address = $originalAddress;
            $settings->logo_light = $originalLogoLight;
            $settings->logo_dark = $originalLogoDark;
            $settings->favicon = $originalFavicon;
            $settings->save();
        }
    }

    public function test_super_admin_can_access_users_management(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_admin_ppdb_can_access_ppdb_registrations(): void
    {
        $ppdbAdmin = User::where('email', 'ppdb@sekolah.sch.id')->first();
        $response = $this->actingAs($ppdbAdmin)->get('/admin/ppdb-registrations');
        $response->assertStatus(200);
    }

    public function test_graduation_livewire_component_search(): void
    {
        $grad = \App\Models\Graduation::first();
        if ($grad) {
            \Livewire\Livewire::test(\App\Livewire\GraduationCheck::class)
                ->set('nisn', $grad->nisn)
                ->call('check')
                ->assertSee($grad->name)
                ->assertSee('DINYATAKAN LULUS')
                ->call('resetSearch')
                ->assertSet('result', null)
                ->assertSet('nisn', '');
        }
    }

    public function test_ppdb_livewire_component_wizard_and_submission(): void
    {
        \Livewire\Livewire::test(\App\Livewire\PpdbRegistrationForm::class)
            ->set('full_name', 'Budi Santoso')
            ->set('nisn', '1234567890')
            ->set('gender', 'L')
            ->set('birth_place', 'Jakarta')
            ->set('birth_date', '2010-05-15')
            ->set('religion', 'Islam')
            ->set('address', 'Jl. Merdeka No. 45 Jakarta Pusat')
            ->set('phone_number', '081234567890')
            ->call('nextStep')
            ->assertSet('currentStep', 2)
            ->set('father_name', 'Agus Santoso')
            ->set('mother_name', 'Siti Rahma')
            ->set('parent_phone', '081298765432')
            ->call('nextStep')
            ->assertSet('currentStep', 3)
            ->set('previous_school_name', 'SMP Negeri 1 Jakarta')
            ->call('nextStep')
            ->assertSet('currentStep', 4)
            ->call('nextStep')
            ->assertSet('currentStep', 5)
            ->set('agreement', true)
            ->call('submit')
            ->assertSet('isSubmitted', true)
            ->assertSee('Pendaftaran Berhasil Dikirim');
    }

    public function test_ppdb_livewire_component_status_check(): void
    {
        $reg = \App\Models\PpdbRegistration::first();
        if ($reg) {
            \Livewire\Livewire::test(\App\Livewire\PpdbRegistrationForm::class)
                ->call('switchTab', 'check_status')
                ->assertSet('activeTab', 'check_status')
                ->set('searchRegNumber', $reg->registration_number)
                ->call('checkStatus')
                ->assertSee($reg->full_name)
                ->assertSee($reg->registration_number);
        }
    }

    public function test_lpj_page_is_accessible(): void
    {
        $response = $this->get(route('lpj.index'));
        $response->assertStatus(200);
        $response->assertSee('Laporan Pertanggungjawaban');
    }

    public function test_lpj_download_action_works(): void
    {
        $lpj = \App\Models\Lpj::first();
        $this->assertNotNull($lpj);

        $response = $this->get(route('lpj.download', $lpj->slug));
        $response->assertStatus(200);
    }

    public function test_buku_non_teks_page_is_accessible(): void
    {
        $response = $this->get(route('buku-non-teks.index'));
        $response->assertStatus(200);
        $response->assertSee('Buku Nonteks Pelajaran');
    }

    public function test_buku_non_teks_download_action_works(): void
    {
        $book = \App\Models\BukuNonTeks::first();
        $this->assertNotNull($book);

        $response = $this->get(route('buku-non-teks.download', $book->slug));
        $response->assertStatus(200);
    }

    public function test_admin_can_access_lpj_resource(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin/lpjs');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_buku_non_teks_resource(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin/buku-non-teks');
        $response->assertStatus(200);
    }

    public function test_custom_login_page_renders_quick_login_accounts(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('admin@sekolah.sch.id');
        $response->assertSee('adminweb@sekolah.sch.id');
        $response->assertSee('ppdb@sekolah.sch.id');
        $response->assertSee('Pusat Akses Cepat');
    }

    public function test_custom_login_quick_login_works_for_developer(): void
    {
        \Livewire\Livewire::test(\App\Filament\Pages\Auth\CustomLogin::class)
            ->call('fillCredentials', 'developer')
            ->assertSet('data.email', 'admin@sekolah.sch.id')
            ->assertSet('data.password', 'password');
    }

    public function test_super_admin_can_access_system_maintenance(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin/system-maintenance');
        $response->assertStatus(200);
        $response->assertSee('Pusat Kendali Pengembang');
    }

    public function test_super_admin_can_access_system_logs(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $response = $this->actingAs($admin)->get('/admin/system-logs');
        $response->assertStatus(200);
        $response->assertSee('Pemeriksa Catatan Sistem');
    }

    public function test_non_super_admin_cannot_access_system_maintenance(): void
    {
        $ppdbAdmin = User::where('email', 'ppdb@sekolah.sch.id')->first();
        $response = $this->actingAs($ppdbAdmin)->get('/admin/system-maintenance');
        $response->assertStatus(403);
    }

    public function test_system_maintenance_actions_work(): void
    {
        $admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $this->actingAs($admin);

        \Livewire\Livewire::test(\App\Filament\Pages\SystemMaintenance::class)
            ->call('clearAllCache')
            ->assertHasNoErrors();
    }
}
