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
        $orangtua = Auth::user()->orangtua;
        $muridKelas = MuridKelas::whereHas('muridOrangTua', function ($query) use ($orangtua) {
                $query->where('orang_tua_id', $orangtua->orang_tua_id);
            })
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->first();

        $jadwals = collect();
        if ($muridKelas) {
            $jadwals = JadwalPelajaran::where('kelas_tahun_id', $muridKelas->kelas_tahun_id)
                ->with(['pelajaran', 'guru.profile'])
                ->orderBy('hari', 'asc')
                ->orderBy('waktu_mulai', 'asc')
                ->get()
                ->map(function ($jadwal) {
                    return [
                        'hari' => $jadwal->hari,
                        'pelajaran' => $jadwal->pelajaran->nama_pelajaran ?? '-',
                        'guru' => $jadwal->guru->profile->name ?? '-',
                        'waktu_mulai' => $jadwal->waktu_mulai,
                        'waktu_selesai' => $jadwal->waktu_selesai,
                    ];
                });
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