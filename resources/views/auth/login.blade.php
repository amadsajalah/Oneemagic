@extends('layouts.app')
@section('title', 'Masuk - OneeMagic')

@section('content')
<div class="flex min-h-screen items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8 rounded-2xl border border-white/10 bg-white/5 p-10 shadow-[0_0_40px_rgba(217,119,6,0.1)] backdrop-blur-md relative overflow-hidden" 
         x-data="{ revealed: false }" 
         x-init="setTimeout(() => revealed = true, 100)">
         
        <!-- Glow top edge -->
        <div class="absolute -top-px left-0 h-px w-full bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>

        <div>
            <div class="flex justify-center">
                <div class="smoke-reveal flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-amber-600 to-purple-900 shadow-[0_0_20px_rgba(217,119,6,0.5)]" :class="revealed ? 'revealed' : ''">
                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L9 8H3L8 12L6 18L12 15L18 18L16 12L21 8H15L12 2Z" />
                    </svg>
                </div>
            </div>
            <h2 class="smoke-reveal mt-6 text-center font-serif text-3xl font-bold tracking-tight text-white" :class="revealed ? 'revealed' : ''" style="transition-delay: 200ms;">
                Masuk ke Dunia Magis
            </h2>
            <p class="smoke-reveal mt-2 text-center text-sm text-slate-400" :class="revealed ? 'revealed' : ''" style="transition-delay: 300ms;">
                Atau
                <a href="{{ route('register') }}" class="font-medium text-amber-500 hover:text-amber-400 transition-colors">buat akun baru</a>
            </p>

            @if(request()->has('error') || $errors->any())
            <div class="smoke-reveal mt-4 rounded-md bg-red-500/10 p-4 border border-red-500/20" :class="revealed ? 'revealed' : ''" style="transition-delay: 350ms;">
                <div class="flex">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-400">
                            @if(request()->has('error'))
                                {{ request()->query('error') }}
                            @else
                                {{ $errors->first() }}
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <form class="smoke-reveal mt-8 space-y-6" action="{{ route('login') }}" method="POST" :class="revealed ? 'revealed' : ''" style="transition-delay: 400ms;">
            @csrf
            
            <div class="space-y-4 rounded-md">
                <div>
                    <label for="email" class="sr-only">Alamat Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="relative block w-full rounded-lg border-0 bg-white/5 py-3 px-4 text-white placeholder-slate-400 ring-1 ring-inset ring-white/10 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-amber-500 sm:text-sm sm:leading-6 transition-all" placeholder="Alamat Email" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Kata Sandi</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full rounded-lg border-0 bg-white/5 py-3 px-4 text-white placeholder-slate-400 ring-1 ring-inset ring-white/10 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-amber-500 sm:text-sm sm:leading-6 transition-all" placeholder="Kata Sandi">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-600 focus:ring-amber-600 focus:ring-offset-black">
                    <label for="remember-me" class="ml-2 block text-sm text-slate-400">Ingat saya</label>
                </div>
            </div>

            <div>
                <button type="submit" class="glow-button relative flex w-full justify-center rounded-lg bg-amber-600 py-3 px-4 text-sm font-semibold text-white hover:bg-amber-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600 transition-all">
                    Masuk
                </button>
            </div>
        </form>
        
    </div>
</div>
@endsection
