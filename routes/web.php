<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', function() {return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('/admin/register', [AdminController::class, 'tampilkanForm']);
    Route::post('/admin/register', [AdminController::class, 'daftarUser'])->name('admin.register');

    Route::get('admin/pelajaran', [AdminController::class, 'buatPelajaran'])->name('admin.pelajaran');
    Route::post('admin/pelajaran', [AdminController::class, 'simpanPelajaran'])->name('admin.pelajaran');

    Route::get('admin/jadwal', [AdminController::class, 'tampilkanJadwal'])->name('admin.jadwal');
    Route::post('admin/jadwal/store', [AdminController::class, 'simpanJadwal'])->name('jadwal.store');
    Route::post('admin/jadwal/update/{id}', [AdminController::class, 'updateJadwal']);
    Route::get('admin/jadwal/update/{id}', [AdminController::class, 'tampilkanUpdateJadwal'])->name('jadwal.update');
    Route::delete('admin/jadwal/destroy/{id}', [AdminController::class, 'hapusJadwal'])->name('jadwal.destroy');
    
    Route::get('admin/post', function() {return view('admin.post');})->name('admin.post');
});