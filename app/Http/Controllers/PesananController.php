<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; // Pastikan Model Pesanan sudah diimport

class PesananController extends Controller
{
    // 1. Fungsi Menampilkan Halaman Beranda & Katalog
    // 1. Fungsi Menampilkan Halaman Beranda & Katalog
    public function index()
    {
        // HAPUS semua array $produk = [...] yang panjang itu.
        
        // GANTI DENGAN INI:
        // Ambil semua data dari database, urutkan dari yang terbaru
        $produk = \App\Models\Produk::latest()->get();

        return view('beranda', compact('produk'));
    }

    // 2. Fungsi Memproses Pesanan (Simpan DB -> Redirect WA)
    public function kirimPesanan(Request $request)
    {
        // 1. Validasi (Sama seperti sebelumnya)
        $request->validate([
            'nama' => 'required',
            'no_wa' => 'required|numeric',
            'detail' => 'required',
        ]);

        // 2. Simpan ke Database (Sama seperti sebelumnya)
        Pesanan::create([
            'nama_pelanggan' => $request->nama,
            'no_whatsapp'    => $request->no_wa,
            'detail_pesanan' => $request->detail,
            'status'         => 'Baru Masuk', 
        ]);

        // 3. Siapkan Link WhatsApp
        $nomorAdmin = '6281937536701'; // Ganti No HP Admin
        
        $pesanWA = "Halo Aneka Usaha, saya ingin memesan.%0A";
        $pesanWA .= "Nama: " . $request->nama . "%0A";
        $pesanWA .= "No WA: " . $request->no_wa . "%0A";
        $pesanWA .= "Detail: " . $request->detail;

        $linkWA = "https://wa.me/$nomorAdmin?text=$pesanWA";

        // --- PERUBAHAN DI SINI ---
        // Jangan langsung redirect, tapi tampilkan halaman sukses
        // Kita kirim variabel $linkWA ke view agar tombolnya berfungsi
        return view('sukses', compact('linkWA'));
    }

    // Tambahkan fungsi ini di dalam class PesananController
    public function cekStatus(Request $request)
    {
        // Ambil input 'kode' dari URL (?kode=...)
        $keyword = $request->kode;

        // Cari di database: Apakah ID Pesanan = keyword ATAU No WA = keyword?
        $pesanan = \App\Models\Pesanan::where('id_pesanan', $keyword)
                    ->orWhere('no_whatsapp', $keyword)
                    ->latest('created_at') // Ambil yang terbaru jika ada duplikat
                    ->first(); // Ambil satu saja

        if ($pesanan) {
            // Jika ketemu, kirim data JSON
            return response()->json([
                'status' => 'found',
                'data' => $pesanan
            ]);
        } else {
            // Jika tidak ketemu
            return response()->json(['status' => 'not_found']);
        }
    }


}