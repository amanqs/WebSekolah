@extends('layouts.app')

@section('title', '500 - Terjadi Kendala Server | ' . ($settings->school_name ?? 'Sekolah'))

@section('content')
    <div class="py-24 sm:py-32 bg-[#F8FAFC] flex items-center justify-center min-h-[650px]">
        <div class="max-w-xl mx-auto px-4 text-center">
            <div class="w-24 h-24 rounded-3xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-6 border border-rose-200 shadow-sm">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="inline-block px-4 py-1.5 rounded-full bg-rose-100 text-rose-800 text-xs font-black uppercase tracking-wider mb-4 border border-rose-200">
                Server Error 500
            </span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-4">
                Terjadi Kendala Teknis
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                Sistem kami sedang mengalami pemeliharaan atau kendala sementara. Mohon coba muat ulang halaman ini beberapa saat lagi.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <button onclick="window.location.reload();" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl bg-blue-900 text-white font-extrabold text-sm hover:bg-blue-800 shadow-md shadow-blue-900/20 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Muat Ulang Halaman</span>
                </button>
                <a href="{{ route('home') }}" class="px-7 py-3.5 rounded-2xl border border-slate-300 text-slate-700 font-bold text-sm hover:bg-sky-50 transition">
                    Ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
@endsection
