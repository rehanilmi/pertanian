<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\PengumumanController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Berita
    Route::resource('berita', BeritaAdminController::class);

    // Upload Gambar Berita
    Route::post('berita/{id}/gambar', [BeritaAdminController::class, 'addImage'])
        ->name('berita.gambar.add');

    // Hapus Gambar
    Route::delete('berita/gambar/{id}', [BeritaAdminController::class, 'deleteImage'])
        ->name('berita.gambar.delete');

    // CRUD Bidang (UUID)
    Route::resource('bidang', BidangController::class)
        ->parameters(['bidang' => 'uuid']);

    Route::resource('pengumuman', PengumumanController::class)
        ->parameters(['pengumuman' => 'uuid']);

});


// =============================
// FRONTEND ROUTES
// =============================

// Home / Beranda
Route::get('/', [BeritaController::class, 'home'])->name('home');

// Daftar berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// Detail berita berdasarkan slug
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{uuid}', [PengumumanController::class, 'show'])->name('pengumuman.show');
