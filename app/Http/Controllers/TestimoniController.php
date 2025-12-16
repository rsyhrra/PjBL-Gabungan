<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib ada untuk akses database manual

class TestimoniController extends Controller
{
    /**
     * Menampilkan halaman form tulis testimoni
     */
    public function halamanTulisTestimoni($kode_pesanan)
    {
        // 1. Cek apakah pesanan ada di tbl_pesanan
        $pesanan = DB::table('tbl_pesanan')->where('kode_pesanan', $kode_pesanan)->first();

        if (!$pesanan) {
            return redirect('/')->with('error_testimoni', 'Kode pesanan tidak valid.');
        }

        // 2. Cek apakah sudah pernah diulas
        $sudahUlas = DB::table('tbl_testimoni')
            ->where('kode_pesanan', $kode_pesanan)
            ->exists();

        if ($sudahUlas) {
            return redirect('/')->with('error_testimoni', 'Pesanan ini sudah pernah diulas sebelumnya.');
        }

        return view('tulis_testimoni', compact('kode_pesanan'));
    }

    /**
     * Memproses penyimpanan data testimoni
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

        // 2. Simpan ke Database (Gunakan DB::table agar pasti masuk ke tbl_testimoni)
        try {
            DB::table('tbl_testimoni')->insert([
                'kode_pesanan'   => $request->kode_pesanan,
                'nama_pelanggan' => $request->nama,
                'kota'           => $request->kota,
                'rating'         => $request->rating,
                'isi_testimoni'  => $request->isi,
                'is_visible'     => 1, // Langsung tampilkan (1 = true)
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // 3. Update status pesanan jadi "sudah direview"
            DB::table('tbl_pesanan')
                ->where('kode_pesanan', $request->kode_pesanan)
                ->update(['is_reviewed' => 1]);

            // 4. REDIRECT KE BERANDA (Ini yang membuat kembali ke halaman awal)
            return redirect('/')->with('success_testimoni', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');

        } catch (\Exception $e) {
            // Jika ada error database, kembalikan ke form dengan pesan error
            return back()->withErrors(['msg' => 'Gagal menyimpan ulasan: ' . $e->getMessage()]);
        }
    }
}