@extends('layouts.app')
@section('title', 'Jurnal & Artikel - OneeMagic')

@section('content')
<div class="relative min-h-screen pt-32 pb-16">
    <!-- Header -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center mb-16">
        <h1 class="text-4xl font-serif font-bold tracking-tight text-white sm:text-5xl">Jurnal <span class="text-amber-500">Ilusi</span></h1>
        <p class="mt-4 text-lg leading-8 text-slate-400">Selami pemikiran, filosofi, dan cerita di balik setiap trik sulap.</p>
    </div>

    <!-- Journal List -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @forelse($journals as $journal)
                <article class="flex flex-col items-start justify-between group">
                    <div class="relative w-full">
                        <div class="aspect-[16/9] w-full rounded-2xl bg-black overflow-hidden ring-1 ring-white/10 group-hover:ring-amber-500/50 transition-all">
                            @if($journal->image_path && file_exists(public_path('storage/'.$journal->image_path)))
                                <img src="{{ asset('storage/'.$journal->image_path) }}" alt="{{ $journal->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                @php
                                    $bgColors = [
                                        'from-amber-900/40',
                                        'from-indigo-900/40',
                                        'from-rose-900/40',
                                        'from-emerald-900/40',
                                        'from-purple-900/40'
                                    ];
                                    $iconColors = [
                                        'text-amber-500 border-amber-500/30 bg-amber-500/10',
                                        'text-indigo-400 border-indigo-400/30 bg-indigo-400/10',
                                        'text-rose-400 border-rose-400/30 bg-rose-400/10',
                                        'text-emerald-400 border-emerald-400/30 bg-emerald-400/10',
                                        'text-purple-400 border-purple-400/30 bg-purple-400/10'
                                    ];
                                    $bg = $bgColors[$loop->index % 5];
                                    $icon = $iconColors[$loop->index % 5];
                                @endphp
                                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] {{ $bg }} via-[#0a0a0a] to-[#050505] flex flex-col items-center justify-center p-6 text-center">
                                    <div class="w-16 h-16 rounded-full border flex items-center justify-center mb-3 {{ $icon }} transition-transform group-hover:scale-110 duration-500 shadow-xl">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    </div>
                                    <span class="font-serif italic text-white/40 text-sm tracking-wide">OneeMagic Journal</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="max-w-xl">
                        <div class="mt-6 flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $journal->published_date }}" class="text-slate-500">{{ \Carbon\Carbon::parse($journal->published_date)->translatedFormat('d F Y') }}</time>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-xl font-bold font-serif leading-6 text-white group-hover:text-amber-400 transition-colors">
                                <a href="{{ route('journal.show', $journal->slug) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $journal->title }}
                                </a>
                            </h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-400">{{ Str::limit(strip_tags($journal->content), 150) }}</p>
                        </div>
                        <div class="mt-4 flex items-center gap-x-4">
                            <a href="{{ route('journal.show', $journal->slug) }}" class="text-sm font-semibold text-amber-500 group-hover:text-amber-400">Baca selengkapnya <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20 text-slate-500">
                    Belum ada jurnal yang diterbitkan.
                </div>
            @endforelse
        </div>
        
        <div class="mt-16">
            {{ $journals->links() }}
        </div>
    </div>
</div>
@endsection
