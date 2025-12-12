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
            // PERBAIKAN 1: Ganti 'unique:testimoni' menjadi 'unique:tbl_testimoni'
            'kode_pesanan' => 'required|string|unique:tbl_testimoni,kode_pesanan',
            'nama'         => 'required|string|max:100',
            'kota'         => 'required|string|max:50',
            'rating'       => 'required|integer|min:1|max:5',
            'isi'          => 'required|string|min:5',
        ], [
            'kode_pesanan.unique' => 'Ulasan untuk pesanan ini sudah terdaftar.',
            'rating.required'     => 'Mohon berikan rating bintang.',
        ]);

        // 2. Simpan ke Database
        // PERBAIKAN 2: Gunakan nama tabel 'tbl_testimoni'
        DB::table('tbl_testimoni')->insert([
            'kode_pesanan'   => $request->kode_pesanan,
            'nama_pelanggan' => $request->nama,
            'kota'           => $request->kota,
            'rating'         => $request->rating,
            'isi_testimoni'  => $request->isi,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // 3. Update status pesanan
        // PERBAIKAN 3: Gunakan nama tabel 'tbl_pesanan'
        DB::table('tbl_pesanan')
            ->where('kode_pesanan', $request->kode_pesanan)
            ->update(['is_reviewed' => true]);

        // 4. Redirect kembali ke halaman utama
        return redirect('/')->with('success_testimoni', 'Terima kasih! Ulasan Anda telah berhasil dikirim dan akan tampil di beranda.');
    }
}