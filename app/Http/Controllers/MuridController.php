<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    public function dashboard()
    {
        $murid = Auth::user()->murid;
        $announcements = Postingan::where('tipe', 'pengumuman')
            ->where(function ($query) use ($murid) {
                $query->where('tujuan', $murid->kelas_tahun_id)
                      ->orWhereNull('tujuan');
            })
            ->with('profile')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('murid.dashboard', compact('murid', 'announcements'));
    }
}