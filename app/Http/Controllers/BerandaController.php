<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    /**
     * Menampilkan halaman utama (Beranda)
     * Memuat data produk, testimoni, dan portofolio terbaru
     */
    public function index()
    {
        // 1. Ambil semua data produk
        // Pastikan nama tabel sesuai dengan di database (tbl_produk)
        $produk = DB::table('tbl_produk')->get();

        // 2. Ambil data testimoni
        // Hanya ambil yang 'is_visible' = true (fitur moderasi admin)
        $testimoni = DB::table('tbl_testimoni')
                        ->where('is_visible', true)
                        ->orderBy('created_at', 'desc')
                        ->limit(6)
                        ->get();

        // 3. AMBIL DATA PORTOFOLIO (BARU - TAHAP 4)
        // Ambil data dari tabel 'tbl_portofolio', urutkan dari yang terbaru
        $portofolio = DB::table('tbl_portofolio')
                        ->orderBy('created_at', 'desc')
                        ->get();

        // 4. Kirim ketiga variabel tersebut ke view 'beranda'
        return view('beranda', compact('produk', 'testimoni', 'portofolio'));
    }
}