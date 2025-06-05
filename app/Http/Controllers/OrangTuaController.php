<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\MuridKelas;
use App\Models\Postingan;
use App\Models\JadwalPelajaran;
use App\Models\Nilai;
use App\Exports\MuridJadwalExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrangTuaController extends Controller
{
    public function dashboard()
    {
        $orangtua = Auth::user()->orangtua;
        $muridKelas = MuridKelas::whereHas('muridOrangTua', function ($query) use ($orangtua) {
                $query->where('orang_tua_id', $orangtua->orang_tua_id);
            })
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->with('murid.profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')
            ->first();

        $announcements = collect();
        if ($muridKelas) {
            $announcements = Postingan::where('tipe', 'pengumuman')
                ->where(function ($query) use ($muridKelas) {
                    $query->where('kelas_tahun_id', $muridKelas->kelas_tahun_id)
                          ->orWhereNull('kelas_tahun_id');
                })
                ->with('profile')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('orangtua.dashboard', compact('orangtua', 'muridKelas', 'announcements'));
    }

    public function jadwalKelas(Request $request)
    {
        $orangtua = Auth::user()->orangtua;
        $muridKelas = MuridKelas::whereHas('muridOrangTua', function ($query) use ($orangtua) {
                $query->where('orang_tua_id', $orangtua->orang_tua_id);
            })
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->with('murid.profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')
            ->first();

        $jadwals = collect();
        if ($muridKelas) {
            $query = JadwalPelajaran::where('kelas_tahun_id', $muridKelas->kelas_tahun_id)
                ->with(['pelajaran.guru.profile'])
                ->orderBy('hari', 'asc')
                ->orderBy('waktu_mulai', 'asc');

            if ($request->has('hari') && !empty($request->input('hari'))) {
                $query->whereIn('hari', $request->input('hari'));
            }

            $jadwals = $query->get();
        }

        return view('orangtua.JadwalKelas', compact('orangtua', 'muridKelas', 'jadwals'));
    }

    public function exportJadwal()
    {
        return Excel::download(new MuridJadwalExport(), 'jadwal-kelas.xlsx');
    }

    public function nilaiKelas()
    {
        $orangtua = Auth::user()->orangtua;
        $muridKelas = MuridKelas::whereHas('muridOrangTua', function ($query) use ($orangtua) {
                $query->where('orang_tua_id', $orangtua->orang_tua_id);
            })
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->with('murid.profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')
            ->first();

        $nilais = collect();
        if ($muridKelas) {
            $nilais = Nilai::where('murid_kelas_id', $muridKelas->murid_kelas_id)
                ->with('pelajaran')
                ->get();
        }

        return view('orangtua.NilaiMurid', compact('orangtua', 'muridKelas', 'nilais'));
    }

    public function pengumuman()
    {
        $orangtua = Auth::user()->orangtua;
        $muridKelas = MuridKelas::whereHas('muridOrangTua', function ($query) use ($orangtua) {
                $query->where('orang_tua_id', $orangtua->orang_tua_id);
            })
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->with('murid.profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')
            ->first();

        $announcements = collect();
        if ($muridKelas) {
            $announcements = Postingan::where('tipe', 'pengumuman')
                ->where(function ($query) use ($muridKelas) {
                    $query->where('kelas_tahun_id', $muridKelas->kelas_tahun_id)
                          ->orWhereNull('kelas_tahun_id');
                })
                ->with('profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('orangtua.Pengumuman', compact('orangtua', 'muridKelas', 'announcements'));
    }

    public function getAnnouncement($id)
    {
        $announcement = Postingan::with('profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')->findOrFail($id);
        return response()->json($announcement);
    }
}