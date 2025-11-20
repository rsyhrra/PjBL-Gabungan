<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Produk; // Pastikan Model Produk sudah ada (sesuai ERD Anda)

class AdminController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLogin() {
        return view('admin.login');
    }

    // 2. Proses Login
    public function processLogin(Request $request) {
        $credentials = $request->only('username', 'password');

        // Cek login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Username atau Password salah!']);
    }

    // 3. Logout
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // 4. Halaman Dashboard (Sesuai Mockup)
    public function dashboard() {
        // A. Data untuk Summary Cards
        $totalProses = Pesanan::where('status', 'Proses')->count();
        $totalSelesai = Pesanan::where('status', 'Selesai')->count();
        $totalDesain = Produk::count(); // Jumlah Desain/Produk

        // B. Data untuk Tabel Pesanan (Ambil 5 terbaru)
        $pesananTerbaru = Pesanan::latest('created_at')->limit(5)->get();

        // C. Data untuk Tabel Produk (Ambil 5 terbaru)
        $produkTerbaru = Produk::latest('id_produk')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProses', 'totalSelesai', 'totalDesain', 
            'pesananTerbaru', 'produkTerbaru'
        ));
    }

    // ... (Fungsi login & dashboard yang lama biarkan saja) ...

    // --- 1. LOGIKA TAMBAH PRODUK ---
   // --- 1. LOGIKA TAMBAH PRODUK ---
    public function storeProduk(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|max:2048',
        ]);

        // Upload Gambar
        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('img'), $imageName);

        // Simpan ke Database
        \App\Models\Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori, // Ambil text dari dropdown
            'deskripsi_produk' => $request->deskripsi ?? '-',
            'harga' => $request->harga,
            'min_order' => $request->min_order ?? '1 pcs', // Simpan min order
            'foto_produk' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // --- 2. LOGIKA UPDATE PRODUK ---
    public function updateProduk(Request $request, $id)
    {
        $produk = \App\Models\Produk::findOrFail($id);

        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi_produk = $request->deskripsi;
        // Pastikan input hidden/select kategori ada di form edit dashboard
        // Untuk simplifikasi, kita anggap user hanya edit nama/harga/deskripsi dulu
        
        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();  
            $request->foto->move(public_path('img'), $imageName);
            $produk->foto_produk = $imageName;
        }

        $produk->save();
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    // --- 3. LOGIKA HAPUS PRODUK ---
    public function deleteProduk($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        // Hapus file foto jika perlu: File::delete(public_path('img/'.$produk->foto_produk));
        $produk->delete();
        return redirect()->back()->with('success', 'Produk dihapus!');
    }

    // --- 4. LOGIKA UPDATE STATUS PESANAN ---
    public function updateStatusPesanan(Request $request, $id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        $pesanan->status = $request->status; // Ambil dari input select
        $pesanan->save();
        
        return redirect()->back()->with('success', 'Status pesanan diperbarui!');
    }

    // --- 5. LOGIKA HAPUS PESANAN ---
    public function deletePesanan($id)
    {
        \App\Models\Pesanan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pesanan dihapus!');
    }
}