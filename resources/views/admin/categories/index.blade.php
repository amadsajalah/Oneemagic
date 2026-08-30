<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Magic Lab - OneeMagic Admin</title>
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
            <a href="{{ route('admin.categories.index') }}" class="nav-item nav-active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                Magic Lab
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
    <main class="flex-1 flex flex-col overflow-hidden relative" x-data="{ showCreateModal: false, showEditModal: false, editData: {} }">
        <!-- Background Ambient Effects -->
        <div class="absolute inset-0 bg-[#030305] pointer-events-none -z-20"></div>
        <div class="absolute top-0 inset-x-0 h-screen bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-amber-900/20 via-[#030305] to-[#030305] opacity-60 pointer-events-none -z-10"></div>
        
        <header class="glass-header flex items-center justify-between px-8 py-5 flex-shrink-0 z-10">
            <div>
                <h1 class="font-serif text-2xl font-bold text-white mb-1">Manajemen <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Magic Lab</span></h1>
                <p class="text-xs text-slate-400">Kelola ensiklopedia, jenis sulap, dan riset ilusi.</p>
            </div>
            <button @click="showCreateModal = true" class="btn-gold px-5 py-2.5 flex items-center gap-2 shadow-lg shadow-amber-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kategori Lab
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8 z-10">
            @if(session('success'))
                <div class="mb-8 rounded-xl bg-green-500/10 border border-green-500/20 px-4 py-3 text-sm text-green-400 flex items-center gap-2 max-w-fit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-20">
                @forelse($categories as $category)
                    <div class="group bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm hover:border-amber-500/30 transition-all flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-48 h-32 rounded-xl overflow-hidden bg-black flex-shrink-0">
                            @if($category->image_path && file_exists(public_path('storage/'.$category->image_path)))
                                <img src="{{ asset('storage/'.$category->image_path) }}" alt="{{ $category->name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-3xl font-serif text-amber-500/30">{{ substr($category->name, 0, 1) }}</div>
                            @endif
                        </div>
                        
                        <div class="flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-white font-serif mb-2">{{ $category->name }}</h3>
                            <p class="text-sm text-slate-400 line-clamp-2 mb-4 flex-1">
                                {{ $category->description ?? 'Belum ada penjelasan.' }}
                            </p>
                            
                            <div class="flex items-center gap-2 mt-auto pt-4 border-t border-white/5">
                                <button @click="editData = { id: {{ $category->id }}, name: '{{ addslashes($category->name) }}', description: '{{ addslashes($category->description) }}', history: `{{ addslashes($category->history) }}` }; showEditModal = true" class="px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 text-xs font-semibold hover:bg-blue-500/20 transition-colors">
                                    Edit Lab
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori lab ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 text-xs font-semibold hover:bg-red-500/20 transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center text-slate-400">Belum ada data di Magic Lab.</div>
                @endforelse
            </div>
        </div>

        <!-- Create Modal -->
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-black/80 backdrop-blur-sm" aria-hidden="true" @click="showCreateModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-3xl p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-[#0a0a0f] border border-white/10 rounded-2xl shadow-2xl shadow-amber-500/10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white font-serif" id="modal-title">Tambah Kategori Sulap Baru</h3>
                        <button @click="showCreateModal = false" class="text-slate-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Nama Aliran Sulap (Misal: Mentalism)</label>
                                <input type="text" name="name" required class="input-premium w-full px-4 py-2.5 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Penjelasan Singkat (Quote/Deskripsi Singkat)</label>
                                <textarea name="description" rows="2" class="input-premium w-full px-4 py-2.5 text-sm resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Sejarah / Riset Mendalam</label>
                                <textarea name="history" rows="6" class="input-premium w-full px-4 py-2.5 text-sm resize-none" placeholder="Tuliskan lore dan edukasi detail..."></textarea>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Foto Ilustrasi/Cover</label>
                                <input type="file" name="image" accept="image/*" class="input-premium w-full px-4 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-amber-500/30 cursor-pointer">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="showCreateModal = false" class="px-5 py-2.5 text-sm font-semibold text-slate-300 hover:text-white transition-colors">Batal</button>
                            <button type="submit" class="btn-gold px-6 py-2.5 text-sm shadow-lg shadow-amber-500/20">Simpan di Lab</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-black/80 backdrop-blur-sm" aria-hidden="true" @click="showEditModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-3xl p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-[#0a0a0f] border border-white/10 rounded-2xl shadow-2xl shadow-amber-500/10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white font-serif" id="modal-title">Edit Kategori Lab</h3>
                        <button @click="showEditModal = false" class="text-slate-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <form :action="'{{ url('/admin/categories') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf @method('PATCH')
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Nama Aliran Sulap</label>
                                <input type="text" name="name" x-model="editData.name" required class="input-premium w-full px-4 py-2.5 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Penjelasan Singkat</label>
                                <textarea name="description" x-model="editData.description" rows="2" class="input-premium w-full px-4 py-2.5 text-sm resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Sejarah / Riset Mendalam</label>
                                <textarea name="history" x-model="editData.history" rows="6" class="input-premium w-full px-4 py-2.5 text-sm resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Ganti Foto Ilustrasi (Bila Perlu)</label>
                                <input type="file" name="image" accept="image/*" class="input-premium w-full px-4 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-amber-500/20 file:text-amber-500 file:px-3 file:py-1.5 file:text-xs file:font-semibold hover:file:bg-amber-500/30 cursor-pointer">
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
    </main>
</body>
</html>
