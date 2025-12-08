<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\LogPesanan; // Pastikan Model LogPesanan sudah dibuat (opsional)
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

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
        // A. Data Statistik Dasar
        $totalProses = Pesanan::where('status', 'Proses')->count();
        $totalSelesai = Pesanan::where('status', 'Selesai')->count();
        $totalDesain = Produk::count(); // Menghitung total produk

        // B. Hitung Total Pendapatan (Profit)
        // Hanya menghitung pesanan yang statusnya 'Selesai'
        $pesananSukses = Pesanan::where('status', 'Selesai')->get();
        $totalPendapatan = 0;

        foreach($pesananSukses as $p) {
            // Parsing JSON detail_pesanan
            // Format JSON: {"items": [{"harga": 2000, "qty": 500, ...}], ...}
            $detail = json_decode($p->detail_pesanan, true);
            
            // Cek apakah format JSON valid dan memiliki 'items'
            if (json_last_error() === JSON_ERROR_NONE && isset($detail['items'])) {
                foreach($detail['items'] as $item) {
                    // Rumus: Harga x Qty
                    $totalPendapatan += ($item['harga'] * $item['qty']);
                }
            }
        }

        // C. Data Grafik (Pesanan Masuk per Bulan di Tahun Ini)
        $pesananTahunIni = Pesanan::select('created_at')
                            ->whereYear('created_at', date('Y'))
                            ->get()
                            ->groupBy(function($date) {
                                // Grouping berdasarkan bulan (format: 01, 02, dst)
                                return Carbon::parse($date->created_at)->format('m');
                            });

        $grafikPesanan = [];
        $grafikBulan = [];

        // Loop 1 sampai 12 (Januari - Desember)
        for ($i = 1; $i <= 12; $i++) {
            $bulanKey = str_pad($i, 2, '0', STR_PAD_LEFT); // Ubah 1 jadi "01"
            
            // Simpan nama bulan untuk label grafik (Jan, Feb...)
            $grafikBulan[] = Carbon::create()->month($i)->translatedFormat('M');
            
            // Jika ada pesanan di bulan tersebut, hitung jumlahnya. Jika tidak, 0.
            $grafikPesanan[] = isset($pesananTahunIni[$bulanKey]) ? $pesananTahunIni[$bulanKey]->count() : 0;
        }

        // D. Data Tabel (Ambil data terbaru)
        $pesananTerbaru = Pesanan::latest('created_at')->get();
        $produkTerbaru = Produk::latest('id_produk')->get();

        return view('admin.dashboard', compact(
            'totalProses', 'totalSelesai', 'totalDesain', 'totalPendapatan',
            'pesananTerbaru', 'produkTerbaru',
            'grafikPesanan', 'grafikBulan'
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
        
        // --- LOGIKA LOG PESANAN (OPSIONAL) ---
        // Jika status berubah, catat ke tabel log_pesanan
        if ($pesanan->status !== $request->status) {
            // Pastikan model LogPesanan ada, jika tidak, hapus blok if ini
            try {
                LogPesanan::create([
                    'kode_pesanan'    => $pesanan->kode_pesanan,
                    'status_lama'     => $pesanan->status,
                    'status_baru'     => $request->status,
                    'waktu_perubahan' => now(),
                ]);
            } catch (\Exception $e) {
                // Abaikan error jika tabel log belum siap
            }
        }
        // -------------------------------------

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