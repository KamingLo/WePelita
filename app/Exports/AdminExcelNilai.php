<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\MuridKelas;
use App\Models\KelasTahun;
use App\Models\Pelajaran;

class AdminExcelNilai implements FromArray, WithHeadings
{
    protected $kelasTahunId;
    protected $pelajaranId;

    public function __construct($kelasTahunId, $pelajaranId)
    {
        $this->kelasTahunId = $kelasTahunId;
        $this->pelajaranId = $pelajaranId;
    }

    public function array(): array
    {
        $muridList = MuridKelas::with(['murid.profile', 'nilai' => function ($query) {
            $query->where('pelajaran_id', $this->pelajaranId);
        }])
            ->where('kelas_tahun_id', $this->kelasTahunId)
            ->get();

        $kelasTahun = KelasTahun::with(['kelas', 'tahunajar'])->findOrFail($this->kelasTahunId);
        $pelajaran = Pelajaran::findOrFail($this->pelajaranId);

        return $muridList->map(function ($muridKelas) use ($kelasTahun, $pelajaran) {
            return [
                'Nama Murid' => $muridKelas->murid->profile->name ?? '-',
                'Kelas' => $kelasTahun->kelas->nama_kelas . ' - ' . $kelasTahun->tahunajar->tahun_ajaran . ' (' . $kelasTahun->tahunajar->semester . ')',
                'Pelajaran' => $pelajaran->namaPelajaran,
                'Nilai Tugas' => $muridKelas->nilai->isNotEmpty() ? ($muridKelas->nilai->first()->nilai_tugas ?? '-') : '-',
                'Nilai UTS' => $muridKelas->nilai->isNotEmpty() ? ($muridKelas->nilai->first()->nilai_uts ?? '-') : '-',
                'Nilai UAS' => $muridKelas->nilai->isNotEmpty() ? ($muridKelas->nilai->first()->nilai_uas ?? '-') : '-',
            ];
        })->toArray();
    }

    public function headings(): array
    {
        return [
            'Nama Murid',
            'Kelas',
            'Pelajaran',
            'Nilai Tugas',
            'Nilai UTS',
            'Nilai UAS',
        ];
    }
}