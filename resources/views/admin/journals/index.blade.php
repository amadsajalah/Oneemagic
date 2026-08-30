<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jurnal - OneeMagic Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #030305; color: #f1f5f9; font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .sidebar { background: rgba(10,10,18,0.95); border-right: 1px solid rgba(255,255,255,0.06); }
        .nav-active { background: rgba(217,119,6,0.15); color: #f59e0b; border-left: 2px solid #f59e0b; }
        .nav-item { border-left: 2px solid transparent; }
        .glass-header { background: rgba(5,5,8,0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); }
        .card-premium { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 1rem; }
        .input-premium { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); color: white; transition: all 0.2s; border-radius: 0.75rem; }
        .input-premium:focus { border-color: rgba(217,119,6,0.5); background: rgba(255,255,255,0.05); outline: none; }
        .btn-gold { background: #d97706; color: white; border-radius: 0.75rem; font-weight: 600; transition: all 0.2s; border: none; }
        .btn-gold:hover { background: #b45309; transform: translateY(-1px); }
    </style>
</head>
<body class="antialiased h-screen overflow-hidden flex">
    {{-- SIDEBAR (Same as Dashboard) --}}
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col h-full overflow-y-auto hidden md:flex">
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
            <a href="{{ route('admin.bookings.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Pemesanan
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Portofolio
            </a>
            <a href="{{ route('admin.journals.index') }}" class="nav-item nav-active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
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
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-amber-900/10 via-transparent to-transparent pointer-events-none"></div>
        
        <header class="glass-header flex items-center justify-between px-8 py-5 flex-shrink-0 z-10">
            <div>
                <h1 class="font-serif text-2xl font-bold text-white mb-1">Manajemen Jurnal</h1>
                <p class="text-xs text-slate-400">Tulis dan kelola artikel jurnal OneeMagic.</p>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 z-10">
            @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-500/10 border border-green-500/20 px-4 py-3 text-sm text-green-400 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KIRI: FORM --}}
                <div class="lg:col-span-1">
                    <div class="card-premium p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <h2 class="text-sm font-bold text-white uppercase tracking-wider">Tulis Artikel Baru</h2>
                        </div>

                        <form action="{{ route('admin.journals.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Judul Artikel</label>
                                <input type="text" name="title" required class="input-premium w-full px-4 py-2.5 text-sm" placeholder="Contoh: Keseruan Acara Semalam">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Slug (URL Kustom) <span class="text-slate-600">— opsional</span></label>
                                <input type="text" name="slug" class="input-premium w-full px-4 py-2.5 text-sm" placeholder="keseruan-acara-semalam">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Isi Artikel</label>
                                <textarea name="content" rows="6" required class="input-premium w-full px-4 py-2.5 text-sm resize-none" placeholder="Tulis cerita jurnal di sini..."></textarea>
                            </div>
                            <button type="submit" class="btn-gold w-full py-3 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Publikasikan Jurnal
                            </button>
                        </form>
                    </div>
                </div>

                {{-- KANAN: TABEL --}}
                <div class="lg:col-span-2">
                    <div class="card-premium overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-white/[0.02] border-b border-white/5">
                                <tr>
                                    <th class="py-4 px-6 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Detail Jurnal</th>
                                    <th class="py-4 px-6 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Tanggal Dibuat</th>
                                    <th class="py-4 px-6 text-right text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($journals as $journal)
                                    <tr class="hover:bg-white/[0.02] transition-colors">
                                        <td class="py-4 px-6">
                                            <p class="text-sm font-medium text-white mb-0.5">{{ $journal->title }}</p>
                                            <a href="{{ route('journal.show', $journal->slug) }}" target="_blank" class="text-[10px] text-amber-500/70 hover:text-amber-500 transition-colors inline-flex items-center gap-1">
                                                /journal/{{ $journal->slug }}
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="text-sm text-slate-300">{{ $journal->created_at->format('d M Y') }}</p>
                                            <p class="text-xs text-slate-500">{{ $journal->created_at->format('H:i') }}</p>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <form action="{{ route('admin.journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus jurnal ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all border border-red-500/20 hover:border-red-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-12 text-center text-sm text-slate-500">Belum ada artikel jurnal. Silakan buat yang pertama!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>
