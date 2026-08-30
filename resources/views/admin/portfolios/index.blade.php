<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Portofolio - OneeMagic Admin</title>
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
        .input-premium option { background-color: #0a0a0f; color: #f1f5f9; }
        .btn-gold { background: #d97706; color: white; border-radius: 0.75rem; font-weight: 600; transition: all 0.2s; border: none; }
        .btn-gold:hover { background: #b45309; transform: translateY(-1px); }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Ringkasan
            </a>
            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-widest">Manajemen</p>
            <a href="{{ route('admin.bookings.index') }}" class="nav-item flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Pemesanan
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="nav-item nav-active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
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
    <main class="flex-1 flex flex-col overflow-hidden relative" x-data="{ showCreateModal: false, showEditModal: false, editData: {}, showVideoModal: false, activeVideoUrl: '', activeVideoType: '' }">
        <!-- Background Ambient Effects -->
        <div class="absolute inset-0 bg-[#030305] pointer-events-none -z-20"></div>
        <div class="absolute top-0 inset-x-0 h-screen bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-amber-900/20 via-[#030305] to-[#030305] opacity-60 pointer-events-none -z-10"></div>
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-amber-600/10 rounded-full blur-[120px] pointer-events-none -z-10 mix-blend-screen animate-pulse-slow"></div>

        <header class="glass-header flex items-center justify-between px-8 py-5 flex-shrink-0 z-10">
            <div>
                <h1 class="font-serif text-2xl font-bold text-white mb-1">Manajemen <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Portofolio</span></h1>
                <p class="text-xs text-slate-400">Kelola mahakarya dan portofolio Anda secara eksklusif.</p>
            </div>
            <button type="button" @click.prevent="showCreateModal = true" class="btn-gold px-5 py-2.5 flex items-center gap-2 shadow-lg shadow-amber-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Karya
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8 z-10">
            @if(session('success'))
                <div class="mb-8 rounded-xl bg-green-500/10 border border-green-500/20 px-4 py-3 text-sm text-green-400 flex items-center gap-2 max-w-fit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Profile Management -->
            <div class="mb-12 bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white font-serif">Profil Magician</h2>
                        <p class="text-xs text-slate-400">Atur profil personal, bio, dan sosial media.</p>
                    </div>
                </div>

                <form action="{{ route('admin.portfolios.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Nama Panggung / Alias</label>
                            <input type="text" name="name" value="{{ $profile->name ?? 'Onee' }}" required class="input-premium w-full px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Foto Profil (Kosongkan jika tak diubah)</label>
                            <input type="file" name="image" accept="image/*" class="input-premium w-full px-4 py-1.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-3 file:py-1 file:text-xs file:font-semibold">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-400 mb-1">Biografi Singkat</label>
                            <textarea name="bio" rows="2" class="input-premium w-full px-4 py-2 text-sm">{{ $profile->bio ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Link Instagram</label>
                            <input type="url" name="instagram_url" value="{{ $profile->instagram_url ?? '' }}" placeholder="https://instagram.com/..." class="input-premium w-full px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Link TikTok</label>
                            <input type="url" name="tiktok_url" value="{{ $profile->tiktok_url ?? '' }}" placeholder="https://tiktok.com/..." class="input-premium w-full px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Link YouTube</label>
                            <input type="url" name="youtube_url" value="{{ $profile->youtube_url ?? '' }}" placeholder="https://youtube.com/..." class="input-premium w-full px-4 py-2 text-sm">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn-gold px-6 py-2 text-sm shadow-lg shadow-amber-500/20">Simpan Profil</button>
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white font-serif">Rekam Jejak Penampilan</h2>
                    <p class="text-xs text-slate-400">Daftar aksi panggung dan event.</p>
                </div>
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 pb-20">
                @forelse($portfolios as $portfolio)
                    <div class="group relative overflow-hidden rounded-2xl bg-black border border-white/10 hover:border-amber-500/50 hover:shadow-[0_0_20px_rgba(245,158,11,0.3)] transition-all duration-300" style="aspect-ratio: 5/7;">
                        
                        <!-- Admin Action Buttons -->
                        <div class="absolute top-2 left-2 right-2 z-30 flex justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button @click="editData = { id: {{ $portfolio->id }}, title: '{{ addslashes($portfolio->title) }}', category_id: '{{ $portfolio->category_id }}', client_name: '{{ addslashes($portfolio->client_name) }}', event_year: '{{ $portfolio->event_year }}', description: '{{ addslashes($portfolio->description) }}', video_url: '{{ addslashes($portfolio->video_url ?? '') }}', video_type: '{{ $portfolio->video_type ?? 'youtube' }}' }; showEditModal = true" 
                                    class="w-8 h-8 rounded-full bg-black/70 hover:bg-blue-600 border border-white/20 flex items-center justify-center text-white transition-all backdrop-blur-md shadow-lg" title="Edit Karya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-full bg-black/70 hover:bg-red-600 border border-white/20 flex items-center justify-center text-white transition-all backdrop-blur-md shadow-lg" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>

                        <!-- Card Image (full cover, darkened) -->
                        <div class="absolute inset-0 z-0">
                            @if($portfolio->image_path && file_exists(public_path('storage/'.$portfolio->image_path)))
                                <img src="{{ asset('storage/'.$portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" style="filter: brightness(0.35);">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-[#0a0a0f] flex items-center justify-center">
                                    <span class="text-amber-500/20 text-5xl font-serif">OM</span>
                                </div>
                            @endif
                        </div>

                        <!-- Bottom gradient for text -->
                        <div class="absolute inset-x-0 bottom-0 h-2/3 z-10 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.85) 40%, transparent 100%);"></div>

                        <!-- Center Play Button -->
                        @if($portfolio->video_url)
                            @php
                                $isSocial = str_contains($portfolio->video_url, 'tiktok') || str_contains($portfolio->video_url, 'instagram') || str_contains($portfolio->video_url, 'vm.tiktok');
                            @endphp
                            <div class="absolute inset-0 z-20 flex items-center justify-center pb-20">
                                @if($isSocial)
                                    <a href="{{ $portfolio->video_url }}" target="_blank" rel="noopener noreferrer"
                                       class="w-12 h-12 rounded-full bg-black/50 border border-white/20 flex items-center justify-center text-white backdrop-blur-sm group-hover:bg-amber-500 group-hover:border-amber-400 group-hover:shadow-[0_0_30px_rgba(245,158,11,0.7)] transition-all duration-300 transform group-hover:scale-110">
                                        <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </a>
                                @else
                                    <button type="button"
                                        @click="activeVideoUrl = '{{ $portfolio->video_url }}'; activeVideoType = '{{ $portfolio->video_type }}'; showVideoModal = true"
                                        class="w-12 h-12 rounded-full bg-black/50 border border-white/20 flex items-center justify-center text-white backdrop-blur-sm group-hover:bg-amber-500 group-hover:border-amber-400 group-hover:shadow-[0_0_30px_rgba(245,158,11,0.7)] transition-all duration-300 transform group-hover:scale-110">
                                        <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </button>
                                @endif
                            </div>
                        @endif

                        <!-- Card Bottom Content -->
                        <div class="absolute inset-x-0 bottom-0 z-20 p-4 pointer-events-none">
                            <span class="inline-flex items-center rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-400 border border-amber-500/30 mb-2 tracking-wider uppercase">
                                {{ $portfolio->category->name }}
                            </span>
                            <h3 class="text-sm font-bold text-white font-serif leading-snug group-hover:text-amber-300 transition-colors line-clamp-2 mb-2" title="{{ $portfolio->title }}">{{ $portfolio->title }}</h3>
                            <div class="flex items-center justify-between border-t border-white/10 pt-2">
                                <span class="text-[9px] text-slate-400 truncate max-w-[80%]">{{ $portfolio->client_name ?? 'Internal' }}</span>
                                <span class="text-[9px] font-bold text-slate-500 shrink-0">{{ $portfolio->event_year }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-32">
                        <div class="w-24 h-24 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-6 text-slate-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <p class="text-xl text-slate-400 font-serif">Belum ada karya. Tambahkan sekarang!</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-4">
                {{ $portfolios->links() }}
            </div>
        </div>

        <!-- Create Modal -->
        <template x-teleport="body">
            <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-[9999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-black/80 backdrop-blur-sm" aria-hidden="true" @click="showCreateModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative z-10 inline-block w-full max-w-2xl p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-[#0a0a0f] border border-white/10 rounded-2xl shadow-2xl shadow-amber-500/10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white font-serif" id="modal-title">Tambah Karya Baru</h3>
                        <button @click="showCreateModal = false" class="text-slate-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Judul Penampilan</label>
                                <input type="text" name="title" required class="input-premium w-full px-4 py-3 text-sm" placeholder="Contoh: The Grand Illusion">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Kategori</label>
                                <select name="category_id" required class="input-premium w-full px-4 py-3 text-sm">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Nama Klien / Penyelenggara</label>
                                <input type="text" name="client_name" class="input-premium w-full px-4 py-3 text-sm" placeholder="Contoh: PT. ABC">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Tahun Penampilan</label>
                                <input type="number" name="event_year" value="{{ now()->year }}" required min="2000" max="2100" class="input-premium w-full px-4 py-3 text-sm">
                            </div>

                            <!-- Video Section -->
                            <div class="col-span-2 bg-white/5 border border-white/10 rounded-xl p-5 mt-2">
                                <h4 class="text-sm font-serif font-bold text-amber-500 mb-4 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Media Video (Opsional)
                                </h4>
                                <div class="grid grid-cols-2 gap-5">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">Tipe Video</label>
                                        <select name="video_type" class="input-premium w-full px-4 py-2.5 text-sm">
                                            <option value="youtube">Link YouTube / TikTok / IG</option>
                                            <option value="mp4">File MP4 Langsung (Link)</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">URL Video</label>
                                        <input type="text" name="video_url" class="input-premium w-full px-4 py-2.5 text-sm" placeholder="https://...">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-[11px] font-semibold text-amber-500/80 mb-1.5">ATAU UPLOAD FILE VIDEO LOKAL (Maks 200MB)</label>
                                        <input type="file" name="video_file" accept="video/mp4,video/x-m4v,video/*" class="input-premium w-full px-4 py-2 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-4 file:py-2 file:text-xs file:font-bold hover:file:bg-amber-500/30 cursor-pointer text-slate-400">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 mt-2">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Deskripsi & Cerita</label>
                                <textarea name="description" rows="3" required class="input-premium w-full px-4 py-3 text-sm resize-none" placeholder="Ceritakan keseruan acara ini..."></textarea>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Foto Cover (Wajib)</label>
                                <input type="file" name="image" accept="image/*" required class="input-premium w-full px-4 py-2.5 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-4 file:py-2 file:text-xs file:font-bold hover:file:bg-amber-500/30 cursor-pointer text-slate-400">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="showCreateModal = false" class="px-5 py-2.5 text-sm font-semibold text-slate-300 hover:text-white transition-colors">Batal</button>
                            <button type="submit" class="btn-gold px-6 py-2.5 text-sm shadow-lg shadow-amber-500/20">Simpan Karya</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </template>

        <!-- Edit Modal -->
        <template x-teleport="body">
            <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-[9999] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-black/80 backdrop-blur-sm" aria-hidden="true" @click="showEditModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative z-10 inline-block w-full max-w-2xl p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-[#0a0a0f] border border-white/10 rounded-2xl shadow-2xl shadow-amber-500/10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white font-serif" id="modal-title">Edit Karya</h3>
                        <button @click="showEditModal = false" class="text-slate-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <!-- Form action dynamically set via Alpine -->
                    <form :action="'{{ url('/admin/portfolios') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf @method('PATCH')
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Judul Penampilan</label>
                                <input type="text" name="title" x-model="editData.title" required class="input-premium w-full px-4 py-3 text-sm">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Kategori</label>
                                <select name="category_id" x-model="editData.category_id" required class="input-premium w-full px-4 py-3 text-sm">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Nama Klien / Penyelenggara</label>
                                <input type="text" name="client_name" x-model="editData.client_name" class="input-premium w-full px-4 py-3 text-sm">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Tahun Penampilan</label>
                                <input type="number" name="event_year" x-model="editData.event_year" required min="2000" max="2100" class="input-premium w-full px-4 py-3 text-sm">
                            </div>

                            <!-- Video Section -->
                            <div class="col-span-2 bg-white/5 border border-white/10 rounded-xl p-5 mt-2">
                                <h4 class="text-sm font-serif font-bold text-amber-500 mb-4 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Media Video (Opsional)
                                </h4>
                                <div class="grid grid-cols-2 gap-5">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">Tipe Video</label>
                                        <select name="video_type" x-model="editData.video_type" class="input-premium w-full px-4 py-2.5 text-sm">
                                            <option value="youtube">Link YouTube / TikTok / IG</option>
                                            <option value="mp4">File MP4 Langsung (Link)</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">URL Video</label>
                                        <input type="text" name="video_url" x-model="editData.video_url" class="input-premium w-full px-4 py-2.5 text-sm" placeholder="https://...">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-[11px] font-semibold text-amber-500/80 mb-1.5">ATAU UPLOAD FILE VIDEO LOKAL (Maks 200MB)</label>
                                        <input type="file" name="video_file" accept="video/mp4,video/x-m4v,video/*" class="input-premium w-full px-4 py-2 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-4 file:py-2 file:text-xs file:font-bold hover:file:bg-amber-500/30 cursor-pointer text-slate-400">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 mt-2">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Deskripsi & Cerita</label>
                                <textarea name="description" x-model="editData.description" rows="3" required class="input-premium w-full px-4 py-3 text-sm resize-none"></textarea>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Foto Cover (Biarkan kosong jika tidak mengubah)</label>
                                <input type="file" name="image" accept="image/*" class="input-premium w-full px-4 py-2.5 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-4 file:py-2 file:text-xs file:font-bold hover:file:bg-amber-500/30 cursor-pointer text-slate-400">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="showEditModal = false" class="px-5 py-2.5 text-sm font-semibold text-slate-300 hover:text-white transition-colors">Batal</button>
                            <button type="submit" class="btn-gold px-6 py-2.5 text-sm shadow-lg shadow-amber-500/20">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </template>

        <!-- Video Modal -->
        <template x-teleport="body">
            <div x-show="showVideoModal" style="display: none;" class="fixed inset-0 z-[9999] flex items-center justify-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="showVideoModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/90 backdrop-blur-xl transition-opacity" aria-hidden="true" @click="showVideoModal = false; activeVideoUrl = ''"></div>
                
                <div x-show="showVideoModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative z-10 w-full max-w-4xl mx-4 bg-black rounded-2xl overflow-hidden shadow-2xl border border-white/10" style="aspect-ratio: 16/9;">
                    <button @click="showVideoModal = false; activeVideoUrl = ''" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 text-white flex items-center justify-center hover:bg-amber-500 transition-colors border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    
                    <template x-if="activeVideoUrl">
                        <div class="w-full h-full bg-black">
                            <template x-if="activeVideoType === 'mp4'">
                                <video :src="activeVideoUrl.startsWith('http') ? activeVideoUrl : '{{ asset('storage') }}/' + activeVideoUrl" controls autoplay class="w-full h-full object-contain"></video>
                            </template>
                            <template x-if="activeVideoType !== 'mp4'">
                                <iframe :src="
                                    activeVideoUrl.includes('youtu.be') 
                                        ? 'https://www.youtube.com/embed/' + activeVideoUrl.split('youtu.be/')[1].split('?')[0] + '?autoplay=1'
                                        : activeVideoUrl.includes('watch?v=') 
                                            ? activeVideoUrl.replace('watch?v=', 'embed/') + '&autoplay=1'
                                            : activeVideoUrl + '?autoplay=1'
                                " class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </main>
</body>
</html>
