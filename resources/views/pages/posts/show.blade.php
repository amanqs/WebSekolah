@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - ' . $settings->school_name)
@section('meta_description', $post->meta_description ?: $post->excerpt)
@section('meta_image', $post->image_url)

@section('content')
    <article class="py-12 md:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-8 bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200/80 w-fit">
                <a href="{{ route('home') }}" class="hover:text-blue-900 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('posts.index') }}" class="hover:text-blue-900 transition">Berita</a>
                <span>/</span>
                <span class="text-slate-900 truncate max-w-xs font-bold">{{ $post->title }}</span>
            </nav>

            <!-- Header Info -->
            <div class="space-y-4 mb-8">
                @if($post->category)
                    <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}" class="inline-block px-4 py-1.5 rounded-full text-xs font-black bg-blue-900 text-white shadow-sm uppercase tracking-wider">
                        {{ $post->category->name }}
                    </a>
                @endif
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-[1.2]">
                    {{ $post->title }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-500 pt-4 border-t border-sky-100 font-medium">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Ditulis oleh: <strong class="text-slate-900">{{ $post->user->name ?? 'Admin Sekolah' }}</strong></span>
                    </span>
                    <span>•</span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $post->published_at?->translatedFormat('l, d F Y') }}</span>
                    </span>
                    <span>•</span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>Dibaca {{ $post->view_count }} kali</span>
                    </span>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="rounded-3xl overflow-hidden aspect-[16/9] mb-10 shadow-lg shadow-blue-950/5 bg-slate-100 border border-sky-100">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>

            <!-- Content -->
            <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed space-y-4 font-normal">
                {!! $post->content !!}
            </div>

            <!-- Tags -->
            @if($post->tags->isNotEmpty())
                <div class="pt-8 mt-12 border-t border-sky-100 flex flex-wrap items-center gap-2">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-wider">Topik Terkait:</span>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('posts.index', ['tag' => $tag->slug]) }}" class="px-3.5 py-1.5 rounded-xl bg-sky-50 hover:bg-blue-900 hover:text-white text-xs font-bold text-blue-900 transition border border-sky-200">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Social Share Buttons -->
            <div class="pt-8 mt-8 border-t border-sky-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-sky-50/70 p-6 rounded-3xl border border-sky-100">
                <span class="text-sm font-extrabold text-slate-900">Bagikan artikel ini:</span>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold flex items-center gap-2 transition shadow-sm">
                        <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>WhatsApp</span>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center gap-2 transition shadow-sm">
                        <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-600 text-white text-xs font-bold flex items-center gap-2 transition shadow-sm">
                        <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        <span>Twitter/X</span>
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');" class="px-4 py-2.5 rounded-xl bg-blue-950 hover:bg-black text-white text-xs font-bold flex items-center gap-2 transition shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                        <span>Salin Link</span>
                    </button>
                </div>
            </div>

            <!-- Related Posts -->
            @if($relatedPosts->isNotEmpty())
                <div class="mt-16 pt-12 border-t border-sky-100">
                    <h3 class="font-display text-2xl font-black text-slate-900 mb-8">Berita Terkait Lainnya</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedPosts as $rel)
                            <a href="{{ route('posts.show', $rel->slug) }}" class="group block">
                                <div class="rounded-2xl overflow-hidden aspect-video bg-slate-100 mb-3 border border-sky-100">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <h4 class="font-display font-bold text-slate-900 text-sm group-hover:text-blue-900 transition line-clamp-2 leading-snug">{{ $rel->title }}</h4>
                                <span class="text-xs text-slate-400 mt-1 block">{{ $rel->published_at?->translatedFormat('d M Y') }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </article>
@endsection
