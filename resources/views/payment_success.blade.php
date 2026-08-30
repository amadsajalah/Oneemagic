@extends('layouts.app')
@section('title', 'Pembayaran Berhasil — OneeMagic')

@section('content')
<div class="relative py-24 min-h-[80vh] flex flex-col items-center justify-center overflow-hidden">
    {{-- Ambient Light --}}
    <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full" style="background: radial-gradient(circle, rgba(34,197,94,0.15) 0%, transparent 60%); filter: blur(50px);"></div>
    </div>

    <div class="relative z-10 w-full max-w-lg mx-auto px-6 text-center">
        
        <div class="mx-auto w-24 h-24 mb-8 bg-green-500/10 rounded-full border border-green-500/20 flex items-center justify-center shadow-[0_0_40px_rgba(34,197,94,0.3)] animate-pulse">
            <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>

        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white mb-4">Pembayaran Berhasil!</h1>
        
        <p class="text-slate-300 text-lg mb-8 leading-relaxed">
            Terima kasih! Pembayaran untuk pertunjukan <strong class="text-white">"{{ $booking->event_name }}"</strong> telah kami terima. Jadwal Anda kini telah <span class="text-amber-500 font-bold">Resmi Terkunci</span>.
        </p>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-8 backdrop-blur-md text-left">
            <div class="flex items-center justify-between mb-3 border-b border-white/5 pb-3">
                <span class="text-sm text-slate-400 uppercase tracking-wider">ID Reservasi</span>
                <span class="text-sm font-mono text-white">#OM-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex items-center justify-between mb-3 border-b border-white/5 pb-3">
                <span class="text-sm text-slate-400 uppercase tracking-wider">Total Pembayaran</span>
                <span class="text-sm font-bold text-green-400">Rp {{ number_format($booking->price, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-slate-400 uppercase tracking-wider">Metode</span>
                <span class="text-sm font-semibold text-white">Midtrans</span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('booking.show', $booking) }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-bold transition-all shadow-[0_0_20px_rgba(217,119,6,0.3)]">
                Detail Reservasi
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-slate-600 text-slate-300 hover:text-white hover:border-slate-400 hover:bg-white/5 transition-colors font-medium">
                Dasbor Saya
            </a>
        </div>
    </div>
</div>
@endsection
