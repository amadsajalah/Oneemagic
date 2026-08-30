@extends('layouts.app')
@section('title', 'Profil Saya - OneeMagic')

@section('content')
<div class="pt-32 pb-24 min-h-screen relative overflow-hidden">
    {{-- Glow Background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[400px] h-[400px] rounded-full blur-[120px]" style="background: radial-gradient(circle, rgba(217,119,6,0.06) 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] rounded-full blur-[120px]" style="background: radial-gradient(circle, rgba(124,58,237,0.06) 0%, transparent 70%);"></div>
    </div>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 rounded-xl px-5 py-4 text-sm text-green-400 border border-green-500/20 shadow-lg backdrop-blur-md" style="background: rgba(34,197,94,0.08);">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="mb-10 text-center" x-data="{ revealed: false }" x-init="setTimeout(() => revealed = true, 100)">
            <p class="smoke-reveal text-amber-500 font-semibold tracking-widest text-sm uppercase mb-3" :class="revealed ? 'revealed' : ''">Pengaturan Akun</p>
            <h2 class="smoke-reveal text-3xl font-bold text-white font-serif md:text-5xl" :class="revealed ? 'revealed' : ''" style="transition-delay: 100ms;">
                Profil Anda
            </h2>
        </div>

        <div class="space-y-8" x-data="{ revealed: false }" x-init="setTimeout(() => revealed = true, 200)">
            
            {{-- Update Profil Info --}}
            <div class="smoke-reveal rounded-3xl overflow-hidden" :class="revealed ? 'revealed' : ''" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 0 40px rgba(0,0,0,0.5);">
                <div class="px-6 py-5 border-b border-white/5" style="background: rgba(255,255,255,0.02);">
                    <h3 class="text-lg font-semibold text-white">Informasi Dasar</h3>
                    <p class="text-sm text-slate-400 mt-1">Perbarui nama, alamat email, dan foto profil akun Anda.</p>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                    @csrf @method('PATCH')
                    
                    <div class="flex flex-col md:flex-row gap-8">
                        {{-- Avatar / Foto --}}
                        <div class="flex flex-col items-center space-y-4">
                            <div class="relative w-32 h-32 rounded-full overflow-hidden ring-4 ring-white/5 group bg-slate-800 flex items-center justify-center">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    <span class="text-4xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif
                                
                                <label for="avatar_upload" class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </label>
                            </div>
                            <input type="file" name="avatar" id="avatar_upload" accept="image/*" class="hidden" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                            <div id="file-name" class="text-xs text-amber-500 text-center max-w-[120px] truncate"></div>
                            @error('avatar') <p class="text-xs text-red-400 text-center">{{ $message }}</p> @enderror
                        </div>

                        {{-- Form Text --}}
                        <div class="flex-1 space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all"
                                       style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); focus: border-color: #d97706; box-shadow: 0 0 0 2px rgba(217,119,6,0.1) inset;">
                                @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all"
                                       style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                                @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="rounded-full bg-amber-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-amber-500 transition-colors shadow-lg shadow-amber-900/20">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Update Password --}}
            <div class="smoke-reveal rounded-3xl overflow-hidden" :class="revealed ? 'revealed' : ''" style="transition-delay: 300ms; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 0 40px rgba(0,0,0,0.5);">
                <div class="px-6 py-5 border-b border-white/5" style="background: rgba(255,255,255,0.02);">
                    <h3 class="text-lg font-semibold text-white">Ubah Kata Sandi</h3>
                    <p class="text-sm text-slate-400 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                </div>
                
                <form action="{{ route('profile.password') }}" method="POST" class="p-6 md:p-8 space-y-5">
                    @csrf @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" required
                               class="w-full md:w-2/3 rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all"
                               style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                        @error('current_password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" required
                               class="w-full md:w-2/3 rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all"
                               style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                        @error('password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full md:w-2/3 rounded-xl px-4 py-3 text-sm text-white focus:outline-none transition-all"
                               style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="rounded-full bg-slate-700 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-600 transition-colors ring-1 ring-inset ring-slate-500/50">
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
