<?php

namespace App\Livewire;

use Livewire\Component;

class LaporanMap extends Component
{
    public $lat;
    public $lng;
    public $alamat;

    protected $listeners = ['updateLatLng' => 'setLocation'];

   public function setLocation($lat, $lng)
{
    $this->lat = $lat;
    $this->lng = $lng;

    $this->updateAlamat(); // langsung panggil untuk isi otomatis alamat
}


    public function updateAlamat()
    {
        if ($this->lat && $this->lng) {
            $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat={$this->lat}&lon={$this->lng}";
            $context = stream_context_create([
                'http' => ['header' => "User-Agent: LaporSampahApp/1.0\r\n"]
            ]);
            $response = @file_get_contents($url, false, $context);

            if ($response) {
                $data = json_decode($response, true);
                $this->alamat = $data['display_name'] ?? 'Alamat tidak ditemukan';
            } else {
                $this->alamat = 'Gagal mengambil alamat';
            }

            $this->dispatch('alamatUpdated', alamat: $this->alamat);

        }
    }

    public function render()
    {
        return view('livewire.laporan-map');
    }
}
