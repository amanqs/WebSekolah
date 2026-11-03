<x-filament-widgets::widget>
    @php
        $data = $this->getData();
    @endphp

    <x-filament::section compact>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div class="flex flex-wrap items-center gap-2.5">
                <x-filament::badge color="info" icon="heroicon-m-cpu-chip">
                    Developer Health
                </x-filament::badge>

                <x-filament::badge color="success">
                    ● Sistem Normal
                </x-filament::badge>

                <div class="flex flex-wrap items-center gap-2 text-xs font-mono text-gray-500 dark:text-gray-400">
                    <span>PHP v{{ $data['php_version'] }}</span>
                    <span>•</span>
                    <span>Laravel v{{ $data['laravel_version'] }}</span>
                    <span>•</span>
                    <span>DB: {{ $data['db_name'] }}</span>
                    <span>•</span>
                    <span class="{{ $data['storage_linked'] ? 'text-emerald-600 dark:text-emerald-400 font-semibold' : 'text-rose-600 dark:text-rose-400 font-semibold' }}">
                        {{ $data['storage_linked'] ? 'Storage: Linked' : 'Storage: Unlinked' }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <x-filament::button
                    :href="\App\Filament\Pages\SystemMaintenance::getUrl()"
                    tag="a"
                    size="xs"
                    color="primary"
                    icon="heroicon-m-wrench-screwdriver"
                >
                    Pusat Maintenance
                </x-filament::button>

                <x-filament::button
                    :href="\App\Filament\Pages\SystemLogs::getUrl()"
                    tag="a"
                    size="xs"
                    color="gray"
                    icon="heroicon-m-document-text"
                >
                    Log Error
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>


