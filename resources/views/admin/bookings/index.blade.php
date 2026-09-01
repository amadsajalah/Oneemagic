<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pemesanan — OneeMagic Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { fontFamily: { serif: ['Playfair Display','serif'] } } } }</script>
    @vite(['resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: #030308; }
        .sidebar-bg { background: rgba(8,8,16,0.98); border-right: 1px solid rgba(255,255,255,0.06); }
        .card { background: rgba(255,255,255,0.035); border: 1px solid rgba(255,255,255,0.07); }
        .nav-active { background: rgba(217,119,6,0.12); color: #f59e0b; border-right: 2px solid #f59e0b; }
        .input-field { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; }
        .input-field:focus { outline: none; border-color: rgba(217,119,6,0.5); }
        .input-field option { background-color: #080810; color: #f1f5f9; }
        .input-field::placeholder { color: rgba(148,163,184,0.4); }
        /* Mobile sidebar overlay */
        #mobile-sidebar-overlay { display: none; }
        #mobile-sidebar-overlay.open { display: block; }
        #mobile-sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
        #mobile-sidebar.open { transform: translateX(0); }
    </style>
</head>
<body class="antialiased text-slate-200">
    <x-toast />

    {{-- MOBILE SIDEBAR OVERLAY --}}
    <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-40 md:hidden" onclick="closeSidebar()"></div>

    {{-- MOBILE SIDEBAR (slide-in from left) --}}
    <aside id="mobile-sidebar" class="fixed inset-y-0 left-0 z-50 sidebar-bg w-64 flex flex-col md:hidden overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-white/5">
            <span class="font-serif text-lg tracking-widest text-white">ONEE<span class="text-amber-500">ADMIN</span></span>
            <button onclick="closeSidebar()" class="text-slate-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Ringkasan
            </a>
            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-widest">Manajemen</p>
            <a href="{{ route('admin.bookings.index') }}" class="nav-item nav-active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Pemesanan
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Portofolio
            </a>
            <a href="{{ route('admin.journals.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Jurnal & Artikel
            </a>
        </nav>
        <div class="flex-shrink-0 p-4 border-t border-white/5">
            <div class="flex items-center gap-3 mb-4 px-1">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-xs font-bold text-white shadow-lg shadow-amber-500/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-amber-500">Administrator</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit" class="flex items-center gap-2 w-full text-left text-[11px] text-red-400/80 hover:text-red-400 px-3 py-2 rounded-lg hover:bg-red-500/10 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Log
                </button>
            </form>
        </div>
    </aside>

    <div class="flex h-screen overflow-hidden">
        {{-- DESKTOP SIDEBAR --}}
        <aside class="sidebar-bg w-64 flex-shrink-0 flex flex-col h-full overflow-y-auto hidden md:flex">
            <div class="flex items-center gap-3 px-6 py-5 border-b border-white/5">
                <img src="{{ asset('logo.png') }}" class="h-8 w-8 rounded-full ring-1 ring-amber-500/30" alt="Logo">
                <span class="font-serif text-lg tracking-widest text-white">ONEE<span class="text-amber-500">ADMIN</span></span>
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Ringkasan
                </a>
                <p class="px-4 pt-4 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-widest">Manajemen</p>
                <a href="{{ route('admin.bookings.index') }}" class="nav-item nav-active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Pemesanan
                </a>
                <a href="{{ route('admin.portfolios.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Portofolio
                </a>
                <a href="{{ route('admin.journals.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Jurnal & Artikel
                </a>
            </nav>
            <div class="flex-shrink-0 p-4 border-t border-white/5">
                <div class="flex items-center gap-3 mb-4 px-1">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-xs font-bold text-white shadow-lg shadow-amber-500/20">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-amber-500">Administrator</p>
                    </div>
                </div>
                <div class="space-y-1">
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left text-[11px] text-red-400/80 hover:text-red-400 px-3 py-2 rounded-lg hover:bg-red-500/10 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar Log
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex-shrink-0 flex items-center justify-between h-16 px-4 md:px-8 border-b border-white/5" style="background: rgba(5,5,10,0.7); backdrop-filter: blur(12px);">
                <div class="flex items-center gap-3">
                    {{-- Mobile hamburger --}}
                    <button onclick="openSidebar()" class="md:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors" aria-label="Buka menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 style="font-family:'Playfair Display',serif;" class="text-lg font-semibold text-white">Manajemen Pemesanan</h1>
                </div>
                <span class="text-xs text-slate-600 hidden sm:block">Daftar Reservasi Klien</span>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-5 flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-green-400 border border-green-500/20" style="background: rgba(34,197,94,0.06);">✓ {{ session('success') }}</div>
                @endif

                {{-- Search + Sort Bar --}}
                <form method="GET" action="{{ route('admin.bookings.index') }}" class="card rounded-xl p-4 mb-6 space-y-3 md:space-y-0 md:flex md:flex-wrap md:items-center md:gap-3">
                    {{-- Search input full width on mobile --}}
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="input-field rounded-xl px-4 py-2.5 text-sm w-full md:flex-1 md:min-w-48"
                           placeholder="🔍  Cari nama klien atau acara...">
                    {{-- Sort & direction side by side on mobile --}}
                    <div class="flex gap-2 w-full md:w-auto md:contents">
                        <select name="sort" class="input-field rounded-xl px-3 py-2.5 text-sm flex-1 md:flex-none">
                            <option value="event_date" {{ request('sort')=='event_date'?'selected':'' }}>Tgl Acara</option>
                            <option value="created_at" {{ request('sort')=='created_at'?'selected':'' }}>Tgl Masuk</option>
                            <option value="status" {{ request('sort')=='status'?'selected':'' }}>Status</option>
                        </select>
                        <select name="direction" class="input-field rounded-xl px-3 py-2.5 text-sm flex-1 md:flex-none">
                            <option value="asc" {{ request('direction','asc')=='asc'?'selected':'' }}>↑ Asc</option>
                            <option value="desc" {{ request('direction')=='desc'?'selected':'' }}>↓ Desc</option>
                        </select>
                    </div>
                    {{-- Buttons side by side full width on mobile --}}
                    <div class="flex gap-2 w-full md:w-auto md:contents">
                        <button type="submit" class="flex-1 md:flex-none px-5 py-2.5 rounded-xl text-sm font-semibold text-white transition-colors" style="background: #d97706;">Terapkan</button>
                        @if(request()->hasAny(['search','sort','direction']))
                            <a href="{{ route('admin.bookings.index') }}" class="flex-1 md:flex-none text-center px-4 py-2.5 rounded-xl text-sm text-slate-400 hover:text-white bg-white/5 hover:bg-white/10 transition-colors">Reset</a>
                        @endif
                    </div>
                </form>


                {{-- MOBILE CARD LIST (visible on mobile only) --}}
                <div class="md:hidden space-y-3 mb-4">
                    @forelse($bookings as $booking)
                        <div class="card rounded-xl p-4 space-y-3">
                            {{-- Header row: Name + Status --}}
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $booking->user->name ?? '—' }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $booking->user->email ?? '' }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    @if($booking->status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-yellow-400/10 text-yellow-400 ring-1 ring-yellow-400/20"><span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse inline-block"></span>Menunggu</span>
                                    @elseif($booking->status === 'approved')
                                        @if($booking->payment_status === 'paid')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20"><span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>Lunas & Fix</span>
                                        @elseif($booking->payment_status === 'verifying')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-400/10 text-blue-400 ring-1 ring-blue-400/20"><span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span>Cek Bayar</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-indigo-400/10 text-indigo-400 ring-1 ring-indigo-400/20"><span class="w-1.5 h-1.5 rounded-full bg-indigo-400 inline-block"></span>Tunggu Bayar</span>
                                        @endif
                                    @elseif($booking->status === 'paid')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20"><span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>Lunas & Fix</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-red-400/10 text-red-400 ring-1 ring-red-400/20"><span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span>Ditolak</span>
                                    @endif
                                </div>
                            </div>
                            {{-- Event info --}}
                            <div class="border-t border-white/5 pt-3 grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <p class="text-slate-500 mb-0.5">Acara</p>
                                    <p class="text-slate-200 font-medium">{{ Str::limit($booking->event_name, 25) }}</p>
                                </div>
                                <div>
                                    <p class="text-slate-500 mb-0.5">Tanggal</p>
                                    <p class="text-slate-200 font-medium">{{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-slate-500 mb-0.5">Waktu</p>
                                    <p class="text-slate-200">{{ $booking->event_time }}</p>
                                </div>
                                <div>
                                    <p class="text-slate-500 mb-0.5">Tamu</p>
                                    <p class="text-slate-200">{{ $booking->guest_count ?? '-' }} orang</p>
                                </div>
                            </div>
                            {{-- Actions --}}
                            <div class="border-t border-white/5 pt-3 flex flex-wrap gap-2">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="flex-1 text-center text-[11px] font-medium text-amber-500 border border-amber-500/30 px-3 py-2 rounded-lg transition-all hover:bg-amber-500/10">
                                    👁 Detail & Chat
                                </a>
                                @if($booking->status === 'pending')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button class="w-full text-[11px] font-medium text-green-400 border border-green-400/30 px-3 py-2 rounded-lg transition-all hover:bg-green-400/10">✓ Terima</button>
                                    </form>
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="w-full text-[11px] font-medium text-red-400 border border-red-400/30 px-3 py-2 rounded-lg transition-all hover:bg-red-400/10">✗ Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="card rounded-xl py-16 text-center text-sm text-slate-600">Belum ada data pemesanan.</div>
                    @endforelse
                </div>

                {{-- DESKTOP TABLE (hidden on mobile) --}}
                <div class="hidden md:block card rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full" style="min-width: 700px;">
                            <thead>
                                <tr class="border-b border-white/5" style="background: rgba(255,255,255,0.025);">
                                    <th class="py-3.5 px-5 text-left text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Klien</th>
                                    <th class="py-3.5 px-5 text-left text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Detail Acara</th>
                                    <th class="py-3.5 px-5 text-left text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Tanggal & Waktu</th>
                                    <th class="py-3.5 px-5 text-left text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Tamu</th>
                                    <th class="py-3.5 px-5 text-left text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                    <th class="py-3.5 px-5 text-right text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/[0.04]">
                                @forelse($bookings as $booking)
                                    <tr class="hover:bg-white/[0.025] transition-colors">
                                        <td class="py-3.5 px-5">
                                            <p class="text-sm font-semibold text-white">{{ $booking->user->name ?? '—' }}</p>
                                            <p class="text-xs text-slate-600">{{ $booking->user->email ?? '' }}</p>
                                        </td>
                                        <td class="py-3.5 px-5">
                                            <p class="text-sm text-slate-300">{{ Str::limit($booking->event_name, 30) }}</p>
                                            <p class="text-xs text-slate-600 truncate max-w-xs">{{ $booking->event_location }}</p>
                                        </td>
                                        <td class="py-3.5 px-5">
                                            <p class="text-sm text-slate-300">{{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}</p>
                                            <p class="text-xs text-slate-600">{{ $booking->event_time }}</p>
                                        </td>
                                        <td class="py-3.5 px-5 text-sm text-slate-400">{{ $booking->guest_count ?? '-' }}</td>
                                        <td class="py-3.5 px-5">
                                            @if($booking->status === 'pending')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-yellow-400/10 text-yellow-400 ring-1 ring-yellow-400/20"><span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse inline-block"></span> Menunggu</span>
                                            @elseif($booking->status === 'approved')
                                                @if($booking->payment_status === 'paid')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20"><span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span> Lunas & Fix</span>
                                                @elseif($booking->payment_status === 'verifying')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-400/10 text-blue-400 ring-1 ring-blue-400/20"><span class="w-1.5 h-1.5 rounded-full bg-blue-400 inline-block"></span> Cek Pembayaran</span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-indigo-400/10 text-indigo-400 ring-1 ring-indigo-400/20"><span class="w-1.5 h-1.5 rounded-full bg-indigo-400 inline-block"></span> Menunggu Bayar</span>
                                                @endif
                                            @elseif($booking->status === 'paid')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20"><span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span> Lunas & Fix</span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-red-400/10 text-red-400 ring-1 ring-red-400/20"><span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span> Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-5">
                                            <div class="flex justify-end gap-2 flex-wrap">
                                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-[11px] font-medium text-amber-500 hover:text-amber-400 border border-amber-500/20 hover:border-amber-500/50 px-3 py-1.5 rounded-lg transition-all flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                    Detail & Chat
                                                </a>
                                                @if($booking->status === 'pending')
                                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button class="text-[11px] font-medium text-green-400 hover:text-green-300 border border-green-400/20 hover:border-green-400/50 px-3 py-1.5 rounded-lg transition-all">✓ Terima</button>
                                                </form>
                                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="text-[11px] font-medium text-red-400 hover:text-red-300 border border-red-400/20 hover:border-red-400/50 px-3 py-1.5 rounded-lg transition-all">✗ Tolak</button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="py-16 text-center text-sm text-slate-700">Belum ada data pemesanan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($bookings->hasPages())
                        <div class="px-5 py-3 border-t border-white/5">{{ $bookings->links() }}</div>
                    @endif
                </div>

                {{-- Pagination for mobile --}}
                @if($bookings->hasPages())
                    <div class="md:hidden mt-4">{{ $bookings->links() }}</div>
                @endif

            </main>
        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('mobile-sidebar').classList.add('open');
            document.getElementById('mobile-sidebar-overlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebar() {
            document.getElementById('mobile-sidebar').classList.remove('open');
            document.getElementById('mobile-sidebar-overlay').classList.remove('open');
            document.body.style.overflow = '';
        }
    </script>
</body>
</html>