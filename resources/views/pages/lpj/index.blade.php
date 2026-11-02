@extends('layouts.app')

@section('title', 'Laporan Pertanggungjawaban (LPJ) - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-emerald-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/70 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3 shadow-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Transparansi & Akuntabilitas Publik</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Laporan Pertanggungjawaban (LPJ)
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto font-normal mt-3 leading-relaxed">
                Dokumentasi resmi laporan pertanggungjawaban pengelolaan Dana BOS (Bantuan Operasional Sekolah), Dana Komite, serta anggaran kegiatan siswa di lingkungan {{ $settings->school_name }}.
            </p>

            <!-- Quick Transparency Summary Badges -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-xs">
                <div class="px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Total Laporan: <strong class="text-white">{{ $lpjs->total() }} Dokumen</strong></span>
                </div>
                <div class="px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Tahun Anggaran Aktif: <strong class="text-white">{{ $fiscalYears->count() }} Periode</strong></span>
                </div>
                <div class="px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Total Diunduh: <strong class="text-white">{{ number_format($totalDownloads) }}x</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="py-12 sm:py-16 bg-[#F8FAFC] min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Filter & Search Panel -->
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm mb-8 space-y-4">
                <form action="{{ route('lpj.index') }}" method="GET" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">

                    <!-- Category Pills -->
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('lpj.index', array_filter(['fiscal_year' => request('fiscal_year'), 'q' => request('q')])) }}"
                           class="px-3.5 py-2 rounded-xl text-xs font-bold transition {{ !request('category') ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('lpj.index', array_filter(['category' => $cat, 'fiscal_year' => request('fiscal_year'), 'q' => request('q')])) }}"
                               class="px-3.5 py-2 rounded-xl text-xs font-bold transition {{ request('category') === $cat ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Year Dropdown & Search Bar -->
                    <div class="flex flex-col sm:flex-row items-center gap-2.5 shrink-0">
                        @if($categories->count() > 0 && request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <div class="w-full sm:w-44">
                            <select name="fiscal_year" onchange="this.form.submit()" class="w-full py-2 px-3 rounded-xl border border-slate-200 text-xs font-semibold focus:border-blue-900 focus:ring-blue-900 bg-slate-50/50 text-slate-700">
                                <option value="">Semua Tahun Anggaran</option>
                                @foreach($fiscalYears as $year)
                                    <option value="{{ $year }}" {{ request('fiscal_year') === $year ? 'selected' : '' }}>
                                        TA {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative w-full sm:w-64">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama LPJ..."
                                   class="w-full pl-3.5 pr-10 py-2 rounded-xl border border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 bg-slate-50/50">
                            <button type="submit" aria-label="Cari LPJ" class="absolute right-3 top-2.5 text-slate-400 hover:text-blue-900 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </div>

                        @if(request()->hasAny(['category', 'fiscal_year', 'q']))
                            <a href="{{ route('lpj.index') }}" title="Reset Filter" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition shrink-0" aria-label="Reset filter">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- LPJ Documents List -->
            @if($lpjs->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 shadow-sm border border-amber-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-display font-bold text-slate-900 text-lg">Tidak ada berkas LPJ yang ditemukan</h3>
                    <p class="text-xs text-slate-400 max-w-md mx-auto mt-1.5 leading-relaxed">
                        Dokumen LPJ belum diunggah atau tidak cocok dengan kriteria pencarian / filter yang dipilih. Silakan atur ulang kata kunci pencarian.
                    </p>
                    <a href="{{ route('lpj.index') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-blue-900 text-white text-xs font-bold shadow-sm hover:bg-blue-800 transition">
                        <span>Lihat Semua LPJ</span>
                    </a>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="divide-y divide-slate-100">
                        @foreach($lpjs as $lpj)
                            <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-5 hover:bg-slate-50/70 transition duration-150 group">
                                <div class="flex items-start gap-4 min-w-0">
                                    <!-- PDF Icon Badge -->
                                    <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex flex-col items-center justify-center font-bold text-xs shrink-0 border border-red-100 shadow-xs group-hover:scale-105 transition-transform duration-200">
                                        <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span class="text-[8px] uppercase tracking-wider font-extrabold">{{ $lpj->file_extension ?: 'PDF' }}</span>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                            @if($lpj->fiscal_year)
                                                <span class="px-2.5 py-0.5 rounded-full text-[10px] bg-amber-50 text-amber-800 font-extrabold border border-amber-200/60">
                                                    TA {{ $lpj->fiscal_year }}
                                                </span>
                                            @endif
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] bg-blue-50 text-blue-900 font-bold border border-blue-200/50">
                                                {{ $lpj->category }}
                                            </span>
                                        </div>

                                        <h3 class="font-display font-extrabold text-sm sm:text-base text-slate-900 group-hover:text-blue-900 transition leading-snug">
                                            {{ $lpj->title }}
                                        </h3>

                                        @if($lpj->description)
                                            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed line-clamp-2">
                                                {{ $lpj->description }}
                                            </p>
                                        @endif

                                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-400 mt-2.5">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7z"/></svg>
                                                <span>Ukuran: <strong class="text-slate-700 font-semibold">{{ $lpj->formatted_file_size }}</strong></span>
                                            </span>
                                            <span>•</span>
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                <span>Diunduh <strong class="text-slate-700 font-semibold">{{ $lpj->download_count }}x</strong></span>
                                            </span>
                                            <span>•</span>
                                            <span>Diunggah {{ $lpj->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="shrink-0 md:self-center pt-2 md:pt-0">
                                    <a href="{{ route('lpj.download', $lpj->slug) }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-800 text-white text-xs font-bold shadow-md shadow-blue-950/10 hover:shadow-lg transition-all duration-200">
                                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>Unduh LPJ</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                @if($lpjs->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $lpjs->links() }}
                    </div>
                @endif
            @endif

            <!-- Informational Notice Card -->
            <div class="mt-12 bg-blue-50/70 border border-blue-100 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-900 text-white flex items-center justify-center font-bold shrink-0">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-display font-bold text-slate-900 text-sm sm:text-base">Keterbukaan Informasi Publik Sekolah</h4>
                        <p class="text-xs text-slate-600 mt-1 max-w-2xl leading-relaxed">
                            Seluruh laporan pertanggungjawaban yang dipublikasikan telah diverifikasi oleh tim manajemen BOS dan Dewan Komite {{ $settings->school_name }}. Untuk permohonan salinan fisik atau audit resmi, silakan hubungi bagian tata usaha.
                        </p>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="shrink-0 px-4 py-2.5 rounded-xl bg-white hover:bg-slate-100 text-blue-950 font-bold text-xs border border-blue-200/80 shadow-xs transition">
                    Hubungi Tata Usaha
                </a>
            </div>

        </div>
    </div>
@endsection

