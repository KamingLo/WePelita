<?php
namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    // Menampilkan form untuk membuat pelajaran baru
    public function create()
    {
        // Mengambil data guru untuk dropdown
        $gurus = Guru::all();

        return view('admin.pelajaran', compact('gurus'));
    }

    // Menyimpan pelajaran baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'guru_id' => 'required|exists:guru,guru_id',
            'namaPelajaran' => 'required|string|max:255',
        ]);

        // Menyimpan data pelajaran
        Pelajaran::create([
            'guru_id' => $request->guru_id,
            'namaPelajaran' => $request->namaPelajaran,
        ]);

        // Redirect ke halaman pelajaran dengan pesan sukses
        return redirect()->route('pelajaran.create')->with('success', 'Pelajaran berhasil ditambahkan');
    }
}
