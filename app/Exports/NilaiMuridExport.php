<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiMuridExport implements FromCollection, WithHeadings
{
    protected $kelasTahunId;
    protected $pelajaranId;

    public function __construct($kelasTahunId, $pelajaranId)
    {
        $this->kelasTahunId = $kelasTahunId;
        $this->pelajaranId = $pelajaranId;
    }

    public function collection()
    {
        return Nilai::with(['muridkelas.murid.profile', 'muridkelas.kelastahun.kelas', 'muridkelas.kelastahun.tahunajar', 'pelajaran'])
            ->whereHas('muridkelas', function ($query) {
                $query->where('kelas_tahun_id', $this->kelasTahunId);
            })
            ->where('pelajaran_id', $this->pelajaranId)
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Murid' => $item->muridkelas->murid->profile->name ?? '-',
                    'Kelas' => $item->muridkelas->kelastahun->kelas->nama_kelas ?? '-',
                    'Tahun Ajaran' => $item->muridkelas->kelastahun->tahunajar->tahun_ajaran ?? '-',
                    'Pelajaran' => $item->pelajaran->namaPelajaran ?? '-',
                    'Nilai Tugas' => $item->nilai_tugas ?? '-',
                    'Nilai UTS' => $item->nilai_uts ?? '-',
                    'Nilai UAS' => $item->nilai_uas ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Murid',
            'Kelas',
            'Tahun Ajaran',
            'Pelajaran',
            'Nilai Tugas',
            'Nilai UTS',
            'Nilai UAS',
        ];
    }
}