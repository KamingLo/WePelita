<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            $profile = Auth::user();
            $validated = $request->validated();

            // Update email
            $profile->email = $validated['email'];

            // Update password if provided
            if (!empty($validated['password'])) {
                $profile->password = Hash::make($validated['password']);
                Log::info('Password updated for profile', ['profile_id' => $profile->profile_id]);
            }

            // Handle avatar deletion if requested
            if ($request->input('delete_avatar', 0) == '1') {
                if ($profile->avatar && File::exists(public_path('storage/file/' . $profile->avatar))) {
                    File::delete(public_path('storage/file/' . $profile->avatar));
                    $profile->avatar = null; // Clear the avatar field in the database
                    Log::info('Deleted avatar', ['path' => $profile->avatar]);
                }
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($profile->avatar && File::exists(public_path('storage/file/' . $profile->avatar))) {
                    File::delete(public_path('storage/file/' . $profile->avatar));
                    Log::info('Deleted old avatar', ['path' => $profile->avatar]);
                }

                // Save new avatar
                $file = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/file'), $filename);
                $profile->avatar = $filename;
                Log::info('Avatar uploaded', ['filename' => $filename]);
            }

            $profile->save();
            Log::info('Profile updated', ['profile_id' => $profile->profile_id, 'avatar' => $profile->avatar]);

            return redirect()->route('postingan.profile.show')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Failed to update profile', [
                'error' => $e->getMessage(),
                'profile_id' => Auth::user()->profile_id,
            ]);
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
    }
}