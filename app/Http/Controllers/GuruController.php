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

class GuruController extends Controller
{
    public function tampilkanDashboardGuru()
    {
        $guru = Guru::findOrFail(auth()->id());
        return view('guru.dashboard', compact('guru'));
    }

    public function tampilkanJadwalPelajaran(){
        return view('guru.jadwalpelajaran');
    }
}