<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Testimoni; // <--- WAJIB ADA: Panggil Model Testimoni

class TestimoniController extends Controller
{
    /**
     * Menampilkan halaman tulis/edit testimoni
     */
    public function halamanTulisTestimoni($kode_pesanan)
    {
        // 1. Cek Pesanan
        $pesanan = DB::table('tbl_pesanan')->where('kode_pesanan', $kode_pesanan)->first();

        if (!$pesanan) {
            return redirect('/')->with('error_testimoni', 'Kode pesanan tidak valid.');
        }

        // 2. PERBAIKAN: Jangan diblokir! Cek apakah data lama ada?
        $existingTestimoni = Testimoni::where('kode_pesanan', $kode_pesanan)->first();

        // 3. Kirim data pesanan & data testimoni lama (jika ada) ke view
        return view('tulis_testimoni', compact('kode_pesanan', 'pesanan', 'existingTestimoni'));
    }

    /**
     * Memproses penyimpanan (Update jika ada, Create jika baru)
     */
    public function kirimTestimoni(Request $request)
    {
        $request->validate([
            'kode_pesanan' => 'required|string',
            'nama'         => 'required|string|max:100',
            'kota'         => 'required|string|max:50',
            'rating'       => 'required|integer|min:1|max:5',
            'isi'          => 'required|string|min:5',
        ]);

        try {
            // 4. PERBAIKAN: Gunakan updateOrCreate menggantikan insert
            Testimoni::updateOrCreate(
                ['kode_pesanan' => $request->kode_pesanan], // Kunci pencarian (WHERE)
                [
                    'nama_pelanggan' => $request->nama,
                    'kota'           => $request->kota,
                    'rating'         => $request->rating,
                    'isi_testimoni'  => $request->isi,
                    'is_visible'     => true, // Paksa tampil
                    'updated_at'     => now() // Update waktu agar tampil paling atas
                ]
            );

            // 5. Update status pesanan
            DB::table('tbl_pesanan')
                ->where('kode_pesanan', $request->kode_pesanan)
                ->update(['is_reviewed' => 1]);

            return redirect('/')->with('success_testimoni', 'Ulasan berhasil disimpan!');

        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal menyimpan: ' . $e->getMessage()]);
        }
    }
}