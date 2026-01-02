<div wire:ignore>
    <div id="map" style="height:350px;border-radius:8px;border:1px solid #ccc"></div>

    <button type="button" class="btn btn-success mt-2" onclick="getUserLocation()">
        <i class="bi bi-geo-alt-fill me-1"></i> Gunakan Lokasi Saya
    </button>

    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const map = L.map('map').setView([-7.4246, 109.2314], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        let marker;

        function setMarker(lat, lng) {
            if (!marker) {
                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);

                marker.on('dragend', () => {
                    const p = marker.getLatLng();
                    send(p.lat, p.lng);
                });
            } else {
                marker.setLatLng([lat, lng]);
            }

            send(lat, lng);
        }

        function send(lat, lng) {
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            Livewire.dispatch('updateLatLng', {
                lat: lat,
                lng: lng
            });
        }


        map.on('click', e => setMarker(e.latlng.lat, e.latlng.lng));

        window.getUserLocation = () => {
            if (!navigator.geolocation) {
                alert('Browser tidak mendukung GPS');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                pos => {
                    const {
                        latitude,
                        longitude,
                        accuracy
                    } = pos.coords;

                    console.log('Akurasi:', accuracy, 'meter');

                    map.setView([latitude, longitude], 18);
                    setMarker(latitude, longitude);
                },
                err => {
                    alert('Gagal mengambil lokasi: ' + err.message);
                }, {
                    enableHighAccuracy: true, // 🔥 INI PENTING
                    timeout: 15000,
                    maximumAge: 0
                }
            );
        };

    });

    window.addEventListener('alamatUpdated', e => {
        const input = document.getElementById('alamat');
        if (input) input.value = e.detail.alamat;
    });
</script>
@endpush