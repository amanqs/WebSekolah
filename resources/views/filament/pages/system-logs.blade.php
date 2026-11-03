<x-filament-panels::page>
    @php
        $fileInfo = $this->getLogFileInfo();
        $logs = $this->getRecentLogs();
    @endphp

    <!-- Header & Info File Log -->
    <x-filament::section icon="heroicon-o-document-text">
        <x-slot name="heading">
            Pemeriksa Catatan Sistem & Error
        </x-slot>

        <x-slot name="description">
            <span class="font-mono text-xs text-gray-500 dark:text-gray-400">{{ $fileInfo['path'] }}</span>
        </x-slot>

        <x-slot name="headerEnd">
            <div class="flex items-center gap-2">
                <x-filament::button
                    type="button"
                    wire:click="$refresh"
                    color="gray"
                    size="xs"
                    icon="heroicon-m-arrow-path"
                >
                    Refresh
                </x-filament::button>

                <x-filament::button
                    type="button"
                    wire:click="downloadLog"
                    color="info"
                    size="xs"
                    icon="heroicon-m-arrow-down-tray"
                >
                    Download
                </x-filament::button>

                <x-filament::button
                    type="button"
                    wire:click="clearLog"
                    wire:confirm="Yakin ingin mengosongkan seluruh riwayat log error?"
                    color="danger"
                    size="xs"
                    icon="heroicon-m-trash"
                >
                    Kosongkan Log
                </x-filament::button>
            </div>
        </x-slot>

        <!-- Metrics File -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-2 pt-3 border-t border-gray-200 dark:border-white/10 text-center">
            <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                <span class="text-xs text-gray-500 dark:text-gray-400 block">Ukuran File</span>
                <span class="text-sm font-bold font-mono text-gray-900 dark:text-white">{{ $fileInfo['size'] }}</span>
            </div>
            <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                <span class="text-xs text-gray-500 dark:text-gray-400 block">Jumlah Baris</span>
                <span class="text-sm font-bold font-mono text-gray-900 dark:text-white">{{ number_format($fileInfo['line_count']) }} Baris</span>
            </div>
            <div class="p-2.5 rounded-xl bg-gray-50/70 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                <span class="text-xs text-gray-500 dark:text-gray-400 block">Terakhir Diperbarui</span>
                <span class="text-sm font-bold text-gray-900 dark:text-white truncate block">{{ $fileInfo['modified'] }}</span>
            </div>
        </div>
    </x-filament::section>

    <!-- Filter Tab Level Log -->
    <div class="flex items-center gap-1.5 p-1 rounded-xl bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 w-fit">
        @foreach(['ALL' => 'Semua Catatan', 'ERROR' => 'Error Kritis', 'WARNING' => 'Peringatan', 'INFO' => 'Informasi'] as $lvl => $label)
            <button type="button"
                    wire:click="setFilter('{{ $lvl }}')"
                    class="px-3 py-1.5 text-xs font-bold rounded-lg transition {{ $filterLevel === $lvl ? 'bg-white dark:bg-white/10 text-primary-600 dark:text-primary-400 shadow-xs' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Daftar Entri Log -->
    <div class="space-y-3">
        @forelse($logs as $log)
            @php
                $badgeColor = match($log['level']) {
                    'ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY' => 'danger',
                    'WARNING' => 'warning',
                    'INFO' => 'info',
                    default => 'gray',
                };
            @endphp
            <x-filament::section compact>
                <div class="flex items-center justify-between gap-3 mb-2 flex-wrap">
                    <div class="flex items-center gap-2">
                        <x-filament::badge :color="$badgeColor">
                            {{ $log['level'] }}
                        </x-filament::badge>
                        <span class="text-xs font-mono text-gray-500 dark:text-gray-400">
                            {{ $log['timestamp'] }}
                        </span>
                    </div>
                    <x-filament::badge color="gray">
                        {{ strtoupper($log['env']) }}
                    </x-filament::badge>
                </div>

                <div class="p-3 rounded-lg bg-gray-950 text-gray-100 font-mono text-xs overflow-x-auto leading-relaxed whitespace-pre-wrap select-all">
{{ $log['message'] }}
                </div>
            </x-filament::section>
        @empty
            <x-filament::section>
                <div class="p-8 text-center">
                    <span class="text-3xl block mb-2">✨</span>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Tidak Ada Log Error</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Sistem berjalan normal dan bersih tanpa catatan error pada level ini.
                    </p>
                </div>
            </x-filament::section>
        @endforelse
    </div>
</x-filament-panels::page>
