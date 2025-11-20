<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pesanan->kode_pesanan }} - Aneka Usaha</title>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #555; font-family: 'Poppins', sans-serif; padding: 30px 0; }
        .invoice-container {
            background: white; width: 100%; max-width: 700px; margin: 0 auto;
            padding: 40px; border-radius: 5px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        /* Header Invoice */
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 1.5rem; font-weight: 800; color: #2C3E50; }
        .invoice-title { text-align: right; }
        .invoice-title h1 { margin: 0; font-size: 2rem; color: #D4A373; text-transform: uppercase; }
        .invoice-title p { margin: 0; color: #888; font-size: 0.9rem; }

        /* Info Section */
        .info-section { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .info-box h3 { font-size: 0.9rem; color: #999; text-transform: uppercase; margin-bottom: 5px; }
        .info-box p { margin: 0; font-weight: 600; color: #333; font-size: 1.1rem; }
        .address { font-size: 0.9rem; color: #555; line-height: 1.5; max-width: 250px; }

        /* Item Table */
        .table-wrapper { border: 1px solid #eee; border-radius: 10px; overflow: hidden; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f9f9f9; text-align: left; padding: 15px; color: #555; font-size: 0.85rem; text-transform: uppercase; }
        td { padding: 15px; border-top: 1px solid #eee; color: #333; }
        
        /* Total Section */
        .total-section { display: flex; justify-content: flex-end; margin-bottom: 40px; }
        .total-box { text-align: right; width: 250px; }
        .total-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.9rem; }
        .total-row.final { font-size: 1.2rem; font-weight: 800; color: #2C3E50; border-top: 2px solid #D4A373; padding-top: 10px; }

        /* Status Badge */
        .status-badge {
            display: inline-block; padding: 8px 15px; border-radius: 5px; 
            font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;
        }
        .status-baru { background: #ffebee; color: #c62828; }
        .status-proses { background: #fff3e0; color: #ef6c00; }
        .status-selesai { background: #e8f5e9; color: #2e7d32; }

        /* Footer & Print Button */
        .footer { text-align: center; color: #aaa; font-size: 0.8rem; margin-top: 50px; border-top: 1px dashed #ddd; padding-top: 20px; }
        .print-btn {
            display: block; width: 100%; background: #2C3E50; color: white; border: none; 
            padding: 15px; font-size: 1rem; font-weight: 600; cursor: pointer; border-radius: 0 0 5px 5px;
            transition: 0.3s; text-align: center; text-decoration: none;
        }
        .print-btn:hover { background: #1a252f; }

        @media print {
            body { background: white; padding: 0; }
            .invoice-container { box-shadow: none; max-width: 100%; padding: 20px; }
            .print-btn { display: none; }
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
            <div class="info-box">
                <h3>Dari:</h3>
                <p>Aneka Usaha</p>
                <div class="address">Jln. In aja dulu No.333<br>(Dekat Pusat Kota)</div>
            </div>
            <div class="info-box" style="text-align:right;">
                <h3>Tanggal Pesanan:</h3>
                <p>{{ date('d M Y', strtotime($pesanan->created_at)) }}</p>
            </div>
        </div>

        <!-- TABLE ITEM -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Deskripsi Item</th>
                        <th style="text-align:right;">Harga / Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <!-- Karena detail pesanan masih teks panjang, kita tampilkan apa adanya -->
                            <!-- Nanti bisa di-upgrade jadi list item jika database sudah mendukung -->
                            <p style="font-weight:600; margin-bottom:5px;">Detail Pesanan Custom</p>
                            <p style="color:#666; font-size:0.9rem; white-space: pre-line;">{{ $pesanan->detail_pesanan }}</p>
                        </td>
                        <td style="text-align:right; vertical-align:top; font-family: 'Courier Prime', monospace;">
                            Running Price<br>
                            <small>(Hubungi Admin)</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- TOTAL (Contoh Statis karena belum ada kolom total_harga di DB) -->
        <div class="total-section">
            <div class="total-box">
                <p style="color:#888; font-size:0.8rem; font-style:italic; margin-bottom:10px;">
                    *Harga final akan dikonfirmasi oleh admin melalui WhatsApp.
                </p>
                <!-- 
                <div class="total-row final">
                    <span>Total:</span>
                    <span>Rp 0,-</span>
                </div>
                -->
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>Terima kasih telah mempercayakan kebutuhan percetakan Anda kepada Aneka Usaha.</p>
            <p>www.aneka-usaha.com</p>
        </div>
    </div>

    <!-- TOMBOL PRINT (Hanya muncul di layar, hilang saat diprint) -->
    <div style="max-width: 700px; margin: 0 auto;">
        <button onclick="window.print()" class="print-btn">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
    </div>

</body>
</html>