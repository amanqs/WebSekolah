@extends('layouts.app')

@section('title', '403 - Akses Terbatas | ' . ($settings->school_name ?? 'Sekolah'))

@section('content')
    <div class="py-24 sm:py-32 bg-[#F8FAFC] flex items-center justify-center min-h-[650px]">
        <div class="max-w-xl mx-auto px-4 text-center">
            <div class="w-24 h-24 rounded-3xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-6 border border-amber-200 shadow-sm">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <span class="inline-block px-4 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-black uppercase tracking-wider mb-4 border border-amber-200">
                Akses Dibatasi (Error 403)
            </span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">
                Akses Tidak Diizinkan
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                Anda tidak memiliki hak akses yang cukup untuk membuka halaman atau berkas ini. Silakan masuk menggunakan akun resmi Anda.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl bg-blue-900 text-white font-extrabold text-sm hover:bg-blue-800 shadow-md shadow-blue-900/20 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    <span>Kembali ke Beranda</span>
                </a>
                <a href="{{ url('/admin') }}" class="px-7 py-3.5 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-black transition">
                    Login Panel Admin
                </a>
            </div>
        </div>
    </div>
@endsection
