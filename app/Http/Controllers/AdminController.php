<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;   // Gunakan DB Facade
use Illuminate\Support\Facades\File; // PENTING: Untuk menghapus file gambar fisik
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Testimoni; 
use App\Models\LogPesanan;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ================== 1. BAGIAN OTENTIKASI ==================

    public function showLogin() {
        return view('admin.login');
    }

    public function processLogin(Request $request) {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['error' => 'Username atau Password salah!']);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // ================== 2. DASHBOARD (GABUNGAN STATISTIK, ULASAN & PORTOFOLIO) ==================

    public function dashboard() {
        // A. Statistik Ringkas
        $totalProses = Pesanan::where('status', 'Proses')->count();
        $totalSelesai = Pesanan::where('status', 'Selesai')->count();
        $totalDesain = Produk::count();

        // B. Hitung Profit
        $semuaPesanan = Pesanan::all(); 
        $totalPendapatan = 0;

        foreach($semuaPesanan as $p) {
            $detail = json_decode($p->detail_pesanan, true);
            if (json_last_error() === JSON_ERROR_NONE && isset($detail['items']) && is_array($detail['items'])) {
                foreach($detail['items'] as $item) {
                    $harga = isset($item['harga']) ? (int)$item['harga'] : 0;
                    $qty   = isset($item['qty']) ? (int)$item['qty'] : 0;
                    $totalPendapatan += ($harga * $qty);
                }
            }
        }

        // C. Data Grafik
        $pesananTahunIni = Pesanan::select('created_at')
                            ->whereYear('created_at', date('Y'))
                            ->get()
                            ->groupBy(function($date) {
                                return Carbon::parse($date->created_at)->format('m');
                            });

        $grafikPesanan = [];
        $grafikBulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulanKey = str_pad($i, 2, '0', STR_PAD_LEFT); 
            $grafikBulan[] = Carbon::create()->month($i)->translatedFormat('M');
            $grafikPesanan[] = isset($pesananTahunIni[$bulanKey]) ? $pesananTahunIni[$bulanKey]->count() : 0;
        }

        // D. Data Tabel Pendukung
        $pesananTerbaru = Pesanan::latest('created_at')->limit(5)->get();
        $produkTerbaru = Produk::latest('id_produk')->limit(5)->get();
        
        // E. Data Testimoni
        $ulasan = Testimoni::latest()->paginate(5);

        // F. Data Portofolio (BARU - TAHAP 3)
        // Ambil semua data portofolio dari tabel tbl_portofolio
        $portofolio = DB::table('tbl_portofolio')->latest()->get();

        return view('admin.dashboard', compact(
            'totalProses', 'totalSelesai', 'totalDesain', 'totalPendapatan',
            'pesananTerbaru', 'produkTerbaru', 
            'ulasan', 
            'portofolio', // Variabel baru dikirim ke view
            'grafikPesanan', 'grafikBulan'
        ));
    }

    // ================== 3. MANAJEMEN PRODUK ==================

    public function storeProduk(Request $request) {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'min_order' => 'required',
        ]);

        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('img'), $imageName);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'deskripsi_produk' => $request->deskripsi ?? '-',
            'harga' => $request->harga,
            'min_order' => $request->min_order,
            'foto_produk' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function updateProduk(Request $request, $id) {
        $produk = Produk::findOrFail($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi_produk = $request->deskripsi;
        
        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();  
            $request->foto->move(public_path('img'), $imageName);
            $produk->foto_produk = $imageName;
        }

        $produk->save();
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduk($id) {
        $produk = Produk::findOrFail($id);
        if(file_exists(public_path('img/'.$produk->foto_produk))){
            @unlink(public_path('img/'.$produk->foto_produk));
        }
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    // ================== 4. MANAJEMEN PESANAN ==================

    public function updateStatusPesanan(Request $request, $id) {
        $pesanan = Pesanan::findOrFail($id);
        
        if ($pesanan->status !== $request->status) {
            try {
                LogPesanan::create([
                    'kode_pesanan'    => $pesanan->kode_pesanan,
                    'status_lama'     => $pesanan->status,
                    'status_baru'     => $request->status,
                    'waktu_perubahan' => now(),
                ]);
            } catch (\Exception $e) { }
        }

        $pesanan->status = $request->status;
        $pesanan->save();
        return redirect()->back()->with('success', 'Status pesanan diperbarui!');
    }

    public function deletePesanan($id) {
        Pesanan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pesanan dihapus dari sistem!');
    }

    // ================== 5. MANAJEMEN TESTIMONI ==================

    public function replyTestimoni(Request $request, $id) {
        $request->validate(['admin_reply' => 'required|string']);
        
        $testi = Testimoni::findOrFail($id);
        $testi->admin_reply = $request->admin_reply;
        $testi->save();

        return redirect()->back()->with('success', 'Balasan ulasan berhasil dikirim!');
    }

    public function toggleTestimoni($id) {
        $testi = Testimoni::findOrFail($id);
        $testi->is_visible = !$testi->is_visible; 
        $testi->save();

        $status = $testi->is_visible ? 'ditampilkan' : 'disembunyikan';
        return redirect()->back()->with('success', "Ulasan berhasil $status.");
    }

    public function deleteTestimoni($id) {
        $testi = Testimoni::findOrFail($id);
        if($testi->foto_profil && file_exists(public_path('img/testi/'.$testi->foto_profil))) {
            @unlink(public_path('img/testi/'.$testi->foto_profil));
        }
        $testi->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
    }

    public function storeTestimoni(Request $request) {
        // ... (kode store testimoni manual jika ada) ...
    }

    // ================== 6. MANAJEMEN PORTOFOLIO (BARU - TAHAP 3) ==================

    public function storePortofolio(Request $request) {
        // 1. Validasi Input
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'foto'     => 'required|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB
        ]);

        // 2. Upload Gambar
        $imageName = time().'_porto.'.$request->foto->extension();
        // Simpan ke folder public/img/portfolio (Pastikan folder ini ada)
        $request->foto->move(public_path('img/portfolio'), $imageName);

        // 3. Simpan ke Database
        DB::table('tbl_portofolio')->insert([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'foto'       => $imageName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function deletePortofolio($id) {
        // Cari data berdasarkan ID
        $item = DB::table('tbl_portofolio')->where('id', $id)->first();
        
        if($item) {
            // Hapus file gambar fisik jika ada
            if(File::exists(public_path('img/portfolio/'.$item->foto))) {
                File::delete(public_path('img/portfolio/'.$item->foto));
            }
            
            // Hapus record dari database
            DB::table('tbl_portofolio')->where('id', $id)->delete();
            
            return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
        }
        
        return redirect()->back()->with('error', 'Data portofolio tidak ditemukan.');
    }
}