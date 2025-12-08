<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pesanan->kode_pesanan }} - Aneka Usaha</title>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Tambahkan FontAwesome untuk Ikon -->
    <style>
        body { background: #555; font-family: 'Poppins', sans-serif; padding: 30px 0; }
        .invoice-container { background: white; width: 100%; max-width: 700px; margin: 0 auto; padding: 40px; border-radius: 5px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 1.5rem; font-weight: 800; color: #2C3E50; }
        .invoice-title { text-align: right; }
        .invoice-title h1 { margin: 0; font-size: 2rem; color: #D4A373; text-transform: uppercase; }
        .invoice-title p { margin: 0; color: #888; font-size: 0.9rem; }
        .info-section { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .info-box h3 { font-size: 0.9rem; color: #999; text-transform: uppercase; margin-bottom: 5px; }
        .info-box p { margin: 0; font-weight: 600; color: #333; font-size: 1.1rem; }
        .address { font-size: 0.9rem; color: #555; line-height: 1.5; max-width: 250px; }
        
        /* Table Baru yang Lebih Rapi */
        .table-wrapper { border: 1px solid #eee; border-radius: 10px; overflow: hidden; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f9f9f9; text-align: left; padding: 15px; color: #555; font-size: 0.85rem; text-transform: uppercase; border-bottom: 2px solid #eee; }
        td { padding: 15px; border-bottom: 1px solid #eee; color: #333; font-size: 0.95rem; }
        tr:last-child td { border-bottom: none; }
        .text-right { text-align: right; }
        .font-mono { font-family: 'Courier Prime', monospace; }
        
        .total-section { display: flex; justify-content: flex-end; margin-bottom: 40px; }
        .total-box { text-align: right; width: 300px; }
        .total-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.9rem; }
        .total-row.final { font-size: 1.2rem; font-weight: 800; color: #2C3E50; border-top: 2px solid #D4A373; padding-top: 10px; }
        
        .status-badge { display: inline-block; padding: 8px 15px; border-radius: 5px; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; }
        .status-baru { background: #ffebee; color: #c62828; }
        .status-proses { background: #fff3e0; color: #ef6c00; }
        .status-selesai { background: #e8f5e9; color: #2e7d32; }
        
        .footer { text-align: center; color: #aaa; font-size: 0.8rem; margin-top: 50px; border-top: 1px dashed #ddd; padding-top: 20px; }
        
        /* --- STYLE TOMBOL AKSI BARU --- */
        .actions-container {
            max-width: 700px; margin: 20px auto; display: flex; gap: 15px;
        }
        .btn-action {
            flex: 1; padding: 15px; border-radius: 50px; text-align: center; text-decoration: none;
            font-weight: 600; font-size: 1rem; transition: 0.3s; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            font-family: 'Poppins', sans-serif;
        }
        
        /* Tombol Print (Gelap) */
        .btn-print { background: #2C3E50; color: white; box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3); }
        .btn-print:hover { background: #1a252f; transform: translateY(-2px); }
        
        /* Tombol Home (Putih/Terang) */
        .btn-home { background: white; color: #2C3E50; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .btn-home:hover { background: #f8f9fa; color: #D4A373; transform: translateY(-2px); }

        /* Media Print: Sembunyikan tombol saat dicetak */
        @media print { 
            body { background: white; padding: 0; } 
            .invoice-container { box-shadow: none; max-width: 100%; padding: 20px; } 
            .actions-container { display: none !important; } 
        }
        
        /* Mobile Responsive */
        @media (max-width: 600px) {
            .actions-container { flex-direction: column; }
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <!-- HEADER -->
        <div class="header">
            <div class="logo">ANEKA USAHA</div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <p>#{{ $pesanan->kode_pesanan }}</p>
                @php
                    $statusClass = 'status-baru';
                    if($pesanan->status == 'Proses') $statusClass = 'status-proses';
                    if($pesanan->status == 'Selesai') $statusClass = 'status-selesai';
                @endphp
                <div style="margin-top: 10px;">
                    <span class="status-badge {{ $statusClass }}">{{ $pesanan->status }}</span>
                </div>
            </div>
        </div>

        <!-- INFO -->
        <div class="info-section">
            <div class="info-box">
                <h3>Ditagihkan Kepada:</h3>
                <p>{{ $pesanan->nama_pelanggan }}</p>
                <p style="font-size:0.9rem; color:#666; margin-top:5px;">{{ $pesanan->no_whatsapp }}</p>
            </div>
            <div class="info-box" style="text-align:right;">
                <h3>Tanggal:</h3>
                <p>{{ date('d M Y', strtotime($pesanan->created_at)) }}</p>
            </div>
        </div>

        <!-- LOGIC PARSING DATA JSON -->
        @php
            // Coba decode JSON dari kolom detail_pesanan
            $dataDetail = json_decode($pesanan->detail_pesanan, true);
            $isJson = (json_last_error() === JSON_ERROR_NONE) && is_array($dataDetail);
            
            $grandTotal = 0;
        @endphp

        <!-- TABLE ITEM -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%;">Produk</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @if($isJson && isset($dataDetail['items']))
                        {{-- LOOPING ITEM JIKA FORMATNYA JSON (PESANAN BARU) --}}
                        @foreach($dataDetail['items'] as $item)
                            @php 
                                $subtotal = $item['harga'] * $item['qty'];
                                $grandTotal += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $item['nama'] }}</strong>
                                </td>
                                <td class="text-right">{{ $item['qty'] }}</td>
                                <td class="text-right font-mono">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="text-right font-mono">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @else
                        {{-- FALLBACK JIKA FORMATNYA TEKS BIASA (PESANAN LAMA) --}}
                        <tr>
                            <td colspan="4">
                                <p style="font-weight:600; margin-bottom:5px;">Detail Manual</p>
                                <p style="color:#666; font-size:0.9rem; white-space: pre-line;">{{ $pesanan->detail_pesanan }}</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- CATATAN TAMBAHAN (JIKA ADA DI JSON) -->
        @if($isJson && !empty($dataDetail['catatan']))
        <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; color: #555;">
            <strong>Catatan Tambahan:</strong><br>
            {{ $dataDetail['catatan'] }}
        </div>
        @endif

        <!-- TOTAL SECTION -->
        <div class="total-section">
            <div class="total-box">
                @if($grandTotal > 0)
                <div class="total-row final">
                    <span>Estimasi Total:</span>
                    <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
                <p style="color:#888; font-size:0.8rem; font-style:italic; margin-top:10px;">
                    *Harga final + ongkir akan dikonfirmasi Admin.
                </p>
                @else
                <p style="color:#888; font-size:0.8rem; font-style:italic;">
                    *Hubungi Admin untuk total harga.
                </p>
                @endif
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>Terima kasih telah berbelanja di Aneka Usaha.</p>
            <p>www.aneka-usaha.com</p>
        </div>
    </div>

    <!-- TOMBOL AKSI (Home & Print) -->
    <div class="actions-container">
        <!-- Tombol Kembali ke Website -->
        <a href="{{ url('/') }}" class="btn-action btn-home">
            <i class="fas fa-home"></i> Kembali ke Katalog
        </a>

        <!-- Tombol Cetak -->
        <button onclick="window.print()" class="btn-action btn-print">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
    </div>

</body>
</html>