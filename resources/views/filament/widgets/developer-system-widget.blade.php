<x-filament-widgets::widget>
    @php
        $data = $this->getData();
    @endphp

    <div class="p-5 rounded-2xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 border border-indigo-900/40 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-8 -top-8 w-36 h-36 bg-indigo-500/10 rounded-full blur-xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-indigo-500/20 text-indigo-300 font-mono text-xs font-bold border border-indigo-400/30">
                        ⚡
                    </span>
                    <h3 class="text-sm font-bold tracking-tight text-white">Status Lingkungan Pengembang (Developer Health)</h3>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        ● Sistem Normal
                    </span>
                </div>
                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-300 font-mono">
                    <span>PHP v{{ $data['php_version'] }}</span>
                    <span>•</span>
                    <span>Laravel v{{ $data['laravel_version'] }}</span>
                    <span>•</span>
                    <span>DB: {{ $data['db_name'] }}</span>
                    <span>•</span>
                    <span class="text-emerald-400 font-semibold">{{ $data['storage_linked'] ? 'Storage: Linked' : 'Storage: Unlinked' }}</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ url('/admin/system-maintenance') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-xs font-bold text-white transition shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Pusat Maintenance</span>
                </a>

                <a href="{{ url('/admin/system-logs') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-xs font-semibold text-slate-200 transition">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Cek Log Error</span>
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
