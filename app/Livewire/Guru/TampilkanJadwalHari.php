<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\JadwalPelajaran;

class TampilkanJadwalHari extends Component
{
    public $hari = '';


    public function updatedHari($value)
    {
        \Log::info('Properti hari berubah jadi: ' . $value);
    }

    public function render()
    {
        \Log::info('Hari terpilih: ' . $this->hari);

        $jadwals = JadwalPelajaran::with(['pelajaran.guru', 'kelasTahun.kelas'])
            ->where('hari', $this->hari) // langsung hardcode
            ->orderBy('waktu_mulai')
            ->get();

        return view('livewire.guru.tampilkan-jadwal-hari', [
            'jadwals' => $jadwals,
            'hari' => $this->hari,
        ]);
    }
}