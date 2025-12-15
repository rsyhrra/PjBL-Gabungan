<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Testimoni; 
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // 1. Halaman Beranda (Katalog)
    public function index()
    {
        $produk = Produk::latest('id_produk')->get();
        $testimoni = Testimoni::latest()->limit(6)->get();
        return view('beranda', compact('produk', 'testimoni'));
    }

    // 2. Proses Kirim Pesanan
    public function kirimPesanan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|numeric',
        ]);

        $tanggal = now()->format('ymd'); 
        $random = strtoupper(Str::random(3));
        $kodeUnik = 'AU-' . $tanggal . '-' . $random;

        Carbon::setLocale('id'); 
        $waktuSekarang = now()->setTimezone('Asia/Jakarta'); 
        $waktuFormat = $waktuSekarang->translatedFormat('d F Y, H:i') . ' WIB';

        $keranjangRaw = $request->keranjang_json;
        $items = json_decode($keranjangRaw, true); 
        
        $detailPesananDB = [
            'items' => $items ?? [], 
            'catatan' => $request->catatan,
            'tanggal_order' => $waktuSekarang->format('Y-m-d H:i:s')
        ];
        
        $waItemsList = "";
        $totalEstimasi = 0;
        
        if ($items && count($items) > 0) {
            foreach($items as $item) {
                $subtotal = $item['harga'] * $item['qty'];
                $totalEstimasi += $subtotal;
                $waItemsList .= "▫️ " . $item['nama'] . " (" . $item['qty'] . " pcs)%0A";
                $waItemsList .= "   _Rp " . number_format($subtotal,0,',','.') . "_%0A";
            }
        } else {
            $waItemsList = "Detail pesanan tidak terbaca (Manual).";
        }

        Pesanan::create([
            'kode_pesanan'   => $kodeUnik,
            'nama_pelanggan' => $request->nama,
            'no_whatsapp'    => $request->no_wa,
            'detail_pesanan' => json_encode($detailPesananDB),
            'status'         => 'Baru Masuk',
        ]);

        $linkInvoice = url('/invoice/' . $kodeUnik);

        $nomorAdmin = '6281937536701'; 
        
        $pesanWA  = "Halo Admin Aneka Usaha! %0A";
        $pesanWA .= "Saya ingin konfirmasi pesanan baru.%0A%0A";
        $pesanWA .= "*KODE ORDER:* " . $kodeUnik . "%0A";
        $pesanWA .= "*Waktu:* " . $waktuFormat . "%0A";
        $pesanWA .= "*Nama:* " . $request->nama . "%0A%0A";
        $pesanWA .= "*DETAIL BELANJA:*%0A";
        $pesanWA .= $waItemsList; 
        $pesanWA .= "----------------------------------%0A";
        $pesanWA .= "*TOTAL ESTIMASI:* Rp " . number_format($totalEstimasi,0,',','.') . "%0A";
        
        if($request->catatan) {
            $pesanWA .= "%0A*Catatan:*%0A" . $request->catatan . "%0A";
        }
        
        $pesanWA .= "%0A";
        $pesanWA .= "*Link Invoice:*%0A" . $linkInvoice . "%0A%0A";
        $pesanWA .= "Mohon diproses ya, terima kasih! 🙏";

        $linkWA = "https://wa.me/$nomorAdmin?text=$pesanWA";

        return view('sukses', compact('linkWA'));
    }

    // 3. API Cek Status Pesanan (AJAX) - DIPERBARUI
     public function cekStatus(Request $request)
    {
        $kode = $request->query('kode');
        
        // Cari pesanan berdasarkan kode atau no_wa
        $pesanan = DB::table('tbl_pesanan')
                    ->where('kode_pesanan', $kode)
                    ->orWhere('no_whatsapp', $kode)
                    ->first();

        if ($pesanan) {
            // CEK APAKAH SUDAH DIULAS DI TABEL TESTIMONI JUGA (Double Check)
            $sudahUlas = DB::table('tbl_testimoni')
                            ->where('kode_pesanan', $pesanan->kode_pesanan)
                            ->exists();
            
            // Jika di tabel testimoni ada, paksa is_reviewed jadi true
            $statusReview = $pesanan->is_reviewed || $sudahUlas;

            return response()->json([
                'status' => 'found',
                'data' => [
                    'kode_pesanan' => $pesanan->kode_pesanan,
                    'nama_pelanggan' => $pesanan->nama_pelanggan,
                    'status' => $pesanan->status,
                    'detail_pesanan' => $pesanan->detail_pesanan,
                    'link_invoice' => route('pesanan.invoice', $pesanan->kode_pesanan),
                    'created_at' => $pesanan->created_at,
                    'is_reviewed' => $statusReview // Kirim status review yang valid
                ]
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function invoice($kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)->firstOrFail();
        return view('invoice', compact('pesanan'));
    }

    // 4. Proses Testimoni (User) - DIPERBARUI
    public function kirimTestimoni(Request $request)
    {
        $request->validate([
            'kode_pesanan' => 'required|exists:tbl_pesanan,kode_pesanan',
            'nama' => 'required',
            'kota' => 'required',
            'isi' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Cek Status Pesanan
        $pesanan = Pesanan::where('kode_pesanan', $request->kode_pesanan)->first();
        if($pesanan->status !== 'Selesai') {
            return back()->withErrors(['kode_pesanan' => 'Pesanan ini belum selesai, belum bisa direview.']);
        }

        // Cek Duplikat Testimoni
        $sudahAda = Testimoni::where('kode_pesanan', $request->kode_pesanan)->exists();
        if($sudahAda) {
            return back()->withErrors(['kode_pesanan' => 'Anda sudah memberikan ulasan untuk pesanan ini sebelumnya.']);
        }

        Testimoni::create([
            'kode_pesanan' => $request->kode_pesanan, // Simpan kode pesanan (Wajib ada kolomnya di DB)
            'nama_pelanggan' => $request->nama,
            'kota' => $request->kota,
            'isi_testimoni' => $request->isi,
            'rating' => $request->rating,
            'foto_profil' => null 
        ]);

        return redirect()->route('beranda')->with('success_testimoni', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}