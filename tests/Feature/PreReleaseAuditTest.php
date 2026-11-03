<?php

namespace Tests\Feature;

use App\Models\Agenda;
use App\Models\Download;
use App\Models\Gallery;
use App\Models\Graduation;
use App\Models\Page;
use App\Models\Post;
use App\Models\PpdbRegistration;
use App\Models\Teacher;
use App\Models\User;
use Tests\TestCase;

class PreReleaseAuditTest extends TestCase
{
    protected User $admin;
    protected User $ppdbUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::where('email', 'admin@sekolah.sch.id')->first();
        $this->ppdbUser = User::where('email', 'ppdb@sekolah.sch.id')->first();
    }

    public function test_all_public_pages_and_filters(): void
    {
        // 1. Home
        $this->get('/')->assertStatus(200);

        // 2. Berita & Detail
        $this->get('/berita')->assertStatus(200);
        $post = Post::published()->first();
        if ($post) {
            $this->get('/berita/' . $post->slug)->assertStatus(200);
        }

        // 3. Guru & Tendik with filter & search
        $this->get('/guru-staf')->assertStatus(200);
        $this->get('/guru-staf?type=guru')->assertStatus(200);
        $this->get('/guru-staf?type=tendik')->assertStatus(200);
        $this->get('/guru-staf?q=Guru')->assertStatus(200);

        // 4. Ekstrakurikuler with search
        $this->get('/ekstrakurikuler')->assertStatus(200);
        $this->get('/ekstrakurikuler?q=Pramuka')->assertStatus(200);

        // 5. Agenda
        $this->get('/agenda')->assertStatus(200);

        // 6. Galeri with type filter
        $this->get('/galeri')->assertStatus(200);
        $this->get('/galeri?type=photo')->assertStatus(200);
        $this->get('/galeri?type=video')->assertStatus(200);

        // 7. Unduhan with category filter & file download
        $this->get('/unduhan')->assertStatus(200);
        $download = Download::first();
        if ($download) {
            $this->get('/unduhan?category=' . urlencode($download->category))->assertStatus(200);
            $this->get('/unduhan/' . $download->slug . '/download')->assertStatus(200);
        }

        // 8. Kontak
        $this->get('/kontak')->assertStatus(200);

        // 9. Dinamis Profile Page
        $page = Page::active()->first();
        if ($page) {
            $this->get('/halaman/' . $page->slug)->assertStatus(200);
        }

        // 10. PPDB & PDF Card
        $this->get('/ppdb')->assertStatus(200);
        $reg = PpdbRegistration::first();
        if ($reg) {
            $pdfRes = $this->get('/ppdb/' . $reg->registration_number . '/cetak-kartu');
            $pdfRes->assertStatus(200);
            $pdfRes->assertHeader('content-type', 'application/pdf');
        }

        // 11. Kelulusan
        $this->get('/kelulusan')->assertStatus(200);

        // 12. LPJ & E-Library Buku Non-Teks
        $this->get('/lpj')->assertStatus(200);
        $this->get('/buku-non-teks')->assertStatus(200);

        // 13. Custom 404
        $this->get('/halaman-yang-pasti-tidak-ada-12345678')->assertStatus(404);
    }

    public function test_super_admin_can_access_all_filament_modules(): void
    {
        $this->actingAs($this->admin);

        $urls = [
            '/admin',
            '/admin/manage-school-settings',
            '/admin/users',
            '/admin/navigations',
            '/admin/pages',
            '/admin/posts',
            '/admin/categories',
            '/admin/teachers',
            '/admin/extracurriculars',
            '/admin/agendas',
            '/admin/galleries',
            '/admin/downloads',
            '/admin/testimonials',
            '/admin/faqs',
            '/admin/hero-slides',
            '/admin/ppdb-registrations',
            '/admin/graduations',
            '/admin/lpjs',
            '/admin/buku-non-teks',
            '/admin/system-maintenance',
            '/admin/system-logs',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
        }

        // View single PPDB registration in Filament
        $reg = PpdbRegistration::first();
        if ($reg) {
            $this->get('/admin/ppdb-registrations/' . $reg->id)->assertStatus(200);
        }
    }

    public function test_ppdb_admin_role_permissions(): void
    {
        $this->actingAs($this->ppdbUser);

        // Can access PPDB
        $this->get('/admin/ppdb-registrations')->assertStatus(200);

        // Should NOT have access to users management or settings
        $this->get('/admin/users')->assertStatus(403);
        $this->get('/admin/manage-school-settings')->assertStatus(403);
    }

    public function test_custom_login_security_in_production_and_local(): void
    {
        $loginPage = new \App\Filament\Pages\Auth\CustomLogin();

        // 1. In Local + Debug
        $this->app->detectEnvironment(fn() => 'local');
        config(['app.debug' => true]);
        $this->assertTrue($loginPage->isDevLoginEnabled());
        $this->assertNotEmpty($loginPage->getDemoAccounts());

        // 2. In Production
        $this->app->detectEnvironment(fn() => 'production');
        config(['app.debug' => false]);
        $this->assertFalse($loginPage->isDevLoginEnabled());
        $this->assertEmpty($loginPage->getDemoAccounts());

        // Verify quickLogin and fillCredentials throw 403 in production
        try {
            $loginPage->quickLogin('developer');
            $this->fail('Expected HttpException 403 was not thrown');
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }

        try {
            $loginPage->fillCredentials('developer');
            $this->fail('Expected HttpException 403 was not thrown');
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }

        // Test login page output in production does not show quick login buttons
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertDontSee('Masuk 1-Klik');
        $response->assertDontSee('Kata Sandi Default Semua Akun');
    }
}

