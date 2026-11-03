@inject('settings', 'App\Settings\GeneralSettings')
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- SEO Meta Tags -->
    <title>@yield('title', $settings->school_name . ' - ' . $settings->tagline)</title>
    <meta name="description" content="@yield('meta_description', $settings->tagline)">
    <meta name="keywords" content="sekolah, {{ $settings->school_name }}, {{ $settings->school_level }}, ppdb online, pendidikan unggul">

    <!-- OpenGraph & Twitter Cards -->
    <meta property="og:title" content="@yield('title', $settings->school_name)">
    <meta property="og:description" content="@yield('meta_description', $settings->tagline)">
    <meta property="og:image" content="@yield('meta_image', $settings->logo_light ? asset('storage/' . $settings->logo_light) : asset('images/default-og.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    @if($settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @else
        <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2997/2997295.png">
    @endif

    @php
        $hexToRgb = function($hex, $default = '30, 58, 138') {
            $hex = ltrim($hex ?? '', '#');
            if (strlen($hex) === 6) {
                return hexdec(substr($hex, 0, 2)) . ', ' . hexdec(substr($hex, 2, 2)) . ', ' . hexdec(substr($hex, 4, 2));
            }
            return $default;
        };
        $primaryRgb = $hexToRgb($settings->primary_color ?? null, '30, 58, 138'); // Royal Navy Blue (#1E3A8A)
        $secondaryRgb = $hexToRgb($settings->secondary_color ?? null, '2, 132, 199'); // Electric Sky Blue (#0284C7)
        $accentRgb = $hexToRgb($settings->accent_color ?? null, '245, 158, 11'); // Soft Gold / Amber (#F59E0B)
        $primaryHex = $settings->primary_color ?? '#1E3A8A';
        $secondaryHex = $settings->secondary_color ?? '#0284C7';
        $accentHex = $settings->accent_color ?? '#F59E0B';
    @endphp

    <!-- Fonts: Plus Jakarta Sans (body) & Outfit (display headings) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN standalone configuration with dynamic RGB variable support & official plugins) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        function withOpacity(variableName) {
            return ({ opacityValue }) => {
                if (opacityValue !== undefined) {
                    return `rgba(var(${variableName}), ${opacityValue})`;
                }
                return `rgb(var(${variableName}))`;
            };
        }

        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        display: ['Outfit', '"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: withOpacity('--color-primary-rgb'),
                        secondary: withOpacity('--color-secondary-rgb'),
                        accent: withOpacity('--color-accent-rgb'),
                        brand: {
                            50: '#F0F9FF',
                            100: '#E0F2FE',
                            200: '#BAE6FD',
                            500: '#0284C7',
                            600: '#0284C7',
                            700: '#0369A1',
                            800: '#1E40AF',
                            900: '#1E3A8A',
                            950: '#0B1528',
                        }
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02)',
                        'card': '0 10px 30px -5px rgba(15, 23, 42, 0.06), 0 4px 6px -2px rgba(15, 23, 42, 0.03)',
                        'card-hover': '0 20px 40px -10px rgba(30, 58, 138, 0.12), 0 8px 16px -4px rgba(2, 132, 199, 0.08)',
                    }
                }
            }
        }
    </script>

    <!-- Dynamic CSS Variables & Global Polish -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        :root {
            --color-primary-rgb: {{ $primaryRgb }};
            --color-secondary-rgb: {{ $secondaryRgb }};
            --color-accent-rgb: {{ $accentRgb }};
            --color-primary: {{ $primaryHex }};
            --color-secondary: {{ $secondaryHex }};
            --color-accent: {{ $accentHex }};
        }

        /* Smooth Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 9px;
            height: 9px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Subtle Shimmer Animation */
        @keyframes subtleShimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .animate-shimmer {
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: subtleShimmer 4s infinite;
        }
    </style>

    @livewireStyles
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-slate-800 flex flex-col min-h-screen selection:bg-blue-900 selection:text-white">

    <!-- Top Announcement Bar (Slim, high-contrast & neat) -->
    <div class="bg-[#0B1528] text-slate-300 text-[11px] py-2 px-4 border-b border-blue-950/80 hidden md:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
            <!-- Left Info Pills -->
            <div class="flex items-center gap-4 text-slate-300">
                <span class="inline-flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <strong class="text-white font-bold">NPSN:</strong>
                    <span class="font-mono text-slate-300">{{ $settings->npsn }}</span>
                </span>
                <span class="text-slate-600">•</span>
                <span class="inline-flex items-center gap-1.5">
                    <span class="text-amber-400 font-bold">Akreditasi {{ $settings->accreditation ?? 'A Unggul' }}</span>
                </span>
                <span class="text-slate-600">•</span>
                <span class="inline-flex items-center gap-1.5 hover:text-white transition">
                    <svg class="w-3.5 h-3.5 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>{{ $settings->phone }}</span>
                </span>
                <span class="text-slate-600">•</span>
                <span class="inline-flex items-center gap-1.5 hover:text-white transition">
                    <svg class="w-3.5 h-3.5 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ $settings->email }}</span>
                </span>
            </div>

            <!-- Right Info & Links -->
            <div class="flex items-center gap-4">
                @if($settings->ppdb_is_active)
                    <div class="hidden lg:flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded-full bg-amber-400/20 text-amber-300 font-bold text-[10px] border border-amber-400/30 uppercase tracking-wider">PPDB {{ $settings->ppdb_academic_year }}</span>
                        <span class="text-slate-300 text-xs">Pendaftaran Online Resmi Dibuka</span>
                    </div>
                    <span class="hidden lg:inline text-slate-600">•</span>
                @endif
                <a href="{{ url('/admin') }}" class="text-slate-300 hover:text-white transition flex items-center gap-1.5 font-semibold text-xs group">
                    <svg class="w-3.5 h-3.5 text-sky-400 group-hover:rotate-45 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>Admin Panel</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    @include('layouts.navigation')

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Interactive Floating Actions (Back-to-top) -->
    <div x-data="{ showTop: false }"
         @scroll.window="showTop = (window.pageYOffset > 300)"
         class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3 pointer-events-none">

        <!-- Back to Top Button -->
        <button x-show="showTop"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-3"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                type="button"
                class="pointer-events-auto w-11 h-11 rounded-full bg-white hover:bg-slate-50 text-blue-900 border border-slate-200 shadow-xl flex items-center justify-center hover:scale-110 transition-all duration-200 group"
                aria-label="Kembali ke atas">
            <svg class="w-5 h-5 text-blue-900 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
        </button>
    </div>

    <!-- Number Counter Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('[data-counter]');
            if (!counters.length) return;

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const target = parseInt(el.getAttribute('data-counter'), 10) || 0;
                        const suffix = el.getAttribute('data-suffix') || '';
                        const duration = 1800;
                        let startTime = null;

                        const animate = (timestamp) => {
                            if (!startTime) startTime = timestamp;
                            const progress = Math.min((timestamp - startTime) / duration, 1);
                            const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                            el.textContent = Math.floor(ease * target) + suffix;
                            if (progress < 1) {
                                requestAnimationFrame(animate);
                            } else {
                                el.textContent = target + suffix;
                            }
                        };
                        requestAnimationFrame(animate);
                        obs.unobserve(el);
                    }
                });
            }, { threshold: 0.15 });

            counters.forEach(c => observer.observe(c));
        });
    </script>

    <!-- Dedicated Accessibility Toolbar (Ramah Disabilitas Khusus SLB) -->
    @include('partials.accessibility-toolbar')

    @livewireScripts
</body>
</html>
