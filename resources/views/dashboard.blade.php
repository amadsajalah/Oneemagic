@extends('layouts.app')
@section('title', 'Ruang Pribadi — OneeMagic')

@section('content')
<style>
    .dash-card {
        background: rgba(8,10,22,0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: 1.25rem;
        position: relative;
        overflow: hidden;
        transition: border-color 0.3s, transform 0.3s;
    }
    .dash-card:hover { border-color: rgba(217,119,6,0.35); transform: translateY(-2px); }
    .dash-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(217,119,6,0.04) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.4s;
    }
    .dash-card:hover::before { opacity: 1; }

    .status-pending  { background: rgba(234,179,8,0.1); color: #eab308; border: 1px solid rgba(234,179,8,0.2); }
    .status-approved { background: rgba(34,197,94,0.1); color: #22c55e; border: 1px solid rgba(34,197,94,0.2); }
    .status-rejected { background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }

    .avatar-ring {
        background: linear-gradient(135deg, #d97706, #7c3aed);
        border-radius: 9999px;
        padding: 2px;
        display: inline-flex;
    }
    .avatar-inner {
        background: linear-gradient(135deg, #92400e, #4c1d95);
        border-radius: 9999px;
        width: 72px; height: 72px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.75rem; font-weight: 700; color: #fff;
        font-family: 'Playfair Display', serif;
    }

    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: fadeSlideUp 0.5s ease both; }
    .anim-2 { animation: fadeSlideUp 0.5s ease 0.1s both; }
    .anim-3 { animation: fadeSlideUp 0.5s ease 0.25s both; }

    .dot-pulse { width: 8px; height: 8px; border-radius: 50%; animation: dpulse 2s infinite; }
    @keyframes dpulse { 0%,100%{ opacity:1; } 50%{ opacity:.4; } }

    .table-row { transition: background 0.2s; }
    .table-row:hover { background: rgba(255,255,255,0.025); }
</style>

<div style="padding-top: 7rem; padding-bottom: 5rem; min-height: 100vh; position: relative;">

    <div style="position:absolute;inset:0;pointer-events:none;overflow:hidden;">
        <div style="position:absolute;top:-100px;right:-100px;width:600px;height:600px;border-radius:50%;filter:blur(120px);background:radial-gradient(circle,rgba(217,119,6,0.06) 0%,transparent 70%);"></div>
        <div style="position:absolute;bottom:-100px;left:-100px;width:500px;height:500px;border-radius:50%;filter:blur(120px);background:radial-gradient(circle,rgba(124,58,237,0.06) 0%,transparent 70%);"></div>
    </div>

    <div style="max-width:72rem;margin:0 auto;padding:0 1.5rem;position:relative;z-index:10;">

        <!-- ✨ PANEL UTAMA DASBOR ✨ -->
        <div style="background:rgba(8,10,22,0.75); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.08); border-radius:1.75rem; padding:2rem; box-shadow:0 0 60px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.05);">
        @if(session('success'))
        <div style="margin-bottom:1.5rem;display:flex;align-items:center;gap:0.75rem;border-radius:0.875rem;padding:0.875rem 1.25rem;font-size:0.875rem;color:#4ade80;border:1px solid rgba(74,222,128,0.2);background:rgba(74,222,128,0.06);" class="anim-1">
            <svg style="width:1.125rem;height:1.125rem;flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="margin-bottom:1.5rem;display:flex;align-items:center;gap:0.75rem;border-radius:0.875rem;padding:0.875rem 1.25rem;font-size:0.875rem;color:#f87171;border:1px solid rgba(248,113,113,0.2);background:rgba(248,113,113,0.06);" class="anim-1">
            <svg style="width:1.125rem;height:1.125rem;flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- HEADER --}}
        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1.5rem;margin-bottom:2.5rem;" class="anim-1">
            <div style="display:flex;align-items:center;gap:1.25rem;">
                <div class="avatar-ring">
                    <div class="avatar-inner">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                </div>
                <div>
                    <p style="font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:rgba(217,119,6,0.8);margin-bottom:0.25rem;">Ruang Pribadi</p>
                    <h1 style="font-family:'Playfair Display',serif;font-size:1.875rem;font-weight:700;color:#fff;line-height:1.2;">Halo, {{ $user->name }}! ✨</h1>
                    <p style="font-size:0.8125rem;color:#64748b;margin-top:0.25rem;">{{ $user->email }}</p>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
                <a href="{{ route('booking.create') }}"
                   style="display:inline-flex;align-items:center;gap:0.5rem;border-radius:9999px;background:#d97706;padding:0.625rem 1.375rem;font-size:0.8125rem;font-weight:600;color:#fff;text-decoration:none;transition:background 0.2s,transform 0.2s;box-shadow:0 4px 16px rgba(217,119,6,0.25);"
                   onmouseover="this.style.background='#b45309';this.style.transform='translateY(-1px)'"
                   onmouseout="this.style.background='#d97706';this.style.transform='translateY(0)'">
                    <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Pesan Pertunjukan
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit"
                            style="display:inline-flex;align-items:center;gap:0.5rem;border-radius:9999px;background:transparent;border:1px solid rgba(255,255,255,0.1);padding:0.625rem 1.25rem;font-size:0.8125rem;font-weight:500;color:#94a3b8;cursor:pointer;transition:background 0.2s,color 0.2s,border-color 0.2s;"
                            onmouseover="this.style.background='rgba(255,255,255,0.06)';this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.2)'"
                            onmouseout="this.style.background='transparent';this.style.color='#94a3b8';this.style.borderColor='rgba(255,255,255,0.1)'">
                        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.25rem;margin-bottom:2.5rem;" class="anim-2">

            <div class="dash-card" style="padding:1.5rem;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                    <span style="font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Total Pemesanan</span>
                    <div style="width:2rem;height:2rem;border-radius:0.5rem;background:rgba(217,119,6,0.1);display:flex;align-items:center;justify-content:center;">
                        <svg style="width:1rem;height:1rem;color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                </div>
                <p style="font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:700;color:#fff;line-height:1;">{{ $bookings->count() }}</p>
                <p style="font-size:0.75rem;color:#475569;margin-top:0.375rem;">pertunjukan dipesan</p>
            </div>

            <div class="dash-card" style="padding:1.5rem;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                    <span style="font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Menunggu</span>
                    <div style="width:2rem;height:2rem;border-radius:0.5rem;background:rgba(234,179,8,0.1);display:flex;align-items:center;justify-content:center;">
                        <svg style="width:1rem;height:1rem;color:#eab308;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p style="font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:700;color:#fff;line-height:1;">{{ $bookings->where('status','pending')->count() }}</p>
                <p style="font-size:0.75rem;color:#475569;margin-top:0.375rem;">menunggu konfirmasi</p>
            </div>

            <div class="dash-card" style="padding:1.5rem;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                    <span style="font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Disetujui</span>
                    <div style="width:2rem;height:2rem;border-radius:0.5rem;background:rgba(34,197,94,0.1);display:flex;align-items:center;justify-content:center;">
                        <svg style="width:1rem;height:1rem;color:#22c55e;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p style="font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:700;color:#fff;line-height:1;">{{ $bookings->where('status','approved')->count() }}</p>
                <p style="font-size:0.75rem;color:#475569;margin-top:0.375rem;">pertunjukan disetujui</p>
            </div>

            <div class="dash-card" style="padding:1.5rem;">
                <div style="width:2.25rem;height:2.25rem;border-radius:0.625rem;background:rgba(99,102,241,0.1);display:flex;align-items:center;justify-content:center;margin-bottom:0.875rem;">
                    <svg style="width:1.125rem;height:1.125rem;color:#818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <p style="font-size:0.8125rem;font-weight:600;color:#e2e8f0;margin-bottom:0.375rem;">Butuh Bantuan?</p>
                <p style="font-size:0.75rem;color:#475569;line-height:1.5;">Hubungi tim kami untuk pertanyaan tentang pemesanan atau acara Anda.</p>
            </div>

        </div>

        {{-- BOOKING TABLE --}}
        <div class="anim-3">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:1.375rem;font-weight:700;color:#fff;">Riwayat Pemesanan</h2>
                    <p style="font-size:0.8125rem;color:#475569;margin-top:0.25rem;">Semua pemesanan pertunjukan Anda</p>
                </div>
                <a href="{{ route('booking.create') }}"
                   style="display:inline-flex;align-items:center;gap:0.375rem;font-size:0.8125rem;font-weight:600;color:#d97706;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#fbbf24'"
                   onmouseout="this.style.color='#d97706'">
                    + Buat Pemesanan Baru
                </a>
            </div>

            <div style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.07);border-radius:1.25rem;overflow:hidden;">
                @if($bookings->isEmpty())
                <div style="padding:5rem 2rem;text-align:center;">
                    <div style="width:5rem;height:5rem;border-radius:50%;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <svg style="width:2.25rem;height:2.25rem;color:#334155;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p style="font-size:1rem;font-weight:600;color:#e2e8f0;margin-bottom:0.5rem;">Belum Ada Pemesanan</p>
                    <p style="font-size:0.875rem;color:#475569;margin-bottom:1.75rem;">Anda belum pernah membuat reservasi pertunjukan. Yuk mulai sekarang!</p>
                    <a href="{{ route('booking.create') }}"
                       style="display:inline-flex;align-items:center;gap:0.5rem;border-radius:9999px;background:#d97706;padding:0.75rem 1.75rem;font-size:0.875rem;font-weight:600;color:#fff;text-decoration:none;box-shadow:0 4px 20px rgba(217,119,6,0.3);transition:background 0.2s,transform 0.2s;"
                       onmouseover="this.style.background='#b45309';this.style.transform='translateY(-2px)'"
                       onmouseout="this.style.background='#d97706';this.style.transform='translateY(0)'">
                        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Buat Reservasi Sekarang
                    </a>
                </div>
                @else
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;min-width:640px;">
                        <thead>
                            <tr style="background:rgba(255,255,255,0.03);border-bottom:1px solid rgba(255,255,255,0.06);">
                                <th style="padding:1rem 1.5rem;text-align:left;font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Acara</th>
                                <th style="padding:1rem 1.5rem;text-align:left;font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Tanggal &amp; Waktu</th>
                                <th style="padding:1rem 1.5rem;text-align:left;font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Status</th>
                                <th style="padding:1rem 1.5rem;text-align:right;font-size:0.6875rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#475569;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr class="table-row" style="border-bottom:1px solid rgba(255,255,255,0.04);">
                                <td style="padding:1.125rem 1.5rem;">
                                    <p style="font-size:0.9375rem;font-weight:600;color:#f1f5f9;margin-bottom:0.25rem;">{{ $booking->event_name }}</p>
                                    <p style="font-size:0.8125rem;color:#475569;display:flex;align-items:center;gap:0.375rem;">
                                        <svg style="width:0.875rem;height:0.875rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ Str::limit($booking->event_location, 40) }}
                                    </p>
                                </td>
                                <td style="padding:1.125rem 1.5rem;">
                                    <p style="font-size:0.875rem;font-weight:500;color:#cbd5e1;">{{ \Carbon\Carbon::parse($booking->event_date)->isoFormat('D MMMM Y') }}</p>
                                    <p style="font-size:0.8125rem;color:#475569;margin-top:0.25rem;display:flex;align-items:center;gap:0.375rem;">
                                        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $booking->event_time }}
                                    </p>
                                </td>
                                <td style="padding:1.125rem 1.5rem;">
                                    @if($booking->status == 'pending')
                                    <span class="status-pending" style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:9999px;padding:0.3125rem 0.875rem;font-size:0.75rem;font-weight:600;">
                                        <span class="dot-pulse" style="background:#eab308;display:inline-block;"></span>
                                        Menunggu Persetujuan
                                    </span>
                                    @elseif($booking->status == 'approved')
                                        @if($booking->payment_status === 'paid')
                                            <span class="status-approved" style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:9999px;padding:0.3125rem 0.875rem;font-size:0.75rem;font-weight:600;">
                                                <span style="width:8px;height:8px;border-radius:50%;background:#22c55e;display:inline-block;"></span>
                                                Lunas & Terjadwal
                                            </span>
                                        @elseif($booking->payment_status === 'verifying')
                                            <span style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:9999px;padding:0.3125rem 0.875rem;font-size:0.75rem;font-weight:600;color:#60a5fa;background:rgba(96,165,250,0.1);border:1px solid rgba(96,165,250,0.2);">
                                                <span style="width:8px;height:8px;border-radius:50%;background:#60a5fa;display:inline-block;"></span>
                                                Verifikasi Pembayaran
                                            </span>
                                        @else
                                            <span style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:9999px;padding:0.3125rem 0.875rem;font-size:0.75rem;font-weight:600;color:#818cf8;background:rgba(129,140,248,0.1);border:1px solid rgba(129,140,248,0.2);">
                                                <span class="dot-pulse" style="background:#818cf8;display:inline-block;"></span>
                                                Menunggu Pembayaran
                                            </span>
                                        @endif
                                    @elseif($booking->status == 'paid')
                                        <span class="status-approved" style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:9999px;padding:0.3125rem 0.875rem;font-size:0.75rem;font-weight:600;">
                                            <span style="width:8px;height:8px;border-radius:50%;background:#22c55e;display:inline-block;"></span>
                                            Lunas & Terjadwal
                                        </span>
                                    @else
                                    <span class="status-rejected" style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:9999px;padding:0.3125rem 0.875rem;font-size:0.75rem;font-weight:600;">
                                        <span style="width:8px;height:8px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                                        Ditolak
                                    </span>
                                    @endif
                                </td>
                                <td style="padding:1.125rem 1.5rem;text-align:right;">
                                    <div style="display:flex;align-items:center;justify-content:flex-end;gap:0.5rem;">
                                        <a href="{{ route('booking.show', $booking) }}"
                                           style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:0.5rem;background:rgba(217,119,6,0.1);border:1px solid rgba(217,119,6,0.3);padding:0.4375rem 0.875rem;font-size:0.75rem;font-weight:600;color:#f59e0b;cursor:pointer;text-decoration:none;transition:all 0.2s;"
                                           onmouseover="this.style.background='rgba(217,119,6,0.2)';this.style.borderColor='rgba(217,119,6,0.5)'"
                                           onmouseout="this.style.background='rgba(217,119,6,0.1)';this.style.borderColor='rgba(217,119,6,0.3)'">
                                            Detail & Chat
                                        </a>

                                        @if($booking->status == 'pending')
                                        <form action="{{ route('booking.destroy', $booking) }}" method="POST" style="display:inline;" id="cform-{{ $booking->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    onclick="document.getElementById('cform-{{ $booking->id }}').submit()"
                                                    style="display:inline-flex;align-items:center;gap:0.375rem;border-radius:0.5rem;background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.2);padding:0.4375rem 0.875rem;font-size:0.75rem;font-weight:600;color:#f87171;cursor:pointer;transition:all 0.2s;"
                                                    onmouseover="this.style.background='rgba(239,68,68,0.12)';this.style.borderColor='rgba(239,68,68,0.35)'"
                                                    onmouseout="this.style.background='rgba(239,68,68,0.06)';this.style.borderColor='rgba(239,68,68,0.2)'">
                                                Batalkan
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div><!-- end panel utama -->

    </div>
</div>
@endsection
