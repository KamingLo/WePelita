<?php

namespace App\Exports;

use App\Models\JadwalPelajaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalPelajaranExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return JadwalPelajaran::with(['pelajaran', 'kelastahun.tahunajar'])
            ->whereHas('kelastahun.tahunajar', function($query) {
                $query->where('status', 'Aktif');
            })
            ->get()
            ->map(function($item) {
                return [
                    'Hari' => $item->hari,
                    'Nama Guru' => $item->pelajaran->guru->profile->name,
                    'Waktu Mulai' => $item->waktu_mulai,
                    'Waktu Selesai' => $item->waktu_selesai,
                    'Pelajaran' => $item->pelajaran->namaPelajaran,
                    'Kelas Tahun' => $item->kelastahun->kelas->nama_kelas ?? '-', // ganti jika nama field beda
                    'Tahun Ajaran' => $item->kelastahun->tahunajar->tahun_ajaran ?? '-', // sesuaikan field-nya
                ];
            });
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
