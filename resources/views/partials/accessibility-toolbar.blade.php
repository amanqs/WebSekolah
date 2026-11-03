<!-- ACCESSIBILITY TOOLBAR (WIDGET RAMAH DISABILITAS KHUSUS SLB) -->
<div x-data="{
        open: false,
        fontSize: localStorage.getItem('a11y_font_size') || 'normal',
        grayscale: localStorage.getItem('a11y_grayscale') === 'true',
        invert: localStorage.getItem('a11y_invert') === 'true',
        highContrast: localStorage.getItem('a11y_contrast') === 'true',
        highlightLinks: localStorage.getItem('a11y_links') === 'true',
        dyslexiaFont: localStorage.getItem('a11y_dyslexia') === 'true',
        pauseAnim: localStorage.getItem('a11y_anim') === 'true',

        init() {
            this.applyAll();
        },

        setFont(size) {
            this.fontSize = size;
            localStorage.setItem('a11y_font_size', size);
            this.applyAll();
        },

        toggleGrayscale() {
            this.grayscale = !this.grayscale;
            localStorage.setItem('a11y_grayscale', this.grayscale);
            this.applyAll();
        },

        toggleInvert() {
            this.invert = !this.invert;
            localStorage.setItem('a11y_invert', this.invert);
            this.applyAll();
        },

        toggleContrast() {
            this.highContrast = !this.highContrast;
            localStorage.setItem('a11y_contrast', this.highContrast);
            this.applyAll();
        },

        toggleHighlightLinks() {
            this.highlightLinks = !this.highlightLinks;
            localStorage.setItem('a11y_links', this.highlightLinks);
            this.applyAll();
        },

        toggleDyslexia() {
            this.dyslexiaFont = !this.dyslexiaFont;
            localStorage.setItem('a11y_dyslexia', this.dyslexiaFont);
            this.applyAll();
        },

        toggleAnim() {
            this.pauseAnim = !this.pauseAnim;
            localStorage.setItem('a11y_anim', this.pauseAnim);
            this.applyAll();
        },

        resetAll() {
            this.fontSize = 'normal';
            this.grayscale = false;
            this.invert = false;
            this.highContrast = false;
            this.highlightLinks = false;
            this.dyslexiaFont = false;
            this.pauseAnim = false;

            localStorage.removeItem('a11y_font_size');
            localStorage.removeItem('a11y_grayscale');
            localStorage.removeItem('a11y_invert');
            localStorage.removeItem('a11y_contrast');
            localStorage.removeItem('a11y_links');
            localStorage.removeItem('a11y_dyslexia');
            localStorage.removeItem('a11y_anim');

            this.applyAll();
        },

        applyAll() {
            const html = document.documentElement;
            const body = document.body;

            // Font Scaling
            html.classList.remove('a11y-font-lg', 'a11y-font-xl');
            if (this.fontSize === 'lg') html.classList.add('a11y-font-lg');
            if (this.fontSize === 'xl') html.classList.add('a11y-font-xl');

            // Visual Modes
            html.classList.toggle('a11y-grayscale', this.grayscale);
            html.classList.toggle('a11y-invert', this.invert);
            body.classList.toggle('a11y-contrast', this.highContrast);
            body.classList.toggle('a11y-highlight-links', this.highlightLinks);
            body.classList.toggle('a11y-dyslexia', this.dyslexiaFont);
            body.classList.toggle('a11y-no-anim', this.pauseAnim);
        }
    }"
    class="relative z-50">

    <!-- FLOATING ACCESSIBILITY BUTTON (Bottom-Left) -->
    <div class="fixed bottom-6 left-6 z-50">
        <button @click="open = !open"
                type="button"
                aria-label="Menu Aksesibilitas Ramah Disabilitas"
                :class="open ? 'bg-amber-500 text-slate-950 scale-105 ring-4 ring-amber-400/30' : 'bg-[#0B1528] text-white hover:bg-blue-900'"
                class="group flex items-center gap-2.5 px-4 py-3 rounded-full shadow-2xl border-2 border-amber-400/70 transition-all duration-300 focus:outline-none hover:scale-105">

            <!-- Universal Accessibility Icon (Wheelchair / A11y Symbol) -->
            <div class="w-6 h-6 rounded-full bg-amber-400 text-blue-950 flex items-center justify-center font-black shrink-0 shadow-xs">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <circle cx="12" cy="4" r="2"/>
                    <path d="M19 13v-2c-1.54.02-3.09-.75-4.07-1.83l-1.29-1.43c-.17-.19-.38-.34-.61-.45-.01 0-.01-.01-.02-.01H13c-.35-.2-.75-.3-1.19-.26-.43.04-.83.22-1.14.5L7.29 10.7c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L11 9.82V14h-1c-2.76 0-5 2.24-5 5h2c0-1.65 1.35-3 3-3h3.5c.28 0 .5-.22.5-.5V12.5l2.12 1.93c.87.8 1.98 1.33 3.16 1.48v-2.02c-.75-.12-1.44-.47-2-.99V13h1.72z"/>
                    <path d="M12 14c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3h-2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1v-2z"/>
                </svg>
            </div>

            <span class="text-xs font-bold tracking-wide hidden sm:inline-block">Aksesibilitas</span>

            <!-- Active Indicator Pill -->
            <span x-show="fontSize !== 'normal' || grayscale || invert || highContrast || highlightLinks || dyslexiaFont || pauseAnim"
                  x-cloak
                  class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
        </button>
    </div>

    <!-- ACCESSIBILITY MODAL / DRAWER PANEL -->
    <div x-show="open"
         x-cloak
         @click.away="open = false"
         @keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-6 scale-95"
         role="dialog"
         aria-modal="true"
         aria-label="Pengaturan Aksesibilitas Web Sekolah"
         class="fixed bottom-24 left-4 sm:left-6 z-50 w-[calc(100vw-2rem)] sm:w-96 max-h-[80vh] bg-white rounded-3xl shadow-2xl border border-slate-200/90 overflow-hidden flex flex-col">

        <!-- Panel Header -->
        <div class="p-4 sm:p-5 bg-[#0B1528] text-white flex items-center justify-between border-b border-slate-800 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-400 text-blue-950 flex items-center justify-center font-black">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <circle cx="12" cy="4" r="2"/>
                        <path d="M19 13v-2c-1.54.02-3.09-.75-4.07-1.83l-1.29-1.43c-.17-.19-.38-.34-.61-.45H13c-.35-.2-.75-.3-1.19-.26-.43.04-.83.22-1.14.5L7.29 10.7c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L11 9.82V14h-1c-2.76 0-5 2.24-5 5h2c0-1.65 1.35-3 3-3h3.5c.28 0 .5-.22.5-.5V12.5l2.12 1.93c.87.8 1.98 1.33 3.16 1.48v-2.02c-.75-.12-1.44-.47-2-.99V13h1.72z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-display font-extrabold text-sm text-white leading-tight">Pengaturan Aksesibilitas</h3>
                    <p class="text-[10px] text-amber-300 font-semibold mt-0.5">Ramah Disabilitas • SLB Negeri Grobogan</p>
                </div>
            </div>
            <button @click="open = false"
                    aria-label="Tutup panel aksesibilitas"
                    class="w-7 h-7 rounded-lg bg-slate-800 text-slate-400 hover:text-white flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Scrollable Options Body -->
        <div class="p-5 space-y-5 overflow-y-auto flex-1 text-slate-800 text-xs">

            <!-- 1. Text Resizing (Ukuran Teks) -->
            <div>
                <label class="block font-bold text-slate-900 text-xs uppercase tracking-wider mb-2 flex items-center justify-between">
                    <span>Ukuran Teks</span>
                    <span class="text-[10px] font-normal text-slate-400" x-text="fontSize === 'normal' ? 'Normal (100%)' : (fontSize === 'lg' ? 'Besar (+15%)' : 'Sangat Besar (+30%)')"></span>
                </label>
                <div class="grid grid-cols-3 gap-2">
                    <button @click="setFont('normal')"
                            type="button"
                            :class="fontSize === 'normal' ? 'bg-blue-900 text-white font-bold shadow-sm' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'"
                            class="py-2.5 px-3 rounded-xl text-center text-xs transition border border-transparent">
                        A <span class="text-[10px] block opacity-80">Normal</span>
                    </button>
                    <button @click="setFont('lg')"
                            type="button"
                            :class="fontSize === 'lg' ? 'bg-blue-900 text-white font-bold shadow-sm' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'"
                            class="py-2.5 px-3 rounded-xl text-center text-sm font-semibold transition border border-transparent">
                        A+ <span class="text-[10px] block opacity-80">Besar</span>
                    </button>
                    <button @click="setFont('xl')"
                            type="button"
                            :class="fontSize === 'xl' ? 'bg-blue-900 text-white font-bold shadow-sm' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'"
                            class="py-2.5 px-3 rounded-xl text-center text-base font-bold transition border border-transparent">
                        A++ <span class="text-[10px] block opacity-80">Maksimal</span>
                    </button>
                </div>
            </div>

            <!-- 2. Contrast & Vision Modes (Warna & Kontras) -->
            <div>
                <label class="block font-bold text-slate-900 text-xs uppercase tracking-wider mb-2">
                    Kontras & Tampilan Visual
                </label>
                <div class="grid grid-cols-2 gap-2">
                    <!-- High Contrast -->
                    <button @click="toggleContrast()"
                            type="button"
                            :class="highContrast ? 'bg-amber-400 text-slate-950 font-extrabold border-amber-500' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-transparent'"
                            class="p-2.5 rounded-xl text-left border flex items-center gap-2 transition">
                        <span class="w-3.5 h-3.5 rounded-full border-2 border-current shrink-0"></span>
                        <span class="text-xs">Kontras Tinggi</span>
                    </button>

                    <!-- Grayscale / Monokrom -->
                    <button @click="toggleGrayscale()"
                            type="button"
                            :class="grayscale ? 'bg-amber-400 text-slate-950 font-extrabold border-amber-500' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-transparent'"
                            class="p-2.5 rounded-xl text-left border flex items-center gap-2 transition">
                        <span class="w-3.5 h-3.5 rounded-full bg-slate-500 shrink-0"></span>
                        <span class="text-xs">Hitam Putih</span>
                    </button>

                    <!-- Invert Colors -->
                    <button @click="toggleInvert()"
                            type="button"
                            :class="invert ? 'bg-amber-400 text-slate-950 font-extrabold border-amber-500' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-transparent'"
                            class="p-2.5 rounded-xl text-left border flex items-center gap-2 transition col-span-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <span class="text-xs">Pembalikan Warna (Invert)</span>
                    </button>
                </div>
            </div>

            <!-- 3. Readability & Navigation (Keterbacaan) -->
            <div>
                <label class="block font-bold text-slate-900 text-xs uppercase tracking-wider mb-2">
                    Keterbacaan & Navigasi
                </label>
                <div class="space-y-2">
                    <!-- Highlight Links -->
                    <button @click="toggleHighlightLinks()"
                            type="button"
                            :class="highlightLinks ? 'bg-blue-50 text-blue-900 border-blue-400 font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-transparent'"
                            class="w-full p-2.5 rounded-xl text-left border flex items-center justify-between transition">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            <span>Sorot Semua Tautan (Highlight Links)</span>
                        </span>
                        <span class="w-4 h-4 rounded-md flex items-center justify-center border text-[10px]" :class="highlightLinks ? 'bg-blue-900 text-white border-blue-900' : 'border-slate-300'">
                            <span x-show="highlightLinks">✓</span>
                        </span>
                    </button>

                    <!-- Dyslexia Font -->
                    <button @click="toggleDyslexia()"
                            type="button"
                            :class="dyslexiaFont ? 'bg-blue-50 text-blue-900 border-blue-400 font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-transparent'"
                            class="w-full p-2.5 rounded-xl text-left border flex items-center justify-between transition">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>Font Ramah Disleksia (Spasi Luas)</span>
                        </span>
                        <span class="w-4 h-4 rounded-md flex items-center justify-center border text-[10px]" :class="dyslexiaFont ? 'bg-blue-900 text-white border-blue-900' : 'border-slate-300'">
                            <span x-show="dyslexiaFont">✓</span>
                        </span>
                    </button>

                    <!-- Pause Animations -->
                    <button @click="toggleAnim()"
                            type="button"
                            :class="pauseAnim ? 'bg-blue-50 text-blue-900 border-blue-400 font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-transparent'"
                            class="w-full p-2.5 rounded-xl text-left border flex items-center justify-between transition">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Hentikan Gerakan & Animasi</span>
                        </span>
                        <span class="w-4 h-4 rounded-md flex items-center justify-center border text-[10px]" :class="pauseAnim ? 'bg-blue-900 text-white border-blue-900' : 'border-slate-300'">
                            <span x-show="pauseAnim">✓</span>
                        </span>
                    </button>
                </div>
            </div>

        </div>

        <!-- Panel Footer (Reset Button) -->
        <div class="p-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between shrink-0">
            <span class="text-[10px] text-slate-400">Tersimpan otomatis di browser</span>
            <button @click="resetAll()"
                    type="button"
                    class="px-3 py-1.5 rounded-xl text-[11px] font-bold text-rose-600 hover:bg-rose-50 border border-rose-200 transition">
                Reset Pengaturan
            </button>
        </div>

    </div>
</div>

<!-- ACCESSIBILITY GLOBAL INJECTED STYLES -->
<style>
    /* Font Scaling */
    html.a11y-font-lg { font-size: 115% !important; }
    html.a11y-font-xl { font-size: 128% !important; }

    /* Grayscale Mode */
    html.a11y-grayscale {
        filter: grayscale(100%) !important;
    }

    /* Color Inversion Mode (Safe for Images & Videos) */
    html.a11y-invert {
        filter: invert(100%) hue-rotate(180deg) !important;
    }
    html.a11y-invert img,
    html.a11y-invert video,
    html.a11y-invert iframe {
        filter: invert(100%) hue-rotate(180deg) !important;
    }

    /* High Contrast Mode */
    body.a11y-contrast {
        background-color: #000000 !important;
        color: #FFFFFF !important;
    }
    body.a11y-contrast p,
    body.a11y-contrast span:not(.a11y-exempt),
    body.a11y-contrast h1,
    body.a11y-contrast h2,
    body.a11y-contrast h3,
    body.a11y-contrast h4,
    body.a11y-contrast h5,
    body.a11y-contrast h6 {
        color: #FFFFFF !important;
    }
    body.a11y-contrast a {
        color: #FACC15 !important;
        text-decoration: underline !important;
    }
    body.a11y-contrast div.bg-white,
    body.a11y-contrast section.bg-white,
    body.a11y-contrast div.bg-slate-50 {
        background-color: #121827 !important;
        border-color: #374151 !important;
    }

    /* Highlight Links */
    body.a11y-highlight-links a {
        text-decoration: underline 2px #F59E0B !important;
        background-color: rgba(254, 240, 138, 0.3) !important;
        color: #1E3A8A !important;
        border-radius: 4px;
        padding-left: 2px;
        padding-right: 2px;
    }

    /* Dyslexia-Friendly Typography */
    body.a11y-dyslexia * {
        letter-spacing: 0.04em !important;
        line-height: 1.85 !important;
    }

    /* Stop Motion / Pause Animations */
    body.a11y-no-anim *,
    body.a11y-no-anim *::before,
    body.a11y-no-anim *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
    }
</style>

