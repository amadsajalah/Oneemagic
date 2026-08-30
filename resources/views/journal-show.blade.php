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
            <div class="w-full aspect-[21/9] rounded-2xl overflow-hidden mb-10 ring-1 ring-white/10">
                <img src="{{ asset('storage/'.$journal->image_path) }}" alt="{{ $journal->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="prose prose-invert prose-lg prose-amber max-w-none">
            {!! nl2br(e($journal->content)) !!}
        </div>
    </div>
</div>
@endsection
