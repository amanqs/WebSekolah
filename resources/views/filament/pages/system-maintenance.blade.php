<x-filament-panels::page>
    @php
        $server = $this->getServerInfo();
        $extensions = $this->getExtensionsStatus();
        $storage = $this->getStorageStats();
        $dbStats = $this->getDatabaseStats();
    @endphp

    <!-- 1. Header Ringkasan & Tombol Aksi Cepat -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 text-white shadow-xl border border-blue-900/40 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-blue-500/20 text-blue-300 font-bold border border-blue-400/30">
                        ⚡
                    </span>
                    <h2 class="text-xl font-bold tracking-tight">Pusat Kendali Pengembang & Pemeliharaan Server</h2>
                </div>
                <p class="text-xs text-slate-300 mt-1 max-w-2xl leading-relaxed">
                    Pantau kondisi server, lakukan pembersihan cache berkala, pastikan tautan dokumen berfungsi, serta unduh cadangan database langsung ke komputer Anda.
                </p>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ app()->isProduction() ? 'bg-emerald-950 text-emerald-300 border-emerald-700' : 'bg-amber-950 text-amber-300 border-amber-700' }}">
                    <span class="w-2 h-2 rounded-full {{ app()->isProduction() ? 'bg-emerald-400' : 'bg-amber-400 animate-pulse' }}"></span>
                    <span class="uppercase tracking-wider">{{ $server['environment'] }}</span>
                </span>
                <span class="text-xs text-slate-400 font-mono px-2.5 py-1 rounded-lg bg-slate-800/80 border border-slate-700">
                    PHP {{ $server['php_version'] }}
                </span>
            </div>
        </div>

        <!-- Tombol Aksi Cepat Maintenance -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2.5 mt-6 pt-5 border-t border-slate-800/80">
            <button type="button"
                    wire:click="clearAllCache"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3 rounded-xl bg-slate-800/90 hover:bg-blue-900/50 border border-slate-700 hover:border-blue-400/50 transition-all text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">🧹</span>
                <span class="text-xs font-bold mt-1 text-white">Bersihkan Cache</span>
                <span class="text-[10px] text-slate-400">optimize:clear</span>
            </button>

            <button type="button"
                    wire:click="optimizeCache"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3 rounded-xl bg-slate-800/90 hover:bg-emerald-900/50 border border-slate-700 hover:border-emerald-400/50 transition-all text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">⚡</span>
                <span class="text-xs font-bold mt-1 text-white">Optimasi Cache</span>
                <span class="text-[10px] text-slate-400">config & route</span>
            </button>

            <button type="button"
                    wire:click="repairStorageLink"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3 rounded-xl bg-slate-800/90 hover:bg-amber-900/50 border border-slate-700 hover:border-amber-400/50 transition-all text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">🔗</span>
                <span class="text-xs font-bold mt-1 text-white">Perbaiki Link Storage</span>
                <span class="text-[10px] text-slate-400">storage:link</span>
            </button>

            <button type="button"
                    wire:click="clearViewCache"
                    wire:loading.attr="disabled"
                    class="flex flex-col items-center justify-center p-3 rounded-xl bg-slate-800/90 hover:bg-purple-900/50 border border-slate-700 hover:border-purple-400/50 transition-all text-center group">
                <span class="text-xl group-hover:scale-110 transition-transform">🖼️</span>
                <span class="text-xs font-bold mt-1 text-white">Refresh View Blade</span>
                <span class="text-[10px] text-slate-400">view:clear</span>
            </button>

            <button type="button"
                    wire:click="downloadDatabaseBackup"
                    wire:loading.attr="disabled"
                    class="col-span-2 sm:col-span-1 flex flex-col items-center justify-center p-3 rounded-xl bg-gradient-to-tr from-blue-700 to-sky-600 hover:from-blue-600 hover:to-sky-500 border border-sky-400/40 transition-all text-center shadow-lg group">
                <span class="text-xl group-hover:scale-110 transition-transform">💾</span>
                <span class="text-xs font-black text-white">Download Backup SQL</span>
                <span class="text-[10px] text-blue-100">Snapshot 1-Klik</span>
            </button>
        </div>
    </div>

    <!-- 2. Grid Informasi Server & Storage -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Kolom 1 & 2: Spesifikasi Server & Lingkungan -->
        <div class="lg:col-span-2 space-y-6">
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
                <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-blue-100 dark:bg-blue-950 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs font-bold">💻</span>
                        <h3 class="font-bold text-sm text-slate-900 dark:text-white">Spesifikasi Server & Runtime</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-mono">{{ $server['server_time'] }}</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 block">PHP Version</span>
                        <span class="text-sm font-bold font-mono text-slate-800 dark:text-slate-200">{{ $server['php_version'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 block">Laravel Framework</span>
                        <span class="text-sm font-bold font-mono text-slate-800 dark:text-slate-200">v{{ $server['laravel_version'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 block">Sistem Operasi</span>
                        <span class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate block">{{ $server['server_os'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 block">Memory Limit</span>
                        <span class="text-sm font-bold font-mono text-emerald-600 dark:text-emerald-400">{{ $server['memory_limit'] }}</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 block">Max Upload File</span>
                        <span class="text-sm font-bold font-mono text-blue-600 dark:text-blue-400">{{ $server['upload_max_filesize'] }} (POST: {{ $server['post_max_size'] }})</span>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 block">Basis Data</span>
                        <span class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate block">{{ $server['db_name'] }} ({{ $server['db_version'] }})</span>
                    </div>
                </div>
            </div>

            <!-- Status Ekstensi PHP -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
                <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100 dark:border-slate-800">
                    <span class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs font-bold">🧩</span>
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">Status Ekstensi Penting PHP</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($extensions as $ext)
                        <div class="flex items-center justify-between p-2.5 rounded-xl border {{ $ext['loaded'] ? 'border-emerald-200/80 bg-emerald-50/40 dark:border-emerald-900/50 dark:bg-emerald-950/20' : 'border-rose-200 bg-rose-50/40 dark:border-rose-900 dark:bg-rose-950/20' }}">
                            <div class="min-w-0 pr-2">
                                <span class="font-mono font-bold text-xs {{ $ext['loaded'] ? 'text-emerald-900 dark:text-emerald-300' : 'text-rose-900 dark:text-rose-300' }} block">
                                    {{ $ext['name'] }}
                                </span>
                                <span class="text-[10px] text-slate-500 dark:text-slate-400 truncate block">
                                    {{ $ext['label'] }}
                                </span>
                            </div>
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full {{ $ext['loaded'] ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }} text-[10px] font-black shrink-0">
                                {{ $ext['loaded'] ? '✓' : '✗' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Kolom 3: Storage & Database Metrics -->
        <div class="space-y-6">

            <!-- Storage Disk Status -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
                <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100 dark:border-slate-800">
                    <span class="w-6 h-6 rounded-lg bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xs font-bold">📁</span>
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">Penyimpanan Media & Berkas</h3>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-xs text-slate-600 dark:text-slate-400">Total Ukuran Media</span>
                        <span class="text-sm font-black text-slate-900 dark:text-white">{{ $storage['total_size'] }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-xs text-slate-600 dark:text-slate-400">Jumlah File Terunggah</span>
                        <span class="text-sm font-black text-slate-900 dark:text-white">{{ number_format($storage['total_files']) }} Berkas</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl border {{ $storage['link_exists'] ? 'border-emerald-200 bg-emerald-50/50 dark:border-emerald-900 dark:bg-emerald-950/30' : 'border-rose-200 bg-rose-50/50 dark:border-rose-900 dark:bg-rose-950/30' }}">
                        <span class="text-xs font-semibold {{ $storage['link_exists'] ? 'text-emerald-800 dark:text-emerald-300' : 'text-rose-800 dark:text-rose-300' }}">Tautan public/storage</span>
                        <span class="text-xs font-bold {{ $storage['link_exists'] ? 'text-emerald-700 dark:text-emerald-400' : 'text-rose-700 dark:text-rose-400' }}">
                            {{ $storage['link_exists'] ? '● Terhubung Aktif' : '✗ Terputus' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Database Data Counter -->
            <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
                <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100 dark:border-slate-800">
                    <span class="w-6 h-6 rounded-lg bg-indigo-100 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs font-bold">📊</span>
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">Rekapitulasi Data Sekolah</h3>
                </div>

                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-lg font-black text-blue-600 dark:text-blue-400">{{ $dbStats['posts'] }}</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-medium">Artikel & Berita</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-lg font-black text-amber-600 dark:text-amber-400">{{ $dbStats['ppdb'] }}</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-medium">Pendaftar PPDB</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-lg font-black text-emerald-600 dark:text-emerald-400">{{ $dbStats['lpj'] }}</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-medium">Laporan LPJ</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-lg font-black text-purple-600 dark:text-purple-400">{{ $dbStats['buku'] }}</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-medium">Buku Non-Teks</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-lg font-black text-sky-600 dark:text-sky-400">{{ $dbStats['teachers'] }}</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-medium">Guru & Pendidik</span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <span class="text-lg font-black text-rose-600 dark:text-rose-400">{{ $dbStats['users'] }}</span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-medium">Akun Pengguna</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-filament-panels::page>
