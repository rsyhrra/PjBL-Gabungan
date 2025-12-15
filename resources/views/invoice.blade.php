<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pesanan->kode_pesanan }} - Aneka Usaha</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- CONFIG --- */
        :root {
            --primary: #2C3E50;  /* Navy Blue */
            --accent: #D4A373;   /* Gold/Brown */
            --bg: #F5F7FA;
            --white: #ffffff;
            --text: #333333;
            --text-light: #777777;
        }

        body { 
            background: var(--bg); 
            font-family: 'Poppins', sans-serif; 
            padding: 40px 20px; 
            color: var(--text);
            -webkit-print-color-adjust: exact; /* Agar warna background ikut terprint */
            print-color-adjust: exact;
        }

        /* --- CONTAINER KERTAS --- */
        .invoice-paper { 
            background: var(--white); 
            width: 100%; 
            max-width: 800px; 
            margin: 0 auto; 
            padding: 0; /* Padding dihandle oleh inner containers */
            border-radius: 15px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.08); 
            overflow: hidden;
            position: relative;
        }

        /* --- DECORATIVE TOP BAR --- */
        .top-bar {
            height: 10px;
            background: linear-gradient(90deg, var(--primary) 70%, var(--accent) 70%);
        }

        /* --- HEADER SECTION --- */
        .header-section {
            padding: 40px 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company-info { display: flex; flex-direction: column; gap: 5px; }
        .logo-wrapper { 
            display: flex; align-items: center; gap: 15px; margin-bottom: 15px;
        }
        .logo-img { height: 60px; width: auto; } /* Ukuran Logo */
        .company-name { font-size: 1.5rem; font-weight: 800; color: var(--primary); letter-spacing: 0.5px; }
        .company-details { font-size: 0.85rem; color: var(--text-light); line-height: 1.5; }

        .invoice-details { text-align: right; }
        .invoice-title { font-size: 3rem; font-weight: 800; color: #f0f2f5; line-height: 1; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 10px; }
        .invoice-number { font-size: 1.2rem; font-weight: 700; color: var(--primary); }
        .invoice-date { font-size: 0.9rem; color: var(--text-light); }

        /* --- STATUS BADGE --- */
        .status-badge { 
            display: inline-block; padding: 8px 20px; border-radius: 50px; 
            font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;
            margin-top: 10px;
        }
        .st-Baru { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
        .st-Proses { background: #fff3e0; color: #ef6c00; border: 1px solid #ffe0b2; }
        .st-Selesai { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }

        /* --- BILL TO SECTION --- */
        .bill-to-section {
            background: #f8f9fa;
            margin: 0 50px 30px 50px;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            border-left: 5px solid var(--accent);
        }
        .bill-title { font-size: 0.8rem; text-transform: uppercase; color: var(--text-light); font-weight: 600; margin-bottom: 5px; }
        .bill-name { font-size: 1.2rem; font-weight: 700; color: var(--primary); }
        .bill-contact { font-size: 0.9rem; color: var(--text); display: flex; align-items: center; gap: 8px; margin-top: 5px; }

        /* --- TABLE SECTION --- */
        .table-section { padding: 0 50px; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        thead th { 
            background-color: var(--primary); 
            color: var(--white); 
            padding: 18px 15px; 
            text-align: left; 
            font-size: 0.85rem; 
            text-transform: uppercase; 
            letter-spacing: 1px;
        }
        thead th:first-child { border-top-left-radius: 8px; }
        thead th:last-child { border-top-right-radius: 8px; }
        
        tbody td { padding: 15px; border-bottom: 1px solid #eee; font-size: 0.95rem; color: var(--text); }
        tbody tr:nth-child(even) { background-color: #fcfcfc; } /* Zebra Striping */
        
        .font-mono { font-family: 'Courier Prime', monospace; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: 600; }

        /* --- TOTAL SUMMARY --- */
        .summary-section { 
            padding: 0 50px 40px 50px; 
            display: flex; 
            justify-content: flex-end; 
        }
        .summary-box { width: 350px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; color: var(--text-light); }
        
        .total-row { 
            display: flex; justify-content: space-between; align-items: center;
            background: var(--primary); color: white;
            padding: 15px 20px; border-radius: 8px;
            font-size: 1.1rem; font-weight: 700;
            margin-top: 15px;
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.2);
        }

        /* --- NOTE & FOOTER --- */
        .note-section {
            padding: 20px 50px;
            background: #fff;
            border-top: 2px dashed #eee;
            margin-bottom: 20px;
        }
        .note-title { font-size: 0.9rem; font-weight: 700; color: var(--primary); margin-bottom: 5px; }
        .note-text { font-size: 0.85rem; color: var(--text-light); font-style: italic; }

        .footer {
            background: #f1f3f5;
            padding: 20px;
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-light);
            border-top: 1px solid #eee;
        }

        /* --- BUTTONS --- */
        .actions-container {
            max-width: 800px; margin: 30px auto; display: flex; gap: 20px; justify-content: center;
        }
        .btn-action {
            padding: 15px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; 
            font-size: 1rem; transition: 0.3s; border: none; cursor: pointer;
            display: flex; align-items: center; gap: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .btn-print { background: var(--primary); color: white; }
        .btn-print:hover { background: #1a252f; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(44, 62, 80, 0.3); }
        
        .btn-home { background: white; color: var(--primary); border: 2px solid #eee; }
        .btn-home:hover { border-color: var(--accent); color: var(--accent); transform: translateY(-3px); }

        /* --- PRINT MODE --- */
        @media print { 
            body { background: white; padding: 0; } 
            .invoice-paper { box-shadow: none; max-width: 100%; border-radius: 0; } 
            .actions-container { display: none !important; } 
            .top-bar { -webkit-print-color-adjust: exact; }
            thead th, .total-row { -webkit-print-color-adjust: exact; color: white !important; }
        }
        
        @media (max-width: 600px) {
            .header-section { flex-direction: column; gap: 20px; padding: 30px; }
            .invoice-details { text-align: left; }
            .invoice-title { font-size: 2.5rem; }
            .bill-to-section { margin: 0 30px 30px 30px; flex-direction: column; gap: 15px; }
            .table-section { padding: 0 30px; overflow-x: auto; }
            .summary-section { padding: 0 30px 40px 30px; }
            .summary-box { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="invoice-paper">
        <!-- Top Colored Bar -->
        <div class="top-bar"></div>

        <!-- Header -->
        <div class="header-section">
            <div class="company-info">
                <div class="logo-wrapper">
                    <!-- LOGO ANEKA USAHA -->
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Aneka Usaha" class="logo-img">
                    <div class="company-name">ANEKA USAHA</div>
                </div>
                <div class="company-details">
                    HC2X+434, Pappa, Kec. Pattallassang,<br>
                    Kabupaten Takalar, Sulawesi Selatan<br>
                    WA: +62 813-4113-6423 | anekausaha160370@gmail.com
                </div>
            </div>
            
            <div class="invoice-details">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#{{ $pesanan->kode_pesanan }}</div>
                <div class="invoice-date">{{ date('d F Y, H:i', strtotime($pesanan->created_at)) }}</div>
                
                @php
                    $statusColor = 'st-' . str_replace(' ', '', $pesanan->status); // st-BaruMasuk, st-Proses, st-Selesai
                    if($pesanan->status == 'Baru Masuk') $statusColor = 'st-Baru';
                @endphp
                <span class="status-badge {{ $statusColor }}">{{ $pesanan->status }}</span>
            </div>
        </div>

        <!-- Bill To Info -->
        <div class="bill-to-section">
            <div>
                <div class="bill-title">Ditagihkan Kepada</div>
                <div class="bill-name">{{ $pesanan->nama_pelanggan }}</div>
                <div class="bill-contact"><i class="fab fa-whatsapp"></i> {{ $pesanan->no_whatsapp }}</div>
            </div>
            <div style="text-align: right;">
                <div class="bill-title">Metode Pembayaran</div>
                <div class="bill-name" style="font-size: 1rem;">Transfer / Tunai</div>
                <!-- Bisa ditambahkan nama bank disini jika ada -->
            </div>
        </div>

        <!-- Logic Parsing Data -->
        @php
            $dataDetail = json_decode($pesanan->detail_pesanan, true);
            $isJson = (json_last_error() === JSON_ERROR_NONE) && is_array($dataDetail);
            $grandTotal = 0;
        @endphp

        <!-- Table Items -->
        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%;">Deskripsi Produk</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if($isJson && isset($dataDetail['items']))
                        @foreach($dataDetail['items'] as $item)
                            @php 
                                $subtotal = $item['harga'] * $item['qty'];
                                $grandTotal += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $item['nama'] }}</div>
                                    <!-- Jika ada varian/keterangan bisa ditambah disini -->
                                </td>
                                <td class="text-right">{{ $item['qty'] }}</td>
                                <td class="text-right font-mono">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="text-right font-mono fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <!-- Fallback untuk data lama (Non-JSON) -->
                        <tr>
                            <td colspan="4">
                                <div class="fw-bold">Pesanan Manual</div>
                                <div style="color: #666; white-space: pre-line; margin-top: 5px;">{{ $pesanan->detail_pesanan }}</div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Summary & Total -->
        <div class="summary-section">
            <div class="summary-box">
                @if($grandTotal > 0)
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="font-mono">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                    <!-- Diskon atau Pajak bisa ditambahkan disini -->
                    <div class="total-row">
                        <span>TOTAL ESTIMASI</span>
                        <span class="font-mono">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                @else
                    <div class="total-row" style="background:#95a5a6;">
                        <span>TOTAL</span>
                        <span style="font-size: 0.9rem;">Hubungi Admin</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Catatan Tambahan -->
        @if($isJson && !empty($dataDetail['catatan']))
        <div class="note-section">
            <div class="note-title">Catatan Tambahan:</div>
            <div class="note-text">"{{ $dataDetail['catatan'] }}"</div>
        </div>
        @endif

        <!-- Footer Invoice -->
        <div class="footer">
            Terima kasih telah mempercayakan kebutuhan percetakan Anda pada <strong>Aneka Usaha</strong>.<br>
            Harap simpan bukti ini untuk konfirmasi pembayaran atau pengambilan barang.
        </div>
    </div>

    <!-- Actions Buttons -->
    <div class="actions-container">
        <a href="{{ url('/') }}" class="btn-action btn-home">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn-action btn-print">
            <i class="fas fa-print"></i> Cetak Invoice
        </button>
    </div>

</body>
</html>