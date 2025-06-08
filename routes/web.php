<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\AnnouncementController;
use App\Models\Admin;
use App\Models\Guru;
use App\Exports\JadwalPelajaranExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [AdminController::class, 'index'])->name('home');
Route::get('/blog', [AdminController::class, 'tampilkanBlog'])->name('blog');
Route::get('/blog/{postingan}', [AdminController::class, 'tampilkanBlogDetail'])->name('blog.show');

Route::get('/postingan/{id}', [PostinganController::class, 'show'])->name('postingan.show');
Route::post('/postingan/{id}/comment', [PostinganController::class, 'storeComment'])->name('postingan.comment');

Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AdminController::class, 'register'])->name('register.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [PostinganController::class, 'showProfile'])->name('postingan.profile.show');
    Route::put('/profile', [PostinganController::class, 'updateProfile'])->name('postingan.profile.update');
});

Route::middleware([RoleMiddleware::class.':admin'])->group(function () {
    Route::get('admin/dashboard', function() {
        $admin = Admin::where('profile_id', auth()->id())->firstOrFail();
        return view('admin.dashboard', compact('admin'));
    })->name('admin.dashboard');

    Route::get('admin/downloaduser/{role}', [AdminController::class, 'exportUser'])->name('admin.downloaduser');
    Route::get('/admin/register', [AdminController::class, 'formUser']);
    Route::post('/admin/register', [AdminController::class, 'tambahkanUser'])->name('admin.register');

    Route::get('admin/TambahPelajaran', [AdminController::class, 'tampilkanPelajaran'])->name('admin.TambahPelajaran');
    Route::post('admin/TambahPelajaran', [AdminController::class, 'simpanPelajaran'])->name('admin.TambahPelajaran');
    
    Route::get('admin/pelajaran/edit/{id}', [AdminController::class, 'tampilkanUpdatePelajaran'])->name('pelajaran.update');
    Route::put('admin/pelajaran/edit/{id}', [AdminController::class, 'updatePelajaran'])->name('pelajaran.update');
    Route::delete('admin/pelajaran/destroy/{id}', [AdminController::class, 'hapusPelajaran'])->name('pelajaran.destroy');

    Route::get('admin/TambahJadwal', [AdminController::class, 'tampilkanJadwal'])->name('admin.TambahJadwal');
    Route::post('admin/TambahJadwal/store', [AdminController::class, 'simpanJadwal'])->name('TambahJadwal.store');
    
    Route::get('admin/jadwal/edit/{id}', [AdminController::class, 'tampilkanUpdateJadwal'])->name('jadwal.update');
    Route::put('admin/jadwal/edit/{id}', [AdminController::class, 'updateJadwal'])->name('jadwal.update');
    Route::delete('admin/jadwal/destroy/{id}', [AdminController::class, 'hapusJadwal'])->name('jadwal.destroy');
    
    Route::get('admin/manajemenKelas', [AdminController::class, 'tampilkanManajemenKelas'])->name('admin.manajemenKelas');
    Route::post('admin/manajemenKelas', [AdminController::class, 'tambahKelas'])->name('admin.tambahKelas');
    Route::get('admin/manajemenKelas/edit/{id}', [AdminController::class, 'tampilkanUpdateKelas'])->name('kelas.update');
    Route::put('admin/manajemenKelas/edit/{id}', [AdminController::class, 'updateKelas'])->name('kelas.update');
    Route::delete('admin/manajemenKelas/destroy/{id}', [AdminController::class, 'hapusKelas'])->name('kelas.destroy');
    
    Route::get('admin/kenaikanKelas', [AdminController::class, 'tampilkanFormKenaikanKelas'])->name('admin.kenaikanKelas');
    Route::post('admin/kenaikanKelas', [AdminController::class, 'prosesKenaikanKelas'])->name('admin.prosesKenaikanKelas');

    Route::get('admin/manajemenPost', [AdminController::class, 'tampilkanManajemenPost'])->name('admin.manajemenPost');
    Route::post('admin/manajemenPost', [AdminController::class, 'tambahPostingan'])->name('admin.post.tambah');
    Route::get('admin/manajemenPost/edit/{id}', [AdminController::class, 'editPostingan'])->name('admin.post.edit');
    Route::put('admin/manajemenPost/edit/{id}', [AdminController::class, 'updatePostingan'])->name('admin.post.update');
    Route::delete('admin/manajemenPost/destroy/{id}', [AdminController::class, 'hapusPostingan'])->name('admin.post.hapus');

    Route::get('admin/ManajemenUser', [AdminController::class, 'tampilkanManajemenUser'])->name('admin.ManajemenUser');
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::put('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/admin/user/delete/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');

    Route::get('admin/export-jadwal', function () {
        return Excel::download(new JadwalPelajaranExport, 'jadwal-pelajaran.xlsx');
    })->name('admin.export');

    Route::get('admin/NilaiSiswa', [AdminController::class, 'tampilkanNilai'])->name('admin.tampilkanNilai');
    Route::get('admin/export-nilai/{kelas_tahun_id}/{pelajaran_id}', [AdminController::class, 'exportNilai'])->name('admin.export.nilai');
});

Route::middleware([RoleMiddleware::class.':guru'])->group(function() {
    Route::get('guru/dashboard', function() {
        $guru = Guru::where('profile_id', auth()->id())->firstOrFail();
        return view('guru.dashboard', compact('guru'));
    })->name('guru.dashboard');

    Route::get('guru/jadwal', [GuruController::class, 'tampilkanJadwalPelajaran'])->name('guru.jadwal');
    Route::get('guru/jadwalanda', [GuruController::class, 'tampilkanJadwalAnda'])->name('guru.jadwalanda');
    Route::get('guru/menu-nilai', [GuruController::class, 'tampilkanMenuNilai'])->name('guru.isinilai');
    Route::post('guru/menu-nilai', [GuruController::class, 'simpanNilai'])->name('guru.isinilai');

    Route::get('guru/ManajemenPost', [GuruController::class, 'tampilkanManajemenPost'])->name('guru.ManajemenPost');
    Route::post('guru/ManajemenPost', [GuruController::class, 'tambahPostingan'])->name('guru.post.tambah');
    Route::get('guru/manajemenPost/edit/{id}', [GuruController::class, 'editPostingan'])->name('guru.post.edit');
    Route::put('guru/manajemenPost/edit/{id}', [GuruController::class, 'updatePostingan'])->name('guru.post.update');
    Route::delete('guru/manajemenPost/destroy/{id}', [GuruController::class, 'hapusPostingan'])->name('guru.post.hapus');

    Route::get('/export-jadwal', function () {
        return Excel::download(new JadwalPelajaranExport, 'jadwal-pelajaran.xlsx');
    });

    Route::get('guru/export-nilai/{kelas_tahun_id}/{pelajaran_id}', function ($kelas_tahun_id, $pelajaran_id) {
        return Excel::download(new \App\Exports\NilaiMuridExport($kelas_tahun_id, $pelajaran_id), 'nilai-murid.xlsx');
    })->name('guru.export.nilai');

    Route::get('guru/', function() {
        return view('guru.post');
    })->name('guru.post');

    Route::get('/guru/ceknilai/download', [GuruController::class, 'downloadNilai'])->name('guru.nilai.download');
});

// Route::middleware([RoleMiddleware::class.':orangtua,murid'])->group(function () {
//     Route::get('/announcement/{id}', [MuridController::class, 'getAnnouncement'])->name('announcement.show');
// });

Route::middleware([RoleMiddleware::class.':murid'])->group(function() {
    Route::get('murid/dashboard', [MuridController::class, 'dashboard'])->name('murid.dashboard');
    Route::get('murid/jadwal', [MuridController::class, 'jadwalKelas'])->name('murid.jadwal');
    Route::get('murid/export-jadwal', [MuridController::class, 'exportJadwal'])->name('murid.export');
    Route::get('murid/nilai', [MuridController::class, 'nilaiKelas'])->name('murid.nilai');
    Route::get('murid/pengumuman', [MuridController::class, 'pengumuman'])->name('murid.pengumuman');
    Route::get('/announcement/murid/{id}', [MuridController::class, 'getAnnouncement'])->name('announcement.murid.show');
    
});

Route::middleware([RoleMiddleware::class.':orangtua'])->group(function() {
    Route::get('orangtua/dashboard', [OrangTuaController::class, 'dashboard'])->name('orangtua.dashboard');
    Route::get('orangtua/jadwal', [OrangTuaController::class, 'jadwalKelas'])->name('orangtua.jadwal');
    Route::get('orangtua/nilai', [OrangTuaController::class, 'nilaiKelas'])->name('orangtua.nilai');
    Route::get('orangtua/pengumuman', [OrangTuaController::class, 'pengumuman'])->name('orangtua.pengumuman');
    Route::get('orangtua/export-jadwal', [OrangTuaController::class, 'exportJadwal'])->name('orangtua.export-jadwal');
    Route::get('/announcement/orangtua/{id}', [OrangTuaController::class, 'getAnnouncement'])->name('announcement.orangtua.show');
});

Route::fallback(function () {
    return redirect('/');
});