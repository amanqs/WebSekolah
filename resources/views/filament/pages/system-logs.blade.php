<x-filament-panels::page>
    @php
        $fileInfo = $this->getLogFileInfo();
        $logs = $this->getRecentLogs();
    @endphp

    <!-- Header & Info File Log -->
    <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-rose-100 dark:bg-rose-950 text-rose-600 dark:text-rose-400 flex items-center justify-center font-bold text-sm">
                        📋
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Pemeriksa Catatan Sistem & Error</h2>
                        <span class="text-xs text-slate-500 font-mono">{{ $fileInfo['path'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                <button type="button"
                        wire:click="$refresh"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-xl transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Refresh</span>
                </button>

                <button type="button"
                        wire:click="downloadLog"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-900 hover:bg-blue-100 rounded-xl transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Download Log</span>
                </button>

                <button type="button"
                        wire:click="clearLog"
                        wire:confirm="Yakin ingin mengosongkan seluruh riwayat log?"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-rose-700 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-900 hover:bg-rose-100 rounded-xl transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>Kosongkan Log</span>
                </button>
            </div>
        </div>

        <!-- Metrics File -->
        <div class="grid grid-cols-3 gap-3 mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 text-center">
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                <span class="text-xs text-slate-500 dark:text-slate-400 block">Ukuran File</span>
                <span class="text-sm font-bold font-mono text-slate-800 dark:text-slate-200">{{ $fileInfo['size'] }}</span>
            </div>
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                <span class="text-xs text-slate-500 dark:text-slate-400 block">Jumlah Baris</span>
                <span class="text-sm font-bold font-mono text-slate-800 dark:text-slate-200">{{ number_format($fileInfo['line_count']) }} Baris</span>
            </div>
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                <span class="text-xs text-slate-500 dark:text-slate-400 block">Terakhir Diperbarui</span>
                <span class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate block">{{ $fileInfo['modified'] }}</span>
            </div>
        </div>
    </div>

    <!-- Filter Tab Level Log -->
    <div class="flex items-center gap-1.5 p-1 rounded-xl bg-slate-100 dark:bg-slate-800 w-fit">
        @foreach(['ALL' => 'Semua Catatan', 'ERROR' => 'Error Kritis', 'WARNING' => 'Peringatan', 'INFO' => 'Informasi'] as $lvl => $label)
            <button type="button"
                    wire:click="setFilter('{{ $lvl }}')"
                    class="px-3 py-1.5 text-xs font-bold rounded-lg transition {{ $filterLevel === $lvl ? 'bg-white dark:bg-slate-900 text-primary-600 dark:text-primary-400 shadow-2xs' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Daftar Entri Log -->
    <div class="space-y-3">
        @forelse($logs as $log)
            @php
                $badgeClass = match($log['level']) {
                    'ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY' => 'bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300 border-rose-200 dark:border-rose-800',
                    'WARNING' => 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                    'INFO' => 'bg-sky-100 text-sky-800 dark:bg-sky-950 dark:text-sky-300 border-sky-200 dark:border-sky-800',
                    default => 'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300 border-slate-200 dark:border-slate-700',
                };
            @endphp
            <div class="p-4 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs hover:border-slate-300 transition-colors">
                <div class="flex items-center justify-between gap-3 mb-2 flex-wrap">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded text-[10px] font-black font-mono uppercase tracking-wider border {{ $badgeClass }}">
                            {{ $log['level'] }}
                        </span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">
                            {{ $log['timestamp'] }}
                        </span>
                    </div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800">
                        {{ $log['env'] }}
                    </span>
                </div>

                <div class="p-3 rounded-lg bg-slate-950 text-slate-200 font-mono text-xs overflow-x-auto leading-relaxed whitespace-pre-wrap select-all">
{{ $log['message'] }}
                </div>
            </div>
        @empty
            <div class="p-12 text-center rounded-2xl bg-white dark:bg-slate-900 border border-dashed border-slate-200 dark:border-slate-800">
                <span class="text-3xl block mb-2">✨</span>
                <h3 class="font-bold text-sm text-slate-800 dark:text-slate-200">Tidak Ada Log Error</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Sistem berjalan normal dan bersih tanpa catatan error pada level ini.
                </p>
            </div>
        @endforelse
    </div>
</x-filament-panels::page>
