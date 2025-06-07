<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DownloadUser;
use App\Exports\AdminExcelNilai;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\OrangTua;
use App\Models\Murid;
use App\Models\Kelas;
use App\Models\TahunAjar;
use App\Models\Pelajaran;
use App\Models\JadwalPelajaran;
use App\Models\Postingan;
use App\Models\Kegiatan;
use App\Models\KelasTahun;
use App\Models\MuridKelas;
use App\Models\MuridOrangTua;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\BrevoMailer;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'pendidikan' => 'required|string',
            'no_telp' => 'required|string',
            'password' => 'required|min:8|string',
            'role' => 'required|in:guru,admin,murid',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('foto')) {
            $avatarPath = $request->file('foto')->store('avatar', 'public');
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

        switch ($request->role) {
            case 'guru':
                $request->validate([
                    'gelar' => 'required|string',
                    'statusMenikah' => 'required|string',
                    'statusKerja' => 'required|string',
                    'nuptk' => 'required|string',
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
                    'ortu_profesi' => 'required|string',
                    'ortu_password' => 'required|min:6|string',
                ]);

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
                
                $orangTua = OrangTua::create([
                    'profesi' => $request->ortu_profesi,
                    'profile_id' => $ortuProfile->profile_id,
                ]);

                $murid = Murid::create([
                    'profile_id' => $profile->profile_id,
                    'asal_sekolah' => $request->asal_sekolah,
                    'nis' => $request->nis,
                    'nisn' => $request->nisn,
                ]);

                $murid->muridKelas()->attach($request->kelas_tahun_id);
                $murid->orangTua()->attach($orangTua->orang_tua_id);
                break;
        }

        return redirect()->route('admin.ManajemenUser')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function tampilkanManajemenKelas()
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $kelastahuns = KelasTahun::all();
    
        $kelasSekarang = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function($query) {
                $query->where('status', 'Aktif');
            })->get();
    
        $semuaKelas = Kelas::all();
    
        return view('admin.ManajemenKelas', compact('admin', 'kelastahuns', 'kelasSekarang', 'semuaKelas'));
    }

    public function tambahKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tahun_ajar' => 'required|string',
            'semester' => 'required|string',
        ]);
    
        $tahunAjar = TahunAjar::firstOrCreate(
            [
                'tahun_ajaran' => $request->tahun_ajar,
                'semester' => $request->semester,
            ],
            [
                'status' => 'Aktif',
            ]
        );
    
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas
        ]);
    
        $kelas->tahun()->attach($tahunAjar->tahun_ajaran_id);
    
        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas baru berhasil dibuat.');
    }

    public function tampilkanUpdateKelas($id)
    {
        $kelastahun = KelasTahun::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.ManajemenKelasEdit', compact('kelastahun', 'admin'));
    }

    public function updateKelas(Request $request, $id)
    {
        $kelastahun = KelasTahun::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string',
            'semester' => 'required|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $tahunAjar = TahunAjar::firstOrCreate(
            [
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester' => $request->semester,
            ],
            [
                'status' => $request->status,
            ]
        );

        if ($tahunAjar->wasRecentlyCreated) {
            $tahunAjar->status = $request->status;
            $tahunAjar->save();
        } else {
            $tahunAjar->update(['status' => $request->status]);
        }

        $kelas = $kelastahun->kelas;
        $kelas->update(['nama_kelas' => $request->nama_kelas]);

        $kelastahun->update(['tahun_ajaran_id' => $tahunAjar->tahun_ajaran_id]);

        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function hapusKelas($id)
    {
        $kelastahun = KelasTahun::findOrFail($id);
        $kelastahun->delete();

        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas berhasil dihapus.');
    }

    public function tampilkanFormKenaikanKelas()
    {
        // Ambil admin berdasarkan profile_id yang login
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();

        $kelasSekarang = KelasTahun::with(['kelas', 'tahunajar'])
        ->whereHas('tahunajar', function($query) {
            $query->where('status', 'Aktif');
        })
        ->join('kelas', 'kelas_tahun.kelas_id', '=', 'kelas.kelas_id')
        ->orderBy('kelas.nama_kelas')
        ->select('kelas_tahun.*')
        ->get();

        // Ambil semua kelas yang tersedia
        $semuaKelas = Kelas::orderBy('nama_kelas')->get();

        // Kirim data ke view
        return view('admin.kenaikanKelas', compact('kelasSekarang', 'semuaKelas', 'admin'));
    }


public function prosesKenaikanKelas(Request $request)
{
    $validated = $request->validate([
        'kelas_asal' => 'required|exists:kelas_tahun,kelas_tahun_id',
        'kelas_tujuan' => 'required|exists:kelas,kelas_id',
        'tahun_ajaran' => 'required|string',
        'semester' => 'required|in:Ganjil,Genap',
    ]);

    // Ambil data kelas asal dengan relasi tahunajar
    $kelasAsal = KelasTahun::with('tahunajar')->findOrFail($request->kelas_asal);

    $kelasTujuanId = $request->kelas_tujuan;
    $tahunAjarTujuan = $request->tahun_ajaran;
    $semesterTujuan = $request->semester;

    // Cek apakah kelas asal dan tujuan + tahun ajar dan semester sama
    if (
        $kelasAsal->kelas_id == $kelasTujuanId &&
        $kelasAsal->tahunajar->tahun_ajaran == $tahunAjarTujuan &&
        $kelasAsal->tahunajar->semester == $semesterTujuan
    ) {
        return redirect()->to('/admin/manajemenKelas?tab=kenaikan')
            ->with('error', 'Kenaikan kelas gagal: Kelas asal dan kelas tujuan dengan tahun ajar dan semester yang sama tidak diperbolehkan.');
    }

    // Update status tahun ajar asal menjadi Tidak Aktif (sesuaikan kebutuhan)
    $kelasAsal->tahunajar->update(['status' => 'Tidak Aktif']);

    // Cari atau buat tahun ajar baru
    $tahunAjarBaru = TahunAjar::firstOrCreate(
        [
            'tahun_ajaran' => $tahunAjarTujuan,
            'semester' => $semesterTujuan,
        ],
        [
            'status' => 'Aktif',
        ]
    );

    // Cari atau buat kelas_tahun baru untuk kelas tujuan dan tahun ajar baru
    $kelasTahunBaru = KelasTahun::firstOrCreate(
        [
            'kelas_id' => $kelasTujuanId,
            'tahun_ajaran_id' => $tahunAjarBaru->tahun_ajaran_id,
        ]
    );

    // Ambil semua murid_kelas dari kelas asal
    $muridKelasAsal = MuridKelas::where('kelas_tahun_id', $kelasAsal->kelas_tahun_id)->get();

    if ($muridKelasAsal->isEmpty()) {
        return redirect()->to('/admin/manajemenKelas?tab=kenaikan')
            ->with('error', 'Tidak ada siswa di kelas asal untuk dipindahkan.');
    }

    // Update status murid_kelas asal jadi tidak aktif (jika ada kolom status, sesuaikan)
    foreach ($muridKelasAsal as $mk) {
        $mk->update(['status' => 'Tidak Aktif']);
    }

    // Proses pembuatan murid_kelas baru dan duplikasi murid_orang_tua
    foreach ($muridKelasAsal as $mk) {
        // Buat murid_kelas baru di kelas tujuan
        $mkBaru = MuridKelas::create([
            'murid_id' => $mk->murid_id,
            'kelas_tahun_id' => $kelasTahunBaru->kelas_tahun_id,
            'status' => 'Aktif', // jika ada kolom status
        ]);

        // Ambil data murid_orang_tua lama berdasar murid_kelas_id lama
        $orangTuaMuridLama = MuridOrangTua::where('murid_kelas_id', $mk->murid_kelas_id)->get();

        // Duplikasi data murid_orang_tua ke murid_kelas baru
        foreach ($orangTuaMuridLama as $ot) {
            MuridOrangTua::create([
                'murid_kelas_id' => $mkBaru->murid_kelas_id,
                'orang_tua_id' => $ot->orang_tua_id,
                // jika ada kolom lain, tambahkan di sini
            ]);
        }
    }

    return redirect()->to('/admin/manajemenKelas?tab=kenaikan')
        ->with('success', 'Kenaikan kelas berhasil diproses.');
}




    public function tampilkanJadwal()
    {
        $pelajaran = Pelajaran::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $kelasTahun = KelasTahun::whereHas('tahunajar', function($query) {
            $query->where('status', 'Aktif');
        })->get();

        $jadwals = JadwalPelajaran::whereHas('kelastahun.tahunajar', function($query) {
            $query->where('status', 'Aktif');
        })
            ->orderBy('kelas_tahun_id', 'asc')
            ->orderBy('hari', 'desc')
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        return view('admin.TambahJadwal', compact('pelajaran', 'kelasTahun', 'jadwals', 'admin'));
    }

    public function tampilkanUpdateJadwal($id)
    {
        $pelajaran = Pelajaran::all();
        $kelas = KelasTahun::all();
        $jadwal = JadwalPelajaran::whereHas('kelastahun.tahunajar', function($query) {
            $query->where('status', 'Aktif');
        })->findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.TambahJadwalEdit', compact('pelajaran', 'kelas', 'jadwal', 'admin'));
    }

    public function simpanJadwal(Request $request)
    {
        $validated = $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_tahun_id' => 'required|exists:kelas_tahun,kelas_tahun_id',
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $bentrokKelas = JadwalPelajaran::where('kelas_tahun_id', $validated['kelas_tahun_id'])
            ->where('hari', $validated['hari'])
            ->whereHas('kelastahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('waktu_mulai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('waktu_mulai', '<=', $validated['waktu_mulai'])
                          ->where('waktu_selesai', '>=', $validated['waktu_selesai']);
                    });
            })
            ->exists();

        if ($bentrokKelas) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jadwal' => 'Sudah ada jadwal lain untuk kelas ini pada waktu tersebut.']);
        }

        $bentrokPelajaran = JadwalPelajaran::where('pelajaran_id', $validated['pelajaran_id'])
            ->where('kelas_tahun_id', '!=', $validated['kelas_tahun_id'])
            ->where('hari', $validated['hari'])
            ->whereHas('kelastahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('waktu_mulai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('waktu_mulai', '<=', $validated['waktu_mulai'])
                          ->where('waktu_selesai', '>=', $validated['waktu_selesai']);
                    });
            })
            ->exists();

        if ($bentrokPelajaran) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jadwal' => 'Pelajaran ini sudah dijadwalkan di kelas lain pada waktu tersebut.']);
        }

        JadwalPelajaran::create($validated);

        return redirect()->route('admin.TambahJadwal')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_tahun_id' => 'required|exists:kelas_tahun,kelas_tahun_id',
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $jadwal = JadwalPelajaran::findOrFail($id);

        $bentrokKelas = JadwalPelajaran::where('jadwal_id', '!=', $id)
            ->where('kelas_tahun_id', $validated['kelas_tahun_id'])
            ->where('hari', $validated['hari'])
            ->whereHas('kelastahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('waktu_mulai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('waktu_mulai', '<=', $validated['waktu_mulai'])
                          ->where('waktu_selesai', '>=', $validated['waktu_selesai']);
                    });
            })
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
            ->whereHas('kelastahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('waktu_mulai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$validated['waktu_mulai'], $validated['waktu_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('waktu_mulai', '<=', $validated['waktu_mulai'])
                          ->where('waktu_selesai', '>=', $validated['waktu_selesai']);
                    });
            })
            ->exists();

        if ($bentrokPelajaran) {
            return back()->withInput()->withErrors([
                'jadwal' => 'Pelajaran ini sudah dijadwalkan di kelas lain pada waktu tersebut.',
            ]);
        }

        $jadwal->update($validated);

        return redirect()->route('admin.TambahJadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function hapusJadwal($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.TambahJadwal')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function tampilkanPelajaran()
    {
        $gurus = Guru::all();
        $pelajarans = Pelajaran::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.TambahPelajaran', compact('gurus', 'pelajarans', 'admin'));
    }

    public function simpanPelajaran(Request $request)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,guru_id',
            'namaPelajaran' => 'required|string|max:255',
        ]);

        Pelajaran::create([
            'guru_id' => $validated['guru_id'],
            'namaPelajaran' => $validated['namaPelajaran'],
        ]);

        return redirect()->route('admin.TambahPelajaran')->with('success', 'Pelajaran berhasil ditambahkan.');
    }

    public function tampilkanUpdatePelajaran($id)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $gurus = Guru::all();
        $pelajaran = Pelajaran::findOrFail($id);

        return view('admin.TambahPelajaranEdit', compact('gurus', 'pelajaran', 'admin'));
    }

    public function updatePelajaran(Request $request, $id)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,guru_id',
            'namaPelajaran' => 'required|string|max:255',
        ]);

        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->update([
            'guru_id' => $validated['guru_id'],
            'namaPelajaran' => $validated['namaPelajaran'],
        ]);

        return redirect()->route('admin.TambahPelajaran')->with('success', 'Pelajaran berhasil diperbarui.');
    }

    public function hapusPelajaran($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->delete();

        return redirect()->route('admin.TambahPelajaran')->with('success', 'Pelajaran berhasil dihapus.');
    }

    // Added the missing tampilkanManajemenPost method
    public function tampilkanManajemenPost()
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $pengumumans = Postingan::with(['profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar'])
            ->where('profile_id', $admin->profile_id)
            ->where('tipe', 'pengumuman')
            ->orderBy('created_at', 'desc')
            ->get();
        $blogs = Postingan::with('profile')
            ->where('profile_id', $admin->profile_id)
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc')
            ->get();
        $kelasTahuns = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })->get();

        return view('admin.manajemenPost', compact('admin', 'pengumumans', 'blogs', 'kelasTahuns'));
    }

    public function tambahPostingan(Request $request)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        \Log::info('tambahPostingan called', ['admin_profile_id' => $admin->profile_id, 'request' => $request->all()]);
    
        $lampiranPath = null;
    
        try {
            $validated = $request->validate([
                'tipe' => 'required|in:pengumuman,blog',
                'judul' => 'required|string|max:255',
                'isi_trix' => 'required|string|min:10', // Ganti 'isi' menjadi 'isi_trix'
                'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'tujuan' => 'nullable|exists:kelas_tahun,kelas_tahun_id',
            ]);
    
            \Log::info('Validation passed', ['validated' => $validated]);
    
            if ($request->hasFile('lampiran')) {
                $file = $request->file('lampiran');
                $filename = time() . '_' . $file->getClientOriginalName();
                \Log::info('Uploading file', ['filename' => $filename]);
                if (!file_exists(public_path('storage/lampiran'))) {
                    mkdir(public_path('storage/lampiran'), 0775, true);
                    \Log::info('Created directory storage/lampiran');
                }
                $file->move(public_path('storage/lampiran'), $filename);
                $lampiranPath = 'lampiran/' . $filename;
                \Log::info('File uploaded', ['lampiranPath' => $lampiranPath]);
            }
    
            $kelasTahunId = ($validated['tipe'] == 'blog') ? null : $validated['tujuan'];
            \Log::info('kelas_tahun_id determined', ['kelasTahunId' => $kelasTahunId]);
    
            \Log::info('Attempting to create post', [
                'profile_id' => $admin->profile_id,
                'kelas_tahun_id' => $kelasTahunId,
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi_trix'], // Gunakan isi_trix sebagai isi
                'lampiran' => $lampiranPath,
            ]);
    
            $post = Postingan::create([
                'profile_id' => $admin->profile_id,
                'kelas_tahun_id' => $kelasTahunId,
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi_trix'], // Gunakan isi_trix sebagai isi
                'lampiran' => $lampiranPath,
            ]);
    
            \Log::info('Post created', ['post_id' => $post->postingan_id]);
    
            return redirect()
                ->route('admin.manajemenPost', ['TipePost' => $validated['tipe']])
                ->with('success', 'Postingan berhasil dibuat.');
        } catch (\Exception $e) {
            \Log::error('Error in tambahPostingan', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
                'lampiranPath' => $lampiranPath,
            ]);
    
            if ($lampiranPath && file_exists(public_path('storage/' . $lampiranPath))) {
                unlink(public_path('storage/' . $lampiranPath));
                \Log::info('Deleted uploaded file', ['path' => $lampiranPath]);
            }
    
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal membuat postingan: ' . $e->getMessage()]);
        }
    }

    public function editPostingan($id)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::with(['profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar'])
            ->where('profile_id', $admin->profile_id)
            ->findOrFail($id);
        $kelasTahuns = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })->get();

        return view('admin.ManajemenPostEdit', compact('postingan', 'admin', 'kelasTahuns'));
    }

    public function updatePostingan(Request $request, $id)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::where('profile_id', $admin->profile_id)->findOrFail($id);

        try {
            $validated = $request->validate([
                'tipe' => 'required|in:pengumuman,blog',
                'judul' => 'required|string|max:255',
                'isi' => 'required|string|min:10',
                'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'tujuan' => 'required_if:tipe,pengumuman|nullable|in:public,' . implode(',', KelasTahun::pluck('kelas_tahun_id')->toArray()),
            ]);

            $lampiranPath = $postingan->lampiran;
            if ($request->hasFile('lampiran')) {
                if ($lampiranPath && Storage::disk('public')->exists($lampiranPath)) {
                    Storage::disk('public')->delete($lampiranPath);
                }
                $file = $request->file('lampiran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/lampiran'), $filename);
                $lampiranPath = 'lampiran/' . $filename;
            }

            $kelasTahunId = ($validated['tipe'] == 'blog') ? null : ($validated['tujuan'] == 'public' ? null : $validated['tujuan']);

            $postingan->update([
                'kelas_tahun_id' => $kelasTahunId,
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'lampiran' => $lampiranPath,
            ]);

            return redirect()->route('admin.manajemenPost', ['TipePost' => $validated['tipe']])
                ->with('success', 'Postingan berhasil diperbarui.');
        } catch (\Exception $e) {
            if ($lampiranPath && $request->hasFile('lampiran') && Storage::disk('public')->exists($lampiranPath)) {
                Storage::disk('public')->delete($lampiranPath);
            }
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui postingan: ' . $e->getMessage()]);
        }
    }

    public function hapusPostingan($id, Request $request)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::where('profile_id', $admin->profile_id)->findOrFail($id);

        try {
            $tipe = $request->input('TipePost', $postingan->tipe);
            if ($postingan->lampiran && Storage::disk('public')->exists($postingan->lampiran)) {
                Storage::disk('public')->delete($postingan->lampiran);
            }
            $postingan->delete();

            return redirect()->route('admin.manajemenPost', ['TipePost' => $tipe])
                ->with('success', 'Postingan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus postingan: ' . $e->getMessage()]);
        }
    }

    public function updateKegiatan(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'isi_kegiatan' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        try {
            $lampiranPath = $kegiatan->lampiran;
            if ($request->hasFile('lampiran')) {
                if ($lampiranPath && Storage::disk('public')->exists($lampiranPath)) {
                    Storage::disk('public')->delete($lampiranPath);
                }
                $lampiranPath = $request->file('lampiran')->store('uploads', 'public');
            }
            
            $kegiatan->update([
                'judul_kegiatan' => $validated['judul_kegiatan'],
                'isi_kegiatan' => $validated['isi_kegiatan'],
                'lampiran' => $lampiranPath,
            ]);
            
            return redirect()->route('admin.manajemenPost', ['TipePost' => 'kegiatan'])
                ->with('success', 'Kegiatan berhasil diupdate!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal mengupdate kegiatan: ' . $e->getMessage()]);
        }
    }

    public function destroyKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        try {
            if ($kegiatan->lampiran && Storage::disk('public')->exists($kegiatan->lampiran)) {
                Storage::disk('public')->delete($kegiatan->lampiran);
            }
            $kegiatan->delete();
            
            return redirect()->route('admin.manajemenPost', ['TipePost' => 'kegiatan'])
                ->with('success', 'Kegiatan berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus kegiatan: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        $blogs = Postingan::with(['profile'])
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('welcome', compact('blogs'));
    }

    public function tampilkanBlog(Request $request)
    {
        $query = Postingan::with(['profile'])
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc');

        if ($filter = $request->query('filter')) {
            switch ($filter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        $blogs = $query->get();
        
        return view('blog', compact('blogs'));
    }

    public function tampilkanBlogDetail($id)
    {
        $postingan = Postingan::with('comments.commentator', 'profile')->findOrFail($id);
        return view('blogFull', compact('postingan'));
    }

    public function tampilkanManajemenUser(Request $request)
{
    try {
        $role = $request->input('role');
        $search = $request->input('search');
        $additionalFilter = $request->input('additional_filter');

        $admins = collect();
        $gurus = collect();
        $muridOrangTuas = collect();

        // Ambil semua kelas yang berstatus aktif
        $kelasList = KelasTahun::whereHas('tahunAjar', function ($query) {
            $query->where('status', 'Aktif');
        })->with(['kelas', 'tahunajar'])->get();

        // Cek admin login
        $admin = Admin::where('profile_id', auth()->id())->first();
        if (!$admin) {
            return redirect()->to('/login')->withErrors(['error' => 'Admin tidak ditemukan. Silakan login kembali.']);
        }

        // Ambil tahun ajaran aktif
        $tahunAjarAktif = TahunAjar::where('status', 'Aktif')->first();

        if ($role === 'admin') {
            $admins = Admin::with('profile')
                ->when($search, function ($query) use ($search) {
                    return $query->whereHas('profile', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                    });
                })
                ->get();
        } elseif ($role === 'guru') {
            $gurus = Guru::with('profile')
                ->when($additionalFilter, function ($query) use ($additionalFilter) {
                    return $query->where('statusKerja', $additionalFilter);
                })
                ->when($search, function ($query) use ($search) {
                    return $query->whereHas('profile', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                    });
                })
                ->get();
        } elseif ($role === 'murid') {
            $muridOrangTuas = MuridOrangTua::with([
                'muridKelas.murid.profile',
                'muridKelas.kelasTahun.kelas',
                'muridKelas.kelasTahun.tahunajar',
                'orangTua.profile'
            ])
                ->whereHas('muridKelas.kelasTahun.tahunAjar', function ($query) use ($tahunAjarAktif) {
                    $query->where('tahun_ajaran_id', $tahunAjarAktif->tahun_ajaran_id);
                })
                ->when($additionalFilter, function ($query) use ($additionalFilter) {
                    return $query->whereHas('muridKelas', function ($q) use ($additionalFilter) {
                        $q->where('kelas_tahun_id', $additionalFilter);
                    });
                })
                ->when($search, function ($query) use ($search) {
                    return $query->whereHas('muridKelas.murid.profile', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                    });
                })
                ->get();
        } elseif ($role === 'orang_tua') {
            $muridOrangTuas = MuridOrangTua::with([
                'muridKelas.murid.profile',
                'muridKelas.kelasTahun.tahunAjar',
                'orangTua.profile'
            ])
                ->whereHas('muridKelas.kelasTahun.tahunAjar', function ($query) use ($tahunAjarAktif) {
                    $query->where('tahun_ajaran_id', $tahunAjarAktif->tahun_ajaran_id);
                })
                ->when($search, function ($query) use ($search) {
                    return $query->whereHas('orangTua.profile', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                    });
                })
                ->get();
        }

        return view('admin.ManajemenUser', compact('admin', 'admins', 'gurus', 'muridOrangTuas', 'kelasList'));
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Gagal memuat data: ' . $e->getMessage()]);
    }
}

    public function editUser($id, Request $request)
    {
        $role = $request->query('role');
        $admin = Admin::with('profile')->where('profile_id', auth()->id())->firstOrFail();

        $kelasList = [];
        if ($role === 'murid') {
            $muridKelas = MuridKelas::with(['murid.profile', 'kelastahun'])->findOrFail($id);
            $user = $muridKelas;
            $kelasList = KelasTahun::whereHas('tahunAjar', function ($query) {
                $query->where('status', 'Aktif');
            })->get();

            return view('admin.ManajemenUserEdit', compact('user', 'role', 'admin', 'kelasList'))->with('id', $id);
        }

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

            $user->murid->nis = $request->nis;
            $user->murid->nisn = $request->nisn;
            $user->murid->asal_sekolah = $request->asal_sekolah;
            $user->murid->save();

            $user->kelas_tahun_id = $request->kelas_tahun_id;
        } else {
            $user = $model::with('profile')->findOrFail($id);
            $profile = $user->profile;

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

        return back()->with('success', 'User berhasil dihapus.');
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

    public function register(Request $request)
    {
        $request->validate([
            // Data murid
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles,email',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'pendidikan' => 'required|string',
            'no_telp' => 'required|string',
            'asal_sekolah' => 'required|string',
            'nis' => 'required|string',
            'nisn' => 'required|string',
            'kelas_tahun_id' => 'required|integer|exists:kelas_tahun,kelas_tahun_id',

            // Data orang tua
            'ortu_name' => 'required|string',
            'ortu_email' => 'required|email|unique:profiles,email',
            'ortu_alamat' => 'required|string',
            'ortu_tempat_lahir' => 'required|string',
            'ortu_tanggal_lahir' => 'required|date',
            'ortu_jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'ortu_pendidikan' => 'required|string',
            'ortu_no_telp' => 'required|string',
            'ortu_profesi' => 'required|string',
        ]);

        // Auto generate password
        $muridPassword = Str::random(8);
        $ortuPassword = Str::random(8);

        // Simpan profile murid
        $profile = Profile::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'pendidikan' => $request->pendidikan,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($muridPassword),
        ]);

        // Simpan profile orang tua
        $ortuProfile = Profile::create([
            'name' => $request->ortu_name,
            'email' => $request->ortu_email,
            'alamat' => $request->ortu_alamat,
            'tempat_lahir' => $request->ortu_tempat_lahir,
            'jenis_kelamin' => $request->ortu_jenis_kelamin,
            'tanggal_lahir' => $request->ortu_tanggal_lahir,
            'pendidikan' => $request->ortu_pendidikan,
            'no_telp' => $request->ortu_no_telp,
            'password' => Hash::make($ortuPassword),
        ]);

        // Simpan data orang tua
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

        // Relasi murid ke kelas
        $murid->muridKelas()->attach($request->kelas_tahun_id);

        // Relasi murid ke orang tua
        $muridKelas = MuridKelas::where('murid_id', $murid->murid_id)
                                ->where('kelas_tahun_id', $request->kelas_tahun_id)
                                ->firstOrFail();
        MuridOrangTua::create([
            'murid_kelas_id' => $muridKelas->murid_kelas_id,
            'orang_tua_id' => $orangTua->orang_tua_id,
        ]);

        // Kirim email Brevo
        $brevo = new BrevoMailer();
        $brevo->sendCredentialsToMurid(
            $profile->email,           // email tujuan (murid)
            $profile->name,            // nama murid
            $profile->email,           // akun email murid
            $muridPassword,            // password murid
            $ortuProfile->email,       // email ortu
            $ortuPassword              // password ortu
        );

        return redirect()->route('home');
    }

    public function showRegisterForm()
    {
        $kelasTahunList = KelasTahun::all();
        return view('register', compact('kelasTahunList'));
    }

    public function exportUser($role)
    {
        $validRoles = ['admin', 'guru', 'murid', 'orang_tua'];

        if (!in_array(strtolower($role), $validRoles)) {
            abort(404, 'Role not found');
        }

        return Excel::download(new DownloadUser($role), $role . '.xlsx');
    }

    public function tampilkanNilai(Request $request)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $pelajaranList = Pelajaran::all();
        $kelasTahuns = KelasTahun::whereHas('tahunajar', function ($query) {
            $query->where('status', 'Aktif');
        })->with(['kelas', 'tahunajar'])->get();

        $pilihanPelajaran = $request->input('pelajaran_id');
        $pilihanKelasTahun = $request->input('kelas_tahun_id');
        $search = $request->input('search');

        $muridList = collect();
        if ($pilihanPelajaran && $pilihanKelasTahun) {
            $muridList = MuridKelas::with(['murid.profile', 'nilai' => function ($query) use ($pilihanPelajaran) {
                $query->where('pelajaran_id', $pilihanPelajaran);
            }])
                ->where('kelas_tahun_id', $pilihanKelasTahun)
                ->when($search, function ($query) use ($search) {
                    $query->whereHas('murid.profile', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                })
                ->get();
        }

        return view('admin.NilaiSiswa', compact('admin', 'pelajaranList', 'kelasTahuns', 'muridList', 'pilihanPelajaran', 'pilihanKelasTahun'));
    }

    public function exportNilai($kelas_tahun_id, $pelajaran_id)
    {
        return Excel::download(new AdminExcelNilai($kelas_tahun_id, $pelajaran_id), 'nilai-murid-' . $kelas_tahun_id . '-' . $pelajaran_id . '-' . date('Ymd_His') . '.xlsx');
    }
}