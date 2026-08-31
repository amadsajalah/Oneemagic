@extends('layouts.app')
@section('title', 'Magic Lab — Ensiklopedia Ilusi | OneeMagic')

@section('content')
@php
$meta = [
    'mentalism'              => ['emoji'=>'🧠','accent'=>'#a855f7','bg'=>'rgba(168,85,247,0.1)', 'tag'=>'Psikologi Ilusi',   'floats'=>['👁️','💭','❓','🌀']],
    'card-magic'             => ['emoji'=>'🃏','accent'=>'#f59e0b','bg'=>'rgba(245,158,11,0.1)', 'tag'=>'Sleight of Hand',   'floats'=>['♠','♥','♦','♣']],
    'stage-illusion'         => ['emoji'=>'🎭','accent'=>'#60a5fa','bg'=>'rgba(96,165,250,0.1)', 'tag'=>'Grand Spectacle',   'floats'=>['⭐','🌟','✨','🔭']],
    'close-up-magic'         => ['emoji'=>'✨','accent'=>'#34d399','bg'=>'rgba(52,211,153,0.1)', 'tag'=>'Intimate Magic',    'floats'=>['💍','🪙','💎','👆']],
    'escape-art'             => ['emoji'=>'⛓️','accent'=>'#fb923c','bg'=>'rgba(251,146,60,0.1)', 'tag'=>'Danger Performance','floats'=>['🔒','🗝️','🚪','💪']],
    'levitation-manipulation'=> ['emoji'=>'🔮','accent'=>'#f472b6','bg'=>'rgba(244,114,182,0.1)','tag'=>'Anti-Gravity',      'floats'=>['🔮','⚪','💫','🎱']],
    'coin-magic'             => ['emoji'=>'🪙','accent'=>'#fbbf24','bg'=>'rgba(251,191,36,0.1)', 'tag'=>'Manipulation',      'floats'=>['🪙','💰','✋','🤌']],
    'hypnosis-stage'         => ['emoji'=>'🌀','accent'=>'#818cf8','bg'=>'rgba(129,140,248,0.1)','tag'=>'Mind Control',      'floats'=>['🌀','👁','💤','🌙']],
    'pickpocket-art'         => ['emoji'=>'🤌','accent'=>'#94a3b8','bg'=>'rgba(148,163,184,0.1)','tag'=>'Theatrical Theft',  'floats'=>['⌚','💼','🔑','👋']],
    'rope-silk-magic'        => ['emoji'=>'🪢','accent'=>'#f0abfc','bg'=>'rgba(240,171,252,0.1)','tag'=>'Object Sorcery',    'floats'=>['🪢','🎀','🧵','✂️']],
    'fire-danger-acts'       => ['emoji'=>'🔥','accent'=>'#ef4444','bg'=>'rgba(239,68,68,0.1)',  'tag'=>'Extreme Arts',      'floats'=>['🔥','💥','⚡','🌋']],
    'street-magic'           => ['emoji'=>'🏙️','accent'=>'#14b8a6','bg'=>'rgba(20,184,166,0.1)',  'tag'=>'Guerilla Magic',    'floats'=>['🏙️','👟','🧱','🛹']],
    'bizarre-magic'          => ['emoji'=>'👁️‍🗨️','accent'=>'#db2777','bg'=>'rgba(219,39,119,0.1)',  'tag'=>'Occult Illusion',   'floats'=>['👁️‍🗨️','🩸','🕯️','💀']],
];
@endphp

<style>
/* ── INTRO ANIMATION ── */
#ml-intro {
    position: fixed; inset: 0; z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    background: #030306;
    flex-direction: column; gap: 1rem;
    pointer-events: none;
    transition: opacity .8s ease, visibility .8s ease;
}
#ml-intro.fade-out { opacity: 0; visibility: hidden; }

#ml-intro .intro-line {
    overflow: hidden;
}
#ml-intro .intro-text {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: clamp(2.5rem, 10vw, 7rem);
    letter-spacing: -0.03em;
    color: white;
    transform: translateY(100%);
    transition: transform .9s cubic-bezier(.16,1,.3,1);
}
#ml-intro .intro-text.slide-up { transform: translateY(0); }
#ml-intro .intro-accent {
    background: linear-gradient(90deg,#f59e0b,#f97316,#a855f7);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
#ml-intro .intro-bar {
    width: 0; height: 2px;
    background: linear-gradient(90deg,#f59e0b,#a855f7);
    transition: width 1s ease .4s;
    border-radius: 9999px;
}
#ml-intro .intro-bar.expand { width: clamp(8rem, 30vw, 20rem); }
#ml-intro .intro-sub {
    font-size: .7rem; letter-spacing: .5em;
    color: rgba(255,255,255,.3); text-transform: uppercase;
    opacity: 0; transition: opacity .5s ease .9s;
}
#ml-intro .intro-sub.show { opacity: 1; }

/* ── PARTICLES ── */
@keyframes floatPart {
    0%,100% { transform: translateY(0) rotate(0deg); opacity: .3; }
    50%      { transform: translateY(-28px) rotate(180deg); opacity: .7; }
}
.part { animation: floatPart var(--d,6s) ease-in-out var(--dl,0s) infinite; }

/* ── MARQUEE ── */
@keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
.mq { animation: marquee var(--mq-dur, 22s) linear infinite; white-space: nowrap; display: inline-flex; gap: 2.5rem; }
.mq-rev { animation-direction: reverse; }

/* ── HERO ── */
@keyframes shimmerGrad {
    0%   { background-position: -200% center; }
    100% { background-position:  200% center; }
}
.hero-grad {
    background: linear-gradient(90deg, #f59e0b 0%, #fde68a 25%, #f97316 50%, #a855f7 75%, #f59e0b 100%);
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmerGrad 5s linear infinite;
}

/* ── CARD (PLAYING CARD STYLE) ── */
.card-wrapper {
    perspective: 1000px;
}
.lab-card {
    position: relative;
    border-radius: 16px;
    cursor: pointer;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,.1);
    background: #08080c;
    aspect-ratio: 2.5 / 3.5;
    transition: transform .6s cubic-bezier(.23,1,.32,1), box-shadow .6s, border-color .4s;
    transform-style: preserve-3d;
    box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);
}
.lab-card::before {
    /* Inner playing card border */
    content: '';
    position: absolute;
    inset: 10px;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 10px;
    pointer-events: none;
    z-index: 20;
    transition: border-color .4s;
}
.lab-card:hover {
    transform: translateY(-12px) rotateY(4deg) rotateX(4deg);
    border-color: rgba(255,255,255,.25);
    box-shadow: -15px 20px 40px rgba(0,0,0,.6);
}
.lab-card:hover::before {
    border-color: rgba(255,255,255,.15);
}
.lab-card .glow-layer { position:absolute;inset:0;opacity:0;transition:opacity .6s;pointer-events:none; }
.lab-card:hover .glow-layer { opacity:1; }
.lab-card .top-bar { display:none; } /* Removed for playing card style */

/* ── MODAL ── */
#lab-modal {
    position:fixed;inset:0;z-index:9000;
    background:rgba(2,2,8,.88);backdrop-filter:blur(14px);
    display:flex;align-items:center;justify-content:center;padding:1.5rem;
    opacity:0;visibility:hidden;transition:opacity .35s,visibility .35s;
}
#lab-modal.active { opacity:1;visibility:visible; }
#lab-modal .modal-box {
    width:100%;max-width:760px;max-height:88vh;overflow-y:auto;
    border-radius:2rem;border:1px solid rgba(255,255,255,.1);
    background:#0a0a10;
    transform:translateY(28px) scale(.97);
    transition:transform .4s cubic-bezier(.16,1,.3,1);
}
#lab-modal.active .modal-box { transform:translateY(0) scale(1); }
</style>

{{-- ══════════ INTRO ANIMATION ══════════ --}}
<div id="ml-intro" aria-hidden="true">
    <div class="intro-line">
        <div class="intro-text" id="intro-t1">The <span class="intro-accent">Magic</span></div>
    </div>
    <div class="intro-line">
        <div class="intro-text" id="intro-t2" style="transition-delay:.12s;">Laboratory</div>
    </div>
    <div class="intro-bar" id="intro-bar"></div>
    <div class="intro-sub" id="intro-sub">OneeMagic × Ensiklopedia Ilusi</div>
</div>

{{-- ══════════ AMBIENT BG ══════════ --}}
<div class="fixed inset-0 -z-20 pointer-events-none" aria-hidden="true">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 70% 50% at 15% 0%,rgba(168,85,247,.13),transparent 60%),radial-gradient(ellipse 60% 40% at 85% 100%,rgba(217,119,6,.09),transparent 60%);"></div>
    {{-- Floating micro-dots --}}
    @for($i=0;$i<10;$i++)
    <div class="part" style="position:absolute;border-radius:50%;
        top:{{rand(5,88)}}%;left:{{rand(4,94)}}%;
        width:{{rand(2,4)}}px;height:{{rand(2,4)}}px;
        background:{{['#f59e0b','#a855f7','#60a5fa','#34d399','#f472b6'][$i%5]}};
        opacity:{{rand(12,30)/100}};--d:{{rand(5,11)}}s;--dl:{{$i*.7}}s;"></div>
    @endfor
</div>

{{-- ══════════ HERO ══════════ --}}
<section class="relative pt-32 pb-10 px-6 lg:px-12 text-center overflow-hidden">
    {{-- Ghost LAB behind --}}
    <div class="absolute inset-x-0 top-16 flex justify-center pointer-events-none select-none -z-10">
        <span style="font-size:clamp(7rem,24vw,22rem);font-weight:900;line-height:1;
                     color:transparent;-webkit-text-stroke:1px rgba(255,255,255,0.035);
                     font-family:'Playfair Display',serif;">LAB</span>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/[.04] border border-white/[.08] mb-6">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-60"></span>
                <span class="relative inline-flex h-2 w-2 rounded-full bg-amber-500"></span>
            </span>
            <span class="text-[10px] font-bold tracking-[.35em] text-amber-400/80 uppercase">OneeMagic × Laboratory</span>
        </div>

        {{-- Title --}}
        <h1 class="font-serif font-black leading-none tracking-tight mb-6">
            <span class="block text-white/40 font-sans font-light mb-2" style="font-size:clamp(.8rem,2vw,1.1rem);letter-spacing:.5em;text-transform:uppercase;">The</span>
            <span class="block hero-grad" style="font-size:clamp(4rem,13vw,10rem);">Magic Lab</span>
        </h1>

        <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
            Ensiklopedia ilusi terlengkap — pelajari sejarah, psikologi, dan seni di balik setiap aliran sulap dunia. Klik kartu untuk menjelajahi.
        </p>

        {{-- Scroll hint --}}
        <a href="#categories"
           class="inline-flex flex-col items-center gap-2 text-slate-600 hover:text-slate-400 transition-colors duration-300 group">
            <span class="text-[11px] tracking-[.3em] uppercase">Scroll untuk menjelajah</span>
            <svg class="w-4 h-4 animate-bounce opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>
    </div>
</section>

{{-- ══════════ MARQUEE ══════════ --}}
<div class="overflow-hidden border-y border-white/[.04] py-3 bg-white/[.01] my-8">
    <div class="mq text-[10px] font-bold tracking-[.35em] uppercase text-white/20" style="--mq-dur:24s;">
        @foreach(array_merge($categories->pluck('name')->toArray(),$categories->pluck('name')->toArray()) as $n)
            <span>{{ $n }}</span><span class="text-amber-500/25 mx-1">✦</span>
        @endforeach
    </div>
</div>

{{-- ══════════ CATEGORIES GRID ══════════ --}}
<section id="categories" class="px-6 lg:px-12 pb-24 scroll-mt-24">
    <div class="max-w-7xl mx-auto">

        {{-- Section header --}}
        <div class="flex items-center gap-4 mb-10">
            <div class="h-px flex-1 bg-gradient-to-r from-transparent to-white/10"></div>
            <p class="text-[10px] font-bold tracking-[.35em] text-slate-600 uppercase">{{ $categories->count() }} Aliran Ilusi</p>
            <div class="h-px flex-1 bg-gradient-to-l from-transparent to-white/10"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4">
            @forelse($categories as $index => $category)
            @php
                $m = $meta[$category->slug] ?? ['emoji'=>'🎩','accent'=>'#f59e0b','bg'=>'rgba(217,119,6,0.08)','tag'=>'Magic','floats'=>[]];
                $suit = ['♠','♥','♦','♣'][$index % 4];
                $num = str_pad($index+1,2,'0',STR_PAD_LEFT);
            @endphp

            <div class="card-wrapper">
                <div class="lab-card group" onclick="openLabModal(this)"
                     data-id="{{ $category->id }}"
                     data-slug="{{ $category->slug }}"
                     data-name="{{ $category->name }}"
                     data-desc="{{ $category->description }}"
                     data-history="{{ htmlspecialchars($category->history ?? '') }}"
                     data-emoji="{{ $m['emoji'] }}"
                     data-accent="{{ $m['accent'] }}"
                     data-tag="{{ $m['tag'] }}">

                    {{-- Glow overlay --}}
                    <div class="glow-layer" style="background:radial-gradient(circle at 50% 50%,{{ $m['bg'] }},transparent 70%);"></div>

                    {{-- TOP LEFT INDEX --}}
                    <div class="absolute top-4 left-4 flex flex-col items-center justify-center z-10 opacity-70 group-hover:opacity-100 transition-opacity">
                        <span class="text-sm font-black font-serif" style="color:{{ $m['accent'] }}">{{ $num }}</span>
                        <span class="text-lg leading-none" style="color:{{ $m['accent'] }}">{{ $suit }}</span>
                    </div>

                    {{-- BOTTOM RIGHT INDEX (UPSIDE DOWN) --}}
                    <div class="absolute bottom-4 right-4 flex flex-col items-center justify-center z-10 rotate-180 opacity-70 group-hover:opacity-100 transition-opacity">
                        <span class="text-sm font-black font-serif" style="color:{{ $m['accent'] }}">{{ $num }}</span>
                        <span class="text-lg leading-none" style="color:{{ $m['accent'] }}">{{ $suit }}</span>
                    </div>

                    {{-- CENTER CONTENT --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center z-10 mt-2">
                        {{-- Center Emoji --}}
                        <div class="text-6xl mb-4 group-hover:scale-110 transition-transform duration-500" style="filter:drop-shadow(0 0 15px {{ $m['accent'] }}44);">
                            {{ $m['emoji'] }}
                        </div>

                        {{-- Title --}}
                        <h3 class="font-serif font-black text-white text-xl leading-tight mb-2 group-hover:text-amber-50 transition-colors">
                            {{ $category->name }}
                        </h3>

                        {{-- Tag --}}
                        <span class="px-3 py-1 rounded-full text-[8px] font-bold tracking-widest uppercase mb-3"
                              style="background:{{ $m['bg'] }};color:{{ $m['accent'] }};border:1px solid {{ $m['accent'] }}33;">
                            {{ $m['tag'] }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-32 text-center">
                <div class="text-6xl mb-4 opacity-20">🎩</div>
                <p class="text-slate-500 font-serif text-xl">Laboratorium masih kosong.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ══════════ BOTTOM: MARQUEE BAND + CTA ══════════ --}}

{{-- Marquee band — clearly separated --}}
<div class="relative overflow-hidden py-6" style="background:rgba(255,255,255,0.015);border-top:1px solid rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.05);">
    {{-- Fade masks on left/right --}}
    <div class="absolute inset-y-0 left-0 w-16 z-10" style="background:linear-gradient(90deg,#050508,transparent);"></div>
    <div class="absolute inset-y-0 right-0 w-16 z-10" style="background:linear-gradient(-90deg,#050508,transparent);"></div>
    <div class="mq mq-rev text-[10px] font-bold tracking-[.35em] uppercase text-white/20" style="--mq-dur:18s;">
        @foreach(array_merge($categories->pluck('name')->toArray(),$categories->pluck('name')->toArray()) as $n)
            <span>{{ $n }}</span><span class="mx-2" style="color:rgba(217,119,6,.35);">✦</span>
        @endforeach
    </div>
</div>

{{-- CTA Section --}}
<section class="relative overflow-hidden py-32 px-6 lg:px-12">
    {{-- Ambient glow --}}
    <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 60% 70% at 50% 60%,rgba(217,119,6,.1),transparent 70%);"></div>

    {{-- Decorative top divider line --}}
    <div class="flex items-center gap-4 mb-20 max-w-3xl mx-auto">
        <div class="h-px flex-1" style="background:linear-gradient(90deg,transparent,rgba(217,119,6,.3));"></div>
        <span class="text-amber-500/30 text-lg">✦</span>
        <div class="h-px flex-1" style="background:linear-gradient(-90deg,transparent,rgba(217,119,6,.3));"></div>
    </div>

    <div class="relative z-10 max-w-3xl mx-auto text-center">
        <p class="text-[10px] font-bold tracking-[.45em] text-amber-500/40 uppercase mb-5">Dari Teori ke Panggung</p>

        <h2 class="font-serif font-black text-white leading-[.95] mb-8" style="font-size:clamp(2.8rem,8vw,5.5rem);">
            Semua Ini<br>
            <span style="background:linear-gradient(90deg,#f59e0b,#f97316,#f59e0b);background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmerGrad 4s linear infinite;">Nyata di Tangannya</span>
        </h2>

        <p class="text-slate-500 text-base leading-relaxed max-w-lg mx-auto mb-12">
            Setiap aliran yang kamu baca di sini — semua hidup dan bernafas dalam setiap pertunjukan sang magician.
        </p>

        {{-- CTA Button --}}
        <a href="{{ route('portfolio.index') }}"
           class="group inline-flex items-center gap-3 px-10 py-5 rounded-2xl font-bold text-white text-sm tracking-wide transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
           style="background:linear-gradient(135deg,#d97706,#ea580c);box-shadow:0 12px 40px rgba(217,119,6,.3);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Kunjungi Portofolio
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</section>

{{-- ══════════ MODAL ══════════ --}}
<div id="lab-modal" onclick="if(event.target===this)closeLabModal()">
    <div class="modal-box">
        <div id="modal-accent-bar" class="h-1 rounded-t-[2rem]"></div>
        <div class="flex items-start justify-between p-8 pb-0">
            <div>
                <div id="modal-emoji" class="text-5xl mb-3"></div>
                <div id="modal-tag" class="inline-block px-3 py-1 rounded-full text-[9px] font-bold tracking-widest uppercase mb-4"></div>
                <h2 id="modal-title" class="font-serif font-black text-white text-3xl md:text-4xl leading-tight"></h2>
            </div>
            <button onclick="closeLabModal()" class="flex-shrink-0 ml-4 w-10 h-10 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="px-8 py-4">
            <p id="modal-desc" class="text-base font-medium italic border-l-2 pl-4 py-1 mb-6 leading-relaxed"></p>
            <div id="modal-history" class="space-y-4 text-slate-400 text-sm leading-[1.95] font-light"></div>
        </div>
        <div class="px-8 pb-8 pt-4 flex justify-between items-center border-t border-white/[.05]">
            <a href="{{ route('portfolio.index') }}" id="modal-portfolio-link" class="text-xs font-bold tracking-widest uppercase text-amber-500 hover:text-amber-400 transition-colors">
                Lihat Sang Magician →
            </a>
            <button onclick="closeLabModal()" class="text-xs text-slate-600 hover:text-slate-400 transition-colors">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
/* ─── INTRO ANIMATION ─── */
(function(){
    const intro = document.getElementById('ml-intro');
    const t1    = document.getElementById('intro-t1');
    const t2    = document.getElementById('intro-t2');
    const bar   = document.getElementById('intro-bar');
    const sub   = document.getElementById('intro-sub');

    requestAnimationFrame(()=>{
        setTimeout(()=>{ t1.classList.add('slide-up'); t2.classList.add('slide-up'); }, 80);
        setTimeout(()=>{ bar.classList.add('expand'); sub.classList.add('show'); }, 400);
        setTimeout(()=>{ intro.classList.add('fade-out'); }, 2000);
        setTimeout(()=>{ intro.style.display='none'; }, 2800);
    });
})();

/* ─── MODAL ─── */
function openLabModal(el){
    const accent  = el.dataset.accent;
    const history = el.dataset.history || '';
    const paras   = history.split(/\n\n+/).map(p=>p.trim()).filter(Boolean);

    document.getElementById('modal-accent-bar').style.background =
        `linear-gradient(90deg,transparent,${accent},transparent)`;
    document.getElementById('modal-emoji').textContent  = el.dataset.emoji;
    document.getElementById('modal-title').textContent  = el.dataset.name;

    const tagEl = document.getElementById('modal-tag');
    tagEl.textContent   = el.dataset.tag;
    tagEl.style.background   = el.dataset.accent+'22';
    tagEl.style.color         = el.dataset.accent;
    tagEl.style.border        = `1px solid ${el.dataset.accent}44`;

    const descEl = document.getElementById('modal-desc');
    descEl.textContent        = el.dataset.desc;
    descEl.style.color        = el.dataset.accent+'cc';
    descEl.style.borderColor  = el.dataset.accent+'44';

    document.getElementById('modal-history').innerHTML =
        paras.map(p=>`<p>${p.replace(/\n/g,'<br>')}</p>`).join('');

    document.getElementById('modal-portfolio-link').href = `{{ route('portfolio.index') }}?category=${el.dataset.slug}`;

    document.getElementById('lab-modal').classList.add('active');
    document.body.style.overflow='hidden';
}
function closeLabModal(){
    document.getElementById('lab-modal').classList.remove('active');
    document.body.style.overflow='';
}
document.addEventListener('keydown',e=>{ if(e.key==='Escape') closeLabModal(); });
</script>
@endpush

@endsection
