<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimoniController extends Controller
{
    /**
     * Menampilkan halaman form tulis testimoni
     */
    public function halamanTulisTestimoni($kode_pesanan)
    {
        // 1. CEK DUPLIKASI: Menggunakan 'tbl_testimoni' (SUDAH BENAR)
        $sudahUlas = DB::table('tbl_testimoni')
            ->where('kode_pesanan', $kode_pesanan)
            ->exists();

        if ($sudahUlas) {
            return redirect('/')->with('error_testimoni', 'Maaf, pesanan ini sudah pernah diulas sebelumnya.');
        }

        return view('tulis_testimoni', compact('kode_pesanan'));
    }

    /**
     * Memproses penyimpanan data testimoni ke database
     */
     public function kirimTestimoni(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'kode_pesanan' => 'required|string',
            'nama'         => 'required|string|max:100',
            'kota'         => 'required|string|max:50',
            'rating'       => 'required|integer|min:1|max:5',
            'isi'          => 'required|string|min:5',
        ]);

        // 2. CEK LOGIKA DUPLIKASI (Fix Masalah Kedua)
        // Kita cek manual apakah kode pesanan ini SUDAH ADA di tabel testimoni
        $cekDuplikat = DB::table('tbl_testimoni')
                        ->where('kode_pesanan', $request->kode_pesanan)
                        ->exists();

        if ($cekDuplikat) {
            // Jika sudah ada, jangan simpan, kembalikan dengan error
            return redirect('/')->with('error_testimoni', 'Maaf, pesanan ini sudah pernah diulas sebelumnya.');
        }

        // 3. Simpan ke Database
        DB::table('tbl_testimoni')->insert([
            'kode_pesanan'   => $request->kode_pesanan,
            'nama_pelanggan' => $request->nama,
            'kota'           => $request->kota,
            'rating'         => $request->rating,
            'isi_testimoni'  => $request->isi,
            'is_visible'     => 1, // PENTING: Set ke 1 agar langsung muncul di beranda
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // 4. Update status pesanan di tbl_pesanan agar tombol review hilang
        DB::table('tbl_pesanan')
            ->where('kode_pesanan', $request->kode_pesanan)
            ->update(['is_reviewed' => 1]); // Pastikan update ke 1 (true)

        return redirect('/')->with('success_testimoni', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
    }
}