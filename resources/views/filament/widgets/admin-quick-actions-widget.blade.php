<x-filament-widgets::widget>
    @php
        $stats = $this->getViewData();
    @endphp

    <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-xs">
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-950 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs">
                    ⚡
                </span>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Pusat Aksi Cepat Administrator</h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Pintasan praktis untuk mengelola data operasional dan konten harian sekolah</p>
                </div>
            </div>

            <a href="{{ route('home') }}" target="_blank"
               class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-xl transition">
                <span>Kunjungi Website Publik</span>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            <!-- 1. Tulis Berita -->
            <a href="{{ url('/admin/posts/create') }}"
               class="group p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 hover:bg-blue-50/60 dark:hover:bg-blue-950/40 hover:border-blue-300 dark:hover:border-blue-700 transition flex flex-col items-center text-center">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shadow-2xs">
                    ✍️
                </div>
                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2 group-hover:text-blue-600 dark:group-hover:text-blue-400">Tulis Berita</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ $stats['total_posts'] }} Artikel</span>
            </a>

            <!-- 2. Verifikasi PPDB -->
            <a href="{{ url('/admin/ppdb-registrations') }}"
               class="group p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 hover:bg-amber-50/60 dark:hover:bg-amber-950/40 hover:border-amber-300 dark:hover:border-amber-700 transition flex flex-col items-center text-center relative">
                @if($stats['pending_ppdb_count'] > 0)
                    <span class="absolute top-2 right-2 px-1.5 py-0.5 rounded-full bg-amber-500 text-white font-black text-[9px] animate-pulse">
                        {{ $stats['pending_ppdb_count'] }}
                    </span>
                @endif
                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/60 text-amber-600 dark:text-amber-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shadow-2xs">
                    🎓
                </div>
                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2 group-hover:text-amber-600 dark:group-hover:text-amber-400">Pendaftar PPDB</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ $stats['pending_ppdb_count'] > 0 ? $stats['pending_ppdb_count'] . ' Butuh Verifikasi' : 'Semua Terverifikasi' }}</span>
            </a>

            <!-- 3. Guru & Tendik -->
            <a href="{{ url('/admin/teachers') }}"
               class="group p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 hover:bg-emerald-50/60 dark:hover:bg-emerald-950/40 hover:border-emerald-300 dark:hover:border-emerald-700 transition flex flex-col items-center text-center">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shadow-2xs">
                    👨‍🏫
                </div>
                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Guru & Tendik</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ $stats['total_teachers'] }} Pengajar</span>
            </a>

            <!-- 4. Upload LPJ -->
            <a href="{{ url('/admin/lpjs/create') }}"
               class="group p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 hover:bg-purple-50/60 dark:hover:bg-purple-950/40 hover:border-purple-300 dark:hover:border-purple-700 transition flex flex-col items-center text-center">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/60 text-purple-600 dark:text-purple-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shadow-2xs">
                    📑
                </div>
                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2 group-hover:text-purple-600 dark:group-hover:text-purple-400">Upload LPJ</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ $stats['total_lpj'] }} Laporan</span>
            </a>

            <!-- 5. Upload E-Book Nonteks -->
            <a href="{{ url('/admin/buku-non-teks/create') }}"
               class="group p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 hover:bg-sky-50/60 dark:hover:bg-sky-950/40 hover:border-sky-300 dark:hover:border-sky-700 transition flex flex-col items-center text-center">
                <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-900/60 text-sky-600 dark:text-sky-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shadow-2xs">
                    📚
                </div>
                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2 group-hover:text-sky-600 dark:group-hover:text-sky-400">Buku Non-Teks</span>
                <span class="text-[10px] text-slate-400 mt-0.5">{{ $stats['total_buku'] }} Buku Terunggah</span>
            </a>

            <!-- 6. Pengaturan Sekolah -->
            <a href="{{ url('/admin/manage-school-settings') }}"
               class="group p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-800/40 hover:bg-slate-100 dark:hover:bg-slate-700/60 hover:border-slate-300 dark:hover:border-slate-600 transition flex flex-col items-center text-center">
                <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shadow-2xs">
                    ⚙️
                </div>
                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-2 group-hover:text-slate-900 dark:group-hover:text-white">Pengaturan Web</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Identitas & Warna</span>
            </a>
        </div>
    </div>
</x-filament-widgets::widget>
