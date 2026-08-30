<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin - OneeMagic</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #030305; color: #f1f5f9; font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .sidebar { background: rgba(10,10,18,0.95); border-right: 1px solid rgba(255,255,255,0.06); }
        .nav-active { background: rgba(217,119,6,0.15); color: #f59e0b; border-left: 2px solid #f59e0b; }
        .nav-item { border-left: 2px solid transparent; }
        .stat-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; }
        .stat-card:hover { background: rgba(255,255,255,0.04); border-color: rgba(217,119,6,0.3); transform: translateY(-2px); }
        .glass-header { background: rgba(5,5,8,0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body class="antialiased h-screen overflow-hidden flex">
    {{-- SIDEBAR --}}
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col h-full overflow-y-auto hidden md:flex">
        <div class="flex items-center gap-3 px-6 py-5 border-b border-white/5">
            <img src="{{ asset('logo.png') }}" class="h-8 w-8 rounded-full ring-1 ring-amber-500/30" alt="Logo">
            <span class="font-serif text-lg tracking-widest text-white">ONEE<span class="text-amber-500">ADMIN</span></span>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-item nav-active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Ringkasan
            </a>
            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-widest">Manajemen</p>
            <a href="{{ route('admin.bookings.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
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
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 w-full text-left text-[11px] text-slate-400 hover:text-white px-3 py-2 rounded-lg hover:bg-white/5 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Web Utama
                </a>
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
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-amber-900/10 via-transparent to-transparent pointer-events-none"></div>
        
        <header class="glass-header flex items-center justify-between px-8 py-5 flex-shrink-0 z-10">
            <div>
                <h1 class="font-serif text-2xl font-bold text-white mb-1">Dasbor Overview</h1>
                <p class="text-xs text-slate-400">Ringkasan aktivitas OneeMagic Entertainment</p>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 z-10">
            
            {{-- STATS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Booking -->
                <div class="stat-card rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Total Pemesanan</p>
                    <p class="font-serif text-4xl font-bold text-white">{{ $totalBookings }}</p>
                </div>
                
                <!-- Pending Booking -->
                <div class="stat-card rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Menunggu Proses</p>
                    <p class="font-serif text-4xl font-bold text-yellow-500">{{ $pendingBookings }}</p>
                </div>

                <!-- Portfolios -->
                <div class="stat-card rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Karya Portofolio</p>
                    <p class="font-serif text-4xl font-bold text-white">{{ $totalPortfolios }}</p>
                </div>

                <!-- Journals -->
                <div class="stat-card rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Artikel Jurnal</p>
                    <p class="font-serif text-4xl font-bold text-white">{{ $totalJournals }}</p>
                </div>
            </div>

            {{-- RECENT BOOKINGS --}}
            <div class="stat-card rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b border-white/5 flex items-center justify-between">
                    <h2 class="text-base font-semibold text-white">Pemesanan Terbaru</h2>
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs text-amber-500 hover:text-amber-400 transition-colors">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/[0.02] text-[10px] uppercase tracking-widest text-slate-500">
                                <th class="py-4 px-6 font-semibold">Klien & Acara</th>
                                <th class="py-4 px-6 font-semibold">Tanggal</th>
                                <th class="py-4 px-6 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($recentBookings as $booking)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="py-4 px-6">
                                    <p class="text-sm font-medium text-white mb-0.5">{{ $booking->event_name }}</p>
                                    <p class="text-xs text-slate-400">{{ $booking->user->name }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-sm text-slate-300">{{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    @if($booking->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-semibold bg-yellow-400/10 text-yellow-400 border border-yellow-400/20"><span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse"></span> Menunggu</span>
                                    @elseif($booking->status === 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-semibold bg-blue-400/10 text-blue-400 border border-blue-400/20"><span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> Disetujui</span>
                                    @elseif($booking->status === 'paid')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-semibold bg-green-400/10 text-green-400 border border-green-400/20"><span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Lunas</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-semibold bg-red-400/10 text-red-400 border border-red-400/20"><span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-slate-500 text-sm">Belum ada pemesanan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
