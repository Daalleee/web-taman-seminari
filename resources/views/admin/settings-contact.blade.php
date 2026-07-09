@extends('layouts.admin')

@section('title', 'Kontak')

@push('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
    #map-picker { height: 400px; border-radius: 12px; z-index: 0; }
    .leaflet-container { border-radius: 12px; }
    .leaflet-control-zoom a { background: white !important; color: #333 !important; }
</style>
@endpush

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.settings.contact') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-primary/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-primary/5 bg-surface-container-low flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-[22px]">contact_phone</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary">Informasi Kontak</h3>
                    <p class="text-sm text-on-surface-variant mt-0.5">Alamat, telepon, email, dan lokasi peta.</p>
                </div>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-on-surface mb-1.5">Alamat</label>
                        <textarea name="address" rows="3" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="Alamat lengkap sekolah...">{{ $settings['address'] ?? '' }}</textarea>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-on-surface mb-1.5">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="+62 xxx xxxx xxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-on-surface mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="email@sekolah.ac.id">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-primary/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-primary/5 bg-surface-container-low flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-[22px]">map</span>
                </div>
                <div>
                    <h3 class="font-headline-sm text-headline-sm text-primary">Lokasi Peta</h3>
                    <p class="text-sm text-on-surface-variant mt-0.5">Seret marker atau klik peta untuk menentukan lokasi.</p>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5">Cari Lokasi</label>
                    <div class="flex gap-2">
                        <input type="text" id="search-location" class="block w-full px-4 py-2.5 border border-primary/10 rounded-xl focus:ring-2 focus:ring-secondary/30 focus:border-secondary sm:text-sm bg-surface-bright focus:bg-white transition-colors" placeholder="Ketik nama tempat, lalu pilih...">
                        <button type="button" id="btn-search" class="px-4 py-2.5 bg-primary text-white rounded-xl hover:bg-primary-container transition-colors text-sm font-medium">Cari</button>
                    </div>
                </div>
                <div id="map-picker"></div>
                <div class="flex flex-wrap gap-4 text-sm text-on-surface-variant">
                    <div>
                        <span class="font-medium text-on-surface">Latitude:</span>
                        <span id="lat-display">{{ $settings->get('map_latitude') ?? '-6.2088' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-on-surface">Longitude:</span>
                        <span id="lng-display">{{ $settings->get('map_longitude') ?? '106.8456' }}</span>
                    </div>
                </div>
                <input type="hidden" name="map_latitude" id="map_latitude" value="{{ $settings->get('map_latitude') ?? '-6.2088' }}">
                <input type="hidden" name="map_longitude" id="map_longitude" value="{{ $settings->get('map_longitude') ?? '106.8456' }}">
                <p class="text-xs text-on-surface-variant">*Koordinat akan tersimpan otomatis saat marker digeser atau peta diklik.</p>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-container rounded-xl shadow-sm transition-all">
                Simpan Kontak
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var lat = parseFloat('{{ $settings->get('map_latitude') ?? '-6.2088' }}') || -6.2088;
        var lng = parseFloat('{{ $settings->get('map_longitude') ?? '106.8456' }}') || 106.8456;

        var map = L.map('map-picker', {
            center: [lat, lng],
            zoom: 16,
            zoomControl: true,
        });

        var googleSat = L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
        });

        var googleRoad = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
        });

        googleSat.addTo(map);

        L.control.layers({
            'Satelit': googleSat,
            'Jalan': googleRoad,
        }, null, { position: 'bottomleft' }).addTo(map);

        var markerIcon = L.divIcon({
            html: '<div style="background:#003366;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(0,0,0,0.4);border:3px solid white;"><svg width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg></div>',
            iconSize: [36, 36],
            iconAnchor: [18, 36],
            className: '',
        });

        var marker = L.marker([lat, lng], { draggable: true, icon: markerIcon }).addTo(map);

        function updateCoords(lat, lng) {
            document.getElementById('map_latitude').value = lat.toFixed(6);
            document.getElementById('map_longitude').value = lng.toFixed(6);
            document.getElementById('lat-display').textContent = lat.toFixed(6);
            document.getElementById('lng-display').textContent = lng.toFixed(6);
        }

        marker.on('dragend', function (e) {
            var pos = marker.getLatLng();
            updateCoords(pos.lat, pos.lng);
        });

        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            updateCoords(e.latlng.lat, e.latlng.lng);
        });

        document.getElementById('btn-search').addEventListener('click', function () {
            var query = document.getElementById('search-location').value;
            if (!query) return;

            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(query) + '&limit=5&countrycodes=id')
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (data.length > 0) {
                        var loc = data[0];
                        map.setView([loc.lat, loc.lon], 17);
                        marker.setLatLng([loc.lat, loc.lon]);
                        updateCoords(parseFloat(loc.lat), parseFloat(loc.lon));
                    } else {
                        alert('Lokasi tidak ditemukan. Coba kata kunci lain.');
                    }
                });
        });

        document.getElementById('search-location').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('btn-search').click();
            }
        });
    });
</script>
@endsection