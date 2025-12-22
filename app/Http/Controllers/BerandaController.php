<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $produk = DB::table('tbl_produk')->get();

        // Ambil Testimoni Terbaru
        $testimoni = DB::table('tbl_testimoni')
                        ->where('is_visible', true) // Hanya yang visible
                        ->orderBy('updated_at', 'desc') // Urutkan yang baru diedit/dibuat di atas
                        ->limit(6)
                        ->get();

        $portofolio = DB::table('tbl_portofolio')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('beranda', compact('produk', 'testimoni', 'portofolio'));
    }
}