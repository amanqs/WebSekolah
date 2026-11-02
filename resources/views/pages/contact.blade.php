@extends('layouts.app')

@section('title', 'Kontak & Lokasi - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Pusat Layanan & Informasi</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Kontak & Lokasi Kampus
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Kunjungi kampus kami atau hubungi tim administrasi sekolah melalui saluran komunikasi resmi di bawah ini.
            </p>
        </div>
    </div>

    <div class="py-12 sm:py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

                <!-- Contact Info & Quick Message (span 5) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
                        <h3 class="font-display font-bold text-base text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-900"></span>
                            <span>Saluran Informasi Resmi</span>
                        </h3>

                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-900 flex items-center justify-center shrink-0 border border-blue-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900">Alamat Kampus</h4>
                                <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">{{ $settings->address }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-900 flex items-center justify-center shrink-0 border border-blue-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900">Telepon Kantor</h4>
                                <p class="text-xs text-slate-600 mt-0.5"><a href="tel:{{ $settings->phone }}" class="hover:text-blue-900">{{ $settings->phone }}</a></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-900 flex items-center justify-center shrink-0 border border-blue-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900">Surat Elektronik (Email)</h4>
                                <p class="text-xs text-slate-600 mt-0.5"><a href="mailto:{{ $settings->email }}" class="hover:text-blue-900">{{ $settings->email }}</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick WhatsApp Direct Message Form -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
                        <h3 class="font-display font-bold text-sm text-slate-900 mb-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Kirim Pesan Cepat</span>
                        </h3>
                        <p class="text-xs text-slate-500 mb-4">Pesan Anda akan otomatis terhubung ke WhatsApp Admin Sekolah.</p>

                        <form onsubmit="event.preventDefault(); const n = document.getElementById('c_name').value; const t = document.getElementById('c_topic').value; const m = document.getElementById('c_msg').value; const text = encodeURIComponent(`Halo Admin {{ $settings->school_name }},\n\nNama: ${n}\nKeperluan: ${t}\nPesan: ${m}`); window.open(`https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp) }}?text=${text}`, '_blank');" class="space-y-3.5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Anda *</label>
                                <input type="text" id="c_name" required placeholder="Contoh: Rian Hidayat" class="w-full rounded-xl border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 text-slate-900 bg-slate-50/50">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Topik Keperluan *</label>
                                <select id="c_topic" class="w-full rounded-xl border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 text-slate-900 bg-slate-50/50">
                                    <option value="Informasi PPDB Online">Informasi PPDB Online</option>
                                    <option value="Administrasi & Akademik">Administrasi & Akademik</option>
                                    <option value="Legalisir Ijazah & Kelulusan">Legalisir Ijazah & Kelulusan</option>
                                    <option value="Kemitraan / Saran Masukan">Kemitraan / Saran Masukan</option>
                                    <option value="Pertanyaan Umum Lainnya">Pertanyaan Umum Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Isi Pesan / Pertanyaan *</label>
                                <textarea id="c_msg" rows="3" required placeholder="Tuliskan pertanyaan Anda..." class="w-full rounded-xl border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 text-slate-900 bg-slate-50/50"></textarea>
                            </div>

                            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 2C6.516 2 2.031 6.484 2.031 12c0 1.93.548 3.734 1.498 5.267L2 22l4.898-1.502c1.48.887 3.208 1.502 5.133 1.502 5.516 0 10-4.484 10-10s-4.484-10-10-10zm0 18.258c-1.636 0-3.15-.47-4.444-1.28l-.318-.2-2.902.89.897-2.83-.207-.33A8.204 8.204 0 013.78 12c0-4.55 3.7-8.25 8.25-8.25 4.552 0 8.25 3.7 8.25 8.25 0 4.55-3.698 8.258-8.25 8.258zm4.524-6.18c-.248-.124-1.464-.723-1.691-.806-.228-.083-.393-.124-.559.124-.165.248-.642.806-.787.971-.144.165-.29.186-.537.062-.248-.124-1.047-.386-1.995-1.232-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.015-.382.109-.505.111-.112.248-.29.372-.435.124-.145.166-.248.248-.414.083-.166.042-.311-.02-.435-.063-.124-.559-1.348-.767-1.846-.202-.486-.407-.42-.559-.428l-.476-.008c-.165 0-.435.062-.663.311-.228.248-.87 0.85-.87 2.073 0 1.223.89 2.406 1.014 2.572.124.165 1.752 2.675 4.244 3.751.593.256 1.056.409 1.417.524.595.189 1.137.162 1.565.098.478-.072 1.464-.599 1.671-1.178.207-.579.207-1.076.145-1.178-.062-.104-.228-.166-.476-.29z"/></svg>
                                <span>Kirim Pesan via WhatsApp</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Google Maps (span 7) -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-sm overflow-hidden h-full flex flex-col">
                        <h3 class="font-display font-bold text-sm text-slate-900 px-2 py-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                            <span>Peta Lokasi Kampus</span>
                        </h3>
                        <div class="flex-1 rounded-xl overflow-hidden min-h-[420px] [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:min-h-[420px] [&>iframe]:border-0 shadow-inner">
                            @if($settings->maps_embed)
                                {!! $settings->maps_embed !!}
                            @else
                                <div class="w-full h-full bg-slate-50 flex items-center justify-center text-slate-400 text-xs">
                                    Peta Google Maps belum dikonfigurasi di Pengaturan Sekolah.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
