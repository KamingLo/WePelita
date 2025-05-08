<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\JadwalPelajaranController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', function() {return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('/admin/register', [AdminController::class, 'showForm']);
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');

    Route::get('admin/pelajaran', [PelajaranController::class, 'create'])->name('admin.pelajaran');
    Route::post('admin/pelajaran', [PelajaranController::class, 'store'])->name('admin.pelajaran');

    Route::get('admin/jadwal', [JadwalPelajaranController::class, 'index'])->name('admin.jadwal');
    Route::post('admin/jadwal/store', [JadwalPelajaranController::class, 'store'])->name('jadwal.store');
    Route::put('admin/jadwal/update/{id}', [JadwalPelajaranController::class, 'update'])->name('jadwal.update');
    Route::delete('admin/jadwal/destroy/{id}', [JadwalPelajaranController::class, 'destroy'])->name('jadwal.destroy');
});