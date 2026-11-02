@php
    $footerNavigations = \App\Models\Navigation::active()->footer()->orderBy('order', 'asc')->get();
@endphp

<footer class="bg-[#0B1528] text-slate-300 pt-16 pb-12 border-t border-slate-900 relative overflow-hidden">
    <!-- Subtle Ambient Glow -->
    <div class="absolute -top-40 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 mb-16">

            <!-- Col 1: School Identity (span 4) -->
            <div class="lg:col-span-4 space-y-5">
                <div class="flex items-center gap-3.5">
                    @if($settings->logo_dark || $settings->logo_light)
                        <img src="{{ asset('storage/' . ($settings->logo_dark ?? $settings->logo_light)) }}" alt="{{ $settings->school_name }}" class="h-12 w-auto object-contain">
                    @else
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-950 via-blue-900 to-sky-700 text-white flex items-center justify-center font-black text-xl shadow-lg shadow-blue-950/40 border-2 border-amber-400/40 shrink-0">
                            <svg class="w-7 h-7 text-amber-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L3 6v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V6l-9-4zm0 4a3 3 0 110 6 3 3 0 010-6zm4.5 11.5c0-.83-.42-1.57-1.07-2.01A5.96 5.96 0 0012 14.5c-1.27 0-2.43.39-3.43 1A2.5 2.5 0 007.5 17.5v.71C8.79 19.38 10.32 20 12 20s3.21-.62 4.5-1.79v-.71z"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-display font-extrabold text-white text-lg leading-tight">{{ $settings->school_name }}</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-amber-400 font-bold">NPSN: {{ $settings->npsn }}</span>
                            <span class="text-slate-600">•</span>
                            <span class="text-xs text-slate-300 font-medium">Terakreditasi A Unggul</span>
                        </div>
                    </div>
                </div>

                <p class="text-sm text-slate-400 leading-relaxed font-normal">
                    {{ $settings->tagline }}. Lembaga pendidikan berwawasan global yang membina insan cendekia berakhlak mulia dan berdaya saing internasional.
                </p>

                <!-- Official Ministry Recognition Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-900/90 border border-slate-800 text-xs text-slate-300">
                    <svg class="w-4 h-4 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Kementerian Pendidikan Dasar & Menengah RI</span>
                </div>

                <!-- Social Media Links -->
                <div class="flex items-center gap-2 pt-2">
                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-blue-600 text-slate-300 hover:text-white flex items-center justify-center transition border border-slate-800" title="Facebook">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-pink-600 text-slate-300 hover:text-white flex items-center justify-center transition border border-slate-800" title="Instagram">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-red-600 text-slate-300 hover:text-white flex items-center justify-center transition border border-slate-800" title="YouTube">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                    @if($settings->tiktok_url)
                        <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition border border-slate-800" title="TikTok">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-1.01-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 2.89 3.5 2.71 1.52-.07 2.8-1.19 3.04-2.68.08-.5.08-1.02.08-1.53V.02z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Col 2: Dynamic Footer Nav / Profil (span 2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="font-display text-white font-bold text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <span>Profil Sekolah</span>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda Utama</a></li>
                    @foreach($footerNavigations as $nav)
                        <li><a href="{{ $nav->resolved_url }}" target="{{ $nav->target }}" class="hover:text-white transition">{{ $nav->title }}</a></li>
                    @endforeach
                    <li><a href="{{ route('teachers.index') }}" class="hover:text-white transition">Dewan Guru & Staf</a></li>
                    <li><a href="{{ route('extracurriculars.index') }}" class="hover:text-white transition">Ekstrakurikuler</a></li>
                </ul>
            </div>

            <!-- Col 3: Layanan Digital & Informasi (span 3) -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="font-display text-white font-bold text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>Layanan & Informasi</span>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-400">
                    @if($settings->ppdb_is_active)
                        <li>
                            <a href="{{ route('ppdb.index') }}" class="hover:text-amber-300 font-bold text-amber-400 flex items-center gap-1.5 transition">
                                <span>Pendaftaran PPDB Online</span>
                                <span class="px-1.5 py-0.5 rounded text-[9px] bg-amber-400/20 uppercase font-black">Buka</span>
                            </a>
                        </li>
                    @endif
                    @if($settings->graduation_is_active)
                        <li><a href="{{ route('kelulusan.index') }}" class="hover:text-white transition">Pengumuman Kelulusan (NISN)</a></li>
                    @endif
                    <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">Warta & Berita Sekolah</a></li>
                    <li><a href="{{ route('agenda.index') }}" class="hover:text-white transition">Kalender & Agenda Kegiatan</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition">Galeri Foto & Dokumentasi</a></li>
                    <li><a href="{{ route('downloads.index') }}" class="hover:text-white transition">Pusat Unduhan Dokumen</a></li>
                    <li><a href="{{ route('lpj.index') }}" class="hover:text-white transition">Laporan LPJ Sekolah</a></li>
                    <li><a href="{{ route('buku-non-teks.index') }}" class="hover:text-white transition">Buku Nonteks Pelajaran</a></li>
                    <li><a href="{{ url('/admin') }}" class="hover:text-sky-300 transition text-slate-500">Masuk Panel Admin</a></li>
                </ul>
            </div>

            <!-- Col 4: Kontak & Alamat (span 3) -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="font-display text-white font-bold text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Hubungi Kami</span>
                </h4>
                <div class="space-y-3 text-xs text-slate-400">
                    <p class="leading-relaxed flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-sky-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $settings->address }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ $settings->phone }}" class="hover:text-white transition">{{ $settings->phone }}</a>
                    </p>
                    @if($settings->whatsapp)
                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp) }}" target="_blank" class="hover:text-emerald-300 text-emerald-400 font-medium transition">{{ $settings->whatsapp }} (WhatsApp)</a>
                        </p>
                    @endif
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ $settings->email }}" class="hover:text-white transition">{{ $settings->email }}</a>
                    </p>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright Line -->
        <div class="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <p>© {{ date('Y') }} <strong class="text-white font-bold">{{ $settings->school_name }}</strong>. Seluruh Hak Cipta Dilindungi.</p>
            <p class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 text-slate-300 font-semibold">
                    <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Terakreditasi BAN-S/M Unggul
                </span>
                <span>•</span>
                <span>Portal Resmi Sekolah</span>
            </p>
        </div>
    </div>
</footer>
