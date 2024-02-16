<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\HasilAnalisisController;

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/search', [AdminController::class, 'index'])->name('search');

// Rute untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rute untuk admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
//Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');//

// Rute untuk halaman admin
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

//Rute untuk halaman hasil
Route::middleware('auth:admin')->group(function () {
    Route::get('analisis/hasil', [AnalisisController::class, 'hasil'])->name('analisis.hasil');
});

//Rute untuk menyimpan hasil
Route::post("/simpan-hasil", [HasilAnalisisController::class, "simpanHasil"]);

//Rute untuk cancel
Route::post('/users/{userId}/update-status', [UserController::class, 'updateStatus'])->name('users.update_status');