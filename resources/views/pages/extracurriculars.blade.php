@extends('layouts.app')

@section('title', 'Ekstrakurikuler & Pengembangan Bakat - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Minat & Bakat Siswa</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Ekstrakurikuler Pilihan & Prestasi
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Wadah eksplorasi potensi kepemimpinan, riset ilmiah, seni budaya, dan olahraga di {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <div x-data="{ modalOpen: false, activeItem: null }" class="py-12 sm:py-16 bg-[#F8FAFC] min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search & Filter Bar -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-sm mb-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-500 font-medium">
                    Menampilkan <span class="font-bold text-blue-900">{{ $extracurriculars->total() }}</span> cabang ekstrakurikuler aktif.
                </p>

                <form action="{{ route('extracurriculars.index') }}" method="GET" class="w-full sm:w-72">
                    <div class="relative">
                        <input type="text"
                               name="q"
                               value="{{ request('q') }}"
                               placeholder="Cari ekskul atau pembina..."
                               class="w-full pl-3.5 pr-10 py-2 rounded-xl border border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 text-slate-900 bg-slate-50/50">
                        <button type="submit" aria-label="Cari ekstrakurikuler" class="absolute right-3 top-2 text-slate-400 hover:text-blue-900 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Extracurriculars Grid -->
            @if($extracurriculars->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-base">Tidak ada ekstrakurikuler yang sesuai pencarian.</h3>
                    <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($extracurriculars as $ekskul)
                        <div @click="activeItem = {{ json_encode([
                                'name' => $ekskul->name,
                                'image' => $ekskul->image_url,
                                'category' => $ekskul->category,
                                'coach' => $ekskul->coach_name,
                                'schedule' => $ekskul->schedule,
                                'description' => $ekskul->description,
                            ]) }}; modalOpen = true;"
                             class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col group cursor-pointer hover:-translate-y-1">
                            <div class="relative aspect-video overflow-hidden bg-slate-100">
                                <img src="{{ $ekskul->image_url }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @if($ekskul->category)
                                    <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-slate-900/80 text-white backdrop-blur-sm">
                                        {{ $ekskul->category }}
                                    </span>
                                @endif
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-display font-extrabold text-base text-slate-900 group-hover:text-blue-900 transition line-clamp-1">
                                        {{ $ekskul->name }}
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1.5 line-clamp-2 leading-relaxed">
                                        {{ $ekskul->description ?: 'Wadah pengembangan potensi diri, kebersamaan, dan kepemimpinan.' }}
                                    </p>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-500">
                                    @if($ekskul->coach_name)
                                        <div class="flex items-center gap-1.5 truncate">
                                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            <span class="truncate">Pembina: {{ $ekskul->coach_name }}</span>
                                        </div>
                                    @endif
                                    @if($ekskul->schedule)
                                        <div class="flex items-center gap-1.5 text-slate-400">
                                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span>Jadwal: {{ $ekskul->schedule }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $extracurriculars->links() }}
                </div>
            @endif
        </div>

        <!-- Detail Modal -->
        <div x-show="modalOpen"
             x-cloak
             @keydown.escape.window="modalOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm p-4">
            <div @click.away="modalOpen = false"
                 class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl relative border border-slate-200">
                <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-slate-900/60 text-white flex items-center justify-center hover:bg-slate-900 transition" aria-label="Tutup">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="aspect-video bg-slate-100 overflow-hidden relative" x-show="activeItem?.image">
                    <img :src="activeItem?.image" :alt="activeItem?.name" class="w-full h-full object-cover">
                </div>

                <div class="p-6">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-900" x-text="activeItem?.category || 'Ekstrakurikuler'"></span>
                    <h3 class="font-display font-black text-xl text-slate-900 mt-2" x-text="activeItem?.name"></h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed" x-text="activeItem?.description"></p>

                    <div class="mt-6 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                        <div class="flex items-center gap-2" x-show="activeItem?.coach">
                            <strong class="text-slate-800">Pembina / Pelatih:</strong>
                            <span x-text="activeItem?.coach"></span>
                        </div>
                        <div class="flex items-center gap-2" x-show="activeItem?.schedule">
                            <strong class="text-slate-800">Waktu Latihan:</strong>
                            <span x-text="activeItem?.schedule"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
