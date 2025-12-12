<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================

// Halaman Utama (Beranda)
Route::get('/', [BerandaController::class, 'index'])->name('home');

// Halaman Pesan (Jika ada)
Route::get('/pesan', function () { return view('pesan'); });

// Fitur Cek Status & Invoice
Route::get('/cek-status', [PesananController::class, 'cekStatus'])->name('pesanan.status');
Route::get('/invoice/{kode}', [PesananController::class, 'invoice'])->name('pesanan.invoice');
Route::post('/proses-pesanan', [PesananController::class, 'kirimPesanan'])->name('pesanan.kirim');

// Fitur Tulis Testimoni (Frontend)
Route::get('/tulis_testimoni/{kode_pesanan}', [TestimoniController::class, 'halamanTulisTestimoni'])->name('testimoni.form');
Route::post('/kirim-testimoni', [TestimoniController::class, 'kirimTestimoni'])->name('testimoni.kirim');


// ==========================================
// 2. RUTE OTENTIKASI ADMIN
// ==========================================
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'processLogin'])->name('admin.login.proses');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


// ==========================================
// 3. RUTE ADMIN DASHBOARD (Wajib Login)
// ==========================================
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // --- MANAJEMEN PRODUK ---
    Route::post('/produk/store', [AdminController::class, 'storeProduk'])->name('produk.store');
    Route::put('/produk/update/{id}', [AdminController::class, 'updateProduk'])->name('produk.update');
    Route::delete('/produk/delete/{id}', [AdminController::class, 'deleteProduk'])->name('produk.delete');

    // --- MANAJEMEN PESANAN ---
    Route::put('/pesanan/update-status/{id}', [AdminController::class, 'updateStatusPesanan'])->name('pesanan.update');
    Route::delete('/pesanan/delete/{id}', [AdminController::class, 'deletePesanan'])->name('pesanan.delete');

    // --- MANAJEMEN ULASAN / TESTIMONI ---
    Route::post('/testimoni/reply/{id}', [AdminController::class, 'replyTestimoni'])->name('testimoni.reply');
    Route::get('/testimoni/toggle/{id}', [AdminController::class, 'toggleTestimoni'])->name('testimoni.toggle');
    Route::delete('/testimoni/delete/{id}', [AdminController::class, 'deleteTestimoni'])->name('testimoni.delete');
    Route::post('/testimoni/store', [AdminController::class, 'storeTestimoni'])->name('testimoni.store');

    // --- MANAJEMEN PORTOFOLIO (BARU) ---
    // Rute untuk menyimpan data portofolio baru
    Route::post('/portofolio/store', [AdminController::class, 'storePortofolio'])->name('portofolio.store');
    
    // Rute untuk menghapus portofolio
    Route::delete('/portofolio/delete/{id}', [AdminController::class, 'deletePortofolio'])->name('portofolio.delete');

});