<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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

        $postingan->comment($request->comment, Auth::user());

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function showProfile()
    {
        return view('ProfileUser', ['profile' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $profile = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:profiles,email,' . $profile->profile_id . ',profile_id',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $profile->email = $validated['email'];

        if (!empty($validated['password'])) {
            $profile->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($profile->avatar && File::exists(public_path('storage/file/' . $profile->avatar))) {
                File::delete(public_path('storage/file/' . $profile->avatar));
                \Log::info('Deleted old avatar', ['path' => $profile->avatar]);
            }

            // Simpan avatar baru
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/file'), $filename); // Simpan langsung ke public/storage/file
            $profile->avatar = $filename; // Simpan nama file saja di database
            \Log::info('Avatar uploaded', ['filename' => $filename]);
        }

        $profile->save();
        \Log::info('Profile updated', ['profile_id' => $profile->profile_id, 'avatar' => $profile->avatar]);

        return redirect()->route('postingan.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}