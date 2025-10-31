<div wire:ignore>
    <div id="map"
         style="height: 350px; width: 100%; border-radius: 8px; border: 1px solid #ccc;"></div>
    <button type="button" class="btn btn-success mt-2" onclick="getUserLocation()">
        <i class="bi bi-geo-alt-fill me-1"></i> Gunakan Lokasi Saya
    </button>

    <input type="hidden" wire:model="lat" name="lat">
    <input type="hidden" wire:model="lng" name="lng">
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;

    const map = L.map('map').setView([-7.4246, 109.2314], 13); // posisi awal Purwokerto

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    let marker;

    function setMarker(lat, lng) {
        if (!marker) {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', function () {
                const pos = marker.getLatLng();
                Livewire.dispatch('updateLatLng', { lat: pos.lat, lng: pos.lng });
            });
        } else {
            marker.setLatLng([lat, lng]);
        }

        Livewire.dispatch('updateLatLng', { lat, lng });
    }

    map.on('click', function (e) {
        setMarker(e.latlng.lat, e.latlng.lng);
    });

    window.getUserLocation = function () {
        if (!navigator.geolocation) {
            alert('Browser tidak mendukung Geolocation.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                map.setView([lat, lng], 16);
                setMarker(lat, lng);
            },
            (err) => alert('Gagal mengambil lokasi: ' + err.message)
        );
    };
});

// 🔥 Listener untuk update field alamat
window.addEventListener('alamatUpdated', (event) => {
    console.log('Alamat diterima:', event.detail.alamat);
    const input = document.querySelector('input#alamat');
    if (input) input.value = event.detail.alamat;
});
</script>
@endpush
