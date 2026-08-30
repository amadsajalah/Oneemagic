@extends('layouts.app')
@section('title', 'Pembayaran Selesai — OneeMagic')

@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:2rem;">
    <div style="background:rgba(8,10,22,0.75); backdrop-filter:blur(20px); border:1px solid rgba(34,197,94,0.3); border-radius:1.75rem; padding:3rem 2rem; max-width:400px; text-align:center;">
        <div style="width:80px;height:80px;background:rgba(34,197,94,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;color:#4ade80;">
            <svg style="width:40px;height:40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h2 style="font-size:1.5rem;font-weight:bold;color:white;margin-bottom:0.5rem;font-family:'Playfair Display',serif;">Pembayaran Sukses!</h2>
        <p style="color:#94a3b8;font-size:0.875rem;line-height:1.6;margin-bottom:2rem;">Terima kasih, pembayaran Anda telah kami terima. Jadwal pertunjukan Anda telah dikonfirmasi.</p>
        <a href="{{ route('dashboard') }}" style="display:inline-block;background:#d97706;color:white;padding:0.75rem 1.5rem;border-radius:0.75rem;font-weight:600;font-size:0.875rem;text-decoration:none;">Kembali ke Dasbor</a>
    </div>
</div>
@endsection
