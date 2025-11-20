<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk; // Pastikan Model Produk diimport
use Illuminate\Support\Str;

class PesananController extends Controller
{
    // 1. Halaman Beranda (Katalog)
    public function index()
    {
        // Ambil semua produk dari database, urutkan dari yang terbaru
        // Data ini akan dikirim ke view 'beranda' untuk ditampilkan di slider
        $produk = Produk::latest('id_produk')->get();

        return view('beranda', compact('produk'));
    }

    // 2. Proses Kirim Pesanan (Form -> DB -> Halaman Sukses)
    public function kirimPesanan(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|numeric',
            'detail' => 'required|string',
        ]);

        // B. Generate Kode Pesanan Unik (Format: AU-YYMMDD-XXX)
        // Contoh: AU-251120-A7B
        $tanggal = now()->format('ymd'); 
        $random = strtoupper(Str::random(3));
        $kodeUnik = 'AU-' . $tanggal . '-' . $random;

        // C. Simpan ke Database
        Pesanan::create([
            'kode_pesanan'   => $kodeUnik,
            'nama_pelanggan' => $request->nama,
            'no_whatsapp'    => $request->no_wa,
            'detail_pesanan' => $request->detail,
            'status'         => 'Baru Masuk', // Default status
            // 'file_desain' => $namaFile (Jika ada upload file, tambahkan logika upload di sini)
        ]);

        $linkInvoice = url('/invoice/' . $kodeUnik);

        // D. Siapkan Link WhatsApp untuk Admin
        $nomorAdmin = '6281937536701'; 
        
        $pesanWA = "Halo Aneka Usaha, saya ingin memesan.%0A";
        $pesanWA .= "No Order: *" . $kodeUnik . "*%0A";
        $pesanWA .= "Nama: " . $request->nama . "%0A";
        $pesanWA .= "Detail: " . $request->detail . "%0A";
        $pesanWA .= "%0A--------------------%0A";
        $pesanWA .= "Lihat Invoice Saya:%0A" . $linkInvoice; // <--- INI TAMBAHANNYA

        $linkWA = "https://wa.me/$nomorAdmin?text=$pesanWA";

        return view('sukses', compact('linkWA'));
    }

    // 3. API Cek Status Pesanan (AJAX)
    public function cekStatus(Request $request)
    {
        // Ambil input keyword dari URL
        $keyword = $request->kode;

        // Cari pesanan berdasarkan ID Pesanan, Kode Unik, atau No WA
        $pesanan = Pesanan::where('kode_pesanan', $keyword)
                    ->orWhere('id_pesanan', $keyword)
                    ->orWhere('no_whatsapp', $keyword)
                    ->latest('created_at') // Ambil yang paling baru jika ada duplikat no WA
                    ->first();

        if ($pesanan) {
            // Jika data ditemukan, kembalikan dalam format JSON
            return response()->json([
                'status' => 'found',
                'data' => $pesanan
            ]);
        } else {
            // Jika tidak ditemukan
            return response()->json(['status' => 'not_found']);
        }
    }

    public function invoice($kode)
    {
        // Cari pesanan berdasarkan Kode Unik
        $pesanan = Pesanan::where('kode_pesanan', $kode)->firstOrFail();
        
        // Cari detail produk (opsional, jika ingin menampilkan foto produk di invoice)
        // Karena di tabel pesanan belum ada id_produk, kita asumsikan detail pesanan teks saja dulu.
        
        return view('invoice', compact('pesanan'));
    }
}