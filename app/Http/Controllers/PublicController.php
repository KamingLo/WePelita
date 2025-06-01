<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Postingan;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function index()
    {
        $blogs = Postingan::with(['admin.profile', 'guru.profile'])
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('welcome', compact('blogs'));
    }

    public function tampilkanPostingan()
    {
        $kegiatans = Kegiatan::all();
        return view('post', compact('kegiatans'));
    }

    public function tampilkanPostinganByIndex(Request $request, $id)
    {
        $kegiatans = Kegiatan::findOrFail($id);
        return view('blog', compact('kegiatans'));
    }

    public function tampilkanBlog(Request $request)
    {
        $query = Postingan::with(['admin.profile', 'guru.profile'])
            ->where('tipe', 'blog')
            ->orderBy('created_at', 'desc');

        if ($filter = $request->query('filter')) {
            switch ($filter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        $blogs = $query->get();
        
        return view('blog', compact('blogs'));
    }

    public function tampilkanBlogDetail($postingan_id)
    {
        $blog = Postingan::with(['admin.profile', 'guru.profile'])->findOrFail($postingan_id);
        return view('blogFull', compact('blog'));
    }
}