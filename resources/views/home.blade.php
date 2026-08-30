@extends('layouts.app')

@section('content')
<div class="relative isolate">
    <!-- Dekorasi Magic -->
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>

    <!-- SECTION 1: Frame Sambutan (Welcome Frame) -->
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">

        <!-- ATMOSPHERIC BACKGROUND GLOWS (FRAME 1) -->
        <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
            <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(80,40,160,0.18) 0%, rgba(30,20,80,0.10) 50%, transparent 100%);"></div>
            <div class="absolute -top-20 -left-20 w-96 h-96 rounded-full" style="background: radial-gradient(circle, rgba(40,80,200,0.12) 0%, transparent 70%); filter: blur(40px);"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full" style="background: radial-gradient(circle, rgba(60,50,180,0.12) 0%, transparent 70%); filter: blur(40px);"></div>
        </div>

        <div class="relative z-10 w-full mx-auto max-w-7xl px-6 lg:px-8 text-center mt-[-4rem]"> <!-- mt-[-4rem] pulls text up slightly to optically center it better -->
            <div x-data="{ revealed: false }" x-init="setTimeout(() => revealed = true, 300)" class="mx-auto max-w-2xl">
                <h1 class="smoke-reveal font-serif text-4xl font-bold tracking-tight text-white sm:text-6xl" :class="revealed ? 'revealed' : ''" style="transition-delay: 100ms;">
                    Rasakan Pengalaman <span class="text-amber-500">Magis</span> Tak Terlupakan
                </h1>

                <p class="smoke-reveal mt-6 text-lg leading-8 text-slate-300" :class="revealed ? 'revealed' : ''" style="transition-delay: 400ms;">
                    OneeMagic menghadirkan pertunjukan sulap premium untuk acara eksklusif Anda. Ilusi yang memukau, elegan, dan penuh misteri.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               style="display:inline-flex;align-items:center;gap:0.5rem;border-radius:9999px;background:#d97706;padding:0.85rem 2rem;font-size:0.875rem;font-weight:600;color:#fff;text-decoration:none;transition:background 0.2s,transform 0.2s,box-shadow 0.2s;"
                               onmouseover="this.style.background='#b45309';this.style.transform='scale(1.04)'"
                               onmouseout="this.style.background='#d97706';this.style.transform='scale(1)'">
                                <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                                Panel Admin
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                               style="display:inline-flex;align-items:center;gap:0.5rem;border-radius:9999px;background:#d97706;padding:0.85rem 2rem;font-size:0.875rem;font-weight:600;color:#fff;text-decoration:none;transition:background 0.2s,transform 0.2s,box-shadow 0.2s;"
                               onmouseover="this.style.background='#b45309';this.style.transform='scale(1.04)'"
                               onmouseout="this.style.background='#d97706';this.style.transform='scale(1)'">
                                <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                Let's Go! ✦
                            </a>
                        @endif
                    @else
                        <button type="button" @click="$dispatch('open-login-modal')"
                                style="display:inline-flex;align-items:center;gap:0.5rem;border-radius:9999px;background:#d97706;padding:0.85rem 2rem;font-size:0.875rem;font-weight:600;color:#fff;border:none;cursor:pointer;transition:background 0.2s,transform 0.2s;"
                                onmouseover="this.style.background='#b45309';this.style.transform='scale(1.04)'"
                                onmouseout="this.style.background='#d97706';this.style.transform='scale(1)'">
                            <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Reservasi Sekarang
                        </button>
                    @endauth
                </div>

                <!-- Scroll Down Indicator (Memandu user untuk scroll) -->
                <div class="flex flex-col items-center justify-center animate-bounce opacity-60" style="margin-top: 4rem;">
                    <span class="text-[10px] text-amber-500 mb-1 uppercase tracking-widest font-semibold">Scroll</span>
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </div>

            <!-- Decorative Filler Text (Menggantung tepat di bawah konten utama, di area kosong kuning) -->
            <div class="absolute inset-x-0 top-full mt-16 flex justify-center w-full px-6 pointer-events-none">
                <div class="text-center transition-all duration-1000 ease-out opacity-0" 
                     x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 800)"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    <p class="font-serif text-amber-500/70 italic text-lg md:text-xl tracking-wider font-light">
                        "Di mana realitas berakhir, keajaiban dimulai."
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-4 opacity-40">
                        <div class="h-px w-12 md:w-24 bg-gradient-to-r from-transparent to-amber-500"></div>
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 9l7 1-5 5 1 7-7-4-7 4 1-7-5-5 7-1z"/></svg>
                        <div class="h-px w-12 md:w-24 bg-gradient-to-l from-transparent to-amber-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: Foto Kakak (Muncul langsung saat di-scroll) -->
    <section class="relative pt-8 pb-12 overflow-hidden">
        
        <!-- Background ambient untuk seksi foto -->
        <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
            <div class="absolute inset-0" style="background: radial-gradient(ellipse 80% 50% at 50% 50%, rgba(217,119,6,0.05) 0%, transparent 70%);"></div>
        </div>

        <div class="relative z-10 w-full text-center">
            <!-- Foto Pesulap -->
            <style>
                .magician-slideshow {
                    position: relative;
                    width: 22rem;
                    height: 420px;
                    margin: 0 auto;
                }
                @media (min-width: 768px) {
                    .magician-slideshow { width: 26rem; height: 500px; }
                }
                .magician-spotlight {
                    position: absolute; top: 50%; left: 50%;
                    transform: translate(-50%, -50%);
                    width: 20rem; height: 20rem;
                    background: radial-gradient(ellipse, rgba(217,119,6,0.25) 0%, rgba(124,58,237,0.08) 50%, transparent 75%);
                    border-radius: 50%; filter: blur(40px);
                    pointer-events: none;
                }
                .magician-imgs { position: absolute; inset: 0; }
                .magician-imgs img {
                    position: absolute; inset: 0; width: 100%; height: 100%;
                    object-fit: contain; opacity: 0;
                    filter: drop-shadow(0 0 28px rgba(255,165,0,0.35));
                    animation: magicFade 16s ease-in-out infinite;
                    animation-fill-mode: both;
                }
                .magician-imgs img:nth-child(1) { animation-delay: 0s; }
                .magician-imgs img:nth-child(2) { animation-delay: 4s; }
                .magician-imgs img:nth-child(3) { animation-delay: 8s; }
                .magician-imgs img:nth-child(4) { animation-delay: 12s; }
                @keyframes magicFade {
                    0%      { opacity: 0; transform: scale(0.98); }
                    6.25%   { opacity: 1; transform: scale(1); }
                    25%     { opacity: 1; transform: scale(1.01); }
                    31.25%  { opacity: 0; transform: scale(1.02); }
                    100%    { opacity: 0; transform: scale(1.02); }
                }
            </style>
            <div class="magician-slideshow">
                <div class="magician-spotlight"></div>
                <div class="magician-imgs">
                    <img src="/images/magician/foto1.png" alt="Magician 1">
                    <img src="/images/magician/foto2.png" alt="Magician 2">
                    <img src="/images/magician/foto3.png" alt="Magician 3">
                    <img src="/images/magician/foto4.png" alt="Magician 4">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-24 pt-8 sm:pb-32">


        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base font-semibold leading-7 text-amber-500">Layanan Eksklusif</h2>
            <p class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl">Pertunjukan Magis Untuk Berbagai Momen</p>
        </div>
        
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                
                <!-- Card 1 -->
                <div class="group flex flex-col items-start rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 hover:bg-white/10 transition-all duration-300 hover:shadow-[0_0_30px_rgba(217,119,6,0.15)] relative overflow-hidden">
                    <!-- Hover Glow Effect -->
                    <div class="absolute -inset-x-4 -top-4 bottom-0 z-0 bg-gradient-to-b from-amber-500/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                    
                    <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-500/20 text-amber-400 ring-1 ring-amber-500/30">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <dt class="relative z-10 mt-6 text-xl font-serif font-semibold leading-7 text-white">
                        Wedding Magic
                    </dt>
                    <dd class="relative z-10 mt-2 text-base leading-7 text-slate-400">
                        Sentuhan ajaib yang membuat hari pernikahan Anda menjadi tak terlupakan bagi semua tamu undangan.
                    </dd>
                </div>

                <!-- Card 2 -->
                <div class="group flex flex-col items-start rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 hover:bg-white/10 transition-all duration-300 hover:shadow-[0_0_30px_rgba(217,119,6,0.15)] relative overflow-hidden">
                    <div class="absolute -inset-x-4 -top-4 bottom-0 z-0 bg-gradient-to-b from-amber-500/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                    <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-500/20 text-amber-400 ring-1 ring-amber-500/30">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <dt class="relative z-10 mt-6 text-xl font-serif font-semibold leading-7 text-white">
                        Corporate Magic
                    </dt>
                    <dd class="relative z-10 mt-2 text-base leading-7 text-slate-400">
                        Hiburan berkelas untuk acara perusahaan, peluncuran produk, atau gala dinner eksklusif.
                    </dd>
                </div>

                <!-- Card 3 -->
                <div class="group flex flex-col items-start rounded-2xl bg-white/5 p-8 ring-1 ring-white/10 hover:bg-white/10 transition-all duration-300 hover:shadow-[0_0_30px_rgba(217,119,6,0.15)] relative overflow-hidden">
                    <div class="absolute -inset-x-4 -top-4 bottom-0 z-0 bg-gradient-to-b from-amber-500/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                    <div class="relative z-10 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-500/20 text-amber-400 ring-1 ring-amber-500/30">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <dt class="relative z-10 mt-6 text-xl font-serif font-semibold leading-7 text-white">
                        Private Show
                    </dt>
                    <dd class="relative z-10 mt-2 text-base leading-7 text-slate-400">
                        Pertunjukan intim dan personal (close-up magic) yang berinteraksi langsung dengan audiens secara dekat.
                    </dd>
                </div>
                
            </dl>
        </div>
    </div>

    <!-- Ruang Ilusi (Magic Lab) Section -->
    <div class="relative py-24 sm:py-32 overflow-hidden border-t border-white/5 bg-black/40 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-base font-semibold leading-7 text-purple-400 tracking-widest uppercase">Magic Lab</h2>
                <p class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl">Ruang Ilusi Interaktif</p>
                <p class="mt-6 text-lg leading-8 text-slate-400">Arahkan kursor Anda ke kartu di bawah ini untuk melihat keajaiban yang tersembunyi.</p>
            </div>

            <style>
                .magic-card:hover .flip-inner {
                    transform: rotateY(180deg) !important;
                }
            </style>
            <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 perspective-[1000px]">
                
                <!-- Flip Card 1 -->
                <div class="group magic-card relative cursor-pointer" style="perspective: 1000px; height: 22rem;">
                    <div class="flip-inner relative w-full h-full transition-all duration-700" style="transform-style: preserve-3d;">
                        <!-- Front Face -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-slate-900 to-[#111] p-6 ring-1 ring-white/10 shadow-2xl flex flex-col items-center justify-center gap-4" style="backface-visibility: hidden; -webkit-backface-visibility: hidden;">
                            <div class="text-6xl text-amber-500">♠</div>
                            <div class="text-center">
                                <h3 class="text-xl font-serif font-bold text-white">Ilusi Pikiran</h3>
                                <p class="mt-2 text-sm text-slate-500">Arahkan kursor untuk mengungkap rahasia</p>
                            </div>
                        </div>
                        <!-- Back Face -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-amber-600 to-purple-900 p-6 ring-1 ring-white/20 shadow-[0_0_40px_rgba(217,119,6,0.3)] flex flex-col items-center justify-center gap-4 text-center" style="backface-visibility: hidden; -webkit-backface-visibility: hidden; transform: rotateY(180deg);">
                            <div class="text-4xl">🧠</div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Membaca Pikiran</h3>
                                <p class="mt-3 text-sm text-white/90 leading-relaxed">Kami dapat menebak kartu apa yang sedang Anda pikirkan bahkan sebelum Anda mengucapkannya.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flip Card 2 -->
                <div class="group magic-card relative cursor-pointer" style="perspective: 1000px; height: 22rem;">
                    <div class="flip-inner relative w-full h-full transition-all duration-700" style="transform-style: preserve-3d;">
                        <!-- Front Face -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-slate-900 to-[#111] p-6 ring-1 ring-white/10 shadow-2xl flex flex-col items-center justify-center gap-4" style="backface-visibility: hidden; -webkit-backface-visibility: hidden;">
                            <div class="text-6xl text-purple-500">♣</div>
                            <div class="text-center">
                                <h3 class="text-xl font-serif font-bold text-white">Manipulasi Objek</h3>
                                <p class="mt-2 text-sm text-slate-500">Arahkan kursor untuk mengungkap rahasia</p>
                            </div>
                        </div>
                        <!-- Back Face -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-purple-900 to-indigo-900 p-6 ring-1 ring-white/20 shadow-[0_0_40px_rgba(147,51,234,0.3)] flex flex-col items-center justify-center gap-4 text-center" style="backface-visibility: hidden; -webkit-backface-visibility: hidden; transform: rotateY(180deg);">
                            <div class="text-4xl">✨</div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Levitasi Murni</h3>
                                <p class="mt-3 text-sm text-white/90 leading-relaxed">Menghilangkan gravitasi. Cincin kawin atau koin akan melayang tepat di depan mata Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flip Card 3 -->
                <div class="group magic-card relative cursor-pointer sm:col-span-2 lg:col-span-1" style="perspective: 1000px; height: 22rem;">
                    <div class="flip-inner relative w-full h-full transition-all duration-700" style="transform-style: preserve-3d;">
                        <!-- Front Face -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-slate-900 to-[#111] p-6 ring-1 ring-white/10 shadow-2xl flex flex-col items-center justify-center gap-4" style="backface-visibility: hidden; -webkit-backface-visibility: hidden;">
                            <div class="text-6xl text-rose-500">♥</div>
                            <div class="text-center">
                                <h3 class="text-xl font-serif font-bold text-white">Ilusi Ruang & Waktu</h3>
                                <p class="mt-2 text-sm text-slate-500">Arahkan kursor untuk mengungkap rahasia</p>
                            </div>
                        </div>
                        <!-- Back Face -->
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-rose-700 to-red-950 p-6 ring-1 ring-white/20 shadow-[0_0_40px_rgba(225,29,72,0.3)] flex flex-col items-center justify-center gap-4 text-center" style="backface-visibility: hidden; -webkit-backface-visibility: hidden; transform: rotateY(180deg);">
                            <div class="text-4xl">🌀</div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Teleportasi Visual</h3>
                                <p class="mt-3 text-sm text-white/90 leading-relaxed">Objek berpindah dari satu tangan ke tangan Anda yang tertutup rapat tanpa tersentuh.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
