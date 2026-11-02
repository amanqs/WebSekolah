@extends('layouts.app')

@section('title', 'Agenda & Kalender Kegiatan - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Kalender Pendidikan</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Agenda & Kegiatan Terjadwal
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Daftar jadwal kegiatan akademik, perlombaan, ujian, dan acara resmi di {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <div class="py-12 sm:py-16 bg-[#F8FAFC]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($agendas->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center text-slate-500 border border-slate-200/80 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-base">Belum ada agenda kegiatan yang dijadwalkan saat ini.</h3>
                    <p class="text-xs text-slate-400 mt-1">Silakan kembali lagi nanti untuk melihat pembaruan jadwal.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($agendas as $agenda)
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col sm:flex-row gap-5 items-start hover:-translate-y-0.5">
                            <!-- Date Badge Column -->
                            <div class="w-full sm:w-24 py-3 rounded-xl bg-blue-900 text-white text-center shrink-0 shadow-sm">
                                <span class="font-display text-2xl sm:text-3xl font-black block leading-none text-amber-300">{{ $agenda->start_date->format('d') }}</span>
                                <span class="text-[10px] uppercase font-bold tracking-wider mt-1 block text-sky-200">{{ $agenda->start_date->translatedFormat('M Y') }}</span>
                            </div>

                            <!-- Content Column -->
                            <div class="flex-1 space-y-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-900">
                                        {{ $agenda->type ?: 'Agenda Resmi' }}
                                    </span>
                                    <span class="text-xs text-slate-400">
                                        Pukul {{ $agenda->start_time ? $agenda->start_time->format('H:i') : '08:00' }} WIB
                                    </span>
                                </div>

                                <h2 class="font-display font-bold text-base sm:text-lg text-slate-900">
                                    {{ $agenda->title }}
                                </h2>

                                @if($agenda->description)
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $agenda->description }}
                                    </p>
                                @endif

                                <div class="pt-2 flex flex-wrap items-center gap-4 text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span>Lokasi: {{ $agenda->location ?: 'Kampus Sekolah' }}</span>
                                    </div>
                                    @if($agenda->end_date && $agenda->end_date != $agenda->start_date)
                                        <div class="flex items-center gap-1.5 text-amber-700">
                                            <svg class="w-3.5 h-3.5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span>Sampai: {{ $agenda->end_date->translatedFormat('d M Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $agendas->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
