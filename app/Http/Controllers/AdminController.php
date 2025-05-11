<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\OrangTua;
use App\Models\Murid;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\JadwalPelajaran;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function formUser()
    {
        $kelasList = Kelas::all();
        return view('admin.register', compact('kelasList'));
    }
    
    public function tambahkanUser(Request $request){
    // Validasi umum untuk profile utama
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles,email',
            'nik' => 'required|string',
            'no_telp' => 'required|string',
            'password' => 'required|min:6|string',
            'role' => 'required|in:guru,orang_tua,admin,murid',
        ]);

        // Buat profile utama
        $profile = Profile::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
        ]);

        // Sesuaikan role
        switch ($request->role) {
            case 'guru':
                Guru::create(['profile_id' => $profile->profile_id]);
                break;

            case 'admin':
                Admin::create(['profile_id' => $profile->profile_id]);
                break;

            case 'orang_tua':
                OrangTua::create(['profile_id' => $profile->profile_id]);
                break;

            case 'murid':
                // Validasi tambahan untuk murid dan orang tua-nya
                $request->validate([
                    'nis' => 'required|string',
                    'nisn' => 'required|string',
                    'kelas_id' => 'required|integer|exists:kelas,kelas_id',

                    // Data orang tua
                    'ortu_name' => 'required|string',
                    'ortu_email' => 'required|email|unique:profiles,email',
                    'ortu_nik' => 'required|string',
                    'ortu_no_telp' => 'required|string',
                    'ortu_password' => 'required|min:6|string',
                ]);

                // 1. Buat profil orang tua
                $ortuProfile = Profile::create([
                    'name' => $request->ortu_name,
                    'email' => $request->ortu_email,
                    'nik' => $request->ortu_nik,
                    'no_telp' => $request->ortu_no_telp,
                    'password' => Hash::make($request->ortu_password),
                ]);

                // 2. Simpan ke tabel orang_tua
                $orangTua = OrangTua::create([
                    'profile_id' => $ortuProfile->profile_id,
                ]);

                // 3. Simpan data murid
                Murid::create([
                    'profile_id' => $profile->profile_id,
                    'kelas_id' => $request->kelas_id,
                    'orang_tua_id' => $orangTua->orang_tua_id,
                    'nis' => $request->nis,
                    'nisn' => $request->nisn,
                ]);
                break;
        }

        return redirect()->route('admin.register')->with('success', 'User baru berhasil ditambahkan');
    }


    public function tampilkanJadwal(){
        $pelajaran = Pelajaran::all();
        $kelas = Kelas::all();
        $jadwals = JadwalPelajaran::all();
        return view('admin.jadwal', compact('pelajaran', 'kelas', 'jadwals'));
    }

    public function tampilkanUpdateJadwal($id){
        $pelajaran = Pelajaran::all();
        $kelas = Kelas::all();
        $jadwal = JadwalPelajaran::findOrFail($id);
        return view('admin.editJadwal', compact('pelajaran', 'kelas', 'jadwal'));
    }

    public function simpanJadwal(Request $request){
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


    public function updateJadwal(Request $request, $id){
        $validated = $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->update([
            'pelajaran_id' => $validated['pelajaran_id'],
            'kelas_id' => $validated['kelas_id'],
            'hari' => $validated['hari'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
        ]);


        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function hapusJadwal($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil dihapus');
    }

    public function tampilkanPelajaran()
    {
        // Mengambil data guru untuk dropdown
        $gurus = Guru::all();
        $pelajarans = Pelajaran::all();

        return view('admin.pelajaran', compact('gurus', 'pelajarans'));
    }

    // Menyimpan pelajaran baru
    public function simpanPelajaran(Request $request)
    {
        // Validasi input
        $request->validate([
            'guru_id' => 'required|exists:guru,guru_id',
            'namaPelajaran' => 'required|string|max:255',
        ]);

        // Menyimpan data pelajaran
        Pelajaran::create([
            'guru_id' => $validated['guru_id'],
            'namaPelajaran' => $validated['namaPelajaran'],
        ]);

        // Redirect ke halaman pelajaran dengan pesan sukses
        return redirect()->route('admin.pelajaran')->with('success', 'Pelajaran berhasil ditambahkan');
    }

    public function tampilkanUpdatePelajaran($id){
        $gurus = Guru::all();
        $pelajaran = Pelajaran::findOrFail($id);

        return view('admin.editPelajaran', compact('gurus', 'pelajaran'));
    }

    public function updatePelajaran(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,guru_id',
            'namaPelajaran' => 'required|string|max:255',
        ]);

        // Temukan pelajaran berdasarkan ID
        $pelajaran = Pelajaran::findOrFail($id);

        // Perbarui data pelajaran
        $pelajaran->update([
            'guru_id' => $validated['guru_id'],
            'namaPelajaran' => $validated['namaPelajaran'],
        ]);

        return redirect()->route('admin.pelajaran')->with('success', 'Pelajaran berhasil diperbarui');
    }

    public function hapusPelajaran($id){
        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->delete();

        return redirect()->route('admin.pelajaran')->with('success', 'Pelajaran berhasil dihapus');
    }

    public function tampilkanPost()
    {
        $pengumumans = Pengumuman::all();
        $kegiatans = Kegiatan::all();
        return view('admin.post', compact('pengumumans', 'kegiatans'));
    }

    public function tambahPostingan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tipe' => 'required|in:pengumuman,kegiatan',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048|image',
        ]);

        // Simpan lampiran jika ada
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $validated['lampiran']->store('lampiran', 'public');
        }

        // Simulasi ambil ID admin yang sedang login (ganti dengan auth jika ada)
        $adminId = auth()->id();
        
        // Masukkan data ke tabel sesuai tipe
        if ($validated['tipe'] === 'pengumuman') {
            Pengumuman::create([
                'admin_id' => $adminId,
                'judul_pengumuman' => $validated['judul'],
                'isi_pengumuman' => $validated['isi'],
                'lampiran' => $lampiranPath,
                'created_at' => now(),
            ]);
        } else {
            Kegiatan::create([
                'admin_id' => $adminId,
                'judul_kegiatan' => $validated['judul'],
                'isi_kegiatan' => $validated['isi'],
                'lampiran' => $lampiranPath,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('admin.post')->with('success', 'Postingan berhasil dibuat!');
    }

    public function tampilkanManajemenPost()
    {
        $pengumumans = Pengumuman::all();
        $kegiatans = Kegiatan::all();
        return view('admin.manajemenPost', compact('pengumumans', 'kegiatans'));
    }

    public function tampilkanPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.editPost', compact('pengumuman'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048|image',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);

        // Simulasi ambil ID admin yang sedang login (gunakan auth jika tersedia)
        $adminId = auth()->id();

        // Jika user upload file baru
        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($pengumuman->lampiran) {
                Storage::disk('public')->delete($pengumuman->lampiran);
            }

            // Simpan lampiran baru
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            $pengumuman->lampiran = $lampiranPath;
        }

        // Update data lainnya
        $pengumuman->update([
            'judul_pengumuman' => $validated['judul'],
            'isi_pengumuman' => $validated['isi'],
            'admin_id' => $adminId,
        ]);

        return redirect()->route('admin.manajemenPost')->with('success', 'Perubahan berhasil disimpan!');
    }


    public function hapusPengumuman($id){
        $pengumuman = Pengumuman::findOrFail($id);
        if ($pengumuman->lampiran) {
            Storage::disk('public')->delete($pengumuman->lampiran);
        }
        $pengumuman->delete();

        return redirect()->route('admin.manajemenPost')->with('success', 'Pengumuman berhasil dihapus');
    }

    public function tampilkanManajemenUser(){
        $Murids = Murid::all();
        $Gurus = Guru::all();
        $Admins = Admin::all();
        $OrangTuas = OrangTua::all();
        
        return view('admin.manajemenUser', compact('Murids', 'Gurus', 'Admins', 'OrangTuas'));
    }
}