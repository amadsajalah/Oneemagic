{{-- 
    MODAL AKSES TERBATAS
    CATATAN: Seluruh z-index menggunakan inline style (bukan Tailwind class), 
    karena CSS sudah di-build dan arbitrary class [z-9999] tidak terscan.
--}}
<div x-data="{ open: false }" 
     @open-login-modal.window="open = true" 
     @keydown.escape.window="open = false"
     x-show="open" 
     role="dialog" 
     aria-modal="true"
     aria-labelledby="modal-title"
     style="display: none; position: fixed; inset: 0; z-index: 99999;">
     
    {{-- Backdrop blur --}}
    <div x-show="open" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         style="position: fixed; inset: 0; background: rgba(0,0,0,0.80); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);"></div>

    {{-- Modal Container: tengah layar --}}
    <div style="position: fixed; inset: 0; display: flex; align-items: center; justify-content: center; padding: 1rem; pointer-events: none;">
        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90 translateY(1rem)"
             x-transition:enter-end="opacity-100 transform scale-100 translateY(0)"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             @click.stop
             style="pointer-events: auto; position: relative; width: 100%; max-width: 420px; border-radius: 1rem; overflow: hidden; background: #0d0d17; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 25px 60px rgba(0,0,0,0.7);">
            
            {{-- Garis atas --}}
            <div style="height: 3px; width: 100%; background: linear-gradient(90deg, #d97706, #7c3aed, #d97706);"></div>

            <div style="padding: 2.5rem 2rem; text-align: center;">
                {{-- Icon --}}
                <div style="margin: 0 auto 1.25rem; width: 4rem; height: 4rem; border-radius: 50%; background: rgba(217,119,6,0.12); border: 1px solid rgba(217,119,6,0.25); display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 1.75rem; height: 1.75rem; color: #f59e0b;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                
                <h3 id="modal-title" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: #ffffff; margin-bottom: 0.75rem;">
                    Akses Terbatas
                </h3>
                
                <p style="font-size: 0.875rem; color: #94a3b8; line-height: 1.6; margin-bottom: 2rem;">
                    Silakan masuk ke akun Anda terlebih dahulu untuk menikmati fitur magis ini. Belum punya akun? Daftar gratis sekarang!
                </p>
                
                {{-- Tombol Masuk --}}
                <a href="{{ route('login') }}" 
                   style="display: flex; width: 100%; align-items: center; justify-content: center; gap: 0.5rem; border-radius: 9999px; background: #d97706; padding: 0.85rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #ffffff; text-decoration: none; transition: background 0.2s, transform 0.2s; margin-bottom: 0.75rem;"
                   onmouseover="this.style.background='#b45309'; this.style.transform='scale(1.02)'"
                   onmouseout="this.style.background='#d97706'; this.style.transform='scale(1)'">
                    <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Masuk Sekarang
                </a>
                
                {{-- Tombol Daftar --}}
                <a href="{{ route('register') }}" 
                   style="display: flex; width: 100%; align-items: center; justify-content: center; border-radius: 9999px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); padding: 0.85rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #cbd5e1; text-decoration: none; transition: background 0.2s; margin-bottom: 1rem;"
                   onmouseover="this.style.background='rgba(255,255,255,0.10)'; this.style.color='#fff'"
                   onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='#cbd5e1'">
                    Daftar Akun Baru
                </a>
                
                {{-- Tombol Batal --}}
                <button @click="open = false" type="button" 
                        style="background: none; border: none; font-size: 0.75rem; color: #475569; cursor: pointer; transition: color 0.2s;"
                        onmouseover="this.style.color='#94a3b8'"
                        onmouseout="this.style.color='#475569'">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>
</div>
