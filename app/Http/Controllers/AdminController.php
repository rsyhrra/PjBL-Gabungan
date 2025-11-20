<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Produk;

class AdminController extends Controller
{
    // ================== BAGIAN OTENTIKASI (LOGIN/LOGOUT) ==================

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


    // ================== BAGIAN DASHBOARD UTAMA ==================

    // 4. Halaman Dashboard
    public function dashboard() {
        // A. Data Statistik untuk Kartu (Summary Cards)
        $totalProses = Pesanan::where('status', 'Proses')->count();
        $totalSelesai = Pesanan::where('status', 'Selesai')->count();
        $totalDesain = Produk::count(); // Menghitung total produk

        // B. Data Tabel Pesanan (Ambil semua atau limit tertentu, urutkan dari terbaru)
        $pesananTerbaru = Pesanan::latest('created_at')->get();

        // C. Data Tabel Produk (Ambil SEMUA agar bisa di-scroll di dashboard)
        $produkTerbaru = Produk::latest('id_produk')->get();

        return view('admin.dashboard', compact(
            'totalProses', 'totalSelesai', 'totalDesain', 
            'pesananTerbaru', 'produkTerbaru'
        ));
    }


    // ================== BAGIAN CRUD PRODUK (MANAJEMEN PRODUK) ==================

    // 5. Simpan Produk Baru
    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
            'min_order' => 'required',
        ]);

        // Upload Gambar ke folder public/img
        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('img'), $imageName);

        // Simpan ke Database
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori, // Dari select option
            'deskripsi_produk' => $request->deskripsi ?? '-',
            'harga' => $request->harga,
            'min_order' => $request->min_order,
            'foto_produk' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // 6. Update Produk
    public function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Update data teks
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi_produk = $request->deskripsi;
        
        // Cek jika user mengupload foto baru
        if ($request->hasFile('foto')) {
            // Upload foto baru
            $imageName = time().'.'.$request->foto->extension();  
            $request->foto->move(public_path('img'), $imageName);
            
            // Hapus foto lama (Opsional, praktik yang baik agar server tidak penuh)
            // if(file_exists(public_path('img/'.$produk->foto_produk))){ unlink(public_path('img/'.$produk->foto_produk)); }
            
            $produk->foto_produk = $imageName;
        }

        $produk->save();
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    // 7. Hapus Produk
    public function deleteProduk($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }


    // ================== BAGIAN MANAJEMEN PESANAN ==================

    // 8. Update Status Pesanan (Langsung dari Dropdown)
    public function updateStatusPesanan(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status; // Baru Masuk / Proses / Selesai
        $pesanan->save();
        
        return redirect()->back()->with('success', 'Status pesanan diperbarui!');
    }

    // 9. Hapus Pesanan
    public function deletePesanan($id)
    {
        Pesanan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pesanan dihapus dari sistem!');
    }
}