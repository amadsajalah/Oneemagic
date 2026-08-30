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
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-[#111] flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
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
