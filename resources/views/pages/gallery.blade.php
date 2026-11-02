@extends('layouts.app')

@section('title', 'Galeri Foto & Video - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Dokumentasi Kegiatan</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Galeri Foto & Video Dokumentasi
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Koleksi memori visual, dokumentasi lomba, kegiatan akademik, dan ekstrakurikuler di {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <div x-data="{ lightboxOpen: false, activeImg: '', activeTitle: '' }" class="py-12 sm:py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-sm mb-10 flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('gallery.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('type') && !request('album') ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        Semua Media
                    </a>
                    <a href="{{ route('gallery.index', ['type' => 'photo']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold transition {{ request('type') === 'photo' ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Foto Saja</span>
                    </a>
                    <a href="{{ route('gallery.index', ['type' => 'video']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold transition {{ request('type') === 'video' ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Video Saja</span>
                    </a>
                </div>

                @if($albums->isNotEmpty())
                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-slate-500 font-bold">Album:</span>
                        <select onchange="window.location.href = this.value;" class="rounded-xl border-slate-200 text-xs text-slate-700 py-1.5 pl-3 pr-8 bg-slate-50">
                            <option value="{{ route('gallery.index') }}">Semua Album</option>
                            @foreach($albums as $album)
                                <option value="{{ route('gallery.index', ['album' => $album]) }}" {{ request('album') === $album ? 'selected' : '' }}>
                                    {{ $album }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <!-- Galleries Grid -->
            @if($galleries->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-base">Tidak ada dokumentasi yang ditemukan.</h3>
                    <p class="text-xs text-slate-400 mt-1">Coba pilih album atau filter media yang lain.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galleries as $item)
                        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col group hover:-translate-y-1">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @if($item->type === 'photo') @click="lightboxOpen = true; activeImg = '{{ $item->thumbnail_url }}'; activeTitle = '{{ addslashes($item->title) }}'" @endif>
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @if($item->type === 'video' && $item->youtube_url)
                                    <a href="{{ $item->youtube_url }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-slate-950/40 group-hover:bg-slate-950/20 transition">
                                        <div class="w-12 h-12 rounded-xl bg-red-600 text-white flex items-center justify-center text-lg shadow-xl pl-0.5 group-hover:scale-110 transition">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </a>
                                @endif
                                <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-lg text-[10px] font-bold {{ $item->type === 'video' ? 'bg-red-600' : 'bg-blue-900' }} text-white shadow-sm flex items-center gap-1">
                                    @if($item->type === 'video')
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <span>Video</span>
                                    @else
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span>Foto</span>
                                    @endif
                                </span>
                            </div>
                            <div class="p-5">
                                <span class="text-[10px] font-bold text-blue-900 block mb-1 uppercase tracking-wider">{{ $item->album }}</span>
                                <h3 class="font-display font-bold text-sm sm:text-base text-slate-900 leading-snug group-hover:text-blue-900 transition">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-xs text-slate-500 mt-1.5 line-clamp-2 leading-relaxed">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>

        <!-- Interactive Lightbox Modal -->
        <div x-show="lightboxOpen"
             x-cloak
             @keydown.escape.window="lightboxOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/90 backdrop-blur-sm p-4">
            <button @click="lightboxOpen = false" type="button" class="absolute top-6 right-6 text-white/80 hover:text-white p-2 rounded-full bg-white/10 hover:bg-white/20 transition" aria-label="Tutup preview">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div @click.away="lightboxOpen = false" class="max-w-4xl max-h-[90vh] flex flex-col items-center">
                <img :src="activeImg" class="max-h-[80vh] w-auto rounded-2xl shadow-2xl object-contain border border-slate-700">
                <p x-text="activeTitle" class="text-white text-sm mt-3 font-bold text-center"></p>
            </div>
        </div>
    </div>
@endsection
