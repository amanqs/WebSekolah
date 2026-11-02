@extends('layouts.app')

@section('title', 'Direktori Guru & Tenaga Kependidikan - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Civitas Akademika</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Direktori Guru & Tenaga Kependidikan
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Mengenal tenaga pendidik dan kependidikan profesional yang berdedikasi membina generasi masa depan di {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <div x-data="{ modalOpen: false, activeTeacher: null }" class="py-12 sm:py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-sm mb-10 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="{{ route('teachers.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('type') ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        Semua Civitas
                    </a>
                    <a href="{{ route('teachers.index', ['type' => 'guru']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold transition {{ request('type') === 'guru' ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        <svg class="w-3.5 h-3.5 {{ request('type') === 'guru' ? 'text-white' : 'text-blue-900' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                        <span>Tenaga Pendidik (Guru)</span>
                    </a>
                    <a href="{{ route('teachers.index', ['type' => 'tendik']) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold transition {{ request('type') === 'tendik' ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-blue-900 border border-slate-200' }}">
                        <svg class="w-3.5 h-3.5 {{ request('type') === 'tendik' ? 'text-white' : 'text-blue-900' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Tenaga Kependidikan (TU)</span>
                    </a>
                </div>

                <form action="{{ route('teachers.index') }}" method="GET" class="w-full md:w-72">
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau mapel..." class="w-full pl-3.5 pr-10 py-2 rounded-xl border border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 text-slate-900 bg-slate-50/50">
                        <button type="submit" aria-label="Cari guru" class="absolute right-3 top-2 text-slate-400 hover:text-blue-900 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Teachers Grid -->
            @if($teachers->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-base">Tidak ada data pegawai yang ditemukan.</h3>
                    <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($teachers as $teacher)
                        <div @click="activeTeacher = {{ json_encode([
                                'name' => $teacher->name,
                                'photo' => $teacher->photo_url,
                                'type' => $teacher->type,
                                'position' => $teacher->position,
                                'subject' => $teacher->subject,
                                'nip' => $teacher->nip,
                                'nuptk' => $teacher->nuptk,
                                'email' => $teacher->email,
                                'phone' => $teacher->phone,
                                'bio' => $teacher->bio,
                            ]) }}; modalOpen = true;"
                             class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col items-center text-center p-6 group cursor-pointer hover:-translate-y-1">
                            <div class="w-28 h-28 rounded-full overflow-hidden mb-4 border-2 border-slate-100 shadow-sm group-hover:scale-105 transition-transform duration-300 relative bg-slate-100">
                                <img src="{{ $teacher->photo_url }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                            </div>

                            <span class="inline-block mb-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $teacher->type === 'guru' ? 'bg-blue-50 text-blue-900' : 'bg-slate-100 text-slate-700' }}">
                                {{ $teacher->position }}
                            </span>

                            <h3 class="font-display font-bold text-sm sm:text-base text-slate-900 group-hover:text-blue-900 transition leading-snug">
                                {{ $teacher->name }}
                            </h3>

                            @if($teacher->subject)
                                <p class="text-xs text-slate-500 mt-1 font-medium">Mapel: {{ $teacher->subject }}</p>
                            @endif

                            @if($teacher->nip)
                                <p class="text-[11px] text-slate-400 font-mono mt-0.5">NIP: {{ $teacher->nip }}</p>
                            @endif

                            <div class="mt-4 pt-3 border-t border-slate-100 w-full flex items-center justify-center gap-1.5 text-xs font-bold text-blue-900">
                                <span>Lihat Profil</span>
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>

        <!-- Teacher Detail Modal -->
        <div x-show="modalOpen"
             x-cloak
             @keydown.escape.window="modalOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm p-4">
            <div @click.away="modalOpen = false"
                 class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl relative p-6 border border-slate-200">
                <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 hover:text-slate-900 transition" aria-label="Tutup modal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div x-show="activeTeacher" class="text-center pt-2">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 border-2 border-slate-200 shadow-sm bg-slate-100">
                        <img :src="activeTeacher?.photo" :alt="activeTeacher?.name" class="w-full h-full object-cover">
                    </div>

                    <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-blue-50 text-blue-900 mb-2" x-text="activeTeacher?.position"></span>
                    <h3 class="font-display font-black text-lg text-slate-900" x-text="activeTeacher?.name"></h3>
                    <p class="text-xs text-slate-500 mt-1" x-show="activeTeacher?.subject" x-text="'Mata Pelajaran: ' + activeTeacher?.subject"></p>

                    <div class="mt-6 border-t border-slate-100 pt-4 text-left space-y-2.5 text-xs text-slate-600">
                        <div class="flex justify-between py-1 border-b border-slate-50" x-show="activeTeacher?.nip">
                            <span class="text-slate-400">NIP:</span>
                            <span class="font-mono font-bold text-slate-800" x-text="activeTeacher?.nip"></span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-50" x-show="activeTeacher?.nuptk">
                            <span class="text-slate-400">NUPTK:</span>
                            <span class="font-mono font-bold text-slate-800" x-text="activeTeacher?.nuptk"></span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-50" x-show="activeTeacher?.email">
                            <span class="text-slate-400">Email:</span>
                            <span class="font-semibold text-blue-900" x-text="activeTeacher?.email"></span>
                        </div>
                        <div class="pt-2" x-show="activeTeacher?.bio">
                            <span class="text-slate-400 block mb-1">Profil Singkat:</span>
                            <p class="text-slate-700 leading-relaxed italic bg-slate-50 p-3 rounded-xl border border-slate-150" x-text="activeTeacher?.bio"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
