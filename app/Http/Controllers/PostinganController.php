<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;

class PostinganController extends Controller
{
    public function show($id)
    {
        $postingan = Postingan::with('comments.commentator')->findOrFail($id);
        return view('postingan.show', compact('postingan'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        $postingan = Postingan::findOrFail($id);

        // Simpan komentar, commentator adalah user yang login (Profile)
        $postingan->comment($request->comment, auth()->user());

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
