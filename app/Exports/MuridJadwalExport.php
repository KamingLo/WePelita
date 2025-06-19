<?php

namespace App\Exports;

use App\Models\JadwalPelajaran;
use App\Models\MuridKelas;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MuridJadwalExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $murid = Auth::user()->murid;
        $jadwals = collect();

        if ($murid) {
            $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
                ->whereHas('kelasTahun.tahunajar', function ($query) {
                    $query->where('status', 'Aktif');
                })
                ->first();

            if ($muridKelas) {
                $jadwals = JadwalPelajaran::where('kelas_tahun_id', $muridKelas->kelas_tahun_id)
                    ->with(['pelajaran.guru.profile'])
                    ->orderBy('hari', 'asc')
                    ->orderBy('waktu_mulai', 'asc')
                    ->get()
                    ->map(function ($jadwal) {
                        return [
                            'hari' => $jadwal->hari,
                            'pelajaran' => $jadwal->pelajaran->namaPelajaran ?? '-',
                            'guru' => $jadwal->pelajaran->guru->profile->name ?? '-',
                            'waktu_mulai' => $jadwal->waktu_mulai,
                            'waktu_selesai' => $jadwal->waktu_selesai,
                        ];
                    });
            }
        }

        return $jadwals;
    }

    public function headings(): array
    {
        return [
            'Hari',
            'Mata Pelajaran',
            'Guru',
            'Waktu Mulai',
            'Waktu Selesai',
        ];
    }
}