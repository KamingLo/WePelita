<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Postingan;
use App\Models\MuridKelas;
use App\Models\JadwalPelajaran;
use App\Models\Nilai;
use App\Exports\MuridJadwalExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    public function dashboard()
    {
        $murid = Auth::user()->murid;
        $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
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

        // Debug the user's roles
        // dd(Auth::user()->roles); // This will dump the roles and stop execution

        \Log::info('Dashboard Data', ['announcements' => $announcements->toArray()]);
        return view('murid.dashboard', compact('murid', 'announcements'));
    }

    public function jadwalKelas(Request $request)
    {
        $murid = Auth::user()->murid;
        $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
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

        return view('murid.JadwalKelas', compact('murid', 'jadwals'));
    }

    public function exportJadwal()
    {
        return Excel::download(new MuridJadwalExport(), 'jadwal-kelas.xlsx');
    }

    public function nilaiKelas()
    {
        $murid = Auth::user()->murid;
        $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->first();

        $nilais = collect();
        if ($muridKelas) {
            $nilais = Nilai::where('murid_kelas_id', $muridKelas->murid_kelas_id)
                ->with('pelajaran')
                ->get();
        }

        return view('murid.NilaiMurid', compact('murid', 'nilais'));
    }


    public function pengumuman()
    {
        $murid = Auth::user()->murid;
        $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
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

        return view('murid.Pengumuman', compact('murid', 'announcements'));
    }

    public function getAnnouncement($id)
    {
        $announcement = Postingan::with('profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')->findOrFail($id);
        return response()->json($announcement);
    }
}