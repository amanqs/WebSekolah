@extends('layouts.app')

@section('title', 'Katalog Buku Nonteks Pelajaran & Literasi - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-violet-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-sky-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/70 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3 shadow-xs">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                <span>Pojok Baca & Gerakan Literasi Sekolah</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Buku Nonteks Pelajaran
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto font-normal mt-3 leading-relaxed">
                Koleksi buku pengayaan pengetahuan, pembentukan kepribadian, karya sastra, serta referensi literasi digital untuk memperluas wawasan siswa dan guru {{ $settings->school_name }}.
            </p>

            <!-- Quick Stats Badges -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-xs">
                <div class="px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Koleksi: <strong class="text-white">{{ $books->total() }} Judul Buku</strong></span>
                </div>
                <div class="px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span>Kategori: <strong class="text-white">{{ $categories->count() }} Bidang</strong></span>
                </div>
                <div class="px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Total Unduhan: <strong class="text-white">{{ number_format($totalDownloads) }}x</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="py-12 sm:py-16 bg-[#F8FAFC] min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm mb-10 space-y-4">
                <form action="{{ route('buku-non-teks.index') }}" method="GET" class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">

                    <!-- Category Pills -->
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('buku-non-teks.index', array_filter(['q' => request('q')])) }}"
                           class="px-3.5 py-2 rounded-xl text-xs font-bold transition {{ !request('category') ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('buku-non-teks.index', array_filter(['category' => $cat, 'q' => request('q')])) }}"
                               class="px-3.5 py-2 rounded-xl text-xs font-bold transition {{ request('category') === $cat ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Search Input -->
                    <div class="flex items-center gap-2 shrink-0">
                        @if($categories->count() > 0 && request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <div class="relative w-full md:w-80">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, ISBN..."
                                   class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 bg-slate-50/50">
                            <button type="submit" aria-label="Cari Buku" class="absolute right-3 top-2.5 text-slate-400 hover:text-blue-900 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </div>

                        @if(request()->hasAny(['category', 'q']))
                            <a href="{{ route('buku-non-teks.index') }}" title="Reset Filter" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition shrink-0" aria-label="Reset filter">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Books Grid -->
            @if($books->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-violet-50 flex items-center justify-center text-violet-600 shadow-sm border border-violet-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="font-display font-bold text-slate-900 text-lg">Tidak ada buku nonteks yang ditemukan</h3>
                    <p class="text-xs text-slate-400 max-w-md mx-auto mt-1.5 leading-relaxed">
                        Koleksi buku belum tersedia atau tidak cocok dengan kriteria pencarian Anda. Silakan coba kata kunci lain.
                    </p>
                    <a href="{{ route('buku-non-teks.index') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-blue-900 text-white text-xs font-bold shadow-sm hover:bg-blue-800 transition">
                        <span>Lihat Semua Buku</span>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($books as $book)
                        <div x-data="{ openSynopsis: false }"
                             class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden group">

                            <!-- Book Cover Presentation -->
                            <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden">
                                <img src="{{ $book->cover_url }}"
                                     alt="{{ $book->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-60"></div>

                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-extrabold bg-blue-900/90 text-white backdrop-blur-md shadow-xs border border-white/20">
                                        {{ $book->category }}
                                    </span>
                                </div>

                                <!-- Year & Size Badge -->
                                <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-[11px] text-white/90 font-medium">
                                    @if($book->published_year)
                                        <span class="flex items-center gap-1">
                                            <span>Tahun {{ $book->published_year }}</span>
                                        </span>
                                    @endif
                                    <span class="bg-black/40 backdrop-blur-md px-2 py-0.5 rounded text-[10px] font-bold text-amber-300">
                                        {{ $book->formatted_file_size }}
                                    </span>
                                </div>
                            </div>

                            <!-- Book Details Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-display font-extrabold text-sm sm:text-base text-slate-900 group-hover:text-blue-900 transition line-clamp-2 leading-snug">
                                        {{ $book->title }}
                                    </h3>

                                    <div class="mt-2 space-y-1 text-xs text-slate-500">
                                        @if($book->author)
                                            <p class="flex items-center gap-1.5 truncate">
                                                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                <span class="truncate">Penulis: <strong class="text-slate-700 font-semibold">{{ $book->author }}</strong></span>
                                            </p>
                                        @endif
                                        @if($book->publisher)
                                            <p class="flex items-center gap-1.5 truncate">
                                                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                <span class="truncate">{{ $book->publisher }}</span>
                                            </p>
                                        @endif
                                        @if($book->isbn)
                                            <p class="text-[10px] text-slate-400 font-mono">ISBN: {{ $book->isbn }}</p>
                                        @endif
                                    </div>

                                    <!-- Synopsis Excerpt -->
                                    @if($book->synopsis)
                                        <div class="mt-3">
                                            <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                                {{ $book->synopsis }}
                                            </p>
                                            <button @click="openSynopsis = true" type="button" class="text-[11px] font-bold text-blue-900 hover:text-blue-700 underline mt-1">
                                                Baca Sinopsis Lengkap
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons & Meta -->
                                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                                    <div class="text-[11px] text-slate-400">
                                        <span>Diunduh {{ $book->download_count }}x</span>
                                    </div>

                                    <a href="{{ route('buku-non-teks.download', $book->slug) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-900 hover:bg-blue-800 text-white text-xs font-bold shadow-xs hover:shadow-md transition">
                                        <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>Unduh PDF</span>
                                    </a>
                                </div>

                            </div>

                            <!-- Modal Sinopsis Lengkap -->
                            @if($book->synopsis)
                                <div x-show="openSynopsis"
                                     x-cloak
                                     @keydown.escape.window="openSynopsis = false"
                                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
                                    <div @click.away="openSynopsis = false"
                                         x-transition
                                         class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 text-left relative max-h-[85vh] overflow-y-auto">
                                        <div class="flex items-start justify-between gap-4 pb-3 border-b border-slate-100">
                                            <div>
                                                <span class="px-2.5 py-0.5 rounded text-[10px] font-extrabold bg-blue-50 text-blue-900 border border-blue-200">
                                                    {{ $book->category }}
                                                </span>
                                                <h4 class="font-display font-extrabold text-slate-900 text-base sm:text-lg mt-1">
                                                    {{ $book->title }}
                                                </h4>
                                                <p class="text-xs text-slate-500 mt-0.5">Penulis: {{ $book->author ?? 'Tim Literasi Sekolah' }} • Penerbit: {{ $book->publisher ?? '-' }}</p>
                                            </div>
                                            <button @click="openSynopsis = false" class="p-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>

                                        <div class="py-4">
                                            <h5 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Sinopsis Buku</h5>
                                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                                {{ $book->synopsis }}
                                            </p>
                                        </div>

                                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                            <span class="text-xs text-slate-400 font-medium">Ukuran: {{ $book->formatted_file_size }}</span>
                                            <a href="{{ route('buku-non-teks.download', $book->slug) }}"
                                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-900 hover:bg-blue-800 text-white text-xs font-bold transition">
                                                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                <span>Unduh Buku Lengkap</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($books->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $books->links() }}
                    </div>
                @endif
            @endif

            <!-- Literacy Notice Box -->
            <div class="mt-12 bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold shrink-0 border border-amber-200">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h4 class="font-display font-extrabold text-slate-900 text-sm sm:text-base">Tentang Buku Nonteks Pelajaran</h4>
                        <p class="text-xs text-slate-600 mt-1 max-w-2xl leading-relaxed">
                            Buku nonteks pelajaran adalah buku pengayaan yang memuat materi untuk memperluas, memperdalam, dan menunjang proses pembelajaran serta pembentukan budi pekerti luhur peserta didik di {{ $settings->school_name }}. Seluruh buku tersedia bebas bagi civitas akademika untuk tujuan edukasi.
                        </p>
                    </div>
                </div>
                <a href="{{ route('downloads.index') }}" class="shrink-0 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                    Lihat Dokumen Lainnya
                </a>
            </div>

        </div>
    </div>
@endsection

