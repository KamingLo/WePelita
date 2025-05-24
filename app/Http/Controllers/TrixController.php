<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrixController extends Controller
{
    public function index()
    {
        return view('trix-form');
    }

    public function store(Request $request)
    {
        // Simpan konten Trix ke database atau tampilkan sebagai demo
        $content = $request->input('content');

        return view('trix-result', compact('content'));
    }
}
