<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Models\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', function() {
        $admin = Admin::findOrFail(auth()->id());
        return view('admin.dashboard', compact('admin'));
    })->name('admin.dashboard');

    Route::get('/admin/register', [AdminController::class, 'formUser']);
    Route::post('/admin/register', [AdminController::class, 'tambahkanUser'])->name('admin.register');

    Route::get('admin/pelajaran', [AdminController::class, 'tampilkanPelajaran'])->name('admin.pelajaran');
    Route::post('admin/pelajaran', [AdminController::class, 'simpanPelajaran'])->name('admin.pelajaran');
    
    Route::get('admin/pelajaran/edit/{id}', [AdminController::class, 'tampilkanUpdatePelajaran'])->name('pelajaran.update');
    Route::put('admin/pelajaran/edit/{id}', [AdminController::class, 'updatePelajaran'])->name('pelajaran.update');
    Route::delete('admin/pelajaran/destroy/{id}', [AdminController::class, 'hapusPelajaran'])->name('pelajaran.destroy');

    Route::get('admin/jadwal', [AdminController::class, 'tampilkanJadwal'])->name('admin.jadwal');
    Route::post('admin/jadwal/store', [AdminController::class, 'simpanJadwal'])->name('jadwal.store');
    
    Route::get('admin/jadwal/edit/{id}', [AdminController::class, 'tampilkanUpdateJadwal'])->name('jadwal.update');
    Route::put('admin/jadwal/edit/{id}', [AdminController::class, 'updateJadwal'])->name('jadwal.update');
    Route::delete('admin/jadwal/destroy/{id}', [AdminController::class, 'hapusJadwal'])->name('jadwal.destroy');
    
    Route::get('admin/post', [AdminController::class, 'tampilkanPost'])->name('admin.post');
    Route::post('admin/post', [AdminController::class, 'tambahPostingan'])->name('admin.posting');
    
    Route::get('admin/manajemenPost', [AdminController::class, 'tampilkanManajemenPost'])->name('admin.manajemenPost');

    Route::get('admin/manajemenPost/pengumuman/update/{id}', [AdminController::class, 'tampilkanPengumuman'])->name('pengumuman.update');
    Route::post('admin/manajemenPost/pengumuman/update/{id}', [AdminController::class, 'updatePengumuman'])->name('edit.pengumuman');
    Route::delete('admin/manajemenPost/pengumuman/destroy/{id}', [AdminController::class, 'hapusPengumuman'])->name('pengumuman.destroy');

    Route::get('admin/manajemenPost/kegiatan/update/{id}', [AdminController::class, 'tampilkanKegiatan'])->name('kegiatan.update');
    Route::post('admin/manajemenPost/kegiatan/update/{id}', [AdminController::class, 'updateKegiatan'])->name('edit.kegiatan');
    Route::delete('admin/manajemenPost/kegiatan/destroy/{id}', [AdminController::class, 'hapusKegiatan'])->name('kegiatan.destroy');

    route::get('admin/manajemenUser', [AdminController::class, 'tampilkanManajemenUser'])->name('admin.manajemenUser');

    Route::get('/admin/user/edit/{id}', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::put('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/admin/user/delete/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');

});