<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // School Identity
        $this->migrator->add('general.school_name', 'SMA Negeri 1 Prestasi Bangsa');
        $this->migrator->add('general.npsn', '20109988');
        $this->migrator->add('general.school_level', 'SMA');
        $this->migrator->add('general.tagline', 'Mewujudkan Generasi Cerdas, Berkarakter, dan Berdaya Saing Global');
        $this->migrator->add('general.principal_name', 'Drs. H. Mulyadi, M.Pd.');
        $this->migrator->add('general.principal_nip', '19740512 199903 1 002');
        $this->migrator->add('general.principal_speech', '<p>Selamat datang di situs resmi SMA Negeri 1 Prestasi Bangsa. Kami berkomitmen untuk menyelenggarakan pendidikan berkualitas tinggi yang mengedepankan pembinaan karakter, kecerdasan intelektual, serta keterampilan abad 21.</p><p>Melalui portal ini, kami berharap dapat memberikan kemudahan akses informasi bagi seluruh peserta didik, wali murid, alumni, dan masyarakat luas.</p>');
        $this->migrator->add('general.principal_photo', null);
        $this->migrator->add('general.logo_light', null);
        $this->migrator->add('general.logo_dark', null);
        $this->migrator->add('general.favicon', null);

        // Color Palette (Professional Blue: Biru Edukasi & Instansi)
        $this->migrator->add('general.primary_color', '#1E3A8A'); // Royal Navy Blue
        $this->migrator->add('general.secondary_color', '#0284C7'); // Electric / Sky Blue
        $this->migrator->add('general.accent_color', '#F59E0B'); // Soft Gold / Amber

        // Contact Info
        $this->migrator->add('general.address', 'Jl. Pendidikan No. 45, Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12180');
        $this->migrator->add('general.phone', '(021) 7890123');
        $this->migrator->add('general.whatsapp', '6281234567890');
        $this->migrator->add('general.email', 'info@sman1prestasibangsa.sch.id');
        $this->migrator->add('general.maps_embed', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28581457813!2d106.7588487!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e49fe3dd05%3A0x629c424074218a0!2sJakarta%20Selatan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>');

        // Social Media
        $this->migrator->add('general.facebook_url', 'https://facebook.com/sman1prestasibangsa');
        $this->migrator->add('general.instagram_url', 'https://instagram.com/sman1prestasibangsa');
        $this->migrator->add('general.youtube_url', 'https://youtube.com/@sman1prestasibangsa');
        $this->migrator->add('general.tiktok_url', 'https://tiktok.com/@sman1prestasibangsa');

        // Section Toggles
        $this->migrator->add('general.enable_hero_slider', true);
        $this->migrator->add('general.enable_principal_speech', true);
        $this->migrator->add('general.enable_school_stats', true);
        $this->migrator->add('general.enable_latest_posts', true);
        $this->migrator->add('general.enable_extracurriculars', true);
        $this->migrator->add('general.enable_gallery', true);
        $this->migrator->add('general.enable_testimonials', true);
        $this->migrator->add('general.enable_faq', true);

        // PPDB & Kelulusan
        $this->migrator->add('general.ppdb_is_active', true);
        $this->migrator->add('general.ppdb_academic_year', '2026/2027');
        $this->migrator->add('general.ppdb_start_date', '2026-05-01');
        $this->migrator->add('general.ppdb_end_date', '2026-07-15');
        $this->migrator->add('general.ppdb_announcement', 'Pendaftaran PPDB Jalur Zonasi, Afirmasi, dan Prestasi telah dibuka!');

        $this->migrator->add('general.graduation_is_active', true);
        $this->migrator->add('general.graduation_academic_year', '2025/2026');
        $this->migrator->add('general.graduation_announcement_datetime', '2026-05-05 10:00:00');
    }
};

