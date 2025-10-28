<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [BeritaController::class, 'home'])->name('home');
