<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\OrangTua;
use App\Models\Murid;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Pelajaran;
use App\Models\JadwalPelajaran;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\KelasTahun;
use App\Models\MuridKelas;
use App\Models\MuridOrangTua;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function formUser()
    {
        $kelasList = KelasTahun::all();
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
            'foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048|image',
        ]);

        if($request->role == 'admin'){
            
            $avatarPath = null;
                if ($request->hasFile('avatar')) {
                    $avatarPath = $request->file('avatar')->store('avatar', 'public');
                }

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
                'foto' => $avatarPath,
            ]);
        }

        

        switch ($request->role) {
            case 'guru':
                $request->validate([
                    'gelar' => 'required|string',
                    'statusMenikah' => 'required',
                    'statusKerja' => 'required',
                    'nuptk' => 'required|string',
                    'foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048|image',
                ]);

                $avatarPath = null;
                if ($request->hasFile('avatar')) {
                    $avatarPath = $request->file('avatar')->store('avatar', 'public');
                }

                $profile = Profile::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    'foto' => $avatarPath,
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
                    'kelas_tahun_id' => 'required|integer|exists:kelas_tahun,kelas_tahun_id',
                    'ortu_name' => 'required|string',
                    'ortu_email' => 'required|email|unique:profiles,email',
                    'ortu_alamat' => 'required|string',
                    'ortu_tempat_lahir' => 'required|string',
                    'ortu_tanggal_lahir' => 'required|date',
                    'ortu_jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'ortu_pendidikan' => 'required|string',
                    'ortu_no_telp' => 'required|string',
                    'foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048|image',
                    'ortu_profesi' => 'required|string',
                    'ortu_password' => 'required|min:6|string',
                ]);

                $avatarPath = null;
                if ($request->hasFile('avatar')) {
                    $avatarPath = $request->file('avatar')->store('avatar', 'public');
                }

                $profile = Profile::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'tempat_lahir' => $request->tempat_lahir,
                    'pendidikan' => $request->pendidikan,
                    'no_telp' => $request->no_telp,
                    'foto' => $avatarPath,
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
                    'nis' => $request->nis,
                    'nisn' => $request->nisn,
                ]);

                // Tambahkan relasi many-to-many
                $murid->muridKelas()->attach($request->kelas_tahun_id);
                $murid->orangTua()->attach($orangTua->orang_tua_id);
                break;
        }

        return redirect()->route('admin.register')->with('success', 'User baru berhasil ditambahkan');
    }

    public function tampilkanManajemenKelas(){
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $kelastahuns = KelasTahun::all();
        return view('admin.ManajemenKelas', compact('admin', 'kelastahuns'));
    }

    public function tambahKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string',
            'tahun_ajar' => 'required|string',
            'semester' => 'required|string',
        ]);

        $status = 'Aktif';

        // Cek apakah tahun ajaran + semester sudah ada
        $tahunAjar = TahunAjar::where('tahun_ajaran', $request->tahun_ajar)
            ->where('semester', $request->semester)
            ->first();

        if (!$tahunAjar) {
            $tahunAjar = TahunAjar::create([
                'tahun_ajaran' => $request->tahun_ajar,
                'semester' => $request->semester,
                'status' => $status,
            ]);
        }

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas
        ]);

        // PERHATIKAN: pakai tahun_ajaran_id, sesuai primaryKey
        $kelas->tahun()->attach($tahunAjar->tahun_ajaran_id);

        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas baru berhasil dibuat');
    }

    public function tampilkanUpdateKelas($id){
        $kelastahun = KelasTahun::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.editKelas', compact('kelastahun', 'admin'));
    }

    public function updateKelas(Request $request, $id)
{
    $kelastahun = KelasTahun::findOrFail($id);

    $request->validate([
        'nama_kelas' => 'required|string',
        'tahun_ajaran' => 'required|string',
        'semester' => 'required|string',
        'status' => 'required|in:Aktif,Tidak Aktif',
    ]);

    // Cari TahunAjaran jika ada
    $tahunAjar = TahunAjar::where('tahun_ajaran', $request->tahun_ajaran)
        ->where('semester', $request->semester)
        ->first();

    if ($tahunAjar) {
        // Update status jika sudah ada
        $tahunAjar->status = $request->status;
        $tahunAjar->save();
    } else {
        // Jika belum ada, buat baru
        $tahunAjar = TahunAjar::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'status' => $request->status,
        ]);
    }

    // Update nama kelas
    $kelas = $kelastahun->kelas;
    $kelas->nama_kelas = $request->nama_kelas;
    $kelas->save();

    // Update relasi kelas_tahun
    $kelastahun->tahun_ajaran_id = $tahunAjar->tahun_ajaran_id;
    $kelastahun->save();

    return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas berhasil diperbarui');
}


    public function hapusKelas($id)
    {
        $kelastahun = KelasTahun::findOrFail($id);
        $kelas = $kelastahun->kelas->kelas_id;
        $kelas = Kelas::findOrFail($kelas);
        $kelas->delete();

        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas berhasil dihapus');
    }

    // Fungsi untuk menampilkan form kenaikan kelas
    public function tampilkanFormKenaikanKelas()
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        
        // Ambil semua kelas tahun untuk tahun ajaran aktif
        $kelasSekarang = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function($query) {
                $query->where('status', 'Aktif');
            })->get();

        // Ambil semua kelas untuk dropdown tujuan
        $semuaKelas = Kelas::all();

        return view('admin.kenaikanKelas', compact('kelasSekarang', 'semuaKelas', 'admin'));
    }

    // Fungsi untuk memproses kenaikan kelas
    public function prosesKenaikanKelas(Request $request)
{
    // Validasi input
    $request->validate([
        'kelas_asal' => 'required|exists:kelas_tahun,kelas_tahun_id',
        'kelas_tujuan' => 'required|exists:kelas,kelas_id',
        'tahun_ajaran' => 'required',
        'semester' => 'required|in:Ganjil,Genap'
    ]);

    // 1. Cari atau buat tahun ajaran baru
    $tahunAjarBaru = TahunAjar::updateOrCreate(
        [
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester
        ],
        [
            'status' => 'Aktif'
        ]
    );

    // 2. Cari atau buat kelas_tahun untuk kelas tujuan
    $kelasTahunBaru = KelasTahun::updateOrCreate([
        'kelas_id' => $request->kelas_tujuan,
        'tahun_ajaran_id' => $tahunAjarBaru->tahun_ajaran_id
    ]);

    // 3. Ambil semua murid dari kelas asal
    $muridKelas = MuridKelas::where('kelas_tahun_id', $request->kelas_asal)->get();

    // 4. Buat record baru untuk setiap murid di kelas baru
    foreach ($muridKelas as $mk) {
        MuridKelas::create([
            'murid_id' => $mk->murid_id,
            'kelas_tahun_id' => $kelasTahunBaru->kelas_tahun_id
        ]);
    }

    // 5. Set kelas_tahun asal menjadi Tidak Aktif
    $kelasAsal = KelasTahun::findOrFail($request->kelas_asal);
    $kelasAsal->tahunajar->status = 'Tidak Aktif';
    $kelasAsal->save();

    return redirect()->back()->with('success', 'Kenaikan kelas berhasil diproses');
}


    public function tampilkanJadwal(){
        $pelajaran = Pelajaran::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $kelasTahun = KelasTahun::all();
        $jadwals = JadwalPelajaran::orderBy('kelas_tahun_id', 'asc')
                                  ->orderBy('hari', 'desc')
                                  ->orderBy('waktu_mulai', 'asc')
                                  ->get();
        return view('admin.jadwal', compact('pelajaran', 'kelasTahun', 'jadwals', 'admin'));
    }

    public function tampilkanUpdateJadwal($id){
        $pelajaran = Pelajaran::all();
        $kelas = KelasTahun::all();
        $jadwal = JadwalPelajaran::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.editJadwal', compact('pelajaran', 'kelas', 'jadwal', 'admin'));
    }

    public function simpanJadwal(Request $request)
    {
        $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_tahun_id' => 'required|exists:kelas_tahun,kelas_tahun_id',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        // 1. Cek apakah jadwal sudah ada untuk kelas ini pada jam yang sama
        $bentrokKelas = JadwalPelajaran::where('kelas_tahun_id', $request->kelas_tahun_id)
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
            ->where('kelas_tahun_id', '!=', $request->kelas_tahun_id)
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
            'kelas_tahun_id' => 'required|exists:kelas_tahun,kelas_tahun_id',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        $jadwal = JadwalPelajaran::findOrFail($id);

        $bentrokKelas = JadwalPelajaran::where('jadwal_id', '!=', $id)
            ->where('kelas_tahun_id', $validated['kelas_tahun_id'])
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
            ->where('kelas_tahun_id', '!=', $validated['kelas_tahun_id'])
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
                $file = $request->file('lampiran');

                // Pastikan nama file unik
                $filename = time() . '_' . $file->getClientOriginalName();

                // Simpan manual ke folder public/storage/lampiran
                $file->move(public_path('storage/lampiran'), $filename);

                // Simpan path relatif ke database
                $lampiranPath = 'lampiran/' . $filename;
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
        $adminId = Admin::where('profile_id', auth()->id())->firstOrFail()->admin_id;

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
        $adminId = Admin::where('profile_id', auth()->id())->firstOrFail()->admin_id;

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
        $MuridOrangTuas = MuridOrangTua::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.ManajemenUser', compact('Gurus', 'Admins', 'MuridOrangTuas', 'admin'));
    }

    public function editUser($id, Request $request)
{
    $role = request('role');
    $admin = Admin::where('profile_id', auth()->id())->firstOrFail()->admin_id;

    $kelasList = [];
    if ($role === 'murid') {
        // Ambil data berdasarkan tabel pivot murid_kelas
        $muridKelas = MuridKelas::with(['murid.profile', 'kelastahun'])->findOrFail($id);
        $user = $muridKelas; // supaya tetap konsisten dengan view
        $kelasList = KelasTahun::whereHas('tahunAjar', function ($query) {
            $query->where('status', 'Aktif');
        })->get();


        return view('admin.ManajemenUserEdit', compact('user', 'role', 'admin', 'kelasList'))->with('id', $id);
    }

    // Untuk role lain, tetap pakai cara lama
    $model = $this->getModelByRole($role);
    $user = $model::with(['profile'])->findOrFail($id);

    return view('admin.ManajemenUserEdit', compact('user', 'role', 'kelasList', 'admin'))->with('id', $id);
}


    public function updateUser(Request $request, $id)
{
    $role = $request->input('role');
    $model = $this->getModelByRole($role);

    if ($role === 'murid') {
        $user = $model::with('murid.profile')->findOrFail($id);
        $profile = $user->murid->profile;

        // Update profile data
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->alamat = $request->alamat;
        $profile->jenis_kelamin = $request->jenis_kelamin;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->pendidikan = $request->pendidikan;
        $profile->foto = $request->file('foto') ? $request->file('foto')->store('avatar', 'public') : $profile->foto;
        $profile->no_telp = $request->no_telp;

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }

        $profile->save();

        // Update fields di murid
        $user->murid->nis = $request->nis;
        $user->murid->nisn = $request->nisn;
        $user->murid->asal_sekolah = $request->asal_sekolah;
        $user->murid->save();

        // Update kelas_tahun di murid_kelas (yaitu $user)
        $user->kelas_tahun_id = $request->kelas_tahun_id;
    } else {
        $user = $model::with('profile')->findOrFail($id);
        $profile = $user->profile;

        // Update profile data
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->alamat = $request->alamat;
        $profile->jenis_kelamin = $request->jenis_kelamin;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->pendidikan = $request->pendidikan;
        $profile->foto = $request->file('foto') ? $request->file('foto')->store('avatar', 'public') : $profile->foto;
        $profile->no_telp = $request->no_telp;

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }

        $profile->save();

        switch ($role) {
            case 'guru':
                $user->gelar = $request->gelar;
                $user->statusMenikah = $request->statusMenikah;
                $user->statusKerja = $request->statusKerja;
                $user->nuptk = $request->nuptk;
                break;

            case 'orang_tua':
                $user->profesi = $request->profesi;
                break;

            case 'admin':
                // tidak ada field tambahan
                break;
        }
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
            'murid' => MuridKelas::class,
            'orang_tua' => OrangTua::class,
            default => abort(404),
        };
    }
}