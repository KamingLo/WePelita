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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function tampilkanDashboardGuru()
    {
        $guru = Guru::findOrFail(auth()->id());
        return view('guru.dashboard', compact('guru'));
    }

    public function tampilkanJadwalPelajaran(){
        $guru =Guru::where('profile_id', auth()->id())->firstOrFail();
        return view('guru.jadwalpelajaran', compact('guru'));
    }
    
    public function tampilkanJadwalAnda(){
        $guru =Guru::where('profile_id', auth()->id())->firstOrFail();
        return view('guru.jadwalajaranda', compact('guru'));
    }


    public function tampilkanPengumuman()
    {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        $pengumuman = Postingan::where('profile_id', $guru->profile_id)->get();
        return view('guru.pengumuman', compact('guru', 'pengumuman'));
    }

    public function buatPengumuman(Request $request)
    {
        $title = $request->title;
        $content = $request->content;

        // Simpan file HTML di storage/app/blog/
        $filename = now()->format('YmdHis') . '-' . \Str::slug($title) . '.html';

        Storage::disk('local')->put("blog/$filename", $content);

        // Optional: Simpan nama file di database jika kamu ingin tracking
        Postingan::create([
            'title' => $title,
            'content' => $filename, // hanya simpan nama file
        ]);

        return redirect()->route('guru.pengumuman')->with('success', 'Blog saved');
    }

    public function tampilkanMenuNilai(){
        return view('guru.nilai');
    }
}