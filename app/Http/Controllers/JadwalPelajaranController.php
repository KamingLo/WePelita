<?php
namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Pelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::all();
        $kelas = Kelas::all();
        $jadwals = JadwalPelajaran::all();
        return view('admin.jadwal', compact('pelajaran', 'kelas', 'jadwals'));
    }

    public function store(Request $request)
{
    $request->validate([
        'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
        'kelas_id' => 'required|exists:kelas,kelas_id',
        'hari' => 'required',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
    ]);

    // Cek apakah ada jadwal bentrok
    $bentrok = JadwalPelajaran::where('kelas_id', $request->kelas_id)
        ->where('hari', $request->hari)
        ->where(function ($query) use ($request) {
            $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                  ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                        ->where('waktu_selesai', '>=', $request->waktu_selesai);
                  });
        })
        ->exists();

    if ($bentrok) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['jadwal' => 'Sudah ada jadwal lain pada waktu tersebut.']);
    }

    JadwalPelajaran::create($request->all());

    return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil ditambahkan');
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil dihapus');
    }
}
