@extends('layouts.app')

@section('title', 'Kabar & Berita Terkini - ' . $settings->school_name)

@section('content')
    <!-- Banner Header -->
    <div class="py-14 sm:py-16 bg-[#0B1528] text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff12_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/60 border border-sky-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                <span>Publikasi & Warta Resmi</span>
            </span>
            <h1 class="font-display text-3xl sm:text-5xl font-black tracking-tight text-white">
                Kabar & Prestasi Terkini
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto font-normal mt-2.5">
                Informasi seputar prestasi, agenda, kegiatan akademik, dan pengumuman resmi {{ $settings->school_name }}.
            </p>
        </div>
    </div>

    <div class="py-12 sm:py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

                <!-- Main Articles Grid (span 8) -->
                <div class="lg:col-span-8 space-y-6">
                    @if($posts->isEmpty())
                        <div class="bg-white rounded-2xl p-12 text-center border border-slate-200/80 shadow-sm">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-900 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base">Tidak ada berita atau artikel yang ditemukan.</h3>
                            <p class="text-xs text-slate-400 mt-1">Coba cari dengan kata kunci lain atau pilih kategori yang berbeda.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach($posts as $post)
                                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-blue-300 border border-slate-200/80 transition-all duration-300 flex flex-col group hover:-translate-y-1">
                                    <div class="relative aspect-video overflow-hidden bg-slate-100">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @if($post->category)
                                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-blue-900 text-white shadow-sm">
                                                {{ $post->category->name }}
                                            </span>
                                        @endif
                                        <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-900/80 backdrop-blur-sm text-slate-300">
                                            {{ $post->view_count }}x dibaca
                                        </span>
                                    </div>
                                    <div class="p-5 flex-1 flex flex-col justify-between">
                                        <div>
                                            <span class="text-[11px] text-slate-400 font-medium block mb-1.5">
                                                {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                                            </span>
                                            <h2 class="font-display font-bold text-sm sm:text-base text-slate-900 group-hover:text-blue-900 transition line-clamp-2 leading-snug">
                                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                            </h2>
                                            <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                                {{ Str::limit(strip_tags($post->content), 100) }}
                                            </p>
                                        </div>
                                        <div class="pt-3 mt-4 border-t border-slate-100">
                                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-900 hover:text-blue-700">
                                                <span>Baca Lengkap</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar (span 4) -->
                <aside class="lg:col-span-4 space-y-6">
                    <!-- Search Widget -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                        <h3 class="font-display font-bold text-sm text-slate-900 mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-900"></span>
                            <span>Cari Artikel</span>
                        </h3>
                        <form action="{{ route('posts.index') }}" method="GET" class="relative">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci..." class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-blue-900 focus:ring-blue-900 text-slate-900 bg-slate-50/50">
                            <button type="submit" aria-label="Cari berita" class="absolute right-3 top-2.5 text-slate-400 hover:text-blue-900 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </form>
                    </div>

                    <!-- Category Filter Widget -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                        <h3 class="font-display font-bold text-sm text-slate-900 mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            <span>Kategori Berita</span>
                        </h3>
                        <div class="space-y-1.5">
                            <a href="{{ route('posts.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition {{ !request('category') ? 'bg-blue-50 text-blue-900 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-900' }}">
                                <span>Semua Kategori</span>
                                <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-white text-slate-500 font-bold border border-slate-100">{{ \App\Models\Post::published()->count() }}</span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('posts.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition {{ request('category') === $cat->slug ? 'bg-blue-50 text-blue-900 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-900' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-white text-slate-500 font-bold border border-slate-100">{{ $cat->posts_count ?? $cat->posts()->published()->count() }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Popular Posts Widget -->
                    @if(isset($popularPosts) && $popularPosts->isNotEmpty())
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                            <h3 class="font-display font-bold text-sm text-slate-900 mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span>Artikel Terpopuler</span>
                            </h3>
                            <div class="space-y-3">
                                @foreach($popularPosts as $pop)
                                    <a href="{{ route('posts.show', $pop->slug) }}" class="flex gap-3 group">
                                        <div class="w-16 h-12 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                            <img src="{{ $pop->image_url }}" alt="{{ $pop->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h4 class="font-bold text-xs text-slate-800 group-hover:text-blue-900 transition line-clamp-2 leading-snug">{{ $pop->title }}</h4>
                                            <span class="text-[10px] text-slate-400 mt-1 block">{{ $pop->view_count }}x dibaca</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>

            </div>
        </div>
    </div>
@endsection
