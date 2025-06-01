<?php

namespace App\Http\Controllers;

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
use App\Models\Komentar;
use App\Models\Postingan;
use App\Models\KelasTahun;
use App\Models\MuridKelas;
use App\Models\MuridOrangTua;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
            'nama_kelas' => 'required|string',
            'tahun_ajar' => 'required|string',
            'semester' => 'required|string',
        ]);
    
        $status = 'Aktif';
    
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
    
        $kelas->tahun()->attach($tahunAjar->tahun_ajaran_id);
    
        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas baru berhasil dibuat.');
    }

    public function tampilkanUpdateKelas($id){
        $kelastahun = KelasTahun::findOrFail($id);
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.ManajemenKelasEdit', compact('kelastahun', 'admin'));
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

        $tahunAjar = TahunAjar::where('tahun_ajaran', $request->tahun_ajaran)
            ->where('semester', $request->semester)
            ->first();

        if ($tahunAjar) {
            $tahunAjar->status = $request->status;
            $tahunAjar->save();
        } else {
            $tahunAjar = TahunAjar::create([
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester' => $request->semester,
                'status' => $request->status,
            ]);
        }

        $kelas = $kelastahun->kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->save();

        // Update relasi kelas_tahun
        $kelastahun->tahun_ajaran_id = $tahunAjar->tahun_ajaran_id;
        $kelastahun->save();

        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function hapusKelas($id)
    {
        $kelastahun = KelasTahun::findOrFail($id);
        $kelas = $kelastahun->kelas->kelas_id;
        $kelas = Kelas::findOrFail($kelas);
        $kelas->delete();

        return redirect()->route('admin.manajemenKelas')->with('success', 'Kelas berhasil dihapus.');
    }

    public function tampilkanFormKenaikanKelas()
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        
        // Ambil semua kelas tahun untuk tahun ajaran aktif
        $kelasSekarang = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function($query) {
                $query->where('status', 'Aktif');
            })->get();
    
        $semuaKelas = Kelas::all();
    
        return view('admin.kenaikanKelas', compact('kelasSekarang', 'semuaKelas', 'admin'));
    }

    public function prosesKenaikanKelas(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'kelas_asal' => 'required|exists:kelas_tahun,kelas_tahun_id',
                'kelas_tujuan' => 'required|exists:kelas,kelas_id',
                'tahun_ajaran' => 'required',
                'semester' => 'required|in:Ganjil,Genap'
            ]);
    
            // Check if the source and target classes are the same
            $kelasAsal = KelasTahun::findOrFail($request->kelas_asal);
            if ($kelasAsal->kelas_id == $request->kelas_tujuan) {
                return redirect()->to('/admin/manajemenKelas?tab=kenaikan')->with('error', 'Kelas asal dan kelas tujuan tidak boleh sama.');
            }
    
            // Create or update the new TahunAjar for the target class
            $tahunAjarBaru = TahunAjar::updateOrCreate(
                [
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'semester' => $request->semester
                ],
                [
                    'status' => 'Aktif'
                ]
            );
    
            // Create or update the new KelasTahun for the target class
            $kelasTahunBaru = KelasTahun::updateOrCreate(
                [
                    'kelas_id' => $request->kelas_tujuan,
                    'tahun_ajaran_id' => $tahunAjarBaru->tahun_ajaran_id
                ]
            );
    
            // Get students from the source class
            $muridKelas = MuridKelas::where('kelas_tahun_id', $request->kelas_asal)->get();
    
            // Check if there are students to move
            if ($muridKelas->isEmpty()) {
                return redirect()->to('/admin/manajemenKelas?tab=kenaikan')->with('error', 'Tidak ada siswa di kelas asal untuk dipindahkan.');
            }
    
            // Move students to the new class
            foreach ($muridKelas as $mk) {
                MuridKelas::create([
                    'murid_id' => $mk->murid_id,
                    'kelas_tahun_id' => $kelasTahunBaru->kelas_tahun_id
                ]);
            }
    
            // Deactivate the source class's TahunAjar
            $kelasAsal->tahunajar->status = 'Tidak Aktif';
            $kelasAsal->tahunajar->save();
    
            return redirect()->to('/admin/manajemenKelas?tab=kenaikan')->with('success', 'Kenaikan kelas berhasil diproses.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed in prosesKenaikanKelas: ' . json_encode($e->errors()));
            throw $e; // Let Laravel handle the redirect with errors
        } catch (\Exception $e) {
            \Log::error('Error in prosesKenaikanKelas: ' . $e->getMessage());
            return redirect()->to('/admin/manajemenKelas?tab=kenaikan')->with('error', 'Gagal memproses kenaikan kelas: ' . $e->getMessage());
        }
    }

    /* --------------------------------------------------- */
    /* ------------------ Bagian Jadwal ------------------ */
    /* --------------------------------------------------- */

    public function tampilkanJadwal(){
        $pelajaran = Pelajaran::all();
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        
        // Get only active classes
        $kelasTahun = KelasTahun::whereHas('tahunajar', function($query) {
            $query->where('status', 'Aktif');
        })->get();

        // Get schedules only for active classes
        $jadwals = JadwalPelajaran::whereHas('kelastahun.tahunajar', function($query) {
            $query->where('status', 'Aktif');
        })
        ->orderBy('kelas_tahun_id', 'asc')
        ->orderBy('hari', 'desc')
        ->orderBy('waktu_mulai', 'asc')
        ->get();

        return view('admin.TambahJadwal', compact('pelajaran', 'kelasTahun', 'jadwals', 'admin'));
    }

    public function tampilkanUpdateJadwal($id){
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
        try {
            $request->validate([
                'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
                'kelas_tahun_id' => 'required|exists:kelas_tahun,kelas_tahun_id',
                'hari' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required|after:waktu_mulai',
            ]);
    
            $bentrokKelas = JadwalPelajaran::where('kelas_tahun_id', $request->kelas_tahun_id)
                ->where('hari', $request->hari)
                ->whereHas('kelastahun.tahunajar', function ($query) {
                    $query->where('status', 'Aktif');
                })
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
    
            $bentrokPelajaran = JadwalPelajaran::where('pelajaran_id', $request->pelajaran_id)
                ->where('kelas_tahun_id', '!=', $request->kelas_tahun_id)
                ->where('hari', $request->hari)
                ->whereHas('kelastahun.tahunajar', function ($query) {
                    $query->where('status', 'Aktif');
                })
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
    
            JadwalPelajaran::create([
                'pelajaran_id' => $request->pelajaran_id,
                'kelas_tahun_id' => $request->kelas_tahun_id,
                'hari' => $request->hari,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
            ]);
    
            return redirect()->route('admin.TambahJadwal')
                ->with('success', 'Jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Error creating schedule: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['jadwal' => 'Gagal menambahkan jadwal: ' . $e->getMessage()]);
        }
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

    /* --------------------------------------------------- */
    /* ----------------------- End ------------------- --- */
    /* --------------------------------------------------- */

    /* --------------------------------------------------- */
    /* ------------------ Bagian Pelajaran --------------- */
    /* --------------------------------------------------- */

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

    public function tampilkanUpdatePelajaran($id){
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

    public function hapusPelajaran($id){
        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->delete();

        return redirect()->route('admin.TambahPelajaran')->with('success', 'Pelajaran berhasil dihapus.');

    }
    /* -------------------------------------------------------- */
    /* -------------------------- End ------------------------- */
    /* -------------------------------------------------------- */

    public function tampilkanManajemenPost()
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $pengumumans = Postingan::with('admin.profile')
            ->where('tipe', 'pengumuman')
            ->orderBy('created_at', 'desc')
            ->get();
        $blogs = Postingan::with('admin.profile')
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.manajemenPost', compact('admin', 'pengumumans', 'blogs'));
    }

    public function tambahPostingan(Request $request)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'tipe' => 'required|in:pengumuman,blog',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:10',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

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

        try {
            Postingan::create([
                'admin_id' => $admin->admin_id,
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'lampiran' => $lampiranPath
            ]);

            return redirect()
                ->route('admin.manajemenPost')
                ->with('success', 'Postingan berhasil dibuat.');

        } catch (\Exception $e) {
            // Delete file if save failed
            if ($lampiranPath) {
                unlink(public_path('storage/' . $lampiranPath));
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal membuat postingan: ' . $e->getMessage()]);
        }
    }

    public function editPostingan($id)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::findOrFail($id);
        return view('admin.ManajemenPostEdit', compact('postingan', 'admin'));
    }

    public function updatePostingan(Request $request, $id)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::findOrFail($id);
    
        $validated = $request->validate([
            'tipe' => 'required|in:pengumuman,blog',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:10',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
    
        DB::beginTransaction();
        try {
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
    
            $postingan->update([
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'lampiran' => $lampiranPath,
            ]);
    
            DB::commit();
            Log::info('Postingan updated successfully', ['postingan_id' => $postingan->postingan_id]);
            return redirect()->route('admin.manajemenPost', ['TipePost' => $validated['tipe']])
                ->with('success', 'Postingan berhasil diperbarui.');        
            } catch (\Exception $e) {
            DB::rollBack();
            if ($lampiranPath && $request->hasFile('lampiran') && Storage::disk('public')->exists($lampiranPath)) {
                Storage::disk('public')->delete($lampiranPath);
            }
            Log::error('Gagal memperbarui postingan: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui postingan: ' . $e->getMessage()]);
        }
    }

    public function hapusPostingan($id, Request $request)
    {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::findOrFail($id);
    
        DB::beginTransaction();
        try {
            $tipe = $request->input('TipePost', $postingan->tipe);
            if ($postingan->lampiran) {
                Storage::disk('public')->delete($postingan->lampiran);
            }
            $postingan->delete();
            DB::commit();
            Log::info('Postingan deleted successfully', ['postingan_id' => $id]);
            return redirect()->route('admin.manajemenPost', ['TipePost' => $tipe])
                ->with('success', 'Postingan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus postingan: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => 'Gagal menghapus postingan: ' . $e->getMessage()]);
        }
    }
    
    public function tampilkanManajemenUser(Request $request)
    {
        try {
            $role = $request->input('role');
            $search = $request->input('search');
            $additionalFilter = $request->input('additional_filter');
    
            // Initialize collections to avoid undefined variable issues
            $admins = collect();
            $gurus = collect();
            $muridOrangTuas = collect();
    
            // Fetch active classes
            $kelasList = KelasTahun::whereHas('tahunAjar', function ($query) {
                $query->where('status', 'Aktif');
            })->with(['kelas', 'tahunajar'])->get();
    
            // Fetch current admin
            $admin = Admin::where('profile_id', auth()->id())->first();
            if (!$admin) {
                return redirect('/login')->withErrors(['error' => 'Admin tidak ditemukan. Silakan login kembali.']);
            }
    
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
                $muridOrangTuas = MuridOrangTua::with(['orangTua.profile'])
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
            \Log::error('Error in tampilkanManajemenUser: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal memuat data: ' . $e->getMessage()]);
        }
    }

    public function editUser($id, Request $request)
    {
        $role = request('role');
        $admin = Admin::with('profile')->where('profile_id', auth()->id())->firstOrFail(); // Ambil objek Admin dengan relasi profile
    
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
}