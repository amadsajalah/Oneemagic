@extends('layouts.app')
@section('title', 'Portofolio - OneeMagic')

@section('content')
<div class="relative min-h-screen pt-20 pb-24 overflow-hidden" x-data="{ activeCategory: '{{ $activeCategory->id ?? 'all' }}', showVideoModal: false, activeVideoUrl: '', activeVideoType: '' }">
    <!-- Background Ambient Effects -->
    <div class="absolute inset-0 bg-[#030305] pointer-events-none -z-20"></div>
    <div class="absolute top-0 inset-x-0 h-screen bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-amber-900/20 via-[#030305] to-[#030305] opacity-60 pointer-events-none -z-10"></div>
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-amber-600/10 rounded-full blur-[120px] pointer-events-none -z-10 mix-blend-screen animate-pulse-slow"></div>

    <!-- Back to Magic Lab -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pt-0 pb-4 relative z-10">
        <a href="{{ route('magic_lab.index') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-amber-400 transition-colors group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Magic Lab
        </a>
    </div>




    <!-- PORTFOLIO HEADER -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center mb-10 relative z-10">
        <h2 class="text-4xl font-serif font-bold tracking-tight text-white mb-4">
            Rekam Jejak <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Pertunjukan</span>
        </h2>
        <p class="text-slate-400">Jelajahi berbagai panggung dan momen tak terlupakan yang telah tercipta.</p>
    </div>

    <!-- Dynamic Category Filters -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 mb-16">
        <div class="flex flex-wrap justify-center gap-3 p-2 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 shadow-2xl max-w-fit mx-auto">
            <button @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'bg-gradient-to-r from-amber-600 to-orange-600 text-white shadow-lg shadow-amber-500/25 border-transparent' : 'bg-transparent text-slate-400 hover:text-white border-transparent hover:bg-white/5'"
                    class="rounded-xl px-6 py-2.5 text-sm font-semibold transition-all duration-300 border relative overflow-hidden group">
                <span class="relative z-10">Semua Lab</span>
            </button>
            @foreach($categories as $category)
                <button @click="activeCategory = '{{ $category->id }}'" 
                        :class="activeCategory === '{{ $category->id }}' ? 'bg-gradient-to-r from-amber-600 to-orange-600 text-white shadow-lg shadow-amber-500/25 border-transparent' : 'bg-transparent text-slate-400 hover:text-white border-transparent hover:bg-white/5'"
                        class="rounded-xl px-6 py-2.5 text-sm font-semibold transition-all duration-300 border relative overflow-hidden group">
                    <span class="relative z-10">{{ $category->name }}</span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Portfolio Grid -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($portfolios as $portfolio)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $portfolio->category_id }}'"
                     x-transition:enter="transition ease-out duration-500 delay-75"
                     x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-8 scale-95"
                     class="group relative overflow-hidden rounded-2xl bg-black border border-white/10 hover:border-amber-500/50 hover:shadow-[0_0_25px_rgba(245,158,11,0.3)] transition-all duration-300" style="aspect-ratio: 5/7;">
                    
                    <!-- Card Image (full cover, darkened) -->
                    <div class="absolute inset-0 z-0">
                        @if($portfolio->image_path && file_exists(public_path('storage/'.$portfolio->image_path)))
                            <img src="{{ asset('storage/'.$portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" style="filter: brightness(0.35);">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-[#0a0a0f] flex items-center justify-center">
                                <span class="text-amber-500/20 text-6xl font-serif">OM</span>
                            </div>
                        @endif
                    </div>

                    <!-- Bottom gradient for text -->
                    <div class="absolute inset-x-0 bottom-0 h-2/3 z-10 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.85) 40%, transparent 100%);"></div>

                    <!-- Play Button -->
                    @if($portfolio->video_url)
                        <div class="absolute inset-0 z-20 flex items-center justify-center pb-20">
                            @php
                                $isSocialMedia = str_contains($portfolio->video_url, 'tiktok') || str_contains($portfolio->video_url, 'instagram') || str_contains($portfolio->video_url, 'vm.tiktok');
                            @endphp
                            @if($isSocialMedia)
                                <a href="{{ $portfolio->video_url }}" target="_blank" rel="noopener noreferrer"
                                   class="w-14 h-14 rounded-full bg-black/50 border border-white/20 flex items-center justify-center text-white backdrop-blur-sm group-hover:bg-amber-500 group-hover:border-amber-400 group-hover:shadow-[0_0_30px_rgba(245,158,11,0.7)] transition-all duration-300 transform group-hover:scale-110">
                                    <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </a>
                            @else
                                <button type="button"
                                    @click="activeVideoUrl = '{{ $portfolio->video_url }}'; activeVideoType = '{{ $portfolio->video_type }}'; showVideoModal = true"
                                    class="w-14 h-14 rounded-full bg-black/50 border border-white/20 flex items-center justify-center text-white backdrop-blur-sm group-hover:bg-amber-500 group-hover:border-amber-400 group-hover:shadow-[0_0_30px_rgba(245,158,11,0.7)] transition-all duration-300 transform group-hover:scale-110">
                                    <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                            @endif
                        </div>
                    @endif

                    <!-- Card Bottom Content -->
                    <div class="absolute inset-x-0 bottom-0 z-20 p-4 pointer-events-none">
                        <span class="inline-flex items-center rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-400 border border-amber-500/30 mb-2 tracking-wider uppercase">
                            {{ $portfolio->category->name }}
                        </span>
                        <h3 class="text-sm font-bold text-white font-serif leading-snug group-hover:text-amber-300 transition-colors line-clamp-2 mb-2" title="{{ $portfolio->title }}">{{ $portfolio->title }}</h3>
                        <div class="flex items-center justify-between border-t border-white/10 pt-2">
                            <span class="text-[9px] text-slate-400 truncate max-w-[80%]">{{ $portfolio->client_name ?? 'Internal Project' }}</span>
                            <span class="text-[9px] font-bold text-slate-500 shrink-0">{{ $portfolio->event_year }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-32">
                    <div class="w-24 h-24 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-6 text-slate-500">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <p class="text-xl text-slate-400 font-serif">Belum ada karya di Magic Lab.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Video Modal (YouTube / MP4 only) -->
    <template x-teleport="body">
        <div x-show="showVideoModal" style="display: none;" class="fixed inset-0 z-[9999] flex items-center justify-center" role="dialog" aria-modal="true">
            <div x-show="showVideoModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/95 backdrop-blur-xl transition-opacity" @click="showVideoModal = false; activeVideoUrl = ''"></div>
            
            <div x-show="showVideoModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative z-10 w-full max-w-4xl mx-4 bg-black rounded-2xl overflow-hidden shadow-2xl border border-white/10" style="aspect-ratio: 16/9;">
                <button @click="showVideoModal = false; activeVideoUrl = ''" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-amber-500 transition-colors border border-white/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <template x-if="activeVideoUrl">
                    <div class="w-full h-full bg-black">
                        <template x-if="activeVideoType === 'mp4'">
                            <video :src="activeVideoUrl.startsWith('http') ? activeVideoUrl : '{{ asset('storage') }}/' + activeVideoUrl" controls autoplay class="w-full h-full object-contain"></video>
                        </template>
                        <template x-if="activeVideoType !== 'mp4'">
                            <iframe :src="
                                activeVideoUrl.includes('youtu.be') 
                                    ? 'https://www.youtube.com/embed/' + activeVideoUrl.split('youtu.be/')[1].split('?')[0] + '?autoplay=1'
                                    : activeVideoUrl.includes('watch?v=') 
                                        ? activeVideoUrl.replace('watch?v=', 'embed/') + '&autoplay=1'
                                        : activeVideoUrl + '?autoplay=1'
                            " class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
@endsection
