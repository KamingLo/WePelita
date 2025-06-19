<?php

namespace App\Exports;

use App\Models\JadwalPelajaran;
use App\Models\MuridKelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class JadwalKelasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $murid = Auth::user()->murid;
        $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->first();

        $jadwals = collect();
        if ($muridKelas) {
            $jadwals = JadwalPelajaran::with(['pelajaran.guru.profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar'])
                ->where('kelas_tahun_id', $muridKelas->kelas_tahun_id)
                ->orderBy('hari', 'asc')
                ->orderBy('waktu_mulai', 'asc')
                ->get()
                ->map(function ($item) {
                    return [
                        'Hari' => $item->hari,
                        'Nama Guru' => $item->pelajaran->guru->profile->name,
                        'Waktu Mulai' => $item->waktu_mulai,
                        'Waktu Selesai' => $item->waktu_selesai,
                        'Pelajaran' => $item->pelajaran->namaPelajaran,
                        'Kelas Tahun' => $item->kelasTahun->kelas->nama_kelas ?? '-',
                        'Tahun Ajaran' => $item->kelasTahun->tahunajar->tahun_ajaran ?? '-',
                    ];
                });
        }

        return $jadwals;
    }

    public function headings(): array
    {
        return [
            'Hari',
            'Nama Guru',
            'Waktu Mulai',
            'Waktu Selesai',
            'Pelajaran',
            'Kelas Tahun',
            'Tahun Ajaran',
        ];
    }
}