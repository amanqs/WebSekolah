<x-filament-widgets::widget>
    @php
        $stats = $this->getViewData();
    @endphp

    <x-filament::section icon="heroicon-o-bolt">
        <x-slot name="heading">
            Pusat Aksi Cepat Administrator
        </x-slot>

        <x-slot name="description">
            Pintasan praktis untuk mengelola operasional dan konten harian sekolah
        </x-slot>

        <x-slot name="headerEnd">
            <x-filament::button
                :href="route('home')"
                tag="a"
                target="_blank"
                color="gray"
                size="sm"
                icon="heroicon-m-arrow-top-right-on-square"
                icon-position="after"
            >
                Website Publik
            </x-filament::button>
        </x-slot>

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6 mt-2">
            <!-- 1. Tulis Berita -->
            <a href="{{ \App\Filament\Resources\PostResource::getUrl('create') }}"
               class="group flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-blue-50/70 dark:hover:bg-blue-950/40 hover:border-blue-400 dark:hover:border-blue-500 transition text-center">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    ✍️
                </div>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-2 group-hover:text-blue-600 dark:group-hover:text-blue-400">Tulis Berita</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">{{ $stats['total_posts'] }} Artikel</span>
            </a>

            <!-- 2. Pendaftar PPDB -->
            <a href="{{ \App\Filament\Resources\PpdbRegistrationResource::getUrl('index') }}"
               class="group flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-amber-50/70 dark:hover:bg-amber-950/40 hover:border-amber-400 dark:hover:border-amber-500 transition text-center relative">
                @if($stats['pending_ppdb_count'] > 0)
                    <span class="absolute top-2 right-2 px-1.5 py-0.5 rounded-full bg-amber-500 text-white font-black text-[9px] animate-pulse">
                        {{ $stats['pending_ppdb_count'] }}
                    </span>
                @endif
                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/60 text-amber-600 dark:text-amber-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    🎓
                </div>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-2 group-hover:text-amber-600 dark:group-hover:text-amber-400">Pendaftar PPDB</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">{{ $stats['pending_ppdb_count'] > 0 ? $stats['pending_ppdb_count'] . ' Menunggu' : 'Terverifikasi' }}</span>
            </a>

            <!-- 3. Guru & Tendik -->
            <a href="{{ \App\Filament\Resources\TeacherResource::getUrl('index') }}"
               class="group flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-emerald-50/70 dark:hover:bg-emerald-950/40 hover:border-emerald-400 dark:hover:border-emerald-500 transition text-center">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    👨‍🏫
                </div>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Guru & Tendik</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">{{ $stats['total_teachers'] }} Pengajar</span>
            </a>

            <!-- 4. Laporan LPJ -->
            <a href="{{ \App\Filament\Resources\LpjResource::getUrl('index') }}"
               class="group flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-purple-50/70 dark:hover:bg-purple-950/40 hover:border-purple-400 dark:hover:border-purple-500 transition text-center">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/60 text-purple-600 dark:text-purple-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    📑
                </div>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-2 group-hover:text-purple-600 dark:group-hover:text-purple-400">Laporan LPJ</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">{{ $stats['total_lpj'] }} Laporan</span>
            </a>

            <!-- 5. Buku Non-Teks -->
            <a href="{{ \App\Filament\Resources\BukuNonTeksResource::getUrl('index') }}"
               class="group flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-sky-50/70 dark:hover:bg-sky-950/40 hover:border-sky-400 dark:hover:border-sky-500 transition text-center">
                <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-900/60 text-sky-600 dark:text-sky-300 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    📚
                </div>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-2 group-hover:text-sky-600 dark:group-hover:text-sky-400">Buku Non-Teks</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">{{ $stats['total_buku'] }} E-Book</span>
            </a>

            <!-- 6. Pengaturan Sekolah -->
            <a href="{{ \App\Filament\Pages\ManageSchoolSettings::getUrl() }}"
               class="group flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 hover:border-gray-400 dark:hover:border-white/20 transition text-center">
                <div class="w-10 h-10 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    ⚙️
                </div>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-2 group-hover:text-primary-600 dark:group-hover:text-primary-400">Pengaturan Web</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">Identitas & Warna</span>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
