<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTestimoniController extends Controller
{
    /**
     * Menampilkan daftar semua ulasan
     */
    public function index()
    {
        // Ambil data ulasan, urutkan dari yang terbaru
        // Kita juga join dengan tabel pesanan jika ingin lihat detail pesanan (opsional)
        $ulasan = DB::table('tbl_testimoni')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // Menampilkan 10 per halaman

        return view('admin.ulasan.index', compact('ulasan'));
    }

    /**
     * Menyimpan balasan admin
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:500'
        ]);

        DB::table('tbl_testimoni')
            ->where('id', $id) // Asumsi tabel Anda punya kolom 'id' (primary key)
            ->update([
                'admin_reply' => $request->admin_reply,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim!');
    }

    /**
     * Mengubah status tampil/sembunyi (Visibility)
     */
    public function toggleVisibility($id)
    {
        // 1. Ambil data saat ini
        $item = DB::table('tbl_testimoni')->where('id', $id)->first();

        if ($item) {
            // 2. Balik statusnya (Jika 1 jadi 0, jika 0 jadi 1)
            $newStatus = !$item->is_visible; // Pastikan kolom is_visible sudah dibuat di DB

            DB::table('tbl_testimoni')
                ->where('id', $id)
                ->update(['is_visible' => $newStatus]);

            $msg = $newStatus ? 'Ulasan ditampilkan.' : 'Ulasan disembunyikan.';
            return redirect()->back()->with('success', $msg);
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
    
    /**
     * Menghapus ulasan (Hati-hati)
     */
    public function delete($id)
    {
        DB::table('tbl_testimoni')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus permanen.');
    }
}