<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\SupplierStockController;
use App\Http\Controllers\Admin\SeedVarietyController;
use App\Http\Controllers\PerbenihanController;
use Illuminate\Support\Facades\Artisan;

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

    Route::resource('suppliers', SupplierController::class)
        ->parameters(['suppliers' => 'uuid']);

    Route::resource('supplier_stocks', SupplierStockController::class)
        ->parameters(['supplier_stocks' => 'uuid']);

    Route::resource('varieties', SeedVarietyController::class)
        ->parameters(['varieties' => 'uuid']);

    Route::post('supplier-stocks/update-stock', [SupplierStockController::class, 'updateStock']
    )->name('supplier_stocks.updateStock');

    Route::get('supplier-stocks/logs', [SupplierStockController::class, 'logs'])
        ->name('supplier_stocks.logs');


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

Route::get('/get-regencies/{province_id}', function($province_id) {
    return DB::table('regencies')
        ->where('province_id', $province_id)
        ->orderBy('name')
        ->get();
});

Route::get('/get-districts/{regency_id}', function($regency_id) {
    return DB::table('districts')
        ->where('regency_id', $regency_id)
        ->orderBy('name')
        ->get();
});

Route::get('/get-villages/{district_id}', function($district_id){
    return DB::table('villages')
        ->where('district_id', $district_id)
        ->orderBy('name')
        ->get();
});


Route::get('/perbenihan', [PerbenihanController::class, 'index'])
    ->name('perbenihan.index');



Route::get('/run-migrate', function () {
    Artisan::call('migrate --force');
    return "Migrasi selesai";
});

Route::get('/run-migrate-fresh', function () {
    Artisan::call('migrate:fresh --force');
    return "Migrate fresh selesai";
});

Route::get('/run-seed', function () {
    Artisan::call('db:seed --force');
    return "Seeding selesai";
});

Route::get('/run-cache-fix', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache fixed";
});

Route::get('/run-storage', function () {
    Artisan::call('storage:link');
    return "Storage linked";
});

