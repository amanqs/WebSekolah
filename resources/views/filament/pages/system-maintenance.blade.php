<x-filament-panels::page>
    @php
        $server = $this->getServerInfo();
        $extensions = $this->getExtensionsStatus();
        $storage = $this->getStorageStats();
        $dbStats = $this->getDatabaseStats();
    @endphp

    <!-- 1. Header Ringkasan & Tombol Aksi Cepat -->
    <x-filament::section icon="heroicon-o-cpu-chip">
        <x-slot name="heading">
            Pusat Kendali Pengembang & Pemeliharaan Server
        </x-slot>

        <x-slot name="description">
            Pantau kondisi server, lakukan pembersihan cache berkala, pastikan tautan dokumen berfungsi, serta unduh cadangan database langsung ke komputer Anda.
        </x-slot>

        <x-slot name="headerEnd">
            <div class="flex items-center gap-2">
                <x-filament::badge :color="app()->isProduction() ? 'success' : 'warning'">
                    {{ strtoupper($server['environment']) }}
                </x-filament::badge>
                <x-filament::badge color="gray">
                    PHP {{ $server['php_version'] }}
                </x-filament::badge>
            </div>
        </x-slot>

        <!-- Tombol Aksi Cepat Maintenance -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 mt-4 pt-4 border-t border-gray-200 dark:border-white/10">
            <button type="button"
                    wire:click="clearAllCache"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-blue-50/70 dark:hover:bg-blue-950/40 hover:border-blue-400 dark:hover:border-blue-500 transition text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">🧹</span>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-1.5 group-hover:text-blue-600 dark:group-hover:text-blue-400">Bersihkan Cache</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400">optimize:clear</span>
            </button>

            <button type="button"
                    wire:click="optimizeCache"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-emerald-50/70 dark:hover:bg-emerald-950/40 hover:border-emerald-400 dark:hover:border-emerald-500 transition text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">⚡</span>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-1.5 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Optimasi Cache</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400">config & route</span>
            </button>

            <button type="button"
                    wire:click="repairStorageLink"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-amber-50/70 dark:hover:bg-amber-950/40 hover:border-amber-400 dark:hover:border-amber-500 transition text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">🔗</span>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-1.5 group-hover:text-amber-600 dark:group-hover:text-amber-400">Tautan Storage</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400">storage:link</span>
            </button>

            <button type="button"
                    wire:click="clearViewCache"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50/70 dark:bg-white/5 hover:bg-purple-50/70 dark:hover:bg-purple-950/40 hover:border-purple-400 dark:hover:border-purple-500 transition text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">🖼️</span>
                <span class="text-xs font-bold text-gray-900 dark:text-white mt-1.5 group-hover:text-purple-600 dark:group-hover:text-purple-400">Refresh Blade</span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400">view:clear</span>
            </button>

            <button type="button"
                    wire:click="downloadDatabaseBackup"
                    wire:loading.attr="disabled"
                    class="col-span-2 sm:col-span-1 flex flex-col items-center justify-center p-3.5 rounded-xl border border-primary-500/40 bg-primary-600 hover:bg-primary-500 text-white transition text-center shadow group">
                <span class="text-xl group-hover:scale-110 transition-transform">💾</span>
                <span class="text-xs font-black text-white mt-1.5">Backup SQL</span>
                <span class="text-[10px] text-white/80">Snapshot 1-Klik</span>
            </button>
        </div>
    </x-filament::section>

    <!-- 2. Grid Informasi Server & Storage -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Kolom 1 & 2: Spesifikasi Server & Lingkungan -->
        <div class="lg:col-span-2 space-y-6">
            <x-filament::section icon="heroicon-o-server">
                <x-slot name="heading">
                    Spesifikasi Server & Runtime
                </x-slot>

                <x-slot name="headerEnd">
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-mono">{{ $server['server_time'] }}</span>
                </x-slot>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <div class="p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 block">PHP Version</span>
                        <span class="text-sm font-bold font-mono text-gray-900 dark:text-white">{{ $server['php_version'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 block">Laravel Framework</span>
                        <span class="text-sm font-bold font-mono text-gray-900 dark:text-white">v{{ $server['laravel_version'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 block">Sistem Operasi</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white truncate block">{{ $server['server_os'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 block">Memory Limit</span>
                        <span class="text-sm font-bold font-mono text-emerald-600 dark:text-emerald-400">{{ $server['memory_limit'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 block">Max Upload File</span>
                        <span class="text-sm font-bold font-mono text-blue-600 dark:text-blue-400">{{ $server['upload_max_filesize'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 block">Basis Data</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white truncate block">{{ $server['db_name'] }} ({{ $server['db_version'] }})</span>
                    </div>
                </div>
            </x-filament::section>

            <!-- Status Ekstensi PHP -->
            <x-filament::section icon="heroicon-o-puzzle-piece">
                <x-slot name="heading">
                    Status Ekstensi Penting PHP
                </x-slot>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($extensions as $ext)
                        <div class="flex items-center justify-between p-3 rounded-xl border {{ $ext['loaded'] ? 'border-emerald-200/80 bg-emerald-50/50 dark:border-emerald-900/50 dark:bg-emerald-950/20' : 'border-rose-200 bg-rose-50/50 dark:border-rose-900/50 dark:bg-rose-950/20' }}">
                            <div class="min-w-0 pr-2">
                                <span class="font-mono font-bold text-xs {{ $ext['loaded'] ? 'text-emerald-900 dark:text-emerald-300' : 'text-rose-900 dark:text-rose-300' }} block">
                                    {{ $ext['name'] }}
                                </span>
                                <span class="text-[10px] text-gray-500 dark:text-gray-400 truncate block">
                                    {{ $ext['label'] }}
                                </span>
                            </div>
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full {{ $ext['loaded'] ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }} text-[10px] font-black shrink-0">
                                {{ $ext['loaded'] ? '✓' : '✗' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>
        </div>

        <!-- Kolom 3: Storage & Database Metrics -->
        <div class="space-y-6">

            <!-- Storage Disk Status -->
            <x-filament::section icon="heroicon-o-folder">
                <x-slot name="heading">
                    Penyimpanan Media & Berkas
                </x-slot>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-xs text-gray-600 dark:text-gray-400">Total Ukuran Media</span>
                        <span class="text-sm font-black text-gray-900 dark:text-white">{{ $storage['total_size'] }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-xs text-gray-600 dark:text-gray-400">Jumlah File Terunggah</span>
                        <span class="text-sm font-black text-gray-900 dark:text-white">{{ number_format($storage['total_files']) }} Berkas</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl border {{ $storage['link_exists'] ? 'border-emerald-200/80 bg-emerald-50/50 dark:border-emerald-900/50 dark:bg-emerald-950/20' : 'border-rose-200/80 bg-rose-50/50 dark:border-rose-900/50 dark:bg-rose-950/20' }}">
                        <span class="text-xs font-semibold {{ $storage['link_exists'] ? 'text-emerald-800 dark:text-emerald-300' : 'text-rose-800 dark:text-rose-300' }}">Tautan public/storage</span>
                        <span class="text-xs font-bold {{ $storage['link_exists'] ? 'text-emerald-700 dark:text-emerald-400' : 'text-rose-700 dark:text-rose-400' }}">
                            {{ $storage['link_exists'] ? '● Terhubung Aktif' : '✗ Terputus' }}
                        </span>
                    </div>
                </div>
            </x-filament::section>

            <!-- Database Data Counter -->
            <x-filament::section icon="heroicon-o-circle-stack">
                <x-slot name="heading">
                    Rekapitulasi Data Sekolah
                </x-slot>

                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-lg font-black text-blue-600 dark:text-blue-400">{{ $dbStats['posts'] }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-gray-400 block font-medium">Artikel & Berita</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-lg font-black text-amber-600 dark:text-amber-400">{{ $dbStats['ppdb'] }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-gray-400 block font-medium">Pendaftar PPDB</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-lg font-black text-emerald-600 dark:text-emerald-400">{{ $dbStats['lpj'] }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-gray-400 block font-medium">Laporan LPJ</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-lg font-black text-purple-600 dark:text-purple-400">{{ $dbStats['buku'] }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-gray-400 block font-medium">Buku Non-Teks</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-lg font-black text-sky-600 dark:text-sky-400">{{ $dbStats['teachers'] }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-gray-400 block font-medium">Guru & Tendik</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                        <span class="text-lg font-black text-rose-600 dark:text-rose-400">{{ $dbStats['users'] }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-gray-400 block font-medium">Akun Pengguna</span>
                    </div>
                </div>
            </x-filament::section>

        </div>

    </div>
</x-filament-panels::page>
