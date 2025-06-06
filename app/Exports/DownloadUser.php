<?php

namespace App\Exports;

use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\Murid;
use App\Models\OrangTua;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class DownloadUser implements FromCollection, WithHeadings
{
    protected $role;

    /**
     * Constructor menerima role sebagai filter export
     */
    public function __construct(string $role)
    {
        $this->role = strtolower($role);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        switch ($this->role) {
            case 'admin':
                return Admin::with('profile')->get()->map(function ($admin) {
                    return [
                        'id' => $admin->admin_id,
                        'name' => $admin->profile->name,
                        'email' => $admin->profile->email,
                        'alamat' => $admin->profile->alamat,
                        'jenis_kelamin' => $admin->profile->jenis_kelamin,
                        'tanggal_lahir' => $admin->profile->tanggal_lahir,
                        'no_telp' => $admin->profile->no_telp,
                    ];
                });

            case 'guru':
                return Guru::with('profile')->get()->map(function ($guru) {
                    return [
                        'id' => $guru->guru_id,
                        'name' => $guru->profile->name,
                        'email' => $guru->profile->email,
                        'alamat' => $guru->profile->alamat,
                        'jenis_kelamin' => $guru->profile->jenis_kelamin,
                        'tanggal_lahir' => $guru->profile->tanggal_lahir,
                        'no_telp' => $guru->profile->no_telp,
                        'gelar' => $guru->gelar,
                        'status_menikah' => $guru->statusMenikah,
                        'status_kerja' => $guru->statusKerja,
                        'nuptk' => $guru->nuptk,
                    ];
                });

            case 'murid':
    return Murid::with(['profile', 'muridKelas.kelasTahun.tahunAjaran'])
        ->whereHas('muridKelas.kelasTahun.tahunAjaran', function ($query) {
            $query->where('status', 'aktif');
        })
        ->get()
        ->map(function ($murid) {
            return [
                'id' => $murid->murid_id,
                'name' => $murid->profile->name,
                'email' => $murid->profile->email,
                'alamat' => $murid->profile->alamat,
                'jenis_kelamin' => $murid->profile->jenis_kelamin,
                'tanggal_lahir' => $murid->profile->tanggal_lahir,
                'no_telp' => $murid->profile->no_telp,
                'asal_sekolah' => $murid->asal_sekolah,
                'nis' => $murid->nis,
                'nisn' => $murid->nisn,
            ];
        });


            case 'orang_tua':
    return OrangTua::with(['profile', 'muridOrangTua.muridKelas.kelasTahun.tahunAjaran'])
        ->whereHas('muridOrangTua.muridKelas.kelasTahun.tahunAjaran', function ($query) {
            $query->where('status', 'aktif');
        })
        ->get()
        ->map(function ($ortu) {
            return [
                'id' => $ortu->orang_tua_id,
                'name' => $ortu->profile->name,
                'email' => $ortu->profile->email,
                'alamat' => $ortu->profile->alamat,
                'jenis_kelamin' => $ortu->profile->jenis_kelamin,
                'tanggal_lahir' => $ortu->profile->tanggal_lahir,
                'no_telp' => $ortu->profile->no_telp,
                'profesi' => $ortu->profesi,
            ];
        });


            default:
                return collect([]);
        }
    }

    /**
     * Heading kolom untuk masing-masing role
     */
    public function headings(): array
    {
        switch ($this->role) {
            case 'admin':
                return ['ID', 'Nama', 'Email', 'Alamat', 'Jenis Kelamin', 'Tanggal Lahir', 'No. Telepon'];

            case 'guru':
                return ['ID', 'Nama', 'Email', 'Alamat', 'Jenis Kelamin', 'Tanggal Lahir', 'No. Telepon', 'Gelar', 'Status Menikah', 'Status Kerja', 'NUPTK'];

            case 'murid':
                return ['ID', 'Nama', 'Email', 'Alamat', 'Jenis Kelamin', 'Tanggal Lahir', 'No. Telepon', 'Asal Sekolah', 'NIS', 'NISN'];

            case 'orang_tua':
                return ['ID', 'Nama', 'Email', 'Alamat', 'Jenis Kelamin', 'Tanggal Lahir', 'No. Telepon', 'Profesi'];

            default:
                return [];
        }
    }
}
