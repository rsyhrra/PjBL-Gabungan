<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function index()
    {
        $produk = Produk::latest('id_produk')->get();
        return view('beranda', compact('produk'));
    }

    public function kirimPesanan(Request $request)
    {
        // ... (Kode kirimPesanan tidak berubah, tetap sama seperti sebelumnya) ...
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|numeric',
        ]);

        $tanggal = now()->format('ymd'); 
        $random = strtoupper(Str::random(3));
        $kodeUnik = 'AU-' . $tanggal . '-' . $random;

        $keranjangRaw = $request->keranjang_json;
        $items = json_decode($keranjangRaw, true); 
        
        $detailPesananDB = [
            'items' => $items ?? [], 
            'catatan' => $request->catatan,
            'tanggal_order' => now()->format('Y-m-d H:i:s')
        ];
        
        $waItemsList = "";
        $totalEstimasi = 0;
        
        if ($items && count($items) > 0) {
            foreach($items as $idx => $item) {
                $subtotal = $item['harga'] * $item['qty'];
                $totalEstimasi += $subtotal;
                $no = $idx + 1;
                $waItemsList .= "$no. " . $item['nama'] . " (" . $item['qty'] . "x) - Rp " . number_format($subtotal,0,',','.') . "%0A";
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
        
        $pesanWA = "Halo Aneka Usaha, saya ingin memesan.%0A%0A";
        $pesanWA .= "No Order: *" . $kodeUnik . "*%0A";
        $pesanWA .= "Nama: " . $request->nama . "%0A%0A";
        $pesanWA .= "*Detail Belanja:*%0A";
        $pesanWA .= $waItemsList; 
        $pesanWA .= "--------------------%0A";
        $pesanWA .= "Est. Total: Rp " . number_format($totalEstimasi,0,',','.') . "%0A";
        if($request->catatan) {
            $pesanWA .= "Catatan: " . $request->catatan . "%0A";
        }
        $pesanWA .= "%0A";
        $pesanWA .= "Lihat Invoice Lengkap:%0A" . $linkInvoice;

        $linkWA = "https://wa.me/$nomorAdmin?text=$pesanWA";

        return view('sukses', compact('linkWA'));
    }

    // --- PERBAIKAN DI SINI ---
    public function cekStatus(Request $request)
    {
        $keyword = $request->kode;

        // ... (Query pencarian tetap sama seperti perbaikan sebelumnya) ...
        $query = Pesanan::query();
        if (is_numeric($keyword)) {
            $query->where('id_pesanan', $keyword)
                  ->orWhere('no_whatsapp', 'like', "%{$keyword}%")
                  ->orWhere('kode_pesanan', $keyword);
        } else {
            $query->where('kode_pesanan', $keyword)
                  ->orWhere('no_whatsapp', $keyword);
        }

        $pesanan = $query->latest('created_at')->first();

        if ($pesanan) {
            // --- PERBAIKAN DI SINI ---
            
            // 1. Jangan timpa 'detail_pesanan'. Biarkan dia berisi JSON String asli.
            // Kita buat atribut baru 'ringkasan' jika ingin menampilkan teks pendek.
            $detailRaw = json_decode($pesanan->detail_pesanan, true);
            $ringkasan = "";
            
            if(json_last_error() === JSON_ERROR_NONE && is_array($detailRaw)) {
                $count = count($detailRaw['items'] ?? []);
                $ringkasan = "$count jenis produk";
            } else {
                $ringkasan = Str::limit($pesanan->detail_pesanan, 50);
            }
            
            // Masukkan data tambahan ke response JSON
            $pesanan->setAttribute('ringkasan_text', $ringkasan);
            $pesanan->setAttribute('link_invoice', url('/invoice/' . $pesanan->kode_pesanan));

            return response()->json([
                'status' => 'found',
                'data' => $pesanan
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
}