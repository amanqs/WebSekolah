@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan | ' . ($settings->school_name ?? 'Sekolah'))

@section('content')
    <div class="py-24 sm:py-32 bg-[#F8FAFC] flex items-center justify-center min-h-[650px]">
        <div class="max-w-xl mx-auto px-4 text-center">
            <div class="w-24 h-24 rounded-3xl bg-sky-100 text-blue-900 flex items-center justify-center mx-auto mb-6 border border-sky-200 shadow-sm animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <span class="inline-block px-4 py-1.5 rounded-full bg-sky-100 text-blue-900 text-xs font-black uppercase tracking-wider mb-4 border border-sky-200">
                Error 404
            </span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                Mohon maaf, tautan yang Anda tuju mungkin telah dipindahkan, dihapus, atau alamat URL yang Anda masukkan salah.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl bg-blue-900 text-white font-extrabold text-sm hover:bg-blue-800 shadow-md shadow-blue-900/20 transition hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    <span>Kembali ke Beranda</span>
                </a>
                <a href="{{ route('contact') }}" class="px-7 py-3.5 rounded-2xl border border-slate-300 text-slate-700 font-bold text-sm hover:bg-sky-50 transition">
                    Hubungi Bantuan
                </a>
            </div>
        </div>
    </div>
@endsection
