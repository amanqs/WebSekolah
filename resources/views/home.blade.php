@extends('layouts.app')

@section('title', $settings->school_name . ' - ' . $settings->tagline)

@section('content')

    <!-- 1. HERO SLIDER SECTION (Clean, Responsive & Perfectly Spaced) -->
    @if($settings->enable_hero_slider && $heroSlides->isNotEmpty())
        <section id="hero"
                 x-data="{
                    active: 0,
                    total: {{ max(1, $heroSlides->count()) }},
                    timer: null,
                    next() { this.active = (this.active + 1) % this.total; },
                    prev() { this.active = (this.active - 1 + this.total) % this.total; },
                    start() {
                        if (this.total > 1) {
                            this.timer = setInterval(() => { this.next() }, 7000);
                        }
                    },
                    stop() {
                        if (this.timer) { clearInterval(this.timer); this.timer = null; }
                    }
                 }"
                 x-init="start()"
                 @mouseenter="stop()"
                 @mouseleave="start()"
                 class="relative bg-[#0B1528] text-white pt-10 pb-12 sm:pt-14 sm:pb-16 lg:pt-16 lg:pb-20 overflow-hidden">

            <!-- Subtle Grid Texture -->
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none z-0"></div>

            <!-- Ambient Glow Spheres -->
            <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 -right-32 w-96 h-96 rounded-full bg-sky-500/15 blur-3xl pointer-events-none"></div>

            <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 items-start">
                    @foreach($heroSlides as $index => $slide)
                        <div x-show="active === {{ $index }}"
                             x-cloak
                             x-transition:enter="transition-opacity ease-out duration-500"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition-opacity ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="col-start-1 row-start-1 w-full"
                             style="{{ $index === 0 ? '' : 'display: none;' }}">

                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                                <!-- Left Column: Typography & CTAs (span 7) -->
                                <div class="lg:col-span-7 space-y-5 text-left">
                                    <!-- Eyebrow Pill -->
                                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/70 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider shadow-sm">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                        <span>{{ $settings->school_name }}</span>
                                        <span class="text-slate-500">•</span>
                                        <span class="text-white">Akreditasi {{ $settings->accreditation ?? 'A Unggul' }}</span>
                                    </div>

                                    <!-- Headline -->
                                    <h1 class="font-display text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-extrabold tracking-tight text-white leading-tight">
                                        {{ $slide->title }}
                                    </h1>

                                    <!-- Subtitle -->
                                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-normal max-w-xl">
                                        {{ $slide->subtitle ?: 'Lembaga pendidikan unggulan berbasis karakter dan teknologi, membina insan cendekia yang berprestasi dan siap menghadapi masa depan.' }}
                                    </p>

                                    <!-- Buttons -->
                                    <div class="flex flex-wrap items-center gap-3 pt-1">
                                        @if($slide->resolved_cta_url)
                                            <a href="{{ $slide->resolved_cta_url }}"
                                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs sm:text-sm shadow-md transition-all duration-200">
                                                <span>{{ $slide->cta_text ?: 'Daftar PPDB Online' }}</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </a>
                                        @else
                                            <a href="{{ route('ppdb.index') }}"
                                               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs sm:text-sm shadow-md transition-all duration-200">
                                                <span>Daftar PPDB Online</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </a>
                                        @endif

                                        <a href="#sambutan"
                                           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-200 hover:text-white font-semibold text-xs sm:text-sm border border-slate-700 transition-all duration-200">
                                            <span>Sambutan Kepala Sekolah</span>
                                            <svg class="w-3.5 h-3.5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </a>
                                    </div>

                                    <!-- Trust Metrics Direct in Hero -->
                                    <div class="pt-4 flex flex-wrap items-center gap-4 text-xs text-slate-400 border-t border-slate-800">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-amber-400">★</span>
                                            <span class="text-slate-300 font-medium">{{ $settings->curriculum ?? 'Kurikulum Merdeka' }}</span>
                                        </div>
                                        <span class="text-slate-600">•</span>
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-emerald-400">✓</span>
                                            <span class="text-slate-300 font-medium">100% Lulusan PTN & Kerja</span>
                                        </div>
                                        <span class="text-slate-600">•</span>
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-sky-400">◆</span>
                                            <span class="text-slate-300 font-medium">20+ Ekstrakurikuler</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Featured Visual Showcase Card (span 5) -->
                                <div class="lg:col-span-5 hidden lg:block">
                                    <div class="bg-slate-900 border border-slate-700/80 rounded-2xl overflow-hidden shadow-2xl">
                                        <!-- Image -->
                                        <div class="aspect-[16/10] bg-slate-950 overflow-hidden relative">
                                            @if($slide->image_url)
                                                <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-tr from-blue-950 to-slate-900 flex items-center justify-center">
                                                    <svg class="w-16 h-16 text-blue-400/40" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L3 6v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V6l-9-4zm0 4a3 3 0 110 6 3 3 0 010-6zm4.5 11.5c0-.83-.42-1.57-1.07-2.01A5.96 5.96 0 0012 14.5c-1.27 0-2.43.39-3.43 1A2.5 2.5 0 007.5 17.5v.71C8.79 19.38 10.32 20 12 20s3.21-.62 4.5-1.79v-.71z"/></svg>
                                                </div>
                                            @endif
                                            <span class="absolute top-3 right-3 px-2.5 py-1 rounded-lg bg-blue-900/90 text-sky-200 text-xs font-bold border border-blue-700/60 shadow-sm">
                                                TA {{ $settings->ppdb_academic_year }}
                                            </span>
                                        </div>

                                        <!-- Card Footer Info -->
                                        <div class="p-4 bg-slate-900/95 border-t border-slate-800 flex items-center justify-between">
                                            <div>
                                                <span class="text-[10px] text-amber-400 font-bold uppercase tracking-wider block">Akreditasi {{ $settings->accreditation_body ?? 'BAN-S/M' }}</span>
                                                <span class="font-display font-bold text-sm text-white">Nilai {{ $settings->accreditation ?? 'A (Unggul)' }}</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Standar Mutu</span>
                                                <span class="text-xs text-slate-200 font-medium">Sekolah Penggerak</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Slide Controls (Below content, perfectly separated) -->
                @if($heroSlides->count() > 1)
                    <div class="mt-8 pt-4 flex items-center justify-between">
                        <!-- Left & Right Arrow Buttons -->
                        <div class="flex items-center gap-2">
                            <button @click="prev()"
                                    class="w-9 h-9 rounded-xl bg-slate-800/80 hover:bg-blue-600 text-white flex items-center justify-center border border-slate-700 transition focus:outline-none"
                                    aria-label="Slide sebelumnya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="next()"
                                    class="w-9 h-9 rounded-xl bg-slate-800/80 hover:bg-blue-600 text-white flex items-center justify-center border border-slate-700 transition focus:outline-none"
                                    aria-label="Slide selanjutnya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>

                        <!-- Dot Indicators -->
                        <div class="flex items-center gap-1.5">
                            @foreach($heroSlides as $i => $s)
                                <button @click="active = {{ $i }}"
                                        class="h-1.5 rounded-full transition-all duration-200 focus:outline-none"
                                        :class="active === {{ $i }} ? 'w-6 bg-amber-400' : 'w-2 bg-slate-600 hover:bg-slate-400'"
                                        aria-label="Lihat slide {{ $i + 1 }}"></button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </section>
    @endif

    <!-- 2. HIGHLIGHTS FEATURE CARDS (Clean Standalone Section, No Negative Margin Glitches) -->
    <section class="py-12 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <a href="{{ route('pages.show', 'visi-dan-misi') }}" class="p-5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:shadow-lg hover:border-blue-300 transition-all duration-200 group flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-900 group-hover:bg-blue-900 group-hover:text-white transition flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-slate-900 text-sm group-hover:text-blue-900 transition">Kurikulum Merdeka</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pembelajaran fleksibel berfokus pada materi esensial & karakter.</p>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="{{ route('extracurriculars.index') }}" class="p-5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:shadow-lg hover:border-blue-300 transition-all duration-200 group flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-sky-100 text-sky-700 group-hover:bg-blue-900 group-hover:text-white transition flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-slate-900 text-sm group-hover:text-blue-900 transition">20+ Ekstrakurikuler</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pengembangan minat bakat seni, riset, olahraga & kepemimpinan.</p>
                    </div>
                </a>

                <!-- Card 3 -->
                <a href="{{ route('teachers.index') }}" class="p-5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:shadow-lg hover:border-blue-300 transition-all duration-200 group flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-700 group-hover:bg-blue-900 group-hover:text-white transition flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-slate-900 text-sm group-hover:text-blue-900 transition">Guru Berprestasi</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pendidik profesional, berdedikasi tinggi & tersertifikasi resmi.</p>
                    </div>
                </a>

                <!-- Card 4 -->
                <a href="{{ route('pages.show', 'fasilitas-kampus') }}" class="p-5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:shadow-lg hover:border-blue-300 transition-all duration-200 group flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 group-hover:bg-blue-900 group-hover:text-white transition flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-slate-900 text-sm group-hover:text-blue-900 transition">Fasilitas Modern</h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">Smart classroom, laboratorium komputer, riset sains & perpustakaan.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- 3. SAMBUTAN KEPALA SEKOLAH SECTION -->
    <section id="sambutan" class="py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">

                <!-- Left: Principal Card (span 5) -->
                <div class="lg:col-span-5">
                    <div class="max-w-sm mx-auto bg-white rounded-2xl p-4 border border-slate-200/80 shadow-md">
                        <div class="aspect-[3/4] rounded-xl overflow-hidden bg-slate-100 relative">
                            @if($settings->principal_photo)
                                @php
                                    $pPhoto = $settings->principal_photo;
                                    $pPhotoUrl = (str_starts_with($pPhoto, 'http://') || str_starts_with($pPhoto, 'https://')) ? $pPhoto : asset('storage/' . $pPhoto);
                                @endphp
                                <img src="{{ $pPhotoUrl }}" alt="{{ $settings->principal_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-tr from-blue-900 to-sky-700 flex items-center justify-center text-white">
                                    <svg class="w-24 h-24 text-white/50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-900 text-amber-300">Kepala Sekolah</span>
                                <h3 class="font-display font-bold text-base text-white mt-1">{{ $settings->principal_name ?: 'Drs. H. Mulyadi, M.Pd.' }}</h3>
                                <p class="text-xs text-slate-300">NIP. 19740512 199903 1 002</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Welcome Text (span 7) -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-900 text-xs font-bold uppercase tracking-wider">
                        <span>Sambutan Resmi</span>
                    </div>

                    <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Membangun Insan Cendekia yang <span class="text-blue-900">Berkarakter Mulia</span> dan Berwawasan Global
                    </h2>

                    <div class="text-slate-600 text-xs sm:text-sm leading-relaxed space-y-3.5">
                        <p>
                            <em>Assalamu’alaikum Warahmatullahi Wabarakatuh, Salam Sejahtera untuk kita semua.</em>
                        </p>
                        <p>
                            Selamat datang di portal informasi resmi <strong>{{ $settings->school_name }}</strong>. Sebagai institusi pendidikan yang berakar pada nilai-nilai luhur budi pekerti, kami berkomitmen mendampingi putra-putri bangsa menjadi generasi yang tidak hanya unggul secara akademis, namun juga memiliki integritas kepribadian dan kepedulian sosial tinggi.
                        </p>
                        <p>
                            Di era transformasi teknologi saat ini, kami terus memperkuat ekosistem belajar yang adaptif melalui implementasi Kurikulum Merdeka, laboratorium canggih, serta pembinaan minat bakat melalui berbagai cabang ekstrakurikuler unggulan.
                        </p>
                    </div>

                    <!-- 3 Pillars -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-display font-bold text-blue-900 text-sm block">01. Integritas</span>
                            <span class="text-[11px] text-slate-500 mt-0.5 block">Karakter dan akhlak mulia sebagai pondasi utama.</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-display font-bold text-blue-900 text-sm block">02. Prestasi</span>
                            <span class="text-[11px] text-slate-500 mt-0.5 block">Capaian akademik & non-akademik berdaya saing.</span>
                        </div>
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-display font-bold text-blue-900 text-sm block">03. Inovasi</span>
                            <span class="text-[11px] text-slate-500 mt-0.5 block">Pemanfaatan sains & teknologi masa depan.</span>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center gap-3">
                        <a href="{{ route('pages.show', 'sejarah-sekolah') }}" class="px-5 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs shadow-sm transition">
                            Pelajari Profil Sekolah
                        </a>
                        <a href="{{ route('teachers.index') }}" class="px-5 py-2.5 rounded-xl bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs border border-slate-200 transition">
                            Lihat Dewan Guru & Staf
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. KEY STATISTICS BAR (Clean High-Contrast Navy Bar) -->
    @if($settings->enable_school_stats)
        <section class="py-12 bg-[#0B1528] text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-800">
                    <div class="pt-3 md:pt-0">
                        <span class="font-display font-black text-3xl sm:text-4xl text-amber-400 block" data-counter="100" data-suffix="%">100%</span>
                        <span class="text-xs sm:text-sm text-slate-200 font-bold mt-1.5 block">Akreditasi {{ $settings->accreditation ?? 'A (Unggul)' }}</span>
                        <span class="text-[11px] text-slate-400 block mt-0.5">Sertifikasi Resmi {{ $settings->accreditation_body ?? 'BAN-S/M' }}</span>
                    </div>
                    <div class="pt-3 md:pt-0">
                        <span class="font-display font-black text-3xl sm:text-4xl text-white block" data-counter="{{ $stats['teachers'] }}" data-suffix="+">{{ $stats['teachers'] }}+</span>
                        <span class="text-xs sm:text-sm text-slate-200 font-bold mt-1.5 block">Dewan Guru Profesional</span>
                        <span class="text-[11px] text-slate-400 block mt-0.5">Tersertifikasi Pendidik</span>
                    </div>
                    <div class="pt-3 md:pt-0">
                        <span class="font-display font-black text-3xl sm:text-4xl text-sky-400 block" data-counter="{{ $stats['students'] }}" data-suffix="+">{{ $stats['students'] }}+</span>
                        <span class="text-xs sm:text-sm text-slate-200 font-bold mt-1.5 block">Peserta Didik Aktif</span>
                        <span class="text-[11px] text-slate-400 block mt-0.5">Generasi Emas & Mandiri</span>
                    </div>
                    <div class="pt-3 md:pt-0">
                        <span class="font-display font-black text-3xl sm:text-4xl text-emerald-400 block" data-counter="{{ $stats['classes'] }}" data-suffix=" Rombel">{{ $stats['classes'] }} Rombel</span>
                        <span class="text-xs sm:text-sm text-slate-200 font-bold mt-1.5 block">Rombongan Belajar</span>
                        <span class="text-[11px] text-slate-400 block mt-0.5">Ruang Kelas & Lab Khusus</span>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 5. BERITA & WARTA TERKINI -->
    @if($settings->enable_latest_posts && $latestPosts->isNotEmpty())
        <section class="py-16 bg-[#F8FAFC]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                    <div>
                        <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Warta & Informasi</span>
                        <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Kabar & Prestasi Terbaru</h2>
                    </div>
                    <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-blue-900 hover:text-blue-700 group">
                        <span>Lihat Semua Berita</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($latestPosts->take(3) as $post)
                        <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col group hover:-translate-y-1">
                            <!-- Image -->
                            <div class="aspect-video bg-slate-100 overflow-hidden relative">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @if($post->category)
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-blue-900 text-white shadow-sm">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-1.5">
                                        <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                                        <span>•</span>
                                        <span>{{ $post->view_count }}x dibaca</span>
                                    </div>
                                    <h3 class="font-display font-bold text-sm sm:text-base text-slate-900 group-hover:text-blue-900 transition line-clamp-2 leading-snug">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                        {{ Str::limit(strip_tags($post->content), 110) }}
                                    </p>
                                </div>
                                <div class="pt-3 mt-4 border-t border-slate-100">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-900 hover:text-blue-700">
                                        <span>Baca Lengkap</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 6. AGENDA & KEGIATAN MENDATANG -->
    @if($upcomingAgendas->isNotEmpty())
        <section class="py-16 bg-white border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                    <div>
                        <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Kalender Sekolah</span>
                        <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Agenda Terjadwal</h2>
                    </div>
                    <a href="{{ route('agenda.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-blue-900 hover:text-blue-700 group">
                        <span>Lihat Semua Agenda</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($upcomingAgendas as $agenda)
                        <div class="p-4 sm:p-5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:shadow-md transition-all duration-200 flex items-start gap-4 group">
                            <!-- Date Badge -->
                            <div class="w-14 h-14 rounded-xl bg-blue-900 text-white flex flex-col items-center justify-center shrink-0 shadow-sm">
                                <span class="text-[9px] font-bold uppercase tracking-wider text-sky-200">{{ $agenda->start_date->format('M') }}</span>
                                <span class="font-display font-black text-lg leading-none mt-0.5 text-amber-300">{{ $agenda->start_date->format('d') }}</span>
                            </div>

                            <!-- Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-900">
                                        {{ $agenda->type ?: 'Akademik' }}
                                    </span>
                                    <span class="text-xs text-slate-400">
                                        {{ $agenda->start_time ? $agenda->start_time->format('H:i') : '08:00' }} WIB
                                    </span>
                                </div>
                                <h3 class="font-display font-bold text-sm text-slate-900 group-hover:text-blue-900 transition truncate">
                                    {{ $agenda->title }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $agenda->location ?: 'Kampus Sekolah' }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 7. EKSTRAKURIKULER UNGGULAN -->
    @if($settings->enable_extracurriculars && $extracurriculars->isNotEmpty())
        <section class="py-16 bg-[#F8FAFC]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                    <div>
                        <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Pengembangan Karakter</span>
                        <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Ekstrakurikuler Pilihan</h2>
                    </div>
                    <a href="{{ route('extracurriculars.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-blue-900 hover:text-blue-700 group">
                        <span>Lihat Semua ({{ $extracurriculars->count() }}+ Cabang)</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($extracurriculars->take(4) as $ekskul)
                        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col group hover:-translate-y-1">
                            <div class="aspect-video bg-slate-100 overflow-hidden relative">
                                <img src="{{ $ekskul->image_url }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @if($ekskul->category)
                                    <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-900/80 text-white backdrop-blur-sm">
                                        {{ $ekskul->category }}
                                    </span>
                                @endif
                            </div>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-display font-bold text-sm sm:text-base text-slate-900 group-hover:text-blue-900 transition">
                                        {{ $ekskul->name }}
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                        {{ $ekskul->description ?: 'Wadah eksplorasi potensi, kepemimpinan, dan kedisiplinan diri.' }}
                                    </p>
                                </div>
                                <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                                    <span>{{ $ekskul->schedule ?: 'Sabtu Pagi' }}</span>
                                    <span class="font-bold text-blue-900">Aktif</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 8. GALERI DOKUMENTASI KEGIATAN -->
    @if($settings->enable_gallery && $galleries->isNotEmpty())
        <section class="py-16 bg-white border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                    <div>
                        <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Dokumentasi Sekolah</span>
                        <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Galeri Foto & Aktivitas</h2>
                    </div>
                    <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-blue-900 hover:text-blue-700 group">
                        <span>Lihat Semua Galeri</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3.5">
                    @foreach($galleries->take(6) as $item)
                        <a href="{{ route('gallery.index') }}" class="aspect-square rounded-xl overflow-hidden bg-slate-100 relative group block shadow-xs hover:shadow-lg transition-all duration-200">
                            <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-2.5">
                                <span class="text-[10px] font-bold text-white line-clamp-2 leading-tight">{{ $item->title }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 9. TESTIMONI ALUMNI & SISWA -->
    @if($settings->enable_testimonials && $testimonials->isNotEmpty())
        <section class="py-16 bg-[#F8FAFC] border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-10">
                    <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Kisah Sukses</span>
                    <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Apa Kata Alumni & Orang Tua</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($testimonials->take(3) as $testi)
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-lg transition-all duration-200 flex flex-col justify-between">
                            <div>
                                <div class="flex text-amber-400 gap-1 mb-2.5 text-xs">
                                    @for($s = 0; $s < ($testi->rating ?: 5); $s++)
                                        ★
                                    @endfor
                                </div>
                                <p class="text-xs sm:text-sm text-slate-600 italic leading-relaxed">
                                    "{{ $testi->content }}"
                                </p>
                            </div>
                            <div class="mt-5 pt-3.5 border-t border-slate-100 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-900 font-bold flex items-center justify-center text-xs shrink-0">
                                    {{ substr($testi->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-display font-bold text-xs sm:text-sm text-slate-900">{{ $testi->name }}</h4>
                                    <span class="text-[10px] text-slate-400 block">{{ $testi->role ?: 'Alumni Berprestasi' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 10. FAQ ACCORDION -->
    @if($settings->enable_faq && $faqs->isNotEmpty())
        <section class="py-16 bg-white border-t border-slate-100">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Bantuan & Informasi</span>
                    <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pertanyaan yang Sering Diajukan</h2>
                </div>

                <div class="space-y-3">
                    @foreach($faqs as $faq)
                        <div x-data="{ open: false }" class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50/50 transition">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full px-5 py-3.5 text-left flex items-center justify-between gap-4 font-display font-bold text-sm text-slate-900 transition hover:bg-slate-100/60 focus:outline-none">
                                <span>{{ $faq->question }}</span>
                                <svg class="w-4 h-4 text-slate-500 transition-transform duration-200 shrink-0" :class="open ? 'rotate-180 text-blue-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open"
                                 x-cloak
                                 class="px-5 pb-4 pt-1 text-xs text-slate-600 leading-relaxed border-t border-slate-200/60">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 11. HIGH-CONVERSION PPDB CALL TO ACTION BANNER -->
    @if($settings->ppdb_is_active)
        <section class="py-14 bg-gradient-to-r from-[#0B1528] via-[#102447] to-[#0A1B3B] text-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-900/80 border border-sky-400/40 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    <span>Penerimaan Peserta Didik Baru (PPDB) {{ $settings->ppdb_academic_year }}</span>
                </span>
                <h2 class="font-display text-2xl sm:text-4xl font-black tracking-tight mb-3 text-white">
                    Siap Menjadi Bagian dari Prestasi {{ $settings->school_name }}?
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto mb-6 font-normal leading-relaxed">
                    Daftarkan putra-putri Anda sekarang juga melalui portal PPDB daring kami secara cepat, mudah, dan transparan.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('ppdb.index') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-slate-950 font-bold text-xs sm:text-sm shadow-lg shadow-amber-500/20 transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        <span>Isi Formulir Pendaftaran Sekarang</span>
                    </a>
                    @if($settings->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp) }}?text={{ urlencode('Halo Admin PPDB ' . $settings->school_name . ', saya ingin konsultasi mengenai pendaftaran siswa baru.') }}" target="_blank" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm shadow-md transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Konsultasi via WhatsApp</span>
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif

@endsection
