<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    @if(!$settings->ppdb_is_active)
        <div class="p-8 sm:p-14 text-center">
            <div class="w-20 h-20 bg-amber-50 text-amber-600 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-amber-200 shadow-sm">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 mb-2">Pendaftaran PPDB Sedang Ditutup</h2>
            <p class="text-slate-600 text-sm sm:text-base max-w-lg mx-auto mb-8 leading-relaxed">
                {{ $settings->ppdb_announcement ?: 'Mohon maaf, loket pendaftaran daring peserta didik baru saat ini sedang dinonaktifkan. Silakan hubungi bagian administrasi sekolah untuk informasi jadwal pembukaan gelombang berikutnya.' }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('home') }}" class="px-7 py-3 rounded-2xl bg-blue-950 text-white font-bold text-sm hover:bg-blue-900 transition shadow-sm">
                    Kembali ke Beranda
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp) }}" target="_blank" class="px-7 py-3 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold text-sm hover:bg-emerald-100 transition flex items-center gap-2">
                    <svg class="w-4 h-4 fill-current text-emerald-600" viewBox="0 0 24 24"><path d="M12.031 2C6.516 2 2.031 6.484 2.031 12c0 1.93.548 3.734 1.498 5.267L2 22l4.898-1.502c1.48.887 3.208 1.502 5.133 1.502 5.516 0 10-4.484 10-10s-4.484-10-10-10zm0 18.258c-1.636 0-3.15-.47-4.444-1.28l-.318-.2-2.902.89.897-2.83-.207-.33A8.204 8.204 0 013.78 12c0-4.55 3.7-8.25 8.25-8.25 4.552 0 8.25 3.7 8.25 8.25 0 4.55-3.698 8.258-8.25 8.258zm4.524-6.18c-.248-.124-1.464-.723-1.691-.806-.228-.083-.393-.124-.559.124-.165.248-.642.806-.787.971-.144.165-.29.186-.537.062-.248-.124-1.047-.386-1.995-1.232-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.015-.382.109-.505.111-.112.248-.29.372-.435.124-.145.166-.248.248-.414.083-.166.042-.311-.02-.435-.063-.124-.559-1.348-.767-1.846-.202-.486-.407-.42-.559-.428l-.476-.008c-.165 0-.435.062-.663.311-.228.248-.87 0.85-.87 2.073 0 1.223.89 2.406 1.014 2.572.124.165 1.752 2.675 4.244 3.751.593.256 1.056.409 1.417.524.595.189 1.137.162 1.565.098.478-.072 1.464-.599 1.671-1.178.207-.579.207-1.076.145-1.178-.062-.104-.228-.166-.476-.29z"/></svg>
                    <span>Hubungi Panitia via WhatsApp</span>
                </a>
            </div>
        </div>
    @elseif($isSubmitted)
        <div class="p-8 sm:p-14 text-center animate-fade-in">
            <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-emerald-200 shadow-md shadow-emerald-500/10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-800 text-xs font-black uppercase tracking-wider mb-3 border border-emerald-200">
                Pendaftaran Berhasil Dikirim
            </span>
            <h2 class="font-display font-black text-2xl sm:text-4xl text-slate-900 mb-2">Selamat, {{ $registeredData->full_name }}!</h2>
            <p class="text-slate-600 text-sm sm:text-base max-w-md mx-auto mb-8 leading-relaxed">
                Data formulir pendaftaran PPDB Anda telah kami terima dan masuk ke sistem database seleksi {{ $settings->school_name }}.
            </p>

            <div class="bg-gradient-to-br from-sky-50 via-blue-50/60 to-indigo-50/40 border border-sky-200 rounded-3xl p-6 sm:p-8 max-w-md mx-auto mb-8 text-left shadow-sm">
                <div class="text-xs font-black uppercase text-blue-900 tracking-wider mb-2">Nomor Registrasi Resmi Anda</div>
                <div class="flex items-center justify-between gap-3 bg-white p-3.5 rounded-2xl border border-sky-200 shadow-sm">
                    <div class="text-2xl font-black text-blue-950 font-mono tracking-wider">{{ $registrationNumber }}</div>
                    <button type="button" onclick="navigator.clipboard.writeText('{{ $registrationNumber }}'); alert('Nomor registrasi berhasil disalin!');" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-sky-50 border border-sky-200 rounded-xl text-xs font-black text-blue-900 hover:bg-sky-100 transition shrink-0">
                        <svg class="w-3.5 h-3.5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Salin</span>
                    </button>
                </div>
                <p class="text-xs text-sky-900/80 mt-3 leading-relaxed">
                    *Harap catat dan simpan nomor registrasi di atas. Nomor ini digunakan untuk pengecekan berkala status kelolosan dan verifikasi fisik di sekolah.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('ppdb.print-card', $registrationNumber) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-2xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold shadow-md shadow-blue-900/20 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Kartu Pendaftaran (PDF)</span>
                </a>
                <button type="button" wire:click="$set('isSubmitted', false)" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-2xl border border-slate-300 text-slate-700 font-bold hover:bg-sky-50 transition">
                    Daftar Siswa Lain
                </button>
            </div>
        </div>
    @else
        <!-- Mode Switcher Tabs -->
        <div class="flex border-b border-sky-100 bg-sky-50/50 p-2 gap-2">
            <button type="button"
                    wire:click="switchTab('register')"
                    class="flex-1 py-3 px-4 rounded-2xl text-center text-xs sm:text-sm font-black transition flex items-center justify-center gap-2 {{ $activeTab === 'register' ? 'bg-white text-blue-900 shadow-sm border border-sky-100' : 'text-slate-600 hover:text-blue-900' }}">
                <svg class="w-4 h-4 {{ $activeTab === 'register' ? 'text-blue-900' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Formulir Pendaftaran Baru</span>
            </button>
            <button type="button"
                    wire:click="switchTab('check_status')"
                    class="flex-1 py-3 px-4 rounded-2xl text-center text-xs sm:text-sm font-black transition flex items-center justify-center gap-2 {{ $activeTab === 'check_status' ? 'bg-white text-blue-900 shadow-sm border border-sky-100' : 'text-slate-600 hover:text-blue-900' }}">
                <svg class="w-4 h-4 {{ $activeTab === 'check_status' ? 'text-blue-900' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span>Cek Status & Cetak Kartu</span>
            </button>
        </div>

        @if($activeTab === 'check_status')
            <!-- Check Status View -->
            <div class="p-6 md:p-12 max-w-2xl mx-auto space-y-8 animate-fade-in">
                <div class="text-center">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 text-blue-900 flex items-center justify-center mx-auto mb-3 border border-sky-200 shadow-sm">
                        <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="font-display font-black text-xl sm:text-2xl text-slate-900">Pengecekan Status Pendaftaran</h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Masukkan Nomor Registrasi (contoh: <span class="font-mono text-slate-700">PPDB-{{ date('Y') }}-0001</span>) atau NISN calon siswa.
                    </p>
                </div>

                <form wire:submit.prevent="checkStatus" class="space-y-4">
                    <div class="relative">
                        <input type="text"
                               wire:model="searchRegNumber"
                               placeholder="Ketik Nomor Registrasi atau 10 digit NISN..."
                               class="w-full pl-5 pr-28 py-3.5 rounded-2xl border-2 border-slate-200 text-sm sm:text-base font-mono focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-slate-900 bg-sky-50/30 focus:bg-white transition">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 px-5 rounded-xl bg-blue-900 text-white font-extrabold text-xs hover:bg-blue-800 shadow-sm transition">
                            Cari Data
                        </button>
                    </div>
                    @error('searchRegNumber') <span class="text-red-500 text-xs block font-bold">{{ $message }}</span> @enderror
                </form>

                @if($searchError)
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span class="font-semibold">{{ $searchError }}</span>
                    </div>
                @endif

                @if($searchedApplicant)
                    <div class="bg-sky-50/50 rounded-3xl p-6 sm:p-7 border border-sky-200 space-y-5 animate-fade-in shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-sky-200 gap-3">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Calon Peserta Didik</span>
                                <h4 class="font-display font-black text-xl text-slate-900">{{ $searchedApplicant->full_name }}</h4>
                            </div>
                            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-black tracking-wider uppercase text-center shrink-0
                                {{ $searchedApplicant->status === 'accepted' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : ($searchedApplicant->status === 'rejected' ? 'bg-rose-100 text-rose-800 border border-rose-200' : ($searchedApplicant->status === 'verified' ? 'bg-sky-100 text-blue-900 border border-sky-200' : 'bg-amber-100 text-amber-800 border border-amber-200')) }}">
                                {{ $searchedApplicant->status_label }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                            <div class="bg-white p-3 rounded-2xl border border-sky-100">
                                <span class="text-slate-400 block text-xs">No. Registrasi</span>
                                <span class="font-mono font-black text-slate-900">{{ $searchedApplicant->registration_number }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-2xl border border-sky-100">
                                <span class="text-slate-400 block text-xs">NISN</span>
                                <span class="font-mono font-black text-slate-900">{{ $searchedApplicant->nisn }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-2xl border border-sky-100">
                                <span class="text-slate-400 block text-xs">Asal Sekolah</span>
                                <span class="font-bold text-slate-800">{{ $searchedApplicant->previous_school_name }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-2xl border border-sky-100">
                                <span class="text-slate-400 block text-xs">Peminatan / Jurusan</span>
                                <span class="font-bold text-slate-800">{{ $searchedApplicant->chosen_major }}</span>
                            </div>
                        </div>

                        @if($searchedApplicant->admin_notes)
                            <div class="p-4 rounded-2xl bg-sky-50 border border-sky-200 text-xs text-blue-950 leading-relaxed">
                                <strong class="font-bold block mb-1">Catatan Panitia PPDB:</strong>
                                {{ $searchedApplicant->admin_notes }}
                            </div>
                        @endif

                        <div class="pt-2 flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('ppdb.print-card', $searchedApplicant->registration_number) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-blue-900 text-white font-bold text-xs sm:text-sm hover:bg-blue-800 shadow-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>Cetak Ulang Kartu Pendaftaran (PDF)</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <!-- Multi-Step Stepper Progress Bar -->
            <div class="bg-sky-50/50 border-b border-sky-100 px-4 py-6 sm:px-8">
                <div class="max-w-3xl mx-auto flex items-center justify-between relative">
                    <div class="absolute left-4 right-4 top-5 -translate-y-1/2 h-1 bg-sky-200 -z-0 rounded-full"></div>
                    <div class="absolute left-4 top-5 -translate-y-1/2 h-1 bg-blue-900 transition-all duration-500 -z-0 rounded-full"
                         style="width: {{ (($currentStep - 1) / ($totalSteps - 1)) * 92 }}%"></div>

                    @foreach(range(1, 5) as $step)
                        <button type="button"
                                wire:click="goToStep({{ $step }})"
                                @disabled($step > $currentStep)
                                class="relative z-10 flex flex-col items-center group focus:outline-none">
                            <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black text-xs sm:text-sm transition-all duration-300
                                {{ $currentStep === $step ? 'bg-blue-900 text-white ring-4 ring-sky-200 shadow-md scale-110' : ($currentStep > $step ? 'bg-sky-600 text-white' : 'bg-slate-200 text-slate-500') }}">
                                @if($currentStep > $step)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    {{ $step }}
                                @endif
                            </div>
                            <span class="hidden md:block text-[11px] font-bold mt-2 uppercase tracking-wider {{ $currentStep === $step ? 'text-blue-900' : 'text-slate-400' }}">
                                @if($step === 1) Data Siswa
                                @elseif($step === 2) Orang Tua
                                @elseif($step === 3) Asal Sekolah
                                @elseif($step === 4) Unggah Berkas
                                @elseif($step === 5) Konfirmasi
                                @endif
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>

            <form wire:submit.prevent="{{ $currentStep === $totalSteps ? 'submit' : 'nextStep' }}" class="p-6 sm:p-10">
                <!-- Upload Loading Indicator -->
                <div wire:loading wire:target="file_photo,file_kk,file_birth_certificate,file_report_or_diploma" class="mb-6 p-4 rounded-2xl bg-sky-50 border border-sky-200 text-blue-900 text-xs sm:text-sm font-bold flex items-center gap-3 animate-pulse">
                    <svg class="animate-spin h-5 w-5 text-blue-900 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span>Sedang mengunggah dokumen... Mohon tunggu hingga proses selesai sebelum melanjutkan.</span>
                </div>

                <!-- Validation Error Summary Alert -->
                @if($errors->any())
                    <div class="mb-6 p-4 sm:p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm">
                        <span class="font-black flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Mohon lengkapi isian wajib bertanda bintang (*) di bawah ini:
                        </span>
                        <ul class="list-disc list-inside space-y-1 text-xs text-red-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Step 1: Data Diri Calon Siswa -->
                @if($currentStep === 1)
                    <div class="space-y-6 animate-fade-in">
                        <div class="border-b border-sky-100 pb-4">
                            <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Langkah 1 dari 5</span>
                            <h3 class="font-display font-black text-xl text-slate-900">Data Pribadi Calon Peserta Didik</h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Isi data pribadi calon siswa sesuai Kartu Keluarga (KK) dan Akta Kelahiran.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap Siswa *</label>
                                <input type="text" wire:model="full_name" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Sesuai akta kelahiran / ijazah sebelumnya">
                                @error('full_name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">NISN (10 Digit) *</label>
                                <input type="text" wire:model="nisn" maxlength="10" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm font-mono text-slate-900 py-3 px-4 transition" placeholder="0012345678">
                                @error('nisn') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" wire:model="nik" maxlength="16" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm font-mono text-slate-900 py-3 px-4 transition" placeholder="16 digit sesuai di KK">
                                @error('nik') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Jenis Kelamin *</label>
                                <select wire:model="gender" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Agama *</label>
                                <select wire:model="religion" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Tempat Lahir *</label>
                                <input type="text" wire:model="birth_place" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Kota / Kabupaten tempat lahir">
                                @error('birth_place') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Lahir *</label>
                                <input type="date" wire:model="birth_date" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                @error('birth_date') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor WhatsApp / HP Siswa *</label>
                                <input type="text" wire:model="phone_number" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="08xxxxxxxxxx">
                                @error('phone_number') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Domisili Lengkap *</label>
                                <textarea wire:model="address" rows="3" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten"></textarea>
                                @error('address') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 2: Data Orang Tua / Wali -->
                @if($currentStep === 2)
                    <div class="space-y-6 animate-fade-in">
                        <div class="border-b border-sky-100 pb-4">
                            <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Langkah 2 dari 5</span>
                            <h3 class="font-display font-black text-xl text-slate-900">Data Orang Tua / Wali</h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Informasi kontak dan data orang tua untuk verifikasi resmi dan administrasi.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Ayah Kandung *</label>
                                <input type="text" wire:model="father_name" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                @error('father_name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pekerjaan Ayah</label>
                                <input type="text" wire:model="father_occupation" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="PNS, Wiraswasta, Karyawan, dll.">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Ibu Kandung *</label>
                                <input type="text" wire:model="mother_name" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                @error('mother_name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pekerjaan Ibu</label>
                                <input type="text" wire:model="mother_occupation" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Ibu Rumah Tangga, Guru, PNS, dll.">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Penghasilan Rata-rata Orang Tua</label>
                                <select wire:model="parent_income" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                    <option value="< Rp 1.500.000">< Rp 1.500.000</option>
                                    <option value="Rp 1.500.000 - Rp 3.000.000">Rp 1.500.000 - Rp 3.000.000</option>
                                    <option value="Rp 3.000.000 - Rp 6.000.000">Rp 3.000.000 - Rp 6.000.000</option>
                                    <option value="Rp 6.000.000 - Rp 10.000.000">Rp 6.000.000 - Rp 10.000.000</option>
                                    <option value="> Rp 10.000.000">> Rp 10.000.000</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor WhatsApp / HP Orang Tua *</label>
                                <input type="text" wire:model="parent_phone" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="08xxxxxxxxxx">
                                @error('parent_phone') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 3: Asal Sekolah & Nilai -->
                @if($currentStep === 3)
                    <div class="space-y-6 animate-fade-in">
                        <div class="border-b border-sky-100 pb-4">
                            <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Langkah 3 dari 5</span>
                            <h3 class="font-display font-black text-xl text-slate-900">Sekolah Asal & Pilihan Peminatan</h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Isi riwayat jenjang sekolah sebelumnya dan program keahlian yang diminati.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Sekolah Asal *</label>
                                <input type="text" wire:model="previous_school_name" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Contoh: SMP Negeri 1 Jakarta / MTs Negeri 2">
                                @error('previous_school_name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nilai Rata-rata Rapor / Ujian</label>
                                <input type="number" step="0.01" wire:model="average_score" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Contoh: 86.50">
                                @error('average_score') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pilihan Peminatan / Jurusan *</label>
                                <select wire:model="chosen_major" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition">
                                    <option value="MIPA (Matematika & IPA)">MIPA (Matematika & Sains)</option>
                                    <option value="IPS (Ilmu Pengetahuan Sosial)">IPS (Ilmu Sosial)</option>
                                    <option value="Bahasa & Budaya">Bahasa & Budaya</option>
                                    <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                                    <option value="Teknik Komputer & Jaringan (TKJ)">Teknik Komputer & Jaringan (TKJ)</option>
                                    <option value="Manajemen Perkantoran">Manajemen Perkantoran</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Asal Sekolah</label>
                                <textarea wire:model="previous_school_address" rows="2" class="w-full rounded-2xl border-slate-200 bg-sky-50/30 focus:bg-white focus:border-sky-600 focus:ring-4 focus:ring-sky-600/10 text-sm text-slate-900 py-3 px-4 transition" placeholder="Kota / Kabupaten asal sekolah"></textarea>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 4: Unggah Berkas Persyaratan -->
                @if($currentStep === 4)
                    <div class="space-y-6 animate-fade-in">
                        <div class="border-b border-sky-100 pb-4">
                            <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Langkah 4 dari 5</span>
                            <h3 class="font-display font-black text-xl text-slate-900">Unggah Berkas Dokumen Persyaratan</h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Format yang diterima: PDF, JPG, atau PNG. Maksimal 3MB per berkas berkas.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="p-6 border-2 border-dashed border-sky-200 rounded-3xl hover:border-sky-600 bg-sky-50/30 hover:bg-white transition space-y-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-blue-900 flex items-center justify-center shrink-0 border border-sky-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-slate-800">Pas Foto 3x4 Calon Siswa</label>
                                        <p class="text-[11px] text-slate-400">Latar merah/biru berseragam resmi sekolah asal.</p>
                                    </div>
                                </div>
                                <input type="file" wire:model="file_photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-900 file:text-white hover:file:bg-blue-800 transition pt-2">
                                @error('file_photo') <span class="text-red-500 text-xs block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="p-6 border-2 border-dashed border-sky-200 rounded-3xl hover:border-sky-600 bg-sky-50/30 hover:bg-white transition space-y-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-blue-900 flex items-center justify-center shrink-0 border border-sky-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-slate-800">Scan Kartu Keluarga (KK)</label>
                                        <p class="text-[11px] text-slate-400">Scan atau foto jelas dan tidak buram/terpotong.</p>
                                    </div>
                                </div>
                                <input type="file" wire:model="file_kk" accept=".pdf,image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-900 file:text-white hover:file:bg-blue-800 transition pt-2">
                                @error('file_kk') <span class="text-red-500 text-xs block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="p-6 border-2 border-dashed border-sky-200 rounded-3xl hover:border-sky-600 bg-sky-50/30 hover:bg-white transition space-y-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-blue-900 flex items-center justify-center shrink-0 border border-sky-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-slate-800">Scan Akta Kelahiran</label>
                                        <p class="text-[11px] text-slate-400">Dokumen resmi asli scan atau foto jelas.</p>
                                    </div>
                                </div>
                                <input type="file" wire:model="file_birth_certificate" accept=".pdf,image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-900 file:text-white hover:file:bg-blue-800 transition pt-2">
                                @error('file_birth_certificate') <span class="text-red-500 text-xs block font-bold">{{ $message }}</span> @enderror
                            </div>

                            <div class="p-6 border-2 border-dashed border-sky-200 rounded-3xl hover:border-sky-600 bg-sky-50/30 hover:bg-white transition space-y-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-blue-900 flex items-center justify-center shrink-0 border border-sky-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-slate-800">Scan Rapor / Ijazah / SKL</label>
                                        <p class="text-[11px] text-slate-400">Surat Keterangan Lulus atau lembar nilai rapor akhir.</p>
                                    </div>
                                </div>
                                <input type="file" wire:model="file_report_or_diploma" accept=".pdf,image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-900 file:text-white hover:file:bg-blue-800 transition pt-2">
                                @error('file_report_or_diploma') <span class="text-red-500 text-xs block font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 5: Review & Submit -->
                @if($currentStep === 5)
                    <div class="space-y-6 animate-fade-in">
                        <div class="border-b border-sky-100 pb-4">
                            <span class="text-xs font-bold text-sky-700 uppercase tracking-wider block mb-1">Langkah 5 dari 5</span>
                            <h3 class="font-display font-black text-xl text-slate-900">Konfirmasi & Pernyataan Pendaftaran</h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Periksa kembali ringkasan data calon siswa sebelum menekan tombol kirim pendaftaran.</p>
                        </div>

                        <div class="bg-sky-50/50 rounded-3xl p-6 sm:p-7 border border-sky-200 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs sm:text-sm">
                                <div class="bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">Nama Siswa</span>
                                    <span class="font-bold text-slate-900">{{ $full_name }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">NISN</span>
                                    <span class="font-bold font-mono text-slate-900">{{ $nisn }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">Jenis Kelamin</span>
                                    <span class="font-bold text-slate-900">{{ $gender === 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">Asal Sekolah</span>
                                    <span class="font-bold text-slate-900">{{ $previous_school_name }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">Peminatan / Jurusan</span>
                                    <span class="font-bold text-blue-900">{{ $chosen_major }}</span>
                                </div>
                                <div class="bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">WhatsApp Siswa</span>
                                    <span class="font-bold text-slate-900">{{ $phone_number }}</span>
                                </div>
                                <div class="md:col-span-2 bg-white p-3.5 rounded-2xl border border-sky-100">
                                    <span class="text-slate-400 block text-xs">Orang Tua / Wali</span>
                                    <span class="font-bold text-slate-900">{{ $father_name }} & {{ $mother_name }} (WA: {{ $parent_phone }})</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 bg-sky-50/80 border border-sky-200 rounded-3xl flex items-start gap-3.5">
                            <input type="checkbox" id="agree" wire:model="agreement" required class="mt-1 rounded-lg text-blue-900 focus:ring-sky-600 w-4 h-4">
                            <label for="agree" class="text-xs text-blue-950 leading-relaxed cursor-pointer font-semibold">
                                Saya menyatakan dengan sesungguhnya bahwa seluruh data dan berkas yang saya unggah adalah benar, sah, dan dapat dipertanggungjawabkan sesuai ketentuan panitia PPDB {{ $settings->school_name }}.
                            </label>
                        </div>
                        @error('agreement') <span class="text-red-500 text-xs block font-bold">{{ $message }}</span> @enderror
                    </div>
                @endif

                <!-- Navigation Action Buttons -->
                <div class="mt-10 pt-6 border-t border-sky-100 flex items-center justify-between">
                    @if($currentStep > 1)
                        <button type="button" wire:click="prevStep" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl border border-slate-300 text-slate-700 font-bold text-xs sm:text-sm hover:bg-sky-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            <span>Langkah Sebelumnya</span>
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if($currentStep < $totalSteps)
                        <button type="button" wire:click="nextStep" class="inline-flex items-center gap-2 px-8 py-3 rounded-2xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-blue-900/20 transition">
                            <span>Lanjut ke Langkah {{ $currentStep + 1 }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @else
                        <button type="submit" wire:loading.attr="disabled" class="px-10 py-3.5 rounded-2xl bg-gradient-to-r from-blue-700 to-sky-600 hover:from-blue-800 hover:to-sky-700 text-white font-black text-xs sm:text-sm shadow-lg shadow-blue-900/30 transition flex items-center gap-2">
                            <span wire:loading.remove class="inline-flex items-center gap-2">
                                <span>Kirim Pendaftaran Sekarang</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span wire:loading>Memproses Pendaftaran...</span>
                        </button>
                    @endif
                </div>
            </form>
        @endif
    @endif
</div>
