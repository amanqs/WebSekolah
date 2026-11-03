<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Extracurricular;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Settings\GeneralSettings;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(GeneralSettings $settings): View
    {
        $heroSlides = $settings->enable_hero_slider ? HeroSlide::active()->get() : collect();
        $latestPosts = $settings->enable_latest_posts ? Post::published()->with('category')->take(6)->get() : collect();
        $extracurriculars = $settings->enable_extracurriculars ? Extracurricular::active()->take(8)->get() : collect();
        $galleries = $settings->enable_gallery ? Gallery::featured()->take(6)->get() : collect();
        $testimonials = $settings->enable_testimonials ? Testimonial::active()->take(6)->get() : collect();
        $faqs = $settings->enable_faq ? Faq::active()->take(8)->get() : collect();
        $upcomingAgendas = Agenda::upcoming()->take(4)->get();

        // Calculate dynamic stats from settings with fallback
        $stats = [
            'teachers' => $settings->total_teachers ?: (Teacher::guru()->active()->count() ?: 35),
            'staff' => Teacher::tendik()->active()->count() ?: 12,
            'extracurriculars' => Extracurricular::active()->count() ?: 12,
            'students' => $settings->total_students ?: 240,
            'classes' => $settings->total_classes ?: 12,
            'alumni' => $settings->total_alumni ?: 450,
            'accreditation' => $settings->accreditation ?: 'A (Unggul)',
            'accreditation_body' => $settings->accreditation_body ?: 'BAN-S/M',
            'curriculum' => $settings->curriculum ?: 'Kurikulum Merdeka',
        ];

        return view('home', compact(
            'settings',
            'heroSlides',
            'latestPosts',
            'extracurriculars',
            'galleries',
            'testimonials',
            'faqs',
            'upcomingAgendas',
            'stats'
        ));
    }
}

