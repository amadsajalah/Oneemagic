<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail & Obrolan — OneeMagic Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { fontFamily: { serif: ['Playfair Display','serif'] } } } }</script>
    @vite(['resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: #030308; }
        .sidebar-bg { background: rgba(8,8,16,0.98); border-right: 1px solid rgba(255,255,255,0.06); }
        .card { 
            background: rgba(8,10,22,0.85); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px); 
            border: 1px solid rgba(255,255,255,0.10); 
            border-radius: 1.5rem; 
        }
        .input-field { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 0.75rem; padding: 0.75rem 1rem; width: 100%; transition: all 0.2s; }
        .input-field:focus { outline: none; border-color: rgba(217,119,6,0.5); background: rgba(255,255,255,0.06); }
        .btn-gold { background: #d97706; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; transition: all 0.2s; }
        .btn-gold:hover { background: #b45309; transform: translateY(-1px); }
        
        .chat-container { height: 400px; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; padding-right: 0.5rem; }
        .chat-bubble { max-width: 80%; padding: 0.75rem 1rem; border-radius: 1rem; font-size: 0.875rem; line-height: 1.5; }
        .chat-admin { align-self: flex-end; background: rgba(217,119,6,0.15); border: 1px solid rgba(217,119,6,0.3); color: #fde68a; border-bottom-right-radius: 0.25rem; }
        .chat-user { align-self: flex-start; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e2e8f0; border-bottom-left-radius: 0.25rem; }
        
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    </style>
</head>
<body class="antialiased text-slate-200">
    <div class="flex h-screen overflow-hidden">
        {{-- SIDEBAR --}}
        <aside class="sidebar-bg w-64 flex-shrink-0 hidden md:flex flex-col h-full overflow-y-auto">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/5 flex-shrink-0">
                <div class="w-8 h-8 rounded-full overflow-hidden ring-1 ring-amber-500/30"><img src="{{ asset('logo.png') }}" class="w-full h-full object-cover"></div>
                <span style="font-family:'Playfair Display',serif;" class="text-base tracking-widest text-white font-semibold">ONEE<span class="text-amber-500">ADMIN</span></span>
            </div>
            <nav class="flex-1 px-3 py-5 space-y-0.5">
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-amber-500 bg-amber-500/10 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </nav>
        </aside>

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex-shrink-0 flex items-center justify-between h-16 px-8 border-b border-white/5" style="background: rgba(5,5,10,0.7); backdrop-filter: blur(12px);">
                <h1 style="font-family:'Playfair Display',serif;" class="text-lg font-semibold text-white">Detail Pemesanan</h1>
                @if($booking->status === 'pending')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-yellow-400/10 text-yellow-400 ring-1 ring-yellow-400/20">Menunggu</span>
                @elseif($booking->status === 'approved')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-indigo-400/10 text-indigo-400 ring-1 ring-indigo-400/20">Menunggu Bayar</span>
                @elseif($booking->status === 'paid')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-green-400/10 text-green-400 ring-1 ring-green-400/20">Lunas & Fix</span>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-red-400/10 text-red-400 ring-1 ring-red-400/20">Ditolak</span>
                @endif
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
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
                            <h2 class="text-sm font-bold text-amber-500 uppercase tracking-widest mb-6">Informasi Acara</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Nama Klien</p>
                                    <p class="text-sm text-white font-medium">{{ $booking->user->name }} ({{ $booking->user->email }})</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Nama Acara</p>
                                    <p class="text-sm text-white font-medium">{{ $booking->event_name }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Tanggal</p>
                                        <p class="text-sm text-slate-300">{{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}</p>
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
                                @if($booking->special_requests)
                                <div>
                                    <p class="text-[10px] text-amber-500/70 uppercase tracking-wider mb-1">Pesan / Catatan Khusus</p>
                                    <div class="p-3 rounded-lg bg-amber-500/5 border border-amber-500/10 text-sm text-amber-100/80 leading-relaxed italic">
                                        "{{ $booking->special_requests }}"
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Payment Box --}}
                        <div class="card p-6 border-amber-500/20 bg-gradient-to-b from-amber-500/5 to-transparent">
                            <h2 class="text-sm font-bold text-amber-500 uppercase tracking-widest mb-6">Status & Pembayaran</h2>
                            
                            @if($booking->status === 'pending')
                                <div class="p-4 rounded-xl bg-yellow-500/5 border border-yellow-500/20 mb-4">
                                    <p class="text-xs text-yellow-400 font-semibold mb-1">Pemesanan Baru Masuk</p>
                                    <p class="text-xs text-slate-400">Diskusikan konsep, detail, dan harga dengan klien melalui Obrolan di samping. Setelah deal, tetapkan harga untuk melanjutkan ke tahap pembayaran.</p>
                                </div>
                                <form action="{{ route('admin.bookings.updatePrice', $booking) }}" method="POST" class="space-y-3">
                                    @csrf @method('PATCH')
                                    <div>
                                        <label class="block text-xs text-slate-400 mb-1">Harga Deal (Rp) — Setelah Sepakat via Chat</label>
                                        <input type="number" name="price" required min="0" placeholder="Contoh: 2500000" class="input-field">
                                    </div>
                                    <button type="submit" class="btn-gold w-full text-center">✓ Setujui & Tetapkan Harga</button>
                                </form>
                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="mt-3">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-semibold text-red-400 hover:bg-red-500/10 transition-colors border border-red-500/20">✗ Tolak Pemesanan</button>
                                </form>
                            @else
                                <div class="mb-4">
                                    <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Harga Disepakati</p>
                                    <div class="flex items-center gap-3">
                                        <p class="text-xl font-bold text-white">Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
                                        @if($booking->payment_status !== 'paid')
                                            <button type="button" onclick="document.getElementById('editPriceForm').classList.toggle('hidden')" class="text-xs px-2 py-1 rounded-md bg-amber-500/10 text-amber-500 hover:bg-amber-500/20 transition-colors border border-amber-500/20">✏️ Edit</button>
                                        @endif
                                    </div>
                                </div>

                                @if($booking->payment_status !== 'paid')
                                <form id="editPriceForm" action="{{ route('admin.bookings.updatePrice', $booking) }}" method="POST" class="hidden space-y-3 mb-4 p-4 bg-black/20 rounded-xl border border-white/5">
                                    @csrf @method('PATCH')
                                    <div>
                                        <label class="block text-xs text-slate-400 mb-1">Revisi Harga Deal (Rp)</label>
                                        <input type="number" name="price" value="{{ $booking->price }}" required min="0" class="input-field !py-2 !text-sm">
                                    </div>
                                    <button type="submit" class="btn-gold w-full text-center !py-2 !text-sm">Simpan Revisi Harga</button>
                                </form>
                                @endif

                                @if($booking->payment_status === 'unpaid')
                                    <div class="p-4 rounded-xl bg-slate-800/50 border border-white/5 text-center mb-3">
                                        <p class="text-sm text-slate-400">Menunggu klien melakukan pembayaran via Midtrans.</p>
                                    </div>
                                    
                                    {{-- Tombol Set Lunas --}}
                                    <form action="{{ route('admin.bookings.verifyPayment', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="payment_status" value="paid">
                                        <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-semibold text-white bg-green-600/80 hover:bg-green-600 transition-colors border border-green-500/30">
                                            ✅ Set Lunas
                                        </button>
                                    </form>

                                @elseif($booking->payment_status === 'pending')
                                    <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-center mb-3">
                                        <p class="text-amber-400 text-sm">Pembayaran Tertunda di Midtrans (menunggu transfer/minimarket).</p>
                                    </div>

                                    <form action="{{ route('admin.bookings.verifyPayment', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="payment_status" value="paid">
                                        <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-semibold text-white bg-green-600/80 hover:bg-green-600 transition-colors border border-green-500/30">
                                            ✅ Set Lunas
                                        </button>
                                    </form>

                                @elseif($booking->payment_status === 'paid')
                                    <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-center">
                                        <p class="text-green-400 font-semibold mb-1">LUNAS</p>
                                        <p class="text-xs text-green-400/70">Pembayaran telah berhasil diverifikasi. Jadwal terkunci.</p>
                                    </div>

                                    {{-- Status Refund --}}
                                    @if($booking->refund_status === 'requested')
                                        <div class="mt-4 p-4 rounded-xl bg-yellow-500/10 border border-yellow-500/30">
                                            <p class="text-yellow-400 font-bold mb-3 text-sm flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                                Pengajuan Perubahan / Refund
                                            </p>

                                            {{-- Alasan --}}
                                            <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">Pesan dari Klien</p>
                                            <div class="p-3 bg-black/40 rounded-lg text-sm text-slate-300 italic mb-3">
                                                "{{ explode("\n\n[Permintaan", $booking->refund_reason)[0] }}"
                                            </div>

                                            {{-- Perubahan data acara jika ada --}}
                                            <div class="grid grid-cols-2 gap-2 mb-4">
                                                <div class="bg-black/30 rounded-lg p-2">
                                                    <p class="text-[9px] text-slate-500 uppercase tracking-wider mb-1">Nama Acara (Saat Ini)</p>
                                                    <p class="text-xs text-white font-medium">{{ $booking->event_name }}</p>
                                                </div>
                                                <div class="bg-black/30 rounded-lg p-2">
                                                    <p class="text-[9px] text-slate-500 uppercase tracking-wider mb-1">Tanggal (Saat Ini)</p>
                                                    <p class="text-xs text-white font-medium">{{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}</p>
                                                </div>
                                                <div class="bg-black/30 rounded-lg p-2">
                                                    <p class="text-[9px] text-slate-500 uppercase tracking-wider mb-1">Waktu (Saat Ini)</p>
                                                    <p class="text-xs text-white font-medium">{{ $booking->event_time }}</p>
                                                </div>
                                                <div class="bg-black/30 rounded-lg p-2">
                                                    <p class="text-[9px] text-slate-500 uppercase tracking-wider mb-1">Harga Sebelumnya</p>
                                                    <p class="text-xs text-amber-400 font-bold">Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            {{-- Harga baru untuk reschedule --}}
                                            <div class="mb-4 p-3 bg-indigo-500/10 border border-indigo-500/20 rounded-lg">
                                                <p class="text-[10px] text-indigo-400 uppercase tracking-wider font-semibold mb-2">Jika Setujui Reschedule — Atur Harga Baru</p>
                                                <input type="number" id="reschedule_new_price" 
                                                    value="{{ $booking->price }}"
                                                    class="w-full bg-black/40 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500/50"
                                                    placeholder="Harga baru (kosongkan = sama)">
                                            </div>

                                            {{-- Hidden forms --}}
                                            <form id="refundApproveForm" action="{{ route('admin.bookings.updateRefund', $booking) }}" method="POST" style="display:none;">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="approve">
                                            </form>
                                            <form id="refundRejectForm" action="{{ route('admin.bookings.updateRefund', $booking) }}" method="POST" style="display:none;">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="reject">
                                            </form>
                                            <form id="refundRescheduleForm" action="{{ route('admin.bookings.updateRefund', $booking) }}" method="POST" style="display:none;">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="reschedule">
                                                <input type="hidden" name="new_price" id="reschedule_price_input" value="">
                                            </form>

                                            <div class="flex gap-2">
                                                <button type="button" onclick="openRefundConfirmModal('reschedule')" class="w-full py-2 bg-green-500/20 hover:bg-green-500 text-green-400 hover:text-white rounded-lg text-xs font-semibold transition-colors border border-green-500/40 flex-1">
                                                    ✓ Setujui & Kembalikan ke Belum Bayar
                                                </button>
                                                <button type="button" onclick="openRefundConfirmModal('reject')" class="w-full py-2 bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-lg text-xs font-semibold transition-colors border border-red-500/40 flex-[0.5]">
                                                    Tolak
                                                </button>
                                            </div>
                                        </div>
                                    @elseif($booking->refund_status === 'approved')
                                        <div class="mt-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-center">
                                            <p class="text-red-400 font-semibold mb-1 text-sm">Refund Disetujui / Dibatalkan</p>
                                            <p class="text-xs text-red-400/70">Pemesanan ini telah dibatalkan karena refund.</p>
                                        </div>
                                    @elseif($booking->refund_status === 'rejected')
                                        <div class="mt-4 p-3 rounded-lg bg-slate-800/50 border border-white/5 text-center">
                                            <p class="text-slate-400 text-xs">Pengajuan Refund telah Ditolak.</p>
                                        </div>
                                    @endif
                                @else
                                    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-center text-sm text-red-400">
                                        Pembayaran Gagal / Kedaluwarsa.
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- RIGHT COLUMN: CHAT --}}
                    <div class="card p-6 flex flex-col h-[500px] lg:h-[700px]">
                        <h2 class="text-sm font-bold text-amber-500 uppercase tracking-widest border-b border-white/5 pb-4 flex items-center justify-between flex-shrink-0 mb-4">
                            <span>Obrolan (Chat)</span>
                            <span class="text-[10px] font-normal text-slate-500 bg-white/5 px-2 py-1 rounded">Internal Secure Chat</span>
                        </h2>
                        
                        <div class="chat-container flex-1 mb-4 overflow-y-auto" id="chatBox">
                            @if($booking->messages->isEmpty())
                                <div class="flex-1 flex items-center justify-center text-slate-500 text-sm text-center">
                                    Belum ada obrolan.<br>Kirim pesan untuk membahas konsep acara atau detail harga.
                                </div>
                            @else
                            @foreach($booking->messages as $msg)
                                <div class="flex {{ $msg->sender_role === 'admin' ? 'justify-end' : 'justify-start' }} group">
                                    <div class="relative max-w-[75%]">
                                        <div class="px-4 py-2.5 rounded-2xl text-sm leading-relaxed {{ $msg->sender_role === 'admin' ? 'bg-amber-500/15 border border-amber-500/30 text-amber-100 rounded-br-sm' : 'bg-white/5 border border-white/10 text-slate-200 rounded-bl-sm' }}">
                                            <p class="text-[10px] opacity-60 mb-1.5 font-medium">{{ $msg->sender_role === 'admin' ? 'Anda (Admin)' : $msg->sender->name }} · {{ $msg->created_at->format('H:i') }}</p>
                                            @if($msg->attachment)
                                                <a href="{{ asset('storage/' . $msg->attachment) }}" target="_blank" class="block mb-2">
                                                    <img src="{{ asset('storage/' . $msg->attachment) }}" class="max-w-full rounded-xl border border-white/10 hover:opacity-80 transition-opacity cursor-zoom-in" style="max-height:220px; object-fit:cover;">
                                                </a>
                                            @endif
                                            @if($msg->message)
                                                <p>{{ $msg->message }}</p>
                                            @endif
                                        </div>
                                        {{-- Tombol Hapus (hanya pesan dari admin sendiri) --}}
                                        @if($msg->sender_role === 'admin')
                                        <form id="deleteForm-{{ $msg->id }}" action="{{ route('admin.bookings.chat.delete', $msg) }}" method="POST"
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

                        {{-- CHAT INPUT --}}
                        <div class="flex-shrink-0 pt-4 border-t border-white/5 mt-2">
                            <form action="{{ route('admin.bookings.chat', $booking) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div id="adminAttachPreview" class="hidden mb-2 px-3 py-2 rounded-lg bg-white/5 border border-white/10 flex items-center gap-2 text-xs text-amber-400">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    <span id="adminAttachName" class="truncate flex-1">Gambar terlampir</span>
                                    <button type="button" onclick="clearAdminAttachment()" class="text-red-400 hover:text-red-300 flex-shrink-0">✕</button>
                                </div>

                                <div class="flex items-center gap-2">
                                    <label class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-slate-400 hover:text-amber-500 hover:border-amber-500/40 cursor-pointer transition-all" title="Lampirkan Gambar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <input type="file" id="adminAttachFile" name="attachment" class="hidden" accept="image/*" onchange="onAdminAttachChange(this)">
                                    </label>
                                    <input type="text" id="chatInputAdmin" name="message" autocomplete="off" 
                                           placeholder="Ketik pesan di sini..." 
                                           class="flex-1 bg-white/5 border border-white/10 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-500/50 transition-all">
                                    <button type="submit" class="flex-shrink-0 w-10 h-10 rounded-xl bg-amber-500 hover:bg-amber-400 text-white flex items-center justify-center transition-all hover:scale-105 shadow-lg shadow-amber-500/20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
    <script>
        // Auto scroll chat to bottom
        const chatBox = document.getElementById('chatBox');
        if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;

        function onAdminAttachChange(input) {
            if (input.files && input.files[0]) {
                document.getElementById('adminAttachName').textContent = input.files[0].name;
                const preview = document.getElementById('adminAttachPreview');
                preview.classList.remove('hidden');
                preview.classList.add('flex');
                document.getElementById('chatInputAdmin').placeholder = 'Tambahkan caption (opsional)...';
            }
        }

        function clearAdminAttachment() {
            document.getElementById('adminAttachFile').value = '';
            const preview = document.getElementById('adminAttachPreview');
            preview.classList.add('hidden');
            preview.classList.remove('flex');
            document.getElementById('chatInputAdmin').placeholder = 'Ketik pesan di sini...';
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

    {{-- Refund Confirm Modal --}}
    <div id="refundConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeRefundConfirmModal()"></div>
        <div class="relative bg-[#0f1423] border border-white/10 rounded-2xl p-6 w-full mx-4 shadow-2xl transform scale-95 transition-transform duration-300" style="max-width: 24rem;" id="refundConfirmModalContent">
            <div class="flex items-center gap-4 mb-4" id="refundConfirmIcon">
                {{-- Icon & text will be set by JS --}}
            </div>
            <div class="flex items-center justify-end gap-3 mt-6">
                <button type="button" onclick="closeRefundConfirmModal()" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-colors">
                    Batal
                </button>
                <button type="button" id="refundConfirmBtn" class="px-4 py-2 rounded-xl text-sm font-bold text-white transition-colors shadow-lg">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>

    <script>
        let refundAction = null;
        
        function openRefundConfirmModal(action) {
            refundAction = action;
            const modal = document.getElementById('refundConfirmModal');
            const modalContent = document.getElementById('refundConfirmModalContent');
            const iconArea = document.getElementById('refundConfirmIcon');
            const confirmBtn = document.getElementById('refundConfirmBtn');

            if (action === 'reschedule' || action === 'approve') {
                iconArea.innerHTML = `
                    <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center flex-shrink-0 border border-green-500/20">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Setujui & Reset Pembayaran?</h3>
                        <p class="text-sm text-slate-400">Pemesanan ini akan kembali menjadi Belum Bayar. Harga baru (jika diatur) akan diterapkan.</p>
                    </div>`;
                confirmBtn.className = 'px-4 py-2 rounded-xl text-sm font-bold text-white bg-green-500 hover:bg-green-600 transition-colors shadow-lg shadow-green-500/20';
                confirmBtn.textContent = 'Ya, Setujui';
            } else {
                iconArea.innerHTML = `
                    <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0 border border-red-500/20">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Tolak Refund?</h3>
                        <p class="text-sm text-slate-400">Pengajuan refund klien akan ditolak. Pemesanan tetap berjalan.</p>
                    </div>`;
                confirmBtn.className = 'px-4 py-2 rounded-xl text-sm font-bold text-white bg-red-500 hover:bg-red-600 transition-colors shadow-lg shadow-red-500/20';
                confirmBtn.textContent = 'Ya, Tolak';
            }

            confirmBtn.onclick = function() {
                let formId = 'refundRejectForm';
                if (action === 'reschedule' || action === 'approve') {
                    formId = 'refundRescheduleForm';
                    const newPrice = document.getElementById('reschedule_new_price').value;
                    document.getElementById('reschedule_price_input').value = newPrice;
                }
                document.getElementById(formId).submit();
            };

            modal.classList.remove('hidden');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeRefundConfirmModal() {
            const modal = document.getElementById('refundConfirmModal');
            const modalContent = document.getElementById('refundConfirmModalContent');
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }
    </script>
</body>
</html>
