<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda.
|
*/

// Halaman Utama (Welcome)
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup Rute yang membutuhkan Login (Auth)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- Fitur Utama: Movie Watchlist ---
    // Menampilkan Dashboard & Daftar Film
    Route::get('/dashboard', [MovieController::class, 'index'])->name('dashboard');
    
    // Menambah Film Baru
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    
    // Mengupdate Status (Sudah/Belum Ditonton)
    Route::patch('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    
    // Menghapus Film
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');


    // --- Fitur Profil User (Opsional) ---
    // Rute ini harus ada agar tidak error jika tombol profil di-klik
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute autentikasi bawaan Breeze (login, register, logout, dll)
require __DIR__.'/auth.php';