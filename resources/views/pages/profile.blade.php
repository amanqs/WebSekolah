@extends('layouts.app')

@section('title', $page->title . ' - ' . $settings->school_name)
@section('meta_description', $page->meta_description)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden text-center">
        @if($page->banner_image)
            @php
                $bannerUrl = (str_starts_with($page->banner_image, 'http://') || str_starts_with($page->banner_image, 'https://')) ? $page->banner_image : asset('storage/' . $page->banner_image);
            @endphp
            <img src="{{ $bannerUrl }}" alt="{{ $page->title }}" class="absolute inset-0 w-full h-full object-cover opacity-20 pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B1528] via-[#0B1528]/80 to-transparent"></div>
        @else
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
            <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>
        @endif

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <div class="flex items-center justify-center gap-2 text-xs font-semibold text-slate-400 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                <span>/</span>
                <span class="text-amber-400 font-bold">Profil Sekolah</span>
            </div>
            <span class="inline-block px-3.5 py-1 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                Informasi Kelembagaan
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white mb-2.5">
                {{ $page->title }}
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal">
                Mengenal lebih dekat identitas, nilai luhur, dan komitmen mutu di {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <!-- Content Body -->
    <div class="py-12 sm:py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

                <!-- Main Content Column -->
                <article class="lg:col-span-8 bg-white rounded-2xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
                    <div class="prose prose-slate prose-base sm:prose-lg max-w-none prose-headings:font-display prose-headings:font-bold prose-headings:text-slate-900 prose-a:text-blue-900 hover:prose-a:underline prose-img:rounded-2xl prose-img:shadow-sm">
                        {!! $page->content !!}
                    </div>

                    <!-- Article Share Footer -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Bagikan Halaman Ini:</span>
                        <div class="flex items-center gap-2">
                            <a href="https://wa.me/?text={{ urlencode($page->title . ' - ' . url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-bold hover:bg-emerald-100 transition flex items-center gap-1.5 border border-emerald-200">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12.031 2C6.516 2 2.031 6.484 2.031 12c0 1.93.548 3.734 1.498 5.267L2 22l4.898-1.502c1.48.887 3.208 1.502 5.133 1.502 5.516 0 10-4.484 10-10s-4.484-10-10-10zm0 18.258c-1.636 0-3.15-.47-4.444-1.28l-.318-.2-2.902.89.897-2.83-.207-.33A8.204 8.204 0 013.78 12c0-4.55 3.7-8.25 8.25-8.25 4.552 0 8.25 3.7 8.25 8.25 0 4.55-3.698 8.258-8.25 8.258zm4.524-6.18c-.248-.124-1.464-.723-1.691-.806-.228-.083-.393-.124-.559.124-.165.248-.642.806-.787.971-.144.165-.29.186-.537.062-.248-.124-1.047-.386-1.995-1.232-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.015-.382.109-.505.111-.112.248-.29.372-.435.124-.145.166-.248.248-.414.083-.166.042-.311-.02-.435-.063-.124-.559-1.348-.767-1.846-.202-.486-.407-.42-.559-.428l-.476-.008c-.165 0-.435.062-.663.311-.228.248-.87 0.85-.87 2.073 0 1.223.89 2.406 1.014 2.572.124.165 1.752 2.675 4.244 3.751.593.256 1.056.409 1.417.524.595.189 1.137.162 1.565.098.478-.072 1.464-.599 1.671-1.178.207-.579.207-1.076.145-1.178-.062-.104-.228-.166-.476-.29z"/></svg>
                                <span>WhatsApp</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-blue-50 text-blue-800 text-xs font-bold hover:bg-blue-100 transition flex items-center gap-1.5 border border-blue-200">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                <span>Facebook</span>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Sidebar (span 4) -->
                <aside class="lg:col-span-4 space-y-6">
                    <!-- Navigation Pages Menu -->
                    @if(isset($otherPages) && $otherPages->isNotEmpty())
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                            <h3 class="font-display font-bold text-sm text-slate-900 mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-900"></span>
                                <span>Menu Informasi Lainnya</span>
                            </h3>
                            <nav class="space-y-1.5">
                                <a href="{{ route('pages.show', $page->slug) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-blue-900 text-white font-bold text-xs shadow-sm">
                                    <span>{{ $page->title }}</span>
                                    <span class="text-xs bg-white/20 text-white rounded-full w-4 h-4 flex items-center justify-center font-bold">✓</span>
                                </a>
                                @foreach($otherPages as $other)
                                    <a href="{{ route('pages.show', $other->slug) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-700 hover:text-blue-900 hover:bg-slate-50 font-semibold text-xs transition group">
                                        <span>{{ $other->title }}</span>
                                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:translate-x-1 group-hover:text-blue-900 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    @endif

                    <!-- PPDB Info Widget -->
                    @if($settings->ppdb_is_active)
                        <div class="bg-gradient-to-br from-[#0B1528] to-[#102447] text-white rounded-2xl p-6 shadow-md border border-slate-800 space-y-3">
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-blue-900 text-amber-300 text-[10px] font-bold uppercase tracking-wider">
                                PPDB {{ $settings->ppdb_academic_year }}
                            </span>
                            <h4 class="font-display text-base font-bold text-white">Pendaftaran Siswa Baru</h4>
                            <p class="text-xs text-slate-300 leading-relaxed font-normal">
                                Daftarkan putra-putri Anda melalui portal PPDB daring kami secara mudah dan transparan.
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('ppdb.index') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm transition">
                                    <span>Daftar Sekarang</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    @endif
                </aside>

            </div>
        </div>
    </div>
@endsection
