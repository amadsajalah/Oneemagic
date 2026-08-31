@extends('layouts.app')
@section('title', $journal->title . ' - OneeMagic')

@section('content')
<div class="relative min-h-screen pt-32 pb-16">
    <div class="mx-auto max-w-3xl px-6 lg:px-8">
        <a href="{{ route('journal.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-amber-500 mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Jurnal
        </a>
        
        <h1 class="text-4xl font-serif font-bold tracking-tight text-white sm:text-5xl mb-6">{{ $journal->title }}</h1>
        
        <div class="flex items-center gap-x-4 text-sm text-slate-500 mb-10">
            <time datetime="{{ $journal->published_date }}">{{ \Carbon\Carbon::parse($journal->published_date)->translatedFormat('d F Y') }}</time>
        </div>

        @if($journal->image_path && file_exists(public_path('storage/'.$journal->image_path)))
            <div class="w-full aspect-[21/9] rounded-2xl overflow-hidden mb-10 ring-1 ring-white/10 shadow-2xl">
                <img src="{{ asset('storage/'.$journal->image_path) }}" alt="{{ $journal->title }}" class="w-full h-full object-cover">
            </div>
        @else
            @php
                // Generate color index based on ID to keep it consistent for the same journal
                $colorIndex = $journal->id % 5;
                $bgColors = ['from-amber-900/40', 'from-indigo-900/40', 'from-rose-900/40', 'from-emerald-900/40', 'from-purple-900/40'];
                $bg = $bgColors[$colorIndex];
            @endphp
            <div class="w-full aspect-[21/9] md:aspect-[3/1] rounded-2xl overflow-hidden mb-10 ring-1 ring-white/10 shadow-2xl bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] {{ $bg }} via-[#0a0a0a] to-[#050505] flex items-center justify-center relative">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10"></div>
                <div class="text-center z-10 p-6">
                    <svg class="w-12 h-12 text-white/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <p class="font-serif italic text-white/30 text-lg tracking-widest uppercase">Journal of Illusion</p>
                </div>
            </div>
        @endif

        <div class="prose prose-invert prose-lg prose-amber max-w-none">
            {!! nl2br(e($journal->content)) !!}
        </div>
    </div>
</div>
@endsection
