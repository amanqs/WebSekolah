@extends('layouts.app')

@section('title', 'Pendaftaran PPDB Online - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden text-center">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Penerimaan Siswa Baru • Tahun Ajaran {{ $settings->ppdb_academic_year }}</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Pendaftaran PPDB Online Terpadu
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Silakan lengkapi formulir pendaftaran daring di bawah ini secara teliti dan benar sesuai dokumen kependudukan resmi.
            </p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="py-12 sm:py-16 bg-[#F8FAFC] min-h-[600px]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:ppdb-registration-form />
        </div>
    </div>
@endsection
