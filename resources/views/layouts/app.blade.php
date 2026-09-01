<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OneeMagic - Pertunjukan Magis Elegan')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            background-color: #050508;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        
        /* Ambient Background */
        .ambient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            background: radial-gradient(circle at 50% 50%, rgba(30, 20, 50, 0.4) 0%, rgba(5, 5, 8, 1) 100%);
        }

        /* Floating Cards Animation */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delay {
            animation: float 7s ease-in-out infinite 2s;
        }

        /* Magic Card Float Animations */
        @keyframes magicFloat1 {
            0%, 100% { transform: rotate(-12deg) translateY(0px); }
            50%       { transform: rotate(-12deg) translateY(-18px); }
        }
        @keyframes magicFloat2 {
            0%, 100% { transform: rotate(8deg) translateY(0px); }
            50%       { transform: rotate(8deg) translateY(-14px); }
        }
        @keyframes magicFloat3 {
            0%, 100% { transform: rotate(-6deg) translateY(0px); }
            50%       { transform: rotate(-6deg) translateY(-20px); }
        }
        @keyframes magicFloat4 {
            0%, 100% { transform: rotate(15deg) translateY(0px); }
            50%       { transform: rotate(15deg) translateY(-12px); }
        }
        @keyframes magicFloat5 {
            0%, 100% { transform: rotate(-10deg) translateY(0px); }
            50%       { transform: rotate(-10deg) translateY(-16px); }
        }
        @keyframes magicFloat6 {
            0%, 100% { transform: rotate(5deg) translateY(0px); }
            50%       { transform: rotate(5deg) translateY(-22px); }
        }
        .mc1 { animation: magicFloat1 11s ease-in-out infinite; }
        .mc2 { animation: magicFloat2 14s ease-in-out infinite 2s; }
        .mc3 { animation: magicFloat3 12s ease-in-out infinite 1s; }
        .mc4 { animation: magicFloat4 15s ease-in-out infinite 3s; }
        .mc5 { animation: magicFloat5 10s ease-in-out infinite 1.5s; }
        .mc6 { animation: magicFloat6 13s ease-in-out infinite 0.5s; }
        .magic-card-inner {
            width: 100%; height: 100%;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .magic-card-inner img {
            width: 100%; height: 100%;
            object-fit: cover;
        }
        @media (prefers-reduced-motion: reduce) {
            .mc1,.mc2,.mc3,.mc4,.mc5,.mc6 { animation: none !important; }
        }

        /* Glow Effect for Buttons */
        .glow-button {
            position: relative;
        }
        .glow-button::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(45deg, #d97706, #7e22ce, #d97706);
            z-index: -1;
            border-radius: inherit;
            filter: blur(8px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .glow-button:hover::before {
            opacity: 0.8;
        }
        
        /* Smoke Reveal Effect */
        .smoke-reveal {
            filter: blur(10px);
            opacity: 0;
            transform: scale(0.95);
            transition: all 1.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .smoke-reveal.revealed {
            filter: blur(0);
            opacity: 1;
            transform: scale(1);
        }
        
        /* 3D Transform Utilities */
        .preserve-3d {
            transform-style: preserve-3d;
        }
        .backface-hidden {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
        
        /* Magic Cursor Glow */
        #magic-cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(217,119,6,0.15) 0%, rgba(217,119,6,0) 70%);
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
            opacity: 0;
        }

        /* Splash Screen */
        .splash-screen {
            position: fixed;
            inset: 0;
            z-index: 100000;
            background-color: #050508;
            transition: background-color 1s ease-in-out;
        }
        .splash-screen.hidden-bg {
            background-color: transparent;
            pointer-events: none;
        }
        .splash-logo-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 0;
            filter: blur(20px);
            transition: all 1.5s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 100001;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        /* State 1: Appear in center */
        .splash-logo-container.animate-center {
            transform: translate(-50%, -50%) scale(1.5);
            opacity: 1;
            filter: blur(0);
        }
        /* State 2: Slide to top left (Nav position) */
        .splash-logo-container.animate-nav {
            top: 30px;
            left: 50px;
            transform: translate(0, 0) scale(0.5);
            opacity: 0; /* Fade out as real nav takes over */
            transition: all 1.2s cubic-bezier(0.65, 0, 0.35, 1);
        }
        /* Fix anchor scroll position — sections don't hide behind fixed navbar */
        section, [id] {
            scroll-margin-top: 80px;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head')
</head>
<body class="relative antialiased selection:bg-amber-500/30 selection:text-amber-200"
      x-data="{ 
          mouseX: 0, 
          mouseY: 0, 
          showCursor: false,
          splashState: 'init' // init, center, nav, done
      }"
      @mousemove="mouseX = $event.clientX; mouseY = $event.clientY; showCursor = true"
      @mouseleave="showCursor = false"
      x-init="
          if(!sessionStorage.getItem('splashed')) {
              setTimeout(() => splashState = 'center', 100);
              setTimeout(() => splashState = 'nav', 2000);
              setTimeout(() => { splashState = 'done'; sessionStorage.setItem('splashed', 'true'); }, 3200);
          } else {
              splashState = 'done';
          }
      ">
      
    <!-- Splash Screen -->
    <template x-if="splashState !== 'done'">
        <div class="splash-screen" :class="splashState === 'nav' ? 'hidden-bg' : ''">
            <div class="splash-logo-container" 
                 :class="{
                     'animate-center': splashState === 'center' || splashState === 'nav',
                     'animate-nav': splashState === 'nav'
                 }">
                <div class="flex h-24 w-24 items-center justify-center rounded-full bg-black shadow-[0_0_50px_rgba(217,119,6,0.5)] overflow-hidden">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-full w-full object-cover">
                </div>
                <span class="font-serif text-3xl tracking-widest text-white">ONEE<span class="text-amber-500">MAGIC</span></span>
            </div>
        </div>
    </template>

    <!-- Magic Cursor -->
    <div id="magic-cursor" :style="`left: ${mouseX}px; top: ${mouseY}px; opacity: ${showCursor ? 1 : 0}`"></div>

    <div class="ambient-bg"></div>




    <!-- Include Global UI Components -->
    <x-toast />


    <!-- Navbar/Header -->
    <header x-data="{ mobileMenuOpen: false }" 
            class="fixed top-0 left-0 right-0 z-50 w-full"
            style="background: rgba(5, 5, 8, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.06); transition: opacity 0.5s ease;"
            :class="splashState === 'done' ? 'opacity-100' : 'opacity-0'">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 lg:px-8" style="height: 72px;" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="{{ route('home') }}" class="-m-1.5 p-1.5 flex items-center gap-3 group">
                    <!-- Logo Circle -->
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-black shadow-[0_0_15px_rgba(217,119,6,0.4)] transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12 overflow-hidden">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-full w-full object-cover">
                    </div>
                    <span class="font-serif text-xl tracking-widest text-white">ONEE<span class="text-amber-500">MAGIC</span></span>
                </a>
            </div>
            
            <div class="flex lg:hidden">
                <button @click="mobileMenuOpen = true" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-slate-300 hover:text-white transition-colors">
                    <span class="sr-only">Buka menu utama</span>
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="{{ route('home') }}" class="text-sm font-semibold leading-6 text-slate-300 hover:text-white transition-colors">Beranda</a>
                @auth
                    <a href="{{ route('magic_lab.index') }}" class="text-sm font-semibold leading-6 text-slate-300 hover:text-white transition-colors">Magic Lab</a>
                    <a href="{{ route('journal.index') }}" class="text-sm font-semibold leading-6 text-slate-300 hover:text-white transition-colors">Jurnal</a>
                    <a href="{{ route('booking.create') }}" class="text-sm font-semibold leading-6 text-amber-500 hover:text-amber-400 transition-colors">Pemesanan</a>
                @else
                    <button type="button" @click="$dispatch('open-login-modal')" class="text-sm font-semibold leading-6 text-slate-300 hover:text-white transition-colors cursor-pointer">Magic Lab</button>
                    <button type="button" @click="$dispatch('open-login-modal')" class="text-sm font-semibold leading-6 text-slate-300 hover:text-white transition-colors cursor-pointer">Jurnal</button>
                    <button type="button" @click="$dispatch('open-login-modal')" class="text-sm font-semibold leading-6 text-amber-500 hover:text-amber-400 transition-colors cursor-pointer">Pemesanan</button>
                @endauth
            </div>
            
            <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-x-4">
                @auth
                    <div style="display:flex;align-items:center;gap:1.5rem;">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" style="font-size:0.875rem;font-weight:600;color:#f59e0b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='#f59e0b'">Admin Dasbor</a>
                        @else
                            <a href="{{ route('dashboard') }}" style="font-size:0.875rem;font-weight:600;color:#f59e0b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='#f59e0b'">Dasbor</a>
                        @endif
                        <span style="width:1px;height:1.25rem;background:rgba(255,255,255,0.12);display:inline-block;"></span>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" style="font-size:0.875rem;font-weight:500;color:#94a3b8;background:none;border:none;cursor:pointer;padding:0;transition:color 0.2s;" onmouseover="this.style.color='#f87171'" onmouseout="this.style.color='#94a3b8'">Keluar &rarr;</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-300 hover:border-amber-500 hover:text-amber-400 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-500 transition-colors">Mendaftar</a>
                @endauth
            </div>
        </nav>

        <!-- Mobile Menu (Drawer) -->
        <div x-show="mobileMenuOpen" 
             style="display: none;"
             class="fixed inset-0 z-50"
             x-ref="dialog" 
             aria-modal="true">
             
            <!-- Backdrop -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileMenuOpen = false"
                 class="fixed inset-0 bg-black/80 backdrop-blur-sm"></div>

            <!-- Panel -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transform transition ease-in-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="fixed inset-y-0 right-0 z-[100] w-full overflow-y-auto border-l border-white/10 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10"
                 style="background-color: #050508;">
                
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="font-serif text-xl tracking-widest text-white">ONEE<span class="text-amber-500">MAGIC</span></span>
                    </a>
                    <button @click="mobileMenuOpen = false" type="button" class="-m-2.5 rounded-md p-2.5 text-slate-400 hover:text-white transition-colors">
                        <span class="sr-only">Tutup menu</span>
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-white/10">
                        <div class="space-y-2 py-6">
                                <a href="{{ route('home') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-white hover:bg-white/10 transition-colors">Beranda</a>
                                @auth
                                    <a href="{{ route('magic_lab.index') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-white hover:bg-white/10 transition-colors">Magic Lab</a>
                                    <a href="{{ route('journal.index') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-white hover:bg-white/10 transition-colors">Jurnal</a>
                                    <a href="{{ route('booking.create') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-amber-500 hover:bg-white/10 transition-colors">Pemesanan</a>
                                @else
                                    <button type="button" @click="$dispatch('open-login-modal'); mobileMenuOpen = false" class="-mx-3 block w-full text-left rounded-lg px-3 py-3 text-base font-semibold leading-7 text-white hover:bg-white/10 transition-colors">Magic Lab</button>
                                    <button type="button" @click="$dispatch('open-login-modal'); mobileMenuOpen = false" class="-mx-3 block w-full text-left rounded-lg px-3 py-3 text-base font-semibold leading-7 text-white hover:bg-white/10 transition-colors">Jurnal</button>
                                    <button type="button" @click="$dispatch('open-login-modal'); mobileMenuOpen = false" class="-mx-3 block w-full text-left rounded-lg px-3 py-3 text-base font-semibold leading-7 text-amber-500 hover:bg-white/10 transition-colors">Pemesanan</button>
                                @endauth
                        </div>
                        <div class="py-6">
                            @auth
                                <div class="mb-2 text-sm text-slate-400">Halo, <span class="text-amber-500">{{ Auth::user()->name }}</span></div>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-amber-500 hover:bg-white/10 hover:text-amber-400 transition-colors">Admin Dasbor</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-amber-500 hover:bg-white/10 hover:text-amber-400 transition-colors">Dasbor Saya</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                    @csrf
                                    <button type="submit" class="-mx-3 block w-full text-left rounded-lg px-3 py-3 text-base font-semibold leading-7 text-slate-400 hover:bg-white/10 hover:text-red-400 transition-colors">Keluar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-3 text-base font-semibold leading-7 text-slate-300 hover:bg-white/10 hover:text-white transition-colors">Masuk</a>
                                <a href="{{ route('register') }}" class="mt-2 block w-full rounded-md bg-amber-600 px-3 py-3 text-center text-sm font-semibold text-white hover:bg-amber-500 transition-colors">Mendaftar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="relative w-full min-h-screen flex flex-col bg-[#0a0f1c] text-white overflow-hidden">
               <!-- Global Background Layer (Spans full page height, including footer) -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden hidden lg:block">
            <!-- Card 1: Top Left -->
            <div class="mc1 absolute" style="top:5%; left:5%; width:200px; height:280px;">
                <div class="magic-card-inner" style="opacity:0.60; filter:blur(2px); box-shadow:0 0 50px rgba(60,80,220,0.15);">
                    <img src="{{ asset('images/magic-card-1.jpg') }}" alt="" style="object-position:center top;">
                    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(20,10,60,0.5) 0%,transparent 65%);"></div>
                </div>
            </div>

            <!-- Card 2: Top Right -->
            <div class="mc2 absolute" style="top:20%; right:15%; width:180px; height:252px;">
                <div class="magic-card-inner" style="opacity:0.60; filter:blur(2px); box-shadow:0 0 60px rgba(80,40,200,0.10);">
                    <img src="{{ asset('images/magic-card-2.jpg') }}" alt="" style="object-position:center center;">
                    <div style="position:absolute;inset:0;background:rgba(10,5,30,0.4);"></div>
                </div>
            </div>

            <!-- Card 3: Middle Left -->
            <div class="mc3 absolute" style="top:45%; left:2%; width:190px; height:266px;">
                <div class="magic-card-inner" style="opacity:0.60; filter:blur(2px); box-shadow:0 0 45px rgba(60,80,220,0.12);">
                    <img src="{{ asset('images/magic-card-3.jpg') }}" alt="" style="object-position:center 30%;">
                    <div style="position:absolute;inset:0;background:linear-gradient(225deg,rgba(20,10,60,0.5) 0%,transparent 65%);"></div>
                </div>
            </div>

            <!-- Card 4: Mid-lower Right -->
            <div class="mc4 absolute" style="top:65%; right:2%; width:185px; height:259px;">
                <div class="magic-card-inner" style="opacity:0.60; filter:blur(2px); box-shadow:0 0 40px rgba(80,40,200,0.10);">
                    <img src="{{ asset('images/magic-card-4.jpg') }}" alt="" style="object-position:center top;">
                    <div style="position:absolute;inset:0;background:linear-gradient(315deg,rgba(20,10,60,0.45) 0%,transparent 60%);"></div>
                </div>
            </div>

            <!-- Card 5: Bottom Left -->
            <div class="mc5 absolute" style="top:90%; left:10%; width:195px; height:273px;">
                <div class="magic-card-inner" style="opacity:0.60; filter:blur(2px); box-shadow:0 0 45px rgba(60,80,220,0.12);">
                    <img src="{{ asset('images/magic-card-2.jpg') }}" alt="" style="object-position:top center;">
                    <div style="position:absolute;inset:0;background:linear-gradient(45deg,rgba(20,10,60,0.5) 0%,transparent 65%);"></div>
                </div>
            </div>
        </div>
        
        <!-- Foreground Content Layer -->
        <div class="relative z-10 w-full flex flex-col flex-grow">
            <main class="flex-grow pt-[72px]">
                @yield('content')
            </main>

            <footer class="mt-32 border-t border-white/10 bg-black/50 py-12 backdrop-blur-md">
                <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                    <p class="text-sm text-slate-500">&copy; {{ date('Y') }} OneeMagic. Hak Cipta Dilindungi.</p>
                </div>
            </footer>
        </div>
        
    </div>

    <!-- Modal Login — rendered last so z-index is always highest -->
    <x-modal-login />

    @stack('scripts')
</body>
</html>
