<?php
namespace App\Livewire\Guru;

use App\Models\Guru;
use App\Models\MuridKelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\KelasTahun;
use Livewire\Component;

class NilaiMurid extends Component
{
    public $pilihanPelajaran = '';
    public $pilihanKelasTahun = '';
    public $selectedMurids = [];
    public $nilai = [];
    public $guru;

    public function mount()
    {
        $this->guru = Guru::where('profile_id', auth()->id())->first();
        if (!$this->guru) {
            session()->flash('error', 'Data guru tidak ditemukan');
        }
    }

    public function render()
    {
        $pelajaranList = collect();
        $kelasTahunList = collect();
        $muridList = collect();

        if ($this->guru) {
            // Get pelajaran where guru_id matches
            $pelajaranList = Pelajaran::where('guru_id', $this->guru->guru_id)->get();

            if ($this->pilihanPelajaran) {
                // Get kelas_tahun list
                $kelasTahunList = KelasTahun::with('kelas')->get();
            }

            if ($this->pilihanKelasTahun) {
                // Get active students in selected kelas_tahun
                $muridList = MuridKelas::with(['murid.profile'])
                    ->where('kelas_tahun_id', $this->pilihanKelasTahun)
                    ->get();
            }
        }

        return view('livewire.guru.nilai-murid', [
            'pelajaranList' => $pelajaranList,
            'kelasTahunList' => $kelasTahunList,
            'muridList' => $muridList
        ]);
    }

    public function submitNilai()
    {
        $this->validate([
            'nilai.*' => 'required|numeric|min:0|max:100'
        ]);

        foreach ($this->nilai as $muridKelasId => $nilai) {
            Nilai::create([
                'murid_kelas_id' => $muridKelasId,
                'pelajaran_id' => $this->pilihanPelajaran,
                'nilai' => $nilai,
                'guru_id' => $this->guru->guru_id
            ]);
        }

        session()->flash('message', 'Nilai berhasil disimpan!');
        $this->reset(['nilai']);
    }
}