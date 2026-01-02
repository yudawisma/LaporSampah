<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class LaporanMap extends Component
{
    public $lat;
    public $lng;
    public $alamat;

    #[On('updateLatLng')]
    public function updateLatLng($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;

        $this->updateAlamat();
    }

    private function updateAlamat()
    {
        if (!$this->lat || !$this->lng) return;

        $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat={$this->lat}&lon={$this->lng}";
        $context = stream_context_create([
            'http' => [
                'header' => "User-Agent: LaporSampahApp/1.0\r\n"
            ]
        ]);

        $response = @file_get_contents($url, false, $context);

        $this->alamat = $response
            ? (json_decode($response, true)['display_name'] ?? 'Alamat tidak ditemukan')
            : 'Gagal mengambil alamat';

        $this->dispatch('alamatUpdated', alamat: $this->alamat);
    }

    public function render()
    {
        return view('livewire.laporan-map');
    }
}
