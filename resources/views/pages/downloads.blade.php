@extends('layouts.app')

@section('title', 'Pusat Unduhan & Dokumen - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Pustaka Digital</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Pusat Unduhan Dokumen Resmi
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Unduh formulir administrasi, silabus kurikulum, surat edaran, dan buku panduan akademik resmi {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <div class="py-12 sm:py-16 bg-[#F8FAFC] min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-sm mb-10 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="{{ route('downloads.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('category') ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        Semua Dokumen
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('downloads.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('category') === $cat ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('downloads.index') }}" method="GET" class="w-full md:w-72">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul berkas..." class="w-full pl-3.5 pr-10 py-2 rounded-xl border border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 bg-slate-50/50">
                        <button type="submit" aria-label="Cari berkas" class="absolute right-3 top-2 text-slate-400 hover:text-blue-900 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-center gap-3">
                    <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Downloads List -->
            @if($downloads->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-900 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-base">Tidak ada berkas unduhan yang ditemukan.</h3>
                    <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="divide-y divide-slate-100">
                        @foreach($downloads as $file)
                            <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/60 transition duration-150">
                                <div class="flex items-start gap-3.5">
                                    <div class="w-11 h-11 rounded-xl bg-red-50 text-red-600 flex flex-col items-center justify-center font-bold text-xs shrink-0 border border-red-100 shadow-xs">
                                        <svg class="w-4 h-4 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span class="text-[8px] uppercase tracking-wider font-extrabold">PDF</span>
                                    </div>
                                    <div>
                                        <h3 class="font-display font-bold text-sm sm:text-base text-slate-900 leading-snug">{{ $file->title }}</h3>
                                        <div class="flex flex-wrap items-center gap-2 text-xs text-slate-400 mt-1">
                                            <span class="px-2 py-0.5 rounded text-[10px] bg-blue-50 text-blue-900 font-bold">{{ $file->category }}</span>
                                            <span>•</span>
                                            <span>Ukuran: <strong class="text-slate-600">{{ $file->formatted_file_size }}</strong></span>
                                            <span>•</span>
                                            <span>Diunduh {{ $file->download_count }}x</span>
                                            <span>•</span>
                                            <span>{{ $file->created_at->format('d M Y') }}</span>
                                        </div>
                                        @if($file->description)
                                            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">{{ $file->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="shrink-0 sm:self-center">
                                    <a href="{{ route('downloads.file', $file->slug) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-blue-900 hover:bg-blue-800 text-white text-xs font-bold shadow-sm transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>Unduh Berkas</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8">
                    {{ $downloads->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
