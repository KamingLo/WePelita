<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        // Simpan komentar, commentator adalah profile yang login
        $postingan->comment($request->comment, Auth::user());

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function showProfile()
    {
        return view('admin.ProfileUser', ['profile' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $profile = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:profiles,email,' . $profile->profile_id . ',profile_id',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB max
        ]);

        // Update email
        $profile->email = $validated['email'];

        // Update password if provided
        if (!empty($validated['password'])) {
            $profile->password = Hash::make($validated['password']);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }

            // Store new avatar
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('avatars', $filename, 'public');
            $profile->avatar = $path;
        }

        $profile->save();

        return redirect()->route('postingan.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}