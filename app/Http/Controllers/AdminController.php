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
use App\Models\MuridOrangTua;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function formUser()
    {
        $kelasList = Kelas::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.register', compact('kelasList', 'admin'));
    }
    
    public function tambahkanUser(Request $request)
    {
        // Validasi umum untuk profile utama
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles,email',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'pendidikan' => 'required|string',
            'no_telp' => 'required|string',
            'password' => 'required|min:8|string',
            'role' => 'required|in:guru,admin,murid',
        ]);

        if($request->role == 'admin'){
            $profile = Profile::create([
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'pendidikan' => $request->pendidikan,
                'no_telp' => $request->no_telp,
                'password' => Hash::make($request->password),
            ]);
        }

        switch ($request->role) {
            case 'guru':
                $request->validate([
                    'gelar' => 'required|string',
                    'statusMenikah' => 'required',
                    'statusKerja' => 'required',
                    'nuptk' => 'required|string',
                ]);

                $profile = Profile::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'tempat_lahir' => $request->tempat_lahir,
                    'pendidikan' => $request->pendidikan,
                    'no_telp' => $request->no_telp,
                    'password' => Hash::make($request->password),
                ]);

                Guru::create([
                    'profile_id' => $profile->profile_id,
                    'gelar' => $request->gelar,
                    'statusMenikah' => $request->statusMenikah,
                    'statusKerja' => $request->statusKerja,
                    'nuptk' => $request->nuptk,
                ]);

                break;

            case 'admin':
                Admin::create(['profile_id' => $profile->profile_id]);
                break;

            case 'murid':
                // Validasi tambahan untuk murid dan orang tua
                $request->validate([
                    'asal_sekolah' => 'required|string',
                    'nis' => 'required|string',
                    'nisn' => 'required|string',
                    'kelas_id' => 'required|integer|exists:kelas,kelas_id',
                    'ortu_name' => 'required|string',
                    'ortu_email' => 'required|email|unique:profiles,email',
                    'ortu_alamat' => 'required|string',
                    'ortu_tempat_lahir' => 'required|string',
                    'ortu_tanggal_lahir' => 'required|date',
                    'ortu_jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'ortu_pendidikan' => 'required|string',
                    'ortu_no_telp' => 'required|string',
                    'ortu_profesi' => 'required|string',
                    'ortu_password' => 'required|min:6|string',
                ]);

                $profile = Profile::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'tempat_lahir' => $request->tempat_lahir,
                    'pendidikan' => $request->pendidikan,
                    'no_telp' => $request->no_telp,
                    'password' => Hash::make($request->password),
                ]);

                // Buat profil orang tua
                $ortuProfile = Profile::create([
                    'name' => $request->ortu_name,
                    'email' => $request->ortu_email,
                    'alamat' => $request->ortu_alamat,
                    'tempat_lahir' => $request->ortu_tempat_lahir,
                    'jenis_kelamin' => $request->ortu_jenis_kelamin,
                    'tanggal_lahir' => $request->ortu_tanggal_lahir,
                    'pendidikan' => $request->ortu_pendidikan,
                    'no_telp' => $request->ortu_no_telp,
                    'password' => Hash::make($request->ortu_password),
                ]);
                
                // Simpan ke tabel orang_tua
                $orangTua = OrangTua::create([
                    'profesi' => $request->ortu_profesi,
                    'profile_id' => $ortuProfile->profile_id,
                ]);

                // Simpan data murid
                $murid = Murid::create([
                    'profile_id' => $profile->profile_id,
                    'asal_sekolah' => $request->asal_sekolah,
                    'kelas_id' => $request->kelas_id,
                    'nis' => $request->nis,
                    'nisn' => $request->nisn,
                ]);

                // Tambahkan relasi many-to-many
                $murid->orangTua()->attach($orangTua->orang_tua_id);

                break;
        }

        return redirect()->route('admin.register')->with('success', 'User baru berhasil ditambahkan');
    }

    public function tampilkanJadwal(){
        $pelajaran = Pelajaran::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $kelas = Kelas::all();
        $jadwals = JadwalPelajaran::orderBy('kelas_id', 'asc')
                                  ->orderBy('hari', 'desc')
                                  ->orderBy('waktu_mulai', 'asc')
                                  ->get();
        return view('admin.jadwal', compact('pelajaran', 'kelas', 'jadwals', 'admin'));
    }

    public function tampilkanUpdateJadwal($id){
        $pelajaran = Pelajaran::all();
        $kelas = Kelas::all();
        $jadwal = JadwalPelajaran::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.editJadwal', compact('pelajaran', 'kelas', 'jadwal', 'admin'));
    }

    public function simpanJadwal(Request $request)
    {
        $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        // 1. Cek apakah jadwal sudah ada untuk kelas ini pada jam yang sama
        $bentrokKelas = JadwalPelajaran::where('kelas_id', $request->kelas_id)
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

        if ($bentrokKelas) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jadwal' => 'Sudah ada jadwal lain untuk kelas ini pada waktu tersebut.']);
        }

        // 2. Cek apakah pelajaran ini sedang diajarkan di kelas lain pada waktu yang sama
        $bentrokPelajaran = JadwalPelajaran::where('pelajaran_id', $request->pelajaran_id)
            ->where('kelas_id', '!=', $request->kelas_id)
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

        if ($bentrokPelajaran) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jadwal' => 'Pelajaran ini sudah dijadwalkan di kelas lain pada waktu tersebut.']);
        }

        // Simpan jadwal jika tidak ada bentrok
        JadwalPelajaran::create($request->all());

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil ditambahkan');
    }



    public function updateJadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        $jadwal = JadwalPelajaran::findOrFail($id);

        $bentrokKelas = JadwalPelajaran::where('jadwal_id', '!=', $id)
            ->where('kelas_id', $validated['kelas_id'])
            ->where('hari', $validated['hari'])
            ->whereRaw('? < waktu_selesai AND ? > waktu_mulai', [
                $validated['waktu_mulai'],
                $validated['waktu_selesai'],
            ])
            ->exists();

        if ($bentrokKelas) {
            return back()->withInput()->withErrors([
                'jadwal' => 'Sudah ada jadwal lain untuk kelas ini pada waktu tersebut.',
            ]);
        }


        $bentrokPelajaran = JadwalPelajaran::where('jadwal_id', '!=', $id)
            ->where('pelajaran_id', $validated['pelajaran_id'])
            ->where('kelas_id', '!=', $validated['kelas_id'])
            ->where('hari', $validated['hari'])
            ->whereRaw('? < waktu_selesai AND ? > waktu_mulai', [
                $validated['waktu_mulai'],
                $validated['waktu_selesai'],
            ])
            ->exists();

        if ($bentrokPelajaran) {
            return back()->withInput()->withErrors([
                'jadwal' => 'Pelajaran ini sudah dijadwalkan di kelas lain pada waktu tersebut.',
            ]);
        }

        $jadwal->update($validated);

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
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.pelajaran', compact('gurus', 'pelajarans', 'admin'));
    }

    // Menyimpan pelajaran baru
    public function simpanPelajaran(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
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
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $gurus = Guru::all();
        $pelajaran = Pelajaran::findOrFail($id);

        return view('admin.editPelajaran', compact('gurus', 'pelajaran', 'admin'));
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
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.post', compact('pengumumans', 'kegiatans', 'admin'));
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

        $adminId = Admin::where('profile_id', auth()->id())->firstOrFail()->admin_id;

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
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.manajemenPost', compact('pengumumans', 'kegiatans', 'admin'));
    }

    public function tampilkanPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.ManajemenPostPengumumanEdit', compact('pengumuman', 'admin'));
    }

    public function tampilkanKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.ManajemenPostKegiatanEdit', compact('kegiatan', 'admin'));
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
        $adminId = Admin::where('profile_id', auth()->id())->firstOrFail();

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

        return redirect()->route('admin.manajemenPost')->with('success', 'Pengumuman berhasil disimpan!');
    }
    
    public function updateKegiatan(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048|image',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        // Simulasi ambil ID admin yang sedang login (gunakan auth jika tersedia)
        $adminId = Admin::where('profile_id', auth()->id())->firstOrFail();

        // Jika user upload file baru
        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($kegiatan->lampiran) {
                Storage::disk('public')->delete($kegiatan->lampiran);
            }

            // Simpan lampiran baru
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            $kegiatan->lampiran = $lampiranPath;
        }

        // Update data lainnya
        $kegiatan->update([
            'admin_id' => $adminId,
            'judul_kegiatan' => $validated['judul'],
            'isi_kegiatan' => $validated['isi'],
        ]);

        return redirect()->route('admin.manajemenPost')->with('success', 'kegiatan berhasil disimpan!');
    }


    public function hapusPengumuman($id){
        $pengumuman = Pengumuman::findOrFail($id);
        if ($pengumuman->lampiran) {
            Storage::disk('public')->delete($pengumuman->lampiran);
        }
        $pengumuman->delete();

        return redirect()->route('admin.manajemenPost')->with('success', 'Pengumuman berhasil dihapus');
    }

    public function hapusKegiatan($id){
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->lampiran) {
            Storage::disk('public')->delete($kegiatan->lampiran);
        }
        $kegiatan->delete();

        return redirect()->route('admin.manajemenPost')->with('success', 'Kegiatan berhasil dihapus');
    }

    public function tampilkanManajemenUser(){
        
        $Gurus = Guru::all();
        $Admins = Admin::all();
        $MuridOrangTuas = MuridOrangTua::with([
            'murid.profile',
            'murid.kelas',
            // 'orang_tua.profile'
        ])->get();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();

        return view('admin.ManajemenUser', compact('Gurus', 'Admins', 'MuridOrangTuas', 'admin'));
    }

    public function editUser($id, Request $request)
    {
        $role = request('role');
        $model = $this->getModelByRole($role);
        $user = $model::with(['profile'])->findOrFail($id);
        $admin = Admin::findOrFail(auth()->id());

        $kelasList = [];
        if ($role === 'murid') {
            $kelasList = Kelas::all();
        }

    return view('admin.ManajemenUserEdit', compact('user', 'role', 'kelasList', 'admin'))->with('id', $id);
    }

    public function updateUser(Request $request, $id)
    {
        $role = $request->input('role');
        $model = $this->getModelByRole($role);
        $user = $model::with('profile')->findOrFail($id);

        // Update data profil umum
        $user->profile->name = $request->name;
        $user->profile->email = $request->email;
        $user->profile->alamat = $request->alamat;
        $user->profile->jenis_kelamin = $request->jenis_kelamin;
        $user->profile->tanggal_lahir = $request->tanggal_lahir;
        $user->profile->tempat_lahir = $request->tempat_lahir;
        $user->profile->pendidikan = $request->pendidikan;
        $user->profile->no_telp = $request->no_telp;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->profile->password = Hash::make($request->password);
        }

        $user->profile->save();

        // Update data berdasarkan peran
        switch ($role) {
            case 'murid':
                $user->nis = $request->nis;
                $user->nisn = $request->nisn;
                $user->asal_sekolah = $request->asal_sekolah;
                $user->kelas_id = $request->kelas_id;
                break;

            case 'guru':
                $user->gelar = $request->gelar;
                $user->statusMenikah = $request->statusMenikah;
                $user->statusKerja = $request->statusKerja;
                $user->nuptk = $request->nuptk;
                break;

            case 'orang_tua':
                $user->profesi = $request->profesi;
                break;

            // Admin hanya update profile, tidak ada field tambahan
            case 'admin':
                // Tidak ada field tambahan di tabel admin
                break;

            default:
                return redirect()->back()->with('error', 'Peran tidak dikenali.');
        }

        $user->save();

        return redirect()->route('admin.ManajemenUser', ['role' => $role])->with('success', 'User berhasil diperbarui.');
    }


    public function destroyUser($id, Request $request)
    {
        $role = $request->query('role');
        $model = $this->getModelByRole($role);
        $user = $model::findOrFail($id);
        $user->profile()->delete();
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    private function getModelByRole($role)
    {
        return match ($role) {
            'admin' => Admin::class,
            'guru' => Guru::class,
            'murid' => Murid::class,
            'orang_tua' => OrangTua::class,
            default => abort(404),
        };
    }
}