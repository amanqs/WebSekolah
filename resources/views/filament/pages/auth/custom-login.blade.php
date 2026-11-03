<x-filament-panels::page.simple>
    @php
        $accounts = $this->getDemoAccounts();
        $meta = $this->getSystemMetadata();
    @endphp

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <!-- Form Login Utama -->
    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}

    <!-- Seksi Akses Cepat Developer & Administrator -->
    <div x-data="{ open: true, currentTab: 'developer' }" class="mt-6 pt-5 border-t border-slate-200 dark:border-slate-800">
        <div class="flex items-center justify-between gap-2 mb-3">
            <button type="button"
                    @click="open = !open"
                    class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-primary-600 transition">
                <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-primary-50 dark:bg-primary-950 text-primary-600 dark:text-primary-400 font-mono text-[10px] font-black">⚡</span>
                <span>Pusat Akses Cepat (Developer & Admin)</span>
                <svg :class="open ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <span class="text-[10px] uppercase tracking-wider font-semibold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800">
                ● Siap Digunakan
            </span>
        </div>

        <div x-show="open" x-collapse>
            <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-3 leading-relaxed">
                Pilih profil akun di bawah ini untuk mengisi formulir secara otomatis atau langsung masuk dengan satu kali klik:
            </p>

            <div class="space-y-2">
                @foreach($accounts as $key => $acc)
                    <div class="p-3 rounded-xl border border-slate-200/90 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-900/60 hover:border-primary-400 dark:hover:border-primary-600 transition-all duration-200">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="font-bold text-xs text-slate-900 dark:text-white">{{ $acc['role'] }}</span>
                                    <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $acc['badge_color'] }}">
                                        {{ $acc['badge'] }}
                                    </span>
                                </div>
                                <div class="text-[11px] font-mono text-slate-600 dark:text-slate-300 mt-0.5 truncate">
                                    {{ $acc['email'] }}
                                </div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 line-clamp-1">
                                    {{ $acc['desc'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 mt-2.5 pt-2 border-t border-slate-200/60 dark:border-slate-800/80">
                            <button type="button"
                                    wire:click="fillCredentials('{{ $key }}')"
                                    wire:loading.attr="disabled"
                                    class="flex-1 inline-flex items-center justify-center gap-1 px-2.5 py-1.5 text-[11px] font-semibold text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                <span>Isi Form</span>
                            </button>

                            <button type="button"
                                    wire:click="quickLogin('{{ $key }}')"
                                    wire:loading.attr="disabled"
                                    class="flex-1 inline-flex items-center justify-center gap-1 px-2.5 py-1.5 text-[11px] font-bold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600 rounded-lg transition shadow-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span>Masuk 1-Klik ⚡</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Password Info Reminder -->
            <div class="mt-3 flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400 px-1">
                <span>Kata Sandi Default Semua Akun:</span>
                <code class="px-1.5 py-0.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 font-mono font-bold">password</code>
            </div>
        </div>
    </div>

    <!-- System Health & Back to Home Footer -->
    <div class="mt-6 pt-4 border-t border-slate-200/80 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 dark:text-slate-400">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-primary-600 dark:text-primary-400 hover:underline font-semibold transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Beranda Website</span>
        </a>

        <div class="flex items-center gap-2 font-mono text-[10px] text-slate-400">
            <span>PHP {{ $meta['php_version'] }}</span>
            <span>•</span>
            <span>Laravel {{ $meta['laravel_version'] }}</span>
            <span>•</span>
            <span class="uppercase">{{ $meta['environment'] }}</span>
        </div>
    </div>
</x-filament-panels::page.simple>

