<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class PublicController extends Controller
{
    public function tampilkanPostingan(){
        $kegiatans = Kegiatan::all();
        return view('post', compact('kegiatans'));
    }

    public function tampilkanPostinganByIndex(Request $request, $id){
        $kegiatans = Kegiatan::findOrFail($id);
        return view('blog', compact('kegiatans'));
    }
}