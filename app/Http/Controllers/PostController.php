<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function editKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.edit-kegiatan', compact('kegiatan'));
    }

    public function updateKegiatan(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'isi_kegiatan' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        try {
            $lampiranPath = $kegiatan->lampiran;
            if ($request->hasFile('lampiran')) {
                if ($lampiranPath && Storage::disk('public')->exists($lampiranPath)) {
                    Storage::disk('public')->delete($lampiranPath);
                }
                $lampiranPath = $request->file('lampiran')->store('uploads', 'public');
            }
            
            $kegiatan->update([
                'judul_kegiatan' => $validated['judul_kegiatan'],
                'isi_kegiatan' => $validated['isi_kegiatan'],
                'lampiran' => $lampiranPath,
            ]);
            
            return redirect()->route('admin.manajemenPost', ['TipePost' => 'kegiatan'])
                ->with('success', 'Kegiatan berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Failed to update kegiatan: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Gagal mengupdate kegiatan: ' . $e->getMessage()]);
        }
    }

    public function destroyKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        try {
            if ($kegiatan->lampiran && Storage::disk('public')->exists($kegiatan->lampiran)) {
                Storage::disk('public')->delete($kegiatan->lampiran);
            }
            $kegiatan->delete();
            
            return redirect()->route('admin.manajemenPost', ['TipePost' => 'kegiatan'])
                ->with('success', 'Kegiatan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Failed to delete kegiatan: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal menghapus kegiatan: ' . $e->getMessage()]);
        }
    }
}