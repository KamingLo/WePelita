<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Guru;
use App\Models\Admin;
use App\Models\OrangTua;
use App\Models\Murid;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
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
                    'status' => 'required|string',
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
                    'Status' => $request->status,
                ]);
                break;
        }

        return redirect()->route('admin.register');
    }
}
