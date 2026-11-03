@php
    $headerNavigations = \App\Models\Navigation::active()->header()->roots()->with('children')->get();
@endphp

<header x-data="{ mobileOpen: false, scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 10)"
        :class="scrolled ? 'bg-white/98 backdrop-blur-md shadow-md shadow-slate-900/5 py-3 border-b border-slate-100' : 'bg-white py-3.5 border-b border-slate-100'"
        class="sticky top-0 z-40 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4">

            <!-- Brand / Logo Area -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                @php
                    $navLogo = $settings->logo_light;
                    $navLogoUrl = null;
                    if ($navLogo) {
                        $navLogoUrl = (str_starts_with($navLogo, 'http://') || str_starts_with($navLogo, 'https://'))
                            ? $navLogo
                            : asset('storage/' . $navLogo);
                    }
                    $fallbackLogoUrl = asset('storage/branding/logo_slb_transparent.png');
                @endphp
                @if($navLogoUrl)
                    <img src="{{ $navLogoUrl }}"
                         onerror="this.onerror=null; this.src='{{ $fallbackLogoUrl }}';"
                         alt="{{ $settings->school_name }}"
                         class="h-10 sm:h-11 w-auto object-contain">
                @else
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-gradient-to-tr from-blue-950 via-blue-900 to-sky-700 text-white flex items-center justify-center font-black text-lg shadow-md shadow-blue-950/20 border-2 border-amber-400/40 relative group-hover:scale-105 transition-transform duration-300 shrink-0">
                        <svg class="w-5 h-5 text-amber-300" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L3 6v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V6l-9-4zm0 4a3 3 0 110 6 3 3 0 010-6zm4.5 11.5c0-.83-.42-1.57-1.07-2.01A5.96 5.96 0 0012 14.5c-1.27 0-2.43.39-3.43 1A2.5 2.5 0 007.5 17.5v.71C8.79 19.38 10.32 20 12 20s3.21-.62 4.5-1.79v-.71z"/>
                        </svg>
                        <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-amber-400 text-blue-950 rounded-full flex items-center justify-center text-[8px] font-black border border-white shadow-xs">★</span>
                    </div>
                @endif
                <div class="flex flex-col min-w-0">
                    <span class="font-display text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-blue-900 transition leading-tight truncate max-w-[200px] sm:max-w-[260px] md:max-w-xs">
                        {{ $settings->school_name }}
                    </span>
                    <span class="text-[11px] text-slate-500 font-medium truncate max-w-xs flex items-center gap-1.5 mt-0.5">
                        <span>{{ $settings->tagline }}</span>
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                <a href="{{ route('home') }}"
                   class="px-3 py-2 text-xs xl:text-sm font-bold rounded-xl transition duration-200 whitespace-nowrap {{ request()->routeIs('home') ? 'text-blue-900 bg-blue-50/80 font-extrabold' : 'text-slate-700 hover:text-blue-900 hover:bg-slate-50' }}">
                    Beranda
                </a>

                @foreach($headerNavigations as $nav)
                    @if($nav->children->count() > 0)
                        <!-- Dropdown Menu Item -->
                        <div x-data="{ open: false }"
                             @mouseenter="open = true"
                             @mouseleave="open = false"
                             @click.away="open = false"
                             class="relative">
                            <button @click="open = !open"
                                    type="button"
                                    class="flex items-center gap-1 px-3 py-2 text-xs xl:text-sm font-bold rounded-xl transition duration-200 whitespace-nowrap {{ $nav->has_active_child ? 'text-blue-900 bg-blue-50/80 font-extrabold' : 'text-slate-700 hover:text-blue-900 hover:bg-slate-50' }}">
                                <span>{{ $nav->title }}</span>
                                <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 shrink-0" :class="open ? 'rotate-180 text-blue-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Solid Clean Dropdown Panel (High Contrast & Crisp) -->
                            <div x-show="open"
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute left-0 mt-2 w-60 bg-white rounded-2xl shadow-xl shadow-slate-900/10 border border-slate-100 py-2 px-1.5 z-50">
                                @foreach($nav->children as $child)
                                    <a href="{{ $child->resolved_url }}"
                                       target="{{ $child->target }}"
                                       class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition duration-150 whitespace-nowrap {{ $child->is_active_url ? 'bg-blue-50 text-blue-900 font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-900' }}">
                                        <span class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $child->is_active_url ? 'bg-blue-900' : 'bg-slate-300' }}"></span>
                                            <span>{{ $child->title }}</span>
                                        </span>
                                        @if($child->is_active_url)
                                            <svg class="w-3.5 h-3.5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Direct Link -->
                        <a href="{{ $nav->resolved_url }}"
                           target="{{ $nav->target }}"
                           class="px-3 py-2 text-xs xl:text-sm font-bold rounded-xl transition duration-200 whitespace-nowrap {{ $nav->is_active_url ? 'text-blue-900 bg-blue-50/80 font-extrabold' : 'text-slate-700 hover:text-blue-900 hover:bg-slate-50' }}">
                            {{ $nav->title }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Right CTA Action Buttons (Never truncates or overflows) -->
            <div class="hidden lg:flex items-center gap-2.5 shrink-0">
                @if($settings->ppdb_is_active)
                    <a href="{{ route('ppdb.index') }}"
                       class="px-4 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs shadow-md shadow-blue-950/15 hover:shadow-lg transition-all duration-200 flex items-center gap-2 shrink-0">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>Daftar PPDB</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                @endif

                @if($settings->graduation_is_active)
                    <a href="{{ route('kelulusan.index') }}"
                       class="px-3.5 py-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-900 font-bold text-xs border border-slate-200/80 transition-all duration-200 flex items-center gap-1.5 shrink-0">
                        <svg class="w-3.5 h-3.5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                        <span>Cek Kelulusan</span>
                    </a>
                @endif
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden flex items-center gap-2">
                @if($settings->ppdb_is_active)
                    <a href="{{ route('ppdb.index') }}" class="px-3 py-1.5 rounded-xl bg-blue-900 text-white text-xs font-bold shadow-xs flex items-center gap-1.5 whitespace-nowrap">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        <span>PPDB</span>
                    </a>
                @endif
                <button @click="mobileOpen = !mobileOpen"
                        type="button"
                        class="p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition focus:outline-none"
                        aria-label="Buka menu navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white border-b border-slate-200 px-4 pt-3 pb-6 space-y-2 max-h-[80vh] overflow-y-auto shadow-2xl">
        <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold transition {{ request()->routeIs('home') ? 'text-blue-900 bg-blue-50 font-black' : 'text-slate-800 hover:bg-slate-50' }}">
            Beranda
        </a>

        @foreach($headerNavigations as $nav)
            @if($nav->children->count() > 0)
                <div x-data="{ childOpen: {{ $nav->has_active_child ? 'true' : 'false' }} }" class="rounded-2xl border border-slate-150 bg-slate-50/50 overflow-hidden">
                    <button @click="childOpen = !childOpen" class="w-full flex items-center justify-between px-4 py-3 text-sm font-bold transition {{ $nav->has_active_child ? 'text-blue-900 font-black' : 'text-slate-800' }}">
                        <span>{{ $nav->title }}</span>
                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-200" :class="childOpen ? 'rotate-180 text-blue-900' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="childOpen" x-cloak class="px-2 pb-2 space-y-1">
                        @foreach($nav->children as $child)
                            <a href="{{ $child->resolved_url }}" target="{{ $child->target }}" class="block px-3 py-2 rounded-xl text-xs font-semibold transition {{ $child->is_active_url ? 'text-blue-900 font-bold bg-white shadow-xs' : 'text-slate-600 hover:text-blue-900 hover:bg-white' }}">
                                • {{ $child->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $nav->resolved_url }}" target="{{ $nav->target }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold transition hover:bg-slate-50 {{ $nav->is_active_url ? 'text-blue-900 bg-blue-50 font-black' : 'text-slate-800' }}">
                    {{ $nav->title }}
                </a>
            @endif
        @endforeach

        <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
            @if($settings->ppdb_is_active)
                <a href="{{ route('ppdb.index') }}" class="w-full py-3 rounded-xl bg-blue-900 text-white text-center font-bold text-xs uppercase tracking-wider shadow-md">
                    Pendaftaran PPDB Online
                </a>
            @endif
            @if($settings->graduation_is_active)
                <a href="{{ route('kelulusan.index') }}" class="w-full py-3 rounded-xl border border-slate-200 text-slate-700 text-center font-bold text-xs hover:bg-slate-50">
                    Cek Pengumuman Kelulusan (NISN)
                </a>
            @endif
        </div>
    </div>
</header>
