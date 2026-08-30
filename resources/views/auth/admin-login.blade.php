<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access — OneeMagic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { serif: ['Playfair Display', 'serif'], sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background: #020204; }
        .glow { box-shadow: 0 0 60px rgba(217, 119, 6, 0.15), 0 0 120px rgba(124, 58, 237, 0.08); }
        .input-field { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); color: white; transition: all 0.2s; }
        .input-field:focus { outline: none; border-color: rgba(217,119,6,0.6); background: rgba(255,255,255,0.06); box-shadow: 0 0 0 3px rgba(217,119,6,0.1); }
        .input-field::placeholder { color: rgba(148,163,184,0.5); }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-12px) rotate(3deg); } }
        .float { animation: float 6s ease-in-out infinite; }
        .float-delay { animation: float 8s ease-in-out infinite 2s; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">

    {{-- Background Glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(217,119,6,0.08) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(124,58,237,0.06) 0%, transparent 70%);"></div>
    </div>

    {{-- Floating Decorations --}}
    <div class="absolute top-20 left-16 text-5xl text-amber-900/30 float select-none">⚡</div>
    <div class="absolute bottom-24 right-20 text-4xl text-purple-900/30 float-delay select-none">🔐</div>
    <div class="absolute top-1/2 left-8 text-3xl text-amber-900/20 float select-none" style="animation-delay: 4s;">✦</div>

    {{-- Login Card --}}
    <div class="relative w-full max-w-md mx-4 glow">
        <div class="rounded-2xl overflow-hidden" style="background: rgba(12,12,20,0.95); border: 1px solid rgba(255,255,255,0.07);">

            {{-- Top Gradient Bar --}}
            <div class="h-1 w-full" style="background: linear-gradient(90deg, #7c3aed, #d97706, #7c3aed);"></div>

            <div class="p-8">
                {{-- Header --}}
                <div class="text-center mb-8">
                    <div class="mx-auto mb-4 w-16 h-16 rounded-full flex items-center justify-center" style="background: rgba(217,119,6,0.1); border: 1px solid rgba(217,119,6,0.2);">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                    </div>
                    <h1 class="font-serif text-2xl font-bold text-white mb-1">Admin Access</h1>
                    <p class="text-sm text-slate-500">OneeMagic Control Panel</p>
                </div>

                {{-- Error Message --}}
                @if($errors->any())
                    <div class="mb-5 rounded-lg px-4 py-3 text-sm text-red-400" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Form --}}
                <form action="/admin-akses" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Email Administrator</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="off"
                               class="input-field w-full rounded-xl px-4 py-3 text-sm"
                               placeholder="admin@domain.com">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Sandi</label>
                        <input type="password" name="password" required
                               class="input-field w-full rounded-xl px-4 py-3 text-sm"
                               placeholder="••••••••">
                    </div>

                    <button type="submit"
                            class="w-full mt-2 rounded-xl py-3.5 text-sm font-semibold text-white transition-all duration-200"
                            style="background: linear-gradient(135deg, #d97706, #b45309);"
                            onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-1px)'"
                            onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)'">
                        Masuk ke Panel Admin
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-6 pt-5 border-t border-white/5 text-center">
                    <p class="text-xs text-slate-600">Halaman ini hanya untuk administrator sistem.</p>
                    <a href="{{ route('home') }}" class="mt-2 inline-block text-xs text-slate-500 hover:text-amber-400 transition-colors">
                        ← Kembali ke Website Utama
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
