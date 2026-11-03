<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    // Identitas & Branding
    public string $school_name;
    public string $npsn;
    public string $school_level; // SD, SMP, SMA, SMK, SLB
    public string $tagline;
    public ?string $principal_name;
    public ?string $principal_nip;
    public ?string $principal_speech;
    public ?string $principal_photo;
    public ?string $logo_light;
    public ?string $logo_dark;
    public ?string $favicon;

    // Akreditasi & Kurikulum
    public ?string $accreditation;
    public ?string $accreditation_body;
    public ?string $curriculum;

    // Statistik Sekolah
    public ?int $total_students;
    public ?int $total_teachers;
    public ?int $total_classes;
    public ?int $total_alumni;

    // Dynamic Color Palette
    public string $primary_color;
    public string $secondary_color;
    public string $accent_color;

    // Kontak & Lokasi
    public string $address;
    public string $phone;
    public string $whatsapp;
    public string $email;
    public ?string $maps_embed;

    // Media Sosial
    public ?string $facebook_url;
    public ?string $instagram_url;
    public ?string $youtube_url;
    public ?string $tiktok_url;

    // Section Toggles
    public bool $enable_hero_slider;
    public bool $enable_principal_speech;
    public bool $enable_school_stats;
    public bool $enable_latest_posts;
    public bool $enable_extracurriculars;
    public bool $enable_gallery;
    public bool $enable_testimonials;
    public bool $enable_faq;

    // Specialized Modules Toggles & Config
    public bool $ppdb_is_active;
    public string $ppdb_academic_year;
    public ?string $ppdb_start_date;
    public ?string $ppdb_end_date;
    public ?string $ppdb_announcement;

    public bool $graduation_is_active;
    public string $graduation_academic_year;
    public ?string $graduation_announcement_datetime;

    public static function group(): string
    {
        return 'general';
    }
}

