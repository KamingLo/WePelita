<?php

namespace App\Livewire\Guru;

use Livewire\Component;

class NilaiMurid extends Component
{
    public function render()
    {
        $guru = Guru::where('profile_id', auth()->id());
        $Murid = MuridKelas::with('kelasTahun.kelas', 'kelasTahun.tahunAjaran', 'pelajaran.guru')
            ->whereHas('kelasTahun.kelas.guru', function ($query) use ($guru) {
                $query->where('profile_id', $guru->id);
            })
            ->whereHas('pelajaran.guru', function ($query) use ($guru) {
                $query->where('profile_id', $guru->id);
            })
        ->where('status', 'aktif');
        return view('livewire.guru.nilai-murid');
    }
}
