<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminController; // Panggil Controller yang Anda buat sebelumnya

// 1. Rute untuk Halaman Beranda
Route::get('/', function () {
    return view('beranda');
});

// 2. Rute untuk Menampilkan Halaman Formulir
Route::get('/pesan', function () {
    return view('pesan');
});

// 3. Rute untuk Memproses Data Formulir (Logika Hibrid)
// Ini akan memanggil fungsi kirimPesanan di PesananController
Route::post('/proses-pesanan', [PesananController::class, 'kirimPesanan'])->name('pesanan.kirim');

Route::get('/', [PesananController::class, 'index'])->name('home');
Route::get('/cek-status', [PesananController::class, 'cekStatus'])->name('pesanan.status');
// Route post proses-pesanan yang lama tetap ada

// Route Login (Bisa diakses siapa saja yang belum login)
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'processLogin'])->name('admin.login.proses');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route untuk API Cek Status (AJAX)
Route::get('/cek-status', [PesananController::class, 'cekStatus'])->name('pesanan.status');
// Route untuk melihat Invoice (Bisa diakses publik jika punya kodenya)
Route::get('/invoice/{kode}', [App\Http\Controllers\PesananController::class, 'invoice'])->name('pesanan.invoice');
// Route Dashboard (Hanya bisa diakses ADMIN yang sudah LOGIN)
// Kita gunakan middleware 'auth:admin' yang sudah kita setup di config tadi
Route::middleware(['auth:admin'])->group(function () {
    // Dashboard Utama
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // --- CRUD PRODUK ---
    // Simpan Produk Baru
    Route::post('/admin/produk/store', [AdminController::class, 'storeProduk'])->name('admin.produk.store');
    // Update Produk
    Route::put('/admin/produk/update/{id}', [AdminController::class, 'updateProduk'])->name('admin.produk.update');
    // Hapus Produk
    Route::delete('/admin/produk/delete/{id}', [AdminController::class, 'deleteProduk'])->name('admin.produk.delete');

    // --- CRUD PESANAN ---
    // Update Status Pesanan (Proses/Selesai)
    Route::put('/admin/pesanan/update-status/{id}', [AdminController::class, 'updateStatusPesanan'])->name('admin.pesanan.update');
    // Hapus Pesanan
    Route::delete('/admin/pesanan/delete/{id}', [AdminController::class, 'deletePesanan'])->name('admin.pesanan.delete');
});