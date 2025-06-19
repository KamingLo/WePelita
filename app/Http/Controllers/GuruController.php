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
use App\Models\Postingan;
use App\Models\Komentar;
use App\Models\KelasTahun;
use App\Models\MuridOrangTua;
use App\Models\Nilai;
use App\Models\MuridKelas;
use App\Models\GuruPelajaranKelas;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GuruController extends Controller
{
    /**
     * Tampilkan halaman input nilai berdasarkan pelajaran dan kelas yang diajar guru
     */
    public function tampilkanMenuNilai(Request $request)
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();

        // Ambil kelas tahun aktif
        $kelasTahunList = KelasTahun::whereHas('tahunajar', function ($query) {
            $query->where('status', 'Aktif');
        })->get();

        $pilihanKelasTahun = null;
        $pelajaranList = collect();
        $pilihanPelajaran = null;
        $muridList = collect();

        // Jika kelas tahun dipilih
        if ($request->has('kelas_tahun_id') && $request->kelas_tahun_id) {
            $pilihanKelasTahun = KelasTahun::whereHas('tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })->findOrFail($request->kelas_tahun_id);

            // Ambil pelajaran yang diajar guru ini di kelas tahun terpilih berdasarkan jadwal
            $pelajaranList = JadwalPelajaran::with('pelajaran')
                ->where('guru_id', $guru->guru_id)
                ->where('kelas_tahun_id', $pilihanKelasTahun->kelas_tahun_id)
                ->get()
                ->pluck('pelajaran')
                ->unique('pelajaran_id');

            // Jika pelajaran dipilih
            if ($request->has('pelajaran_id') && $request->pelajaran_id) {
                $pilihanPelajaran = $pelajaranList->firstWhere('pelajaran_id', $request->pelajaran_id);

                // Ambil murid dan nilai
                $muridList = MuridKelas::with(['murid.profile', 'nilai' => function ($query) use ($pilihanPelajaran) {
                    $query->where('pelajaran_id', $pilihanPelajaran->pelajaran_id);
                }])
                    ->where('kelas_tahun_id', $pilihanKelasTahun->kelas_tahun_id)
                    ->get();
            }
        }

        return view('guru.isinilai', compact('guru', 'kelasTahunList', 'pilihanKelasTahun', 'pelajaranList', 'pilihanPelajaran', 'muridList'));
    }

     /**
     * Tampilkan halaman manajemen postingan milik guru (pengumuman & blog)
     */
    public function tampilkanManajemenPost()
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        $pengumumans = Postingan::with('profile')
            ->where('profile_id', $guru->profile_id)
            ->where('tipe', 'pengumuman')
            ->orderBy('created_at', 'desc')
            ->get();
        $blogs = Postingan::with('profile')
            ->where('profile_id', $guru->profile_id)
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc')
            ->get();
        $kelasTahuns = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
        return view('guru.ManajemenPost', compact('guru', 'pengumumans', 'blogs', 'kelasTahuns'));
    }

    /**
     * Simpan postingan baru (pengumuman atau blog)
     */
    public function tambahPostingan(Request $request)
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'tipe' => 'required|in:pengumuman,blog',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:10',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'tujuan' => 'nullable|exists:kelas_tahun,kelas_tahun_id',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/lampiran'), $filename);
            $lampiranPath = 'lampiran/' . $filename;
        }

        try {
            $kelasTahunId = ($validated['tipe'] == 'blog') ? null : $validated['tujuan'];
            $post = Postingan::create([
                'profile_id' => $guru->profile_id,
                'kelas_tahun_id' => $kelasTahunId,
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'lampiran' => $lampiranPath
            ]);

            return redirect()
                ->route('guru.ManajemenPost')
                ->with('success', 'Postingan berhasil dibuat.');
        } catch (\Exception $e) {
            if ($lampiranPath && file_exists(public_path('storage/' . $lampiranPath))) {
                unlink(public_path('storage/' . $lampiranPath));
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal membuat postingan: ' . $e->getMessage()]);
        }
    }

    /**
     * Perbarui data postingan yang telah dibuat guru
     */
    public function updatePostingan(Request $request, $id)
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::where('profile_id', $guru->profile_id)->findOrFail($id);

        $validated = $request->validate([
            'tipe' => 'required|in:pengumuman,blog',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:10',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'tujuan' => 'nullable|exists:kelas_tahun,kelas_tahun_id',
        ]);

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

            $kelasTahunId = ($validated['tipe'] == 'blog') ? null : $validated['tujuan'];

            $postingan->update([
                'kelas_tahun_id' => $kelasTahunId,
                'tipe' => $validated['tipe'],
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'lampiran' => $lampiranPath,
            ]);

            return redirect()->route('guru.ManajemenPost', ['TipePost' => $validated['tipe']])
                ->with('success', 'Postingan berhasil diperbarui.');
        } catch (\Exception $e) {
            if ($lampiranPath && $request->hasFile('lampiran') && Storage::disk('public')->exists($lampiranPath)) {
                Storage::disk('public')->delete($lampiranPath);
            }
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui postingan: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan halaman dashboard guru
     */
    public function tampilkanDashboardGuru()
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        return view('guru.dashboard', compact('guru'));
    }

    /**
     * Tampilkan halaman jadwal pelajaran seluruh kelas
     */
    public function tampilkanJadwalPelajaran()
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        return view('guru.jadwalpelajaran', compact('guru'));
    }
    
    /**
     * Tampilkan halaman jadwal mengajar guru saat ini
     */
    public function tampilkanJadwalAnda()
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        return view('guru.jadwalajaranda', compact('guru'));
    }

    /**
     * Simpan atau perbarui nilai murid pada pelajaran dan kelas tertentu
     */
    public function simpanNilai(Request $request)
    {
        $request->validate([
            'pelajaran_id' => 'required|exists:pelajaran,pelajaran_id',
            'kelas_tahun_id' => 'required|exists:kelas_tahun,kelas_tahun_id',
            'nilai' => 'required|array',
            'nilai.*.nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai.*.nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai.*.nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        foreach ($request->nilai as $muridKelasId => $data) {
            Nilai::updateOrCreate(
                [
                    'murid_kelas_id' => $muridKelasId,
                    'pelajaran_id' => $request->pelajaran_id,
                ],
                [
                    'nilai_tugas' => $data['nilai_tugas'] ?? null,
                    'nilai_uts' => $data['nilai_uts'] ?? null,
                    'nilai_uas' => $data['nilai_uas'] ?? null,
                ]
            );
        }

        return back()->with('success', 'Nilai berhasil disimpan.');
    }

    /**
     * Tampilkan form edit postingan guru
     */
    public function editPostingan($id)
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::where('profile_id', $guru->profile_id)->findOrFail($id);
        $kelasTahuns = KelasTahun::with(['kelas', 'tahunajar'])
            ->whereHas('tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })->get();
        return view('guru.ManajemenPostEdit', compact('postingan', 'guru', 'kelasTahuns'));
    }

    /**
     * Hapus postingan milik guru, termasuk file lampiran jika ada
     */
    public function hapusPostingan($id, Request $request)
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        $postingan = Postingan::where('profile_id', $guru->profile_id)->findOrFail($id);

        try {
            $tipe = $request->input('TipePost', $postingan->tipe);
            
            if ($postingan->lampiran && Storage::disk('public')->exists($postingan->lampiran)) {
                Storage::disk('public')->delete($postingan->lampiran);
            }
            
            $postingan->delete();
            
            return redirect()->route('guru.ManajemenPost', ['TipePost' => $tipe])
                ->with('success', 'Postingan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus postingan: ' . $e->getMessage()]);
        }
    }

    /**
     * Export nilai murid ke format Excel berdasarkan kelas yang dipilih
     */
    public function downloadNilai(Request $request)
    {
        $selectedKelas = $request->input('kelas_tahun_id');

        if (!$selectedKelas) {
            return redirect()->route('guru.isinilai')->with('error', 'Pilih kelas dulu');
        }

        $nilaiList = Nilai::with(['muridKelas.murid', 'muridKelas.kelasTahun', 'pelajaran'])
            ->whereHas('muridKelas', function($q) use ($selectedKelas) {
                $q->where('kelas_tahun_id', $selectedKelas);
            })
            ->get();

        // Buat array data untuk export
        $data = [];
        foreach ($nilaiList as $nilai) {
            $data[] = [
                'Nama Murid' => $nilai->muridKelas->murid->profile->name,
                'Kelas' => $nilai->muridKelas->kelasTahun->kelas->nama_kelas ?? '-',
                'Pelajaran' => $nilai->pelajaran->namaPelajaran,
                'Nilai Tugas' => $nilai->nilai_tugas ?? '-',
                'Nilai UTS' => $nilai->nilai_uts ?? '-',
                'Nilai UAS' => $nilai->nilai_uas ?? '-',
            ];
        }

        $filename = 'nilai_kelas_'.$selectedKelas.'_'.date('Ymd_His').'.xlsx';

        // Buat export menggunakan \Maatwebsite\Excel\Excel::download
        return Excel::download(new \App\Exports\NilaiExport($data), $filename);
    }
}