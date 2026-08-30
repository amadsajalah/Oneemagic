@extends('layouts.app')
@section('title', 'Ruang Pribadi — OneeMagic')

@section('content')
<style>
    .card { 
        background: rgba(8,10,22,0.85); 
        backdrop-filter: blur(16px); 
        -webkit-backdrop-filter: blur(16px); 
        border: 1px solid rgba(255,255,255,0.10); 
        border-radius: 1.5rem; 
    }
    .input-field { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 0.75rem; padding: 0.75rem 1rem; width: 100%; transition: all 0.2s; }
    .input-field:focus { outline: none; border-color: rgba(217,119,6,0.5); background: rgba(255,255,255,0.06); }
    .btn-gold { background: #d97706; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; border: none; cursor: pointer; }
    .btn-gold:hover { background: #b45309; transform: translateY(-1px); }
    
    .chat-container { height: 400px; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; padding-right: 0.5rem; }
    .chat-bubble { max-width: 80%; padding: 0.75rem 1rem; border-radius: 1rem; font-size: 0.875rem; line-height: 1.5; }
    .chat-user { align-self: flex-end; background: rgba(217,119,6,0.15); border: 1px solid rgba(217,119,6,0.3); color: #fde68a; border-bottom-right-radius: 0.25rem; }
    .chat-admin { align-self: flex-start; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e2e8f0; border-bottom-left-radius: 0.25rem; }
    
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    
    .file-upload-wrapper { position: relative; overflow: hidden; display: inline-block; width: 100%; }
    .file-upload-wrapper input[type=file] { font-size: 100px; position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer; height: 100%; }
</style>

<div style="min-height:100vh;padding-top:2rem;padding-bottom:5rem;position:relative;">

    <div style="max-width:72rem;margin:0 auto;padding:0 1.5rem;position:relative;z-index:10;">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('dashboard') }}" class="text-xs text-amber-500 hover:text-amber-400 mb-2 inline-flex items-center gap-1 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dasbor
                </a>
                <h1 style="font-family:'Playfair Display',serif;" class="text-3xl font-bold text-white">Detail Reservasi</h1>
            </div>
            
            <div>
                @if($booking->status === 'pending')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-400/10 text-yellow-400 ring-1 ring-yellow-400/20"><span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span> Menunggu Persetujuan</span>
                @elseif($booking->status === 'approved')
                    @if($booking->payment_status === 'paid')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20"><span class="w-2 h-2 rounded-full bg-green-400"></span> Lunas & Terjadwal</span>
                    @elseif($booking->payment_status === 'verifying')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-400/10 text-blue-400 ring-1 ring-blue-400/20"><span class="w-2 h-2 rounded-full bg-blue-400"></span> Menunggu Verifikasi Pembayaran</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-indigo-400/10 text-indigo-400 ring-1 ring-indigo-400/20"><span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span> Menunggu Pembayaran</span>
                    @endif
                @elseif($booking->status === 'paid')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20"><span class="w-2 h-2 rounded-full bg-green-400"></span> Lunas & Terjadwal</span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-400/10 text-red-400 ring-1 ring-red-400/20"><span class="w-2 h-2 rounded-full bg-red-400"></span> Dibatalkan</span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition.duration.500ms class="mb-6 flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-green-400 border border-green-500/20" style="background: rgba(34,197,94,0.06);">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition.duration.500ms class="mb-6 flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-red-400 border border-red-500/20" style="background: rgba(239,68,68,0.06);">✗ {{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- LEFT COLUMN: INFO & PAYMENT --}}
            <div class="space-y-6">
                {{-- Info Acara --}}
                <div class="card p-6">
                    <h2 class="text-sm font-bold text-amber-500 uppercase tracking-widest mb-6 border-b border-white/5 pb-4">Data Acara</h2>
                    
                    <div class="space-y-5">
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Nama Acara</p>
                            <p class="text-base text-white font-medium">{{ $booking->event_name }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Tanggal</p>
                                <p class="text-sm text-slate-300">{{ \Carbon\Carbon::parse($booking->event_date)->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Waktu</p>
                                <p class="text-sm text-slate-300">{{ $booking->event_time }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Lokasi</p>
                            <p class="text-sm text-slate-300">{{ $booking->event_location }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Perkiraan Tamu</p>
                            <p class="text-sm text-slate-300">{{ $booking->guest_count }} Orang</p>
                        </div>
                    </div>
                </div>

                {{-- Payment Box --}}
                <div class="card p-6 border-amber-500/20 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent pointer-events-none"></div>
                    <div class="relative z-10">
                        <h2 class="text-sm font-bold text-amber-500 uppercase tracking-widest mb-6 border-b border-amber-500/10 pb-4">Pembayaran & Tagihan</h2>
                        
                        @if($booking->status === 'pending')
                            {{-- Menunggu Admin --}}
                            <div class="text-center py-4">
                                <div class="w-12 h-12 rounded-full bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-yellow-400 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-sm text-slate-300 font-medium">Menunggu Persetujuan Admin</p>
                                <p class="text-xs text-slate-500 mt-1">Diskusikan detail acara & harga lewat fitur Obrolan.</p>
                            </div>

                        @elseif($booking->status === 'rejected')
                            {{-- Ditolak Admin --}}
                            <div class="text-center py-6 px-4 rounded-xl bg-red-500/10 border border-red-500/20">
                                <div class="w-12 h-12 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                                <p class="text-base font-bold text-red-400">Pemesanan Ditolak</p>
                                <p class="text-xs text-slate-400 mt-2">Maaf, pemesanan Anda tidak dapat kami terima saat ini. Silakan hubungi kami melalui obrolan untuk info lebih lanjut.</p>
                            </div>

                        @elseif(in_array($booking->status, ['approved', 'paid']))
                            {{-- Disetujui / Dalam proses pembayaran / Lunas --}}
                            <div class="mb-6 p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-center">
                                <p class="text-[10px] text-amber-500 uppercase tracking-wider mb-1">Total Tagihan (Harga Deal)</p>
                                <p class="text-3xl font-bold text-white">Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
                            </div>

                            @if(in_array($booking->payment_status, ['unpaid', 'failed']))
                                {{-- Belum bayar / Gagal --}}
                                @if($booking->payment_status === 'failed')
                                    <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-xs text-center">
                                        ⚠️ Pembayaran sebelumnya gagal atau dibatalkan. Silakan coba lagi.
                                    </div>
                                @endif

                                @if($booking->midtrans_snap_token)
                                    {{-- Token sudah ada, tinggal buka popup --}}
                                    <button type="button" id="pay-button" class="btn-gold w-full flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                        Lanjutkan Pembayaran
                                    </button>
                                @else
                                    {{-- Belum ada token, buat dulu --}}
                                    <form action="{{ route('booking.pay', $booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-gold w-full flex justify-center items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                            Bayar Sekarang
                                        </button>
                                    </form>
                                @endif
                                
                            @elseif($booking->payment_status === 'pending')
                                {{-- Menunggu Pembayaran Midtrans Selesai (misal transfer bank) --}}
                                <div class="text-center py-6 px-4 rounded-xl border border-blue-500/30 bg-blue-500/10">
                                    <div class="w-12 h-12 rounded-full bg-blue-500/20 border border-blue-500/40 flex items-center justify-center mx-auto mb-3 text-blue-400">
                                        <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-blue-400">Menunggu Pembayaran</p>
                                    <p class="text-xs text-slate-300 mt-2">Silakan selesaikan pembayaran sesuai instruksi dari Midtrans.</p>
                                    
                                    @if($booking->midtrans_snap_token)
                                        <button type="button" id="pay-button" class="mt-4 px-4 py-2 bg-blue-500/20 border border-blue-500 hover:bg-blue-500 text-white rounded-lg text-xs transition-colors">
                                            Lihat Instruksi / Bayar
                                        </button>
                                    @endif
                                </div>

                            @elseif($booking->payment_status === 'paid')
                                {{-- Lunas --}}
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 rounded-full bg-green-500/10 border border-green-500/20 flex items-center justify-center mx-auto mb-3 text-green-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <p class="text-base font-bold text-green-400">PEMBAYARAN LUNAS ✓</p>
                                    <p class="text-xs text-slate-400 mt-1">Jadwal Anda telah dikunci. Sampai jumpa di hari acara!</p>
                                    
                                    @if($booking->refund_status === 'requested')
                                        <div class="mt-4 p-3 rounded-lg bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs">
                                            ⏳ Pengajuan Refund sedang diproses Admin.
                                        </div>
                                    @elseif($booking->refund_status === 'approved')
                                        <div class="mt-4 p-3 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 text-xs">
                                            ✅ Pengajuan Refund Disetujui. Dana akan dikembalikan.
                                        </div>
                                    @elseif($booking->refund_status === 'rejected')
                                        <div class="mt-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-xs">
                                            ❌ Pengajuan Refund Ditolak Admin.
                                        </div>
                                    @else
                                        <button type="button" onclick="openRefundModal()" class="mt-4 px-4 py-2 border border-slate-600 hover:bg-white/5 text-slate-300 rounded-lg text-xs transition-colors w-full">
                                            Ajukan Refund / Pembatalan
                                        </button>
                                    @endif
                                </div>
                            @endif

                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: CHAT --}}
            <div class="card p-6 flex flex-col h-[500px] lg:h-[700px]">
                <h2 class="text-sm font-bold text-amber-500 uppercase tracking-widest border-b border-white/5 pb-4 flex items-center gap-2 flex-shrink-0 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Diskusi Konsep & Harga
                </h2>
                
                {{-- CHAT MESSAGES AREA --}}
                <div class="flex-1 overflow-y-auto flex flex-col gap-3 pb-2 pr-1" id="chatBox">
                    @if($booking->messages->isEmpty())
                        <div class="flex flex-col items-center justify-center h-full text-slate-500 text-sm text-center">
                            <svg class="w-10 h-10 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                            Kirim pesan pertama Anda!<br>Diskusikan detail acara dengan Admin.
                        </div>
                    @else
                        @foreach($booking->messages as $msg)
                            <div class="flex {{ $msg->sender_role === 'customer' ? 'justify-end' : 'justify-start' }} group">
                                <div class="relative max-w-[75%]">
                                    {{-- Bubble --}}
                                    <div class="px-4 py-2.5 rounded-2xl text-sm leading-relaxed {{ $msg->sender_role === 'customer' ? 'bg-amber-500/15 border border-amber-500/30 text-amber-100 rounded-br-sm' : 'bg-white/5 border border-white/10 text-slate-200 rounded-bl-sm' }}">
                                        <p class="text-[10px] opacity-60 mb-1.5 font-medium">{{ $msg->sender_role === 'customer' ? 'Anda' : 'Admin OneeMagic' }} · {{ $msg->created_at->format('H:i') }}</p>
                                        @if($msg->attachment)
                                            <a href="{{ asset('storage/' . $msg->attachment) }}" target="_blank" class="block mb-2">
                                                <img src="{{ asset('storage/' . $msg->attachment) }}" class="max-w-full rounded-xl border border-white/10 hover:opacity-80 transition-opacity cursor-zoom-in" style="max-height:220px; object-fit:cover;">
                                            </a>
                                        @endif
                                        @if($msg->message)
                                            <p>{{ $msg->message }}</p>
                                        @endif
                                    </div>
                                    {{-- Tombol Hapus (muncul on hover, hanya pesan sendiri) --}}
                                    @if($msg->sender_role === 'customer')
                                    <form id="deleteForm-{{ $msg->id }}" action="{{ route('booking.chat.delete', $msg) }}" method="POST" 
                                          class="absolute -top-2 -left-8 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $msg->id }})" class="w-6 h-6 rounded-full bg-red-500/80 hover:bg-red-500 text-white flex items-center justify-center transition-colors shadow-lg" title="Hapus pesan">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- CHAT INPUT AREA --}}
                <div class="flex-shrink-0 pt-4 border-t border-white/5 mt-2">
                    <form action="{{ route('booking.chat', $booking) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Preview lampiran yang dipilih --}}
                        <div id="attachPreview" class="hidden mb-2 px-3 py-2 rounded-lg bg-white/5 border border-white/10 flex items-center gap-2 text-xs text-amber-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            <span id="attachName" class="truncate flex-1">Gambar terlampir</span>
                            <button type="button" onclick="clearAttachment()" class="text-red-400 hover:text-red-300 flex-shrink-0">✕</button>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            {{-- Tombol Lampir Gambar --}}
                            <label id="attachLabel" class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-slate-400 hover:text-amber-500 hover:border-amber-500/40 cursor-pointer transition-all" title="Lampirkan Gambar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <input type="file" id="attachFile" name="attachment" class="hidden" accept="image/*" onchange="onAttachChange(this)">
                            </label>
                            
                            {{-- Input Teks --}}
                            <input type="text" id="chatInput" name="message" autocomplete="off" 
                                   placeholder="Ketik pesan untuk Admin..." 
                                   class="flex-1 bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-500/50 focus:bg-white/8 transition-all">
                            
                            {{-- Tombol Kirim --}}
                            <button type="submit" class="flex-shrink-0 w-10 h-10 rounded-xl bg-amber-500 hover:bg-amber-400 text-white flex items-center justify-center transition-all hover:scale-105 shadow-lg shadow-amber-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
@if($booking->midtrans_snap_token && in_array($booking->payment_status, ['unpaid', 'pending', 'failed']))
    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif
    <script>
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $booking->midtrans_snap_token }}', {
                onSuccess: function(result){
                    fetch("{{ route('booking.paymentSuccess', $booking) }}", {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload();
                        }
                    });
                },
                onPending: function(result){
                    fetch("{{ route('booking.paymentPending', $booking) }}", {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(() => window.location.reload());
                },
                onError: function(result){
                    window.location.reload();
                },
                onClose: function(){
                    // Hit API untuk reset token
                    fetch("{{ route('booking.resetToken', $booking) }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        };
    </script>
@endif
<script>
    // Auto scroll chat to bottom
    const chatBox = document.getElementById('chatBox');
    if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;

    function onAttachChange(input) {
        if (input.files && input.files[0]) {
            document.getElementById('attachName').textContent = input.files[0].name;
            document.getElementById('attachPreview').classList.remove('hidden');
            document.getElementById('attachPreview').classList.add('flex');
            document.getElementById('chatInput').placeholder = 'Tambahkan caption (opsional)...';
        }
    }

    function clearAttachment() {
        document.getElementById('attachFile').value = '';
        document.getElementById('attachPreview').classList.add('hidden');
        document.getElementById('attachPreview').classList.remove('flex');
        document.getElementById('chatInput').placeholder = 'Ketik pesan untuk Admin...';
    }

    let deleteFormId = null;

    function confirmDelete(id) {
        deleteFormId = 'deleteForm-' + id;
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        modal.classList.remove('hidden');
        // trigger reflow
        void modal.offsetWidth;
        
        modal.classList.remove('opacity-0');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            deleteFormId = null;
        }, 300);
    }

    function submitDeleteForm() {
        if (deleteFormId) {
            document.getElementById(deleteFormId).submit();
        }
    }
</script>

{{-- Custom Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-[#0f1423] border border-white/10 rounded-2xl p-6 w-full mx-4 shadow-2xl transform scale-95 transition-transform duration-300" style="max-width: 24rem;" id="deleteModalContent">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0 border border-red-500/20">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white mb-1">Hapus Pesan?</h3>
                <p class="text-sm text-slate-400">Pesan ini akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-colors">
                Batal
            </button>
            <button type="button" onclick="submitDeleteForm()" class="px-4 py-2 rounded-xl text-sm font-bold text-white bg-red-500 hover:bg-red-600 transition-colors shadow-lg shadow-red-500/20">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>
{{-- Refund Modal --}}
<div id="refundModal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeRefundModal()"></div>
    <div class="relative bg-[#0f1423] border border-white/10 rounded-2xl p-6 w-full mx-4 shadow-2xl transform scale-95 transition-transform duration-300 overflow-y-auto" style="max-width: 30rem; max-height: 90vh;" id="refundModalContent">
        
        <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center flex-shrink-0 border border-amber-500/20">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white mb-1">Ajukan Refund / Perubahan</h3>
                <p class="text-[11px] text-slate-400 leading-tight">Anda bisa mengajukan pembatalan atau meminta perubahan jadwal/nama acara. Admin akan memverifikasi pengajuan ini.</p>
            </div>
        </div>

        <form action="{{ route('booking.requestRefund', $booking) }}" method="POST">
            @csrf

            {{-- Alasan --}}
            <div class="mb-4">
                <label class="block text-xs text-slate-400 mb-2 uppercase tracking-wider">Alasan / Pesan untuk Admin <span class="text-red-400">*</span></label>
                <textarea name="refund_reason" rows="3" required
                    class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500/50"
                    placeholder="Contoh: Ingin ganti tanggal karena ada acara lain, atau minta pembatalan penuh..."></textarea>
            </div>

            {{-- Divider --}}
            <div class="border-t border-white/5 my-4 pt-4">
                <p class="text-[11px] text-amber-500/70 uppercase tracking-wider font-semibold mb-3">✦ Perubahan Jadwal / Nama (Opsional)</p>
                <p class="text-[11px] text-slate-500 mb-4">Isi jika ingin reschedule. Kosongkan jika hanya ingin refund penuh.</p>

                <div class="space-y-3">
                    <div>
                        <label class="block text-xs text-slate-400 mb-1">Nama Acara Baru</label>
                        <input type="text" name="new_event_name" value="{{ $booking->event_name }}"
                            class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500/50"
                            placeholder="Kosongkan jika tidak berubah">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal Baru</label>
                            <input type="date" name="new_event_date" value="{{ $booking->event_date }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full bg-black/40 border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500/50">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Waktu Baru</label>
                            <input type="time" name="new_event_time" value="{{ $booking->event_time }}"
                                class="w-full bg-black/40 border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500/50">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-3 mt-4">
                <button type="button" onclick="closeRefundModal()" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-sm font-bold text-white bg-amber-500 hover:bg-amber-600 transition-colors shadow-lg shadow-amber-500/20">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRefundModal() {
        const modal = document.getElementById('refundModal');
        const modalContent = document.getElementById('refundModalContent');
        
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        
        modal.classList.remove('opacity-0');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeRefundModal() {
        const modal = document.getElementById('refundModal');
        const modalContent = document.getElementById('refundModalContent');
        
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endpush
@endsection

