@extends('layouts.app')
@section('title', 'Pesan Pertunjukan Eksklusif — OneeMagic')

@push('head')
{{-- Leaflet.js CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<style>
    .field-group { margin-bottom: 1.5rem; }
    .field-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #94a3b8;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    .field-input {
        display: block;
        width: 100%;
        border-radius: 0.75rem;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 0.875rem 1.125rem;
        font-size: 0.9375rem;
        color: #f1f5f9;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
        color-scheme: dark;
    }
    .field-input::placeholder { color: rgba(100,116,139,0.6); }
    .field-input:focus {
        border-color: rgba(217,119,6,0.6);
        background: rgba(255,255,255,0.06);
        box-shadow: 0 0 0 3px rgba(217,119,6,0.08);
    }
    .field-input:hover:not(:focus) { border-color: rgba(255,255,255,0.18); }

    .step-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.75rem; height: 1.75rem;
        border-radius: 50%;
        background: rgba(217,119,6,0.15);
        border: 1px solid rgba(217,119,6,0.3);
        font-size: 0.75rem;
        font-weight: 700;
        color: #f59e0b;
        flex-shrink: 0;
    }

    .info-card {
        background: rgba(217,119,6,0.05);
        border: 1px solid rgba(217,119,6,0.15);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.55s ease both; }
    .fade-up-2 { animation: fadeUp 0.55s ease 0.1s both; }
    .fade-up-3 { animation: fadeUp 0.55s ease 0.2s both; }
</style>

<div style="min-height:100vh;padding-top:6.5rem;padding-bottom:5rem;position:relative;">

    {{-- Background Glow --}}
    <div style="position:absolute;inset:0;pointer-events:none;overflow:hidden;">
        <div style="position:absolute;top:0;left:50%;transform:translateX(-50%);width:700px;height:400px;border-radius:50%;filter:blur(100px);background:radial-gradient(circle,rgba(217,119,6,0.07) 0%,transparent 70%);"></div>
        <div style="position:absolute;bottom:0;right:0;width:400px;height:400px;border-radius:50%;filter:blur(100px);background:radial-gradient(circle,rgba(124,58,237,0.05) 0%,transparent 70%);"></div>
    </div>

    <div style="max-width:56rem;margin:0 auto;padding:0 1.5rem;position:relative;z-index:10;">

        {{-- PAGE HEADER --}}
        <div style="text-align:center;margin-bottom:3rem;" class="fade-up">
            <p style="font-size:0.75rem;font-weight:600;letter-spacing:0.15em;text-transform:uppercase;color:rgba(217,119,6,0.8);margin-bottom:0.75rem;">✦ RESERVASI PERTUNJUKAN</p>
            <h1 style="font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:700;color:#fff;line-height:1.2;margin-bottom:1rem;">
                Pemesanan <span style="color:#f59e0b;">Eksklusif</span>
            </h1>
            <p style="font-size:0.9375rem;color:#64748b;max-width:36rem;margin:0 auto;line-height:1.7;">
                Isi detail acara Anda di bawah ini. Tim kami akan meninjau dan menghubungi Anda dalam waktu <strong style="color:#94a3b8;">1×24 jam</strong> untuk konfirmasi jadwal dan konsep pertunjukan.
            </p>
        </div>

        {{-- Flash Messages --}}
        @if($errors->any())
        <div style="margin-bottom:1.5rem;border-radius:0.875rem;padding:1rem 1.25rem;border:1px solid rgba(239,68,68,0.25);background:rgba(239,68,68,0.06);" class="fade-up">
            <p style="font-size:0.8125rem;font-weight:600;color:#f87171;margin-bottom:0.5rem;">Oops! Ada beberapa hal yang perlu diperbaiki:</p>
            <ul style="list-style:none;padding:0;margin:0;">
                @foreach($errors->all() as $error)
                <li style="font-size:0.8125rem;color:#fca5a5;display:flex;align-items:center;gap:0.5rem;margin-top:0.25rem;">
                    <svg style="width:0.875rem;height:0.875rem;flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-8 items-start fade-up-2">

            {{-- ===== MAIN FORM ===== --}}
            <div style="background:rgba(255,255,255,0.025);border:1px solid rgba(255,255,255,0.08);border-radius:1.5rem;overflow:hidden;">
                {{-- Form Top Accent --}}
                <div style="height:3px;background:linear-gradient(90deg,#d97706,#7c3aed,#d97706);"></div>

                <div style="padding:2rem;">
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        {{-- Section 1: Informasi Acara --}}
                        <div style="margin-bottom:2rem;">
                            <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem;padding-bottom:0.875rem;border-bottom:1px solid rgba(255,255,255,0.06);">
                                <span class="step-badge">1</span>
                                <span style="font-size:0.875rem;font-weight:600;color:#e2e8f0;">Informasi Acara</span>
                            </div>

                            <div class="field-group">
                                <label for="event_name" class="field-label">Nama / Jenis Acara</label>
                                <input id="event_name" name="event_name" type="text" required
                                       value="{{ old('event_name') }}"
                                       placeholder="Cth: Gala Dinner Perusahaan, Pesta Ulang Tahun..."
                                       class="field-input">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="field-group" style="margin-bottom:0;">
                                    <label for="event_date" class="field-label">Tanggal Acara</label>
                                    <input id="event_date" name="event_date" type="date" required
                                           value="{{ old('event_date') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="field-input">
                                </div>
                                <div class="field-group" style="margin-bottom:0;">
                                    <label for="event_time" class="field-label">Waktu Acara</label>
                                    <input id="event_time" name="event_time" type="time" required
                                           value="{{ old('event_time') }}"
                                           class="field-input">
                                </div>
                            </div>
                        </div>

                        {{-- Section 2: Lokasi & Tamu --}}
                        <div style="margin-bottom:2rem;">
                            <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem;padding-bottom:0.875rem;border-bottom:1px solid rgba(255,255,255,0.06);">
                                <span class="step-badge">2</span>
                                <span style="font-size:0.875rem;font-weight:600;color:#e2e8f0;">Lokasi & Kapasitas</span>
                            </div>

                            <div class="field-group">
                                <label class="field-label">Lokasi Acara</label>

                                {{-- Search box --}}
                                <div style="position:relative;margin-bottom:0.75rem;">
                                    <input id="location_search" type="text" autocomplete="off"
                                           placeholder="Cari nama lokasi, hotel, gedung..."
                                           style="display:block;width:100%;border-radius:0.75rem;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);padding:0.875rem 1.125rem 0.875rem 2.875rem;font-size:0.9375rem;color:#f1f5f9;outline:none;transition:border-color 0.2s,background 0.2s,box-shadow 0.2s;font-family:'Inter',sans-serif;box-sizing:border-box;"
                                           onfocus="this.style.borderColor='rgba(217,119,6,0.6)';this.style.background='rgba(255,255,255,0.06)';this.style.boxShadow='0 0 0 3px rgba(217,119,6,0.08)'"
                                           onblur="this.style.borderColor='rgba(255,255,255,0.1)';this.style.background='rgba(255,255,255,0.04)';this.style.boxShadow='none'">
                                    <svg style="position:absolute;left:0.875rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:#64748b;pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    {{-- Autocomplete dropdown --}}
                                    <div id="map_suggestions" style="display:none;position:absolute;top:100%;left:0;right:0;z-index:9999;background:#0f0f1a;border:1px solid rgba(255,255,255,0.1);border-radius:0.625rem;margin-top:0.25rem;max-height:180px;overflow-y:auto;"></div>
                                </div>

                                {{-- Leaflet Map --}}
                                <div id="map_picker" style="height:260px;border-radius:0.875rem;border:1px solid rgba(255,255,255,0.1);overflow:hidden;z-index:1;"></div>
                                <p style="font-size:0.75rem;color:#475569;margin-top:0.5rem;display:flex;align-items:center;gap:0.375rem;">
                                    <svg style="width:0.8125rem;height:0.8125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Cari lokasi atau klik langsung di peta untuk menandai titik acara
                                </p>

                                {{-- Hidden + visible result input --}}
                                <input id="event_location" name="event_location" type="hidden" value="{{ old('event_location') }}" required>
                                <div id="location_result" style="display:none;margin-top:0.625rem;border-radius:0.625rem;background:rgba(34,197,94,0.06);border:1px solid rgba(34,197,94,0.2);padding:0.625rem 0.875rem;font-size:0.8125rem;color:#86efac;display:flex;align-items:flex-start;gap:0.5rem;">
                                    <svg style="width:0.875rem;height:0.875rem;color:#4ade80;flex-shrink:0;margin-top:0.1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span id="location_result_text" style="line-height:1.5;"></span>
                                </div>
                            </div>

                            <div class="field-group" style="margin-bottom:0;">
                                <label for="guest_count" class="field-label">Perkiraan Jumlah Tamu</label>
                                <input id="guest_count" name="guest_count" type="number" min="1" required
                                       value="{{ old('guest_count') }}"
                                       placeholder="Cth: 150"
                                       class="field-input">
                            </div>
                        </div>

                        {{-- Section 3: Catatan Khusus --}}
                        <div style="margin-bottom:2rem;">
                            <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem;padding-bottom:0.875rem;border-bottom:1px solid rgba(255,255,255,0.06);">
                                <span class="step-badge">3</span>
                                <span style="font-size:0.875rem;font-weight:600;color:#e2e8f0;">Pesan & Konsep</span>
                            </div>

                            <div class="field-group" style="margin-bottom:0;">
                                <label for="special_requests" class="field-label">Catatan Khusus / Pesan Magis <span style="color:#475569;font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span></label>
                                <textarea id="special_requests" name="special_requests" rows="5"
                                          placeholder="Ceritakan lebih lanjut tentang konsep acara, tema, atau permintaan khusus Anda..."
                                          class="field-input" style="resize:vertical;">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                style="display:flex;align-items:center;justify-content:center;gap:0.625rem;width:100%;border-radius:0.875rem;background:#d97706;border:none;padding:1rem 1.5rem;font-size:0.9375rem;font-weight:600;color:#fff;cursor:pointer;transition:background 0.2s,transform 0.15s,box-shadow 0.2s;box-shadow:0 4px 20px rgba(217,119,6,0.3);font-family:'Inter',sans-serif;"
                                onmouseover="this.style.background='#b45309';this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 24px rgba(217,119,6,0.4)'"
                                onmouseout="this.style.background='#d97706';this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(217,119,6,0.3)'">
                            <svg style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Permintaan Pemesanan
                        </button>
                    </form>
                </div>
            </div>

            {{-- ===== SIDEBAR INFO ===== --}}
            <div style="position:sticky;top:7rem;" class="fade-up-3">

                {{-- Proses Pemesanan --}}
                <div style="background:rgba(255,255,255,0.025);border:1px solid rgba(255,255,255,0.08);border-radius:1.25rem;padding:1.5rem;margin-bottom:1.25rem;">
                    <h3 style="font-size:0.875rem;font-weight:700;color:#e2e8f0;margin-bottom:1.25rem;display:flex;align-items:center;gap:0.5rem;">
                        <svg style="width:1rem;height:1rem;color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Alur Pemesanan
                    </h3>
                    @php
                    $steps = [
                        ['icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Isi Formulir','desc'=>'Lengkapi detail acara Anda'],
                        ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Tinjauan Admin','desc'=>'Tim kami memproses dalam 1×24 jam'],
                        ['icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z','title'=>'Konfirmasi','desc'=>'Anda akan dihubungi untuk finalisasi'],
                        ['icon'=>'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z','title'=>'Pertunjukan Berlangsung','desc'=>'Nikmati pertunjukan magis eksklusif!'],
                    ];
                    @endphp
                    <div style="display:flex;flex-direction:column;gap:0.875rem;">
                        @foreach($steps as $i => $step)
                        <div style="display:flex;align-items:flex-start;gap:0.75rem;">
                            <div style="width:2rem;height:2rem;border-radius:50%;background:rgba(217,119,6,0.1);border:1px solid rgba(217,119,6,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:0.125rem;">
                                <svg style="width:0.875rem;height:0.875rem;color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.8125rem;font-weight:600;color:#e2e8f0;">{{ $step['title'] }}</p>
                                <p style="font-size:0.75rem;color:#475569;margin-top:0.125rem;">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        @if($i < count($steps)-1)
                        <div style="margin-left:0.9375rem;width:1px;height:0.75rem;background:rgba(255,255,255,0.07);"></div>
                        @endif
                        @endforeach
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="info-card">
                    <svg style="width:1.25rem;height:1.25rem;color:#f59e0b;flex-shrink:0;margin-top:0.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p style="font-size:0.8125rem;color:#94a3b8;line-height:1.6;">Pemesanan bersifat <strong style="color:#e2e8f0;">tidak mengikat</strong> hingga dikonfirmasi oleh admin. Anda bisa membatalkan selama masih berstatus <em style="color:#eab308;">Menunggu</em>.</p>
                </div>

                {{-- Back to dashboard --}}
                <a href="{{ route('dashboard') }}"
                   style="display:flex;align-items:center;justify-content:center;gap:0.5rem;margin-top:1.25rem;border-radius:0.875rem;border:1px solid rgba(255,255,255,0.08);background:transparent;padding:0.75rem;font-size:0.8125rem;font-weight:500;color:#64748b;text-decoration:none;transition:background 0.2s,color 0.2s,border-color 0.2s;"
                   onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='#94a3b8';this.style.borderColor='rgba(255,255,255,0.15)'"
                   onmouseout="this.style.background='transparent';this.style.color='#64748b';this.style.borderColor='rgba(255,255,255,0.08)'">
                    <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dasbor
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Map (Pusat default: Jakarta)
        const map = L.map('map_picker').setView([-6.2088, 106.8456], 13);
        
        // Dark theme map tiles (Esri World Dark Gray Base - No API Key Required)
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Dark_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ',
            maxZoom: 16
        }).addTo(map);

        let marker = null;
        const locationInput = document.getElementById('event_location');
        const locationSearch = document.getElementById('location_search');
        const searchSuggestions = document.getElementById('map_suggestions');
        const locationResult = document.getElementById('location_result');
        const locationResultText = document.getElementById('location_result_text');

        // Custom Icon Emas
        const goldIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Fungsi Set Lokasi & Update Form
        function setLocation(lat, lng, label) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng], {icon: goldIcon}).addTo(map);
            map.setView([lat, lng], 15);
            
            locationInput.value = label;
            locationResultText.textContent = label;
            locationResult.style.display = 'flex';
            locationSearch.value = label;
            searchSuggestions.style.display = 'none';
        }

        // Event: Klik Peta
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            
            // Reverse geocoding (Nominatim OpenStreetMap)
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    const label = data.display_name || `Kordinat: ${lat.toFixed(4)}, ${lng.toFixed(4)}`;
                    setLocation(lat, lng, label);
                })
                .catch(() => {
                    setLocation(lat, lng, `Kordinat: ${lat.toFixed(4)}, ${lng.toFixed(4)}`);
                });
        });

        // Event: Ketik Pencarian (Autocomplete)
        let searchTimeout;
        locationSearch.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const query = e.target.value;
            
            if (query.length < 3) {
                searchSuggestions.style.display = 'none';
                return;
            }

            // Tunda 500ms agar tidak spam API
            searchTimeout = setTimeout(() => {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5`)
                    .then(response => response.json())
                    .then(data => {
                        searchSuggestions.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const div = document.createElement('div');
                                div.style.padding = '0.75rem 1rem';
                                div.style.cursor = 'pointer';
                                div.style.borderBottom = '1px solid rgba(255,255,255,0.05)';
                                div.style.fontSize = '0.8125rem';
                                div.style.color = '#cbd5e1';
                                div.textContent = item.display_name;
                                
                                div.addEventListener('mouseover', () => div.style.background = 'rgba(255,255,255,0.05)');
                                div.addEventListener('mouseout', () => div.style.background = 'transparent');
                                
                                div.addEventListener('click', () => {
                                    setLocation(item.lat, item.lon, item.display_name);
                                });
                                searchSuggestions.appendChild(div);
                            });
                            searchSuggestions.style.display = 'block';
                        } else {
                            searchSuggestions.style.display = 'none';
                        }
                    });
            }, 500);
        });

        // Tutup saran pencarian saat klik di luar
        document.addEventListener('click', function(e) {
            if (!locationSearch.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.style.display = 'none';
            }
        });
        
        // Memuat lokasi sebelumnya (jika validasi error dan kembali)
        const initialVal = locationInput.value;
        if(initialVal) {
             locationResultText.textContent = initialVal;
             locationResult.style.display = 'flex';
             locationSearch.value = initialVal;
        }
    });
</script>
@endpush

