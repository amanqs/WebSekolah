<div class="max-w-4xl mx-auto">
    <!-- Countdown Box if release time is in the future -->
    @if($isLocked && $targetDate)
        <div x-data="countdownTimer('{{ $targetDate->toISOString() }}')" x-init="init()" class="bg-gradient-to-br from-blue-950 via-slate-900 to-blue-900 text-white rounded-3xl p-8 sm:p-12 shadow-xl text-center mb-10 relative overflow-hidden border border-sky-400/20">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-900/80 backdrop-blur-md text-amber-300 text-xs font-black uppercase tracking-wider mb-4 border border-sky-400/30">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    Hitung Mundur Pembukaan Pengumuman
                </span>
                <h2 class="font-display font-black text-2xl sm:text-4xl text-white mb-2">
                    Tahun Ajaran {{ $settings->graduation_academic_year }}
                </h2>
                <p class="text-slate-200 text-xs sm:text-sm max-w-lg mx-auto mb-8 font-normal leading-relaxed">
                    Akses pengecekan status kelulusan peserta didik akan dibuka serentak secara daring pada:
                    <span class="block font-bold text-white text-base mt-1">{{ $targetDate->translatedFormat('l, d F Y - H:i') }} WIB</span>
                </p>

                <div class="grid grid-cols-4 gap-3 sm:gap-6 max-w-lg mx-auto">
                    <div class="bg-sky-950/60 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-sky-400/20 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-amber-400 font-mono" x-text="days">00</div>
                        <div class="text-[10px] sm:text-xs uppercase tracking-wider text-slate-300 font-bold mt-1">Hari</div>
                    </div>
                    <div class="bg-sky-950/60 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-sky-400/20 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-white font-mono" x-text="hours">00</div>
                        <div class="text-[10px] sm:text-xs uppercase tracking-wider text-slate-300 font-bold mt-1">Jam</div>
                    </div>
                    <div class="bg-sky-950/60 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-sky-400/20 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-white font-mono" x-text="minutes">00</div>
                        <div class="text-[10px] sm:text-xs uppercase tracking-wider text-slate-300 font-bold mt-1">Menit</div>
                    </div>
                    <div class="bg-sky-950/60 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-sky-400/20 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-white font-mono" x-text="seconds">00</div>
                        <div class="text-[10px] sm:text-xs uppercase tracking-wider text-slate-300 font-bold mt-1">Detik</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Search Box Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-7 sm:p-12 mb-10 no-print">
            <div class="text-center max-w-xl mx-auto mb-8">
                <div class="w-16 h-16 bg-sky-100 text-blue-900 rounded-3xl flex items-center justify-center mx-auto mb-4 border border-sky-200 shadow-sm">
                    <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </div>
                <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 mb-2">Pengecekan Status Kelulusan</h2>
                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                    Silakan masukkan 10 digit Nomor Induk Siswa Nasional (NISN) Anda untuk melihat surat keputusan kelulusan resmi dari {{ $settings->school_name }}.
                </p>
            </div>

            <form wire:submit.prevent="check" class="max-w-lg mx-auto">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Nomor Induk Siswa Nasional (NISN) *
                        </label>
                        <div class="relative">
                            <input type="text"
                                   wire:model="nisn"
                                   maxlength="10"
                                   placeholder="Contoh: 0012345678"
                                   class="w-full pl-5 pr-12 py-3.5 rounded-2xl border-2 border-slate-200 text-base font-mono tracking-widest focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-slate-900 bg-sky-50/30 focus:bg-white transition">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>
                        @error('nisn') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">
                            Tanggal Lahir (Opsional - Validasi Keamanan)
                        </label>
                        <input type="date" wire:model="birth_date" class="w-full py-3 px-4 rounded-2xl border border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-700 transition">
                    </div>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full py-4 rounded-2xl bg-blue-900 text-white font-black text-sm uppercase tracking-wider hover:bg-blue-800 shadow-md shadow-blue-900/30 transition flex items-center justify-center gap-2">
                        <span wire:loading.remove class="inline-flex items-center gap-2">
                            <span>Periksa Status Kelulusan Sekarang</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                        <span wire:loading>Memverifikasi Data Siswa...</span>
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Error / Not Found Alert -->
    @if($errorMessage)
        <div class="bg-rose-50 border border-rose-200 p-5 rounded-3xl mb-8 flex items-start gap-4 animate-fade-in no-print">
            <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h4 class="font-bold text-rose-900 text-sm">Data Tidak Ditemukan</h4>
                <p class="text-xs sm:text-sm text-rose-700 mt-0.5 leading-relaxed">{{ $errorMessage }}</p>
            </div>
        </div>
    @endif

    <!-- Result Display Card (Official Certificate Layout) -->
    @if($result)
        <div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden animate-fade-in mb-10 print:shadow-none print:border-none print:m-0">
            <!-- Printable School Letterhead Header -->
            <div class="hidden print:block p-6 border-b-2 border-black text-center">
                <h2 class="text-xl font-bold uppercase">{{ $settings->school_name }}</h2>
                <p class="text-xs">{{ $settings->address }} | Telp: {{ $settings->phone }} | Email: {{ $settings->email }}</p>
                <div class="border-b border-black mt-2"></div>
            </div>

            <div class="p-8 sm:p-12 text-center
                {{ $result->status === 'lulus' ? 'bg-gradient-to-b from-emerald-50/90 to-white' : ($result->status === 'tidak_lulus' ? 'bg-gradient-to-b from-rose-50/90 to-white' : 'bg-gradient-to-b from-amber-50/90 to-white') }}">

                @if($result->status === 'lulus')
                    <div class="w-24 h-24 bg-emerald-500 text-white rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-emerald-500/30">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-black tracking-widest uppercase mb-3 border border-emerald-200">
                        Surat Keputusan Kelulusan Resmi
                    </span>
                    <h3 class="font-display text-3xl sm:text-5xl font-black text-emerald-700 tracking-tight mb-2">
                        DINYATAKAN LULUS
                    </h3>
                    <p class="text-emerald-900 text-xs sm:text-sm max-w-lg mx-auto font-medium leading-relaxed">
                        Selamat atas kelulusan dan prestasi gemilang Anda di {{ $settings->school_name }}! Semoga ilmu yang didapat bermanfaat untuk masa depan.
                    </p>
                @elseif($result->status === 'tidak_lulus')
                    <div class="w-24 h-24 bg-rose-500 text-white rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-rose-500/30">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-rose-100 text-rose-800 text-xs font-black tracking-widest uppercase mb-3 border border-rose-200">
                        Surat Keputusan Kelulusan Resmi
                    </span>
                    <h3 class="font-display text-3xl sm:text-5xl font-black text-rose-700 tracking-tight mb-2">
                        BELUM MEMENUHI SYARAT KELULUSAN
                    </h3>
                    <p class="text-rose-900 text-xs sm:text-sm max-w-lg mx-auto font-medium leading-relaxed">
                        Harap segera hadir ke sekolah bersama orang tua/wali untuk berkonsultasi dengan bagian Kurikulum dan Guru BK.
                    </p>
                @else
                    <div class="w-24 h-24 bg-amber-500 text-white rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-amber-500/30">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-black tracking-widest uppercase mb-3 border border-amber-200">
                        Pemberitahuan Akademik
                    </span>
                    <h3 class="font-display text-3xl sm:text-5xl font-black text-amber-700 tracking-tight mb-2">
                        STATUS DITUNDA
                    </h3>
                    <p class="text-amber-900 text-xs sm:text-sm max-w-lg mx-auto font-medium leading-relaxed">
                        Pengumuman kelulusan Anda tertunda. Mohon segera melengkapi kewajiban administrasi akademik di ruang Tata Usaha.
                    </p>
                @endif
            </div>

            <!-- Student Bio Details Grid -->
            <div class="p-6 sm:p-10 border-t border-sky-100 bg-white">
                <div class="bg-sky-50/50 rounded-3xl p-6 sm:p-8 border border-sky-100 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-xs sm:text-sm">
                    <div class="bg-white p-3.5 rounded-2xl border border-sky-100/70">
                        <span class="text-slate-400 text-xs uppercase tracking-wider block">Nama Lengkap Siswa</span>
                        <span class="font-black text-slate-900 text-base">{{ $result->name }}</span>
                    </div>
                    <div class="bg-white p-3.5 rounded-2xl border border-sky-100/70">
                        <span class="text-slate-400 text-xs uppercase tracking-wider block">Nomor Induk Siswa Nasional (NISN)</span>
                        <span class="font-mono font-black text-slate-900 text-base">{{ $result->nisn }}</span>
                    </div>
                    <div class="bg-white p-3.5 rounded-2xl border border-sky-100/70">
                        <span class="text-slate-400 text-xs uppercase tracking-wider block">Kelas / Rombel</span>
                        <span class="font-bold text-slate-900">{{ $result->class_name }}</span>
                    </div>
                    <div class="bg-white p-3.5 rounded-2xl border border-sky-100/70">
                        <span class="text-slate-400 text-xs uppercase tracking-wider block">Nomor Peserta Ujian</span>
                        <span class="font-mono font-bold text-slate-900">{{ $result->exam_number ?? '-' }}</span>
                    </div>
                    @if($result->average_score)
                        <div class="bg-white p-3.5 rounded-2xl border border-sky-100/70">
                            <span class="text-slate-400 text-xs uppercase tracking-wider block">Nilai Rata-Rata Akhir</span>
                            <span class="font-black text-blue-900 text-xl">{{ number_format($result->average_score, 2) }}</span>
                        </div>
                    @endif
                    <div class="bg-white p-3.5 rounded-2xl border border-sky-100/70">
                        <span class="text-slate-400 text-xs uppercase tracking-wider block">Tahun Ajaran Kelulusan</span>
                        <span class="font-bold text-slate-800">{{ $result->academic_year }}</span>
                    </div>
                </div>

                @if($result->note)
                    <div class="mt-6 p-5 rounded-2xl bg-sky-50 border border-sky-200">
                        <div class="text-xs font-black uppercase tracking-wider text-blue-900 mb-1">
                            Catatan Resmi Sekolah & Jadwal Pengambilan Ijazah/SKL:
                        </div>
                        <p class="text-xs sm:text-sm text-blue-950 leading-relaxed">{{ $result->note }}</p>
                    </div>
                @endif

                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center items-center no-print">
                    <button type="button" onclick="window.print()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-blue-900 hover:bg-blue-800 text-white font-bold text-xs sm:text-sm transition shadow-md shadow-blue-900/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Cetak Bukti Kelulusan Ini</span>
                    </button>
                    <button type="button" wire:click="resetSearch" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl border border-slate-300 text-slate-700 font-bold text-xs sm:text-sm hover:bg-sky-50 transition">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span>Cek Data Siswa Lain</span>
                    </button>
                </div>
            </div>
        </div>

        <style>
            @media print {
                header, footer, nav, .no-print {
                    display: none !important;
                }
                body {
                    background: white !important;
                    color: black !important;
                }
            }
        </style>
    @endif
</div>

<script>
    window.countdownTimer = function(targetIso) {
        return {
            target: new Date(targetIso).getTime(),
            days: '00',
            hours: '00',
            minutes: '00',
            seconds: '00',
            timer: null,
            init() {
                this.update();
                this.timer = setInterval(() => this.update(), 1000);
            },
            update() {
                const now = new Date().getTime();
                const diff = this.target - now;
                if (diff <= 0) {
                    clearInterval(this.timer);
                    location.reload();
                    return;
                }
                this.days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                this.hours = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                this.minutes = String(Math.floor((diff % (1000 * 60)) / (1000 * 60))).padStart(2, '0');
                this.seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
            }
        }
    }
</script>
