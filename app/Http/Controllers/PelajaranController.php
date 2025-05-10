namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tipe' => 'required|in:pengumuman,kegiatan',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|max:2048',
        ]);

        // Simpan lampiran jika ada
        $lampiran = null;
        if ($request->hasFile('lampiran')) {
            $lampiran = file_get_contents($request->file('lampiran')->getRealPath());
        }

        // Simulasi ambil ID admin yang sedang login (ganti dengan auth jika ada)
        $adminId = 1;

        // Masukkan data ke tabel sesuai tipe
        if ($validated['tipe'] === 'pengumuman') {
            DB::table('pengumuman')->insert([
                'admin_id' => $adminId,
                'judul_pengumuman' => $validated['judul'],
                'isi_pengumuman' => $validated['isi'],
                'lampiran' => $lampiran,
                'created_at' => now(),
            ]);
        } else {
            DB::table('kegiatan')->insert([
                'admin_id' => $adminId,
                'judul_kegiatan' => $validated['judul'],
                'isi_kegiatan' => $validated['isi'],
                'lampiran' => $lampiran,
                'created_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Postingan berhasil dibuat!');
    }
}
