<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport penting untuk mobile -->
    <title>Admin Dashboard - Aneka Usaha</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tambahkan Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* --- 1. TEMA WARNA --- */
        :root {
            --bg-color: #FDFBF7;       /* Cream Background */
            --primary: #2C3E50;        /* Navy Blue */
            --primary-light: #34495e;  
            --accent: #D4A373;         /* Gold/Brown */
            --white: #ffffff;
            --text-grey: #666;
            --shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: var(--bg-color); color: var(--primary); overflow-x: hidden; }

        /* --- 2. SIDEBAR --- */
        .sidebar {
            width: 280px; background-color: var(--primary); color: #fff;
            display: flex; flex-direction: column; padding: 30px; 
            position: fixed; height: 100%; z-index: 1000; left: 0; top: 0;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease; /* Animasi Slide */
        }
        
        .logo-area {
            text-align: center; margin-bottom: 50px;
            font-size: 1.5rem; font-weight: 700; letter-spacing: 1px;
            color: var(--accent); border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
        }

        .nav-item {
            padding: 15px 20px; color: rgba(255,255,255,0.7); text-decoration: none; 
            font-weight: 500; border-radius: 12px; margin-bottom: 10px; 
            transition: 0.3s; display: flex; align-items: center; gap: 15px; font-size: 0.95rem;
        }
        .nav-item:hover, .nav-item.active { 
            background-color: var(--accent); color: white; 
            transform: translateX(5px); box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3);
        }

        /* Overlay untuk Mobile Sidebar */
        .sidebar-overlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 999;
        }
        
        /* --- 3. MAIN CONTENT --- */
        .main-content { margin-left: 280px; flex: 1; display: flex; flex-direction: column; width: calc(100% - 280px); transition: margin-left 0.3s ease, width 0.3s ease; }
        
        /* Topbar */
        .topbar {
            background: var(--white); padding: 15px 40px; 
            display: flex; justify-content: space-between; align-items: center; gap: 20px;
            box-shadow: var(--shadow); position: sticky; top: 0; z-index: 90;
        }

        .menu-toggle { display: none; font-size: 1.5rem; cursor: pointer; color: var(--primary); }
        
        /* Search Box Real-time */
        .search-box {
            background: #f0f0f0; padding: 10px 20px; border-radius: 25px; border: none;
            width: 100%; max-width: 400px; color: var(--primary); outline: none; transition: 0.3s; font-family: inherit;
        }
        .search-box:focus { background: #fff; box-shadow: 0 0 0 2px var(--accent); }

        .logout-btn { 
            text-decoration: none; color: var(--primary); font-weight: 600; 
            display: flex; align-items: center; gap: 10px; transition: 0.3s;
            padding: 8px 15px; border-radius: 30px; border: 1px solid #eee; white-space: nowrap;
        }
        .logout-btn:hover { background-color: #fee; border-color: #fcc; color: #e74c3c; }

        /* Container */
        .content-area { padding: 40px; }

        /* --- 4. SUMMARY CARDS --- */
        .cards-grid { 
            display: grid; 
            /* Menggunakan auto-fit agar jumlah kolom menyesuaikan lebar layar */
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); 
            gap: 25px; 
            margin-bottom: 30px; 
        }
        .card {
            background: var(--white); padding: 30px; border-radius: 20px; 
            box-shadow: var(--shadow); position: relative; overflow: hidden;
            transition: 0.3s; border: 1px solid #f0f0f0;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-color: var(--accent); }
        
        .card h3 { font-size: 0.9rem; margin-bottom: 10px; color: var(--text-grey); font-weight: 500; }
        
        /* Font size khusus untuk nilai uang agar muat */
        .card .val { font-size: 2.2rem; font-weight: 700; color: var(--primary); }
        .card .val.money { font-size: 1.8rem; } 
        
        .card-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 3.5rem; color: var(--accent); opacity: 0.15; }

        /* --- STYLE BARU UNTUK CARD GRAFIK --- */
        .chart-section {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid #f0f0f0;
            margin-bottom: 40px;
            height: 400px; /* Tinggi Fix agar rapi */
            position: relative;
        }
        .chart-title {
            font-size: 1.1rem; font-weight: 700; color: var(--primary);
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }

        /* --- 5. TABLES & SCROLL FRAME --- */
        .table-section { margin-bottom: 50px; background: var(--white); border-radius: 20px; box-shadow: var(--shadow); padding: 30px; }
        
        .section-header { 
            font-size: 1.3rem; font-weight: 700; margin-bottom: 20px; 
            color: var(--primary); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;
        }

        /* Bingkai Scroll untuk Tabel */
        .table-scroll-frame {
            max-height: 500px; overflow-y: auto; border-radius: 10px; border: 1px solid #eee;
        }
        .table-scroll-frame::-webkit-scrollbar { width: 8px; }
        .table-scroll-frame::-webkit-scrollbar-track { background: #f9f9f9; }
        .table-scroll-frame::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
        
        table { width: 100%; border-collapse: separate; border-spacing: 0; min-width: 800px; }
        
        /* Sticky Header */
        thead th { 
            position: sticky; top: 0; background: var(--white); z-index: 5;
            text-align: left; padding: 15px; color: var(--text-grey); font-size: 0.85rem; 
            text-transform: uppercase; letter-spacing: 1px; font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        td { background: #fff; padding: 15px; vertical-align: middle; border-bottom: 1px solid #f5f5f5; }
        tr:hover td { background: #fafafa; }

        /* --- 6. BUTTONS & STATUS --- */
        .btn { padding: 8px 15px; border-radius: 8px; border: none; cursor: pointer; color: white; font-size: 0.85rem; transition: 0.3s; }
        .btn-edit { background: var(--primary); } .btn-edit:hover { background: var(--primary-light); }
        .btn-delete { background: #e74c3c; } .btn-delete:hover { background: #c0392b; }
        
        /* Tombol Detail Baru */
        .btn-view { background: #3498db; color: white; display: inline-flex; align-items: center; gap: 5px; } 
        .btn-view:hover { background: #2980b9; }

        .btn-add { 
            background: var(--accent); padding: 12px 25px; font-size: 0.95rem; 
            font-weight: 600; box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
            color: white; border: none; cursor: pointer; border-radius: 8px;
        }
        .btn-add:hover { transform: translateY(-2px); background: #b0855b; }

        /* Warna-warni Status Dropdown */
        .status-select { 
            padding: 8px 12px; border-radius: 20px; border: 1px solid #eee; 
            font-family: 'Poppins', sans-serif; cursor: pointer; outline: none; font-weight: 600; font-size: 0.85rem;
        }
        .status-baru { background-color: #ffebee; color: #c62828; border-color: #ef9a9a; }
        .status-proses { background-color: #fff3e0; color: #ef6c00; border-color: #ffcc80; }
        .status-selesai { background-color: #e8f5e9; color: #2e7d32; border-color: #a5d6a7; }

        /* --- 7. MODAL POPUP --- */
        .modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(44, 62, 80, 0.7); z-index: 9999; 
            justify-content: center; align-items: center; backdrop-filter: blur(3px);
            overflow-y: auto; /* Memungkinkan scroll di dalam modal jika kontennya panjang */
        }
        .modal-content {
            background: var(--white); padding: 35px; border-radius: 20px; 
            width: 500px; max-width: 90%; position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3); animation: slideUp 0.4s ease;
        }
        
        /* Modal Detail Table Style */
        .detail-table { width: 100%; margin-top: 15px; border-collapse: collapse; }
        .detail-table th { background: #f8f9fa; font-size: 0.8rem; padding: 10px; color: #666; }
        .detail-table td { padding: 10px; border-bottom: 1px solid #eee; font-size: 0.9rem; }
        .detail-total { margin-top: 15px; padding-top: 15px; border-top: 2px dashed #eee; display: flex; justify-content: space-between; font-weight: 700; color: var(--primary); }

        @keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .close-modal { position: absolute; top: 20px; right: 25px; font-size: 1.5rem; cursor: pointer; color: #ccc; }
        .close-modal:hover { color: var(--accent); }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.9rem; color: var(--primary); }
        .form-control {
            width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 10px;
            font-family: 'Poppins', sans-serif; outline: none; transition: 0.3s;
        }
        .form-control:focus { border-color: var(--accent); background: #fff; }
        
        .btn-submit { 
            width: 100%; background: var(--accent); color: white; padding: 15px; 
            border: none; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 1rem; margin-top: 10px;
        }
        .btn-submit:hover { background: #b0855b; }

        /* --- 8. MOBILE RESPONSIVE --- */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); } /* Sembunyikan sidebar ke kiri */
            .sidebar.active { transform: translateX(0); } /* Munculkan sidebar */
            .sidebar-overlay.active { display: block; } /* Gelapkan background */
            
            .main-content { margin-left: 0; width: 100%; }
            
            .topbar { padding: 15px 20px; }
            .menu-toggle { display: block; } /* Munculkan tombol hamburger */
            
            .search-box { width: 100%; font-size: 0.9rem; }
            .logout-btn span { display: none; } /* Sembunyikan teks "Logout" di HP, sisakan icon */
            
            .content-area { padding: 20px; }
            .cards-grid { grid-template-columns: 1fr; } /* Kartu jadi 1 kolom ke bawah */
            
            .section-header { flex-direction: column; align-items: flex-start; }
            .section-header .btn-add { width: 100%; text-align: center; margin-top: 10px; }
            
            .modal-content { padding: 25px; width: 95%; max-height: 90vh; overflow-y: auto; }
            .close-modal { top: 15px; right: 15px; }

            /* Tinggi grafik di mobile */
            .chart-section { height: 300px; padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- Overlay untuk menutup sidebar di mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="sidebar" id="sidebar">
        <div class="logo-area">ANEKA USAHA</div>
        
        <a href="#" class="nav-item">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="#tabel-pesanan" class="nav-item">
            <i class="fas fa-shopping-cart"></i> Pesanan Masuk
        </a>
        <a href="#daftar-produk" class="nav-item">
            <i class="fas fa-box-open"></i> Manajemen Produk
        </a>
    </div>

    <div class="main-content">
        
        <div class="topbar">
            <!-- Tombol Hamburger (Hanya muncul di Mobile) -->
            <div class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </div>

            <input type="text" id="globalSearch" class="search-box" placeholder="Cari pesanan..." onkeyup="filterDashboard()">
            
            <a href="{{ route('admin.logout') }}" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </div>

        <div class="content-area">
            
            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#2C3E50',
                    timer: 2000
                });
            </script>
            @endif

            <!-- 1. KARTU RINGKASAN (UPDATED: Tambah Profit) -->
            <div class="cards-grid">
                <div class="card">
                    <h3>Pesanan Diproses</h3>
                    <div class="val">{{ $totalProses }}</div>
                    <i class="fas fa-spinner card-icon"></i>
                </div>
                <div class="card">
                    <h3>Pesanan Selesai</h3>
                    <div class="val">{{ $totalSelesai }}</div>
                    <i class="fas fa-check-circle card-icon"></i>
                </div>
                <div class="card">
                    <h3>Total Produk</h3>
                    <div class="val">{{ $totalDesain }}</div>
                    <i class="fas fa-layer-group card-icon"></i>
                </div>
                <!-- Kartu Baru: Total Pendapatan -->
                <div class="card">
                    <h3>Total Pendapatan</h3>
                    <div class="val money">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    <i class="fas fa-wallet card-icon"></i>
                </div>
            </div>

            <!-- 2. SECTION GRAFIK (BARU) -->
            <div class="chart-section">
                <div class="chart-title">
                    <i class="fas fa-chart-line" style="color: var(--accent);"></i>
                    Tren Penjualan ({{ date('Y') }})
                </div>
                <!-- Canvas untuk Chart.js -->
                <canvas id="salesChart"></canvas>
            </div>

            <!-- 3. TABEL PESANAN -->
            <div class="table-section" id="tabel-pesanan">
                <div class="section-header">
                    <span><i class="fas fa-list-alt" style="color:var(--accent); margin-right:10px;"></i> Pesanan Masuk</span>
                </div>
                <div class="table-scroll-frame">
                    <table>
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort' => 'kode_pesanan', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" style="text-decoration:none; color:inherit;">
                                    Kode <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort' => 'nama_pelanggan', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" style="text-decoration:none; color:inherit;">
                                    Customer <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th>WhatsApp</th>
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort' => 'status', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" style="text-decoration:none; color:inherit;">
                                    Status <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th>Detail Pesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesananTerbaru as $p)
                        <tr>
                            <td style="font-weight: 700; color: var(--primary);">{{ $p->kode_pesanan }}</td>
                            <td style="font-weight: 600;">{{ $p->nama_pelanggan }}</td>
                            
                            <td>
                                <a href="https://wa.me/{{ $p->no_whatsapp }}" target="_blank" style="color: #25D366; text-decoration: none; font-weight: 600;">
                                    <i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.pesanan.update', $p->id_pesanan) }}" method="POST">
                                    @csrf @method('PUT')
                                    <select name="status" onchange="this.form.submit()" 
                                        class="status-select {{ $p->status == 'Baru Masuk' ? 'status-baru' : ($p->status == 'Proses' ? 'status-proses' : 'status-selesai') }}">
                                        <option value="Baru Masuk" {{ $p->status == 'Baru Masuk' ? 'selected' : '' }}>Baru Masuk</option>
                                        <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            
                            <!-- MODIFIKASI: Kolom Detail Pesanan dengan Tombol Lihat -->
                            <td>
                                <button class="btn btn-view" onclick='showDetailPesanan(@json($p))'>
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </button>
                            </td>

                            <td>
                                <form action="{{ route('admin.pesanan.delete', $p->id_pesanan) }}" method="POST" class="form-delete">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-delete" onclick="confirmDelete(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

            <!-- 4. TABEL PRODUK -->
            <div class="table-section" id="daftar-produk">
                <div class="section-header">
                    <span><i class="fas fa-images" style="color:var(--accent); margin-right:10px;"></i> Manajemen Produk ({{ $produkTerbaru->count() }})</span>
                    <button class="btn btn-add" onclick="openModal('modalAdd')">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </button>
                </div>
                <div class="table-scroll-frame">
                    <table>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Min. Order</th> <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produkTerbaru as $prod)
                            <tr>
                                <td>
                                    <img src="{{ asset('img/'.$prod->foto_produk) }}" width="60" height="60" style="border-radius: 10px; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                </td>
                                <td style="font-weight: 600;">{{ $prod->nama_produk }}</td>
                                <td style="color: var(--accent); font-weight: 600;">Rp {{ number_format($prod->harga) }}</td>
                                <td style="font-size: 0.85rem;">{{ $prod->min_order }}</td>
                                <td style="font-size: 0.85rem; color: #888;">{{ Str::limit($prod->deskripsi_produk, 30) }}</td>
                                <td style="display: flex; gap: 8px; align-items: center; height: 100px;">
                                    <button class="btn btn-edit" onclick="editProduk(
                                        '{{ $prod->id_produk }}',
                                        '{{ $prod->nama_produk }}',
                                        '{{ $prod->harga }}',
                                        '{{ $prod->deskripsi_produk }}'
                                    )"><i class="fas fa-pen"></i></button>

                                    <form action="{{ route('admin.produk.delete', $prod->id_produk) }}" method="POST" class="form-delete">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-delete" onclick="confirmDelete(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL DETAIL PESANAN -->
    <div id="modalDetailPesanan" class="modal">
        <div class="modal-content" style="width: 600px;">
            <span class="close-modal" onclick="closeModal('modalDetailPesanan')">&times;</span>
            <h3 class="modal-title" style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">Detail Pesanan</h3>
            
            <!-- Info Header Pelanggan -->
            <div style="background: #f9f9f9; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <p><strong>Kode:</strong> <span id="detKode" style="color: var(--accent); font-weight: bold;">-</span></p>
                <p><strong>Customer:</strong> <span id="detNama">-</span></p>
                <p><strong>Tanggal:</strong> <span id="detTgl">-</span></p>
            </div>

            <!-- Tabel Detail Item -->
            <div style="max-height: 250px; overflow-y: auto;">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Item Produk</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Harga</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detTabelBody">
                        <!-- Diisi via JS -->
                    </tbody>
                </table>
            </div>

            <!-- Catatan & Total -->
            <div id="detCatatan" style="margin-top: 15px; font-size: 0.85rem; color: #e67e22; font-style: italic;"></div>
            
            <div class="detail-total">
                <span>Estimasi Total</span>
                <span id="detTotal">Rp 0</span>
            </div>
        </div>
    </div>

    <!-- MODAL ADD PRODUK -->
    <div id="modalAdd" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalAdd')">&times;</span>
            <h3 class="modal-title">Tambah Produk Baru</h3>
            
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Undangan Gold..." required>
                </div>
                <div style="display:flex; gap:10px;">
                    <div class="form-group" style="flex:1;">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" placeholder="2500" required>
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label>Min. Order</label>
                        <input type="text" name="min_order" class="form-control" placeholder="400 lbr" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="Undangan">Undangan</option>
                        <option value="Spanduk">Spanduk</option>
                        <option value="ATK">ATK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Spesifikasi produk..."></textarea>
                </div>
                <div class="form-group">
                    <label>Upload Foto Produk</label>
                    <input type="file" name="foto" class="form-control" required>
                </div>
                <button type="submit" class="btn-submit">Simpan Produk</button>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT PRODUK -->
    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalEdit')">&times;</span>
            <h3 class="modal-title">Edit Produk</h3>
            
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" id="editNama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" id="editHarga" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="editDeskripsi" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control">
                    <small style="color: #888;">*Kosongkan jika tidak ingin mengubah foto</small>
                </div>
                <button type="submit" class="btn-submit">Update Produk</button>
            </form>
        </div>
    </div>

    <script>
        // 1. MODAL HANDLER
        function openModal(id) { 
            document.getElementById(id).style.display = 'flex'; 
            // Matikan scroll pada body saat modal terbuka
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal(id) { 
            document.getElementById(id).style.display = 'none'; 
            // Hidupkan kembali scroll pada body saat modal tertutup
            document.body.style.overflow = 'auto';
        }
        
        window.onclick = function(event) {
            if (event.target.className === 'modal') { 
                event.target.style.display = 'none'; 
                // Hidupkan kembali scroll jika user klik di luar modal (overlay)
                document.body.style.overflow = 'auto';
            }
        }

        // FUNGSI TOGGLE SIDEBAR MOBILE
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }

        // 2. FUNGSI MENAMPILKAN DETAIL PESANAN
        function showDetailPesanan(data) {
            // Isi Header
            document.getElementById('detKode').innerText = data.kode_pesanan;
            document.getElementById('detNama').innerText = data.nama_pelanggan;
            let tgl = new Date(data.created_at).toLocaleDateString('id-ID', { 
                day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' 
            });
            document.getElementById('detTgl').innerText = tgl;

            // Parsing Detail Pesanan (JSON atau Text Manual)
            let tbody = document.getElementById('detTabelBody');
            tbody.innerHTML = ""; // Bersihkan isi lama
            
            let grandTotal = 0;
            let catatan = "";

            try {
                // Coba parsing JSON
                let detailObj = JSON.parse(data.detail_pesanan);
                
                // Jika formatnya array/object yang benar
                if (detailObj.items && Array.isArray(detailObj.items)) {
                    detailObj.items.forEach(item => {
                        let subtotal = item.harga * item.qty;
                        grandTotal += subtotal;
                        
                        let row = `
                            <tr>
                                <td>${item.nama}</td>
                                <td style="text-align:center;">${item.qty}</td>
                                <td style="text-align:right;">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
                                <td style="text-align:right; font-weight:600;">Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                    
                    if (detailObj.catatan) {
                        catatan = "Catatan: " + detailObj.catatan;
                    }
                } else {
                    throw new Error("Format JSON lama atau berbeda");
                }
            } catch (e) {
                // FALLBACK: Jika bukan JSON (Data lama / manual text)
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" style="color:#666; font-style:italic;">
                            ${data.detail_pesanan}
                        </td>
                    </tr>
                `;
                document.getElementById('detTotal').innerText = "Hubungi Admin";
                document.getElementById('detCatatan').innerText = "";
                openModal('modalDetailPesanan');
                return; // Stop di sini
            }

            // Update Footer Modal
            document.getElementById('detTotal').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(grandTotal);
            document.getElementById('detCatatan').innerText = catatan;

            openModal('modalDetailPesanan');
        }

        // 3. EDIT PRODUCT FILLER
        function editProduk(id, nama, harga, deskripsi) {
            document.getElementById('editNama').value = nama;
            document.getElementById('editHarga').value = harga;
            document.getElementById('editDeskripsi').value = deskripsi;
            
            let url = "{{ route('admin.produk.update', ':id') }}";
            url = url.replace(':id', id);
            document.getElementById('formEdit').action = url;

            openModal('modalEdit');
        }

        // 4. REAL-TIME SEARCH FUNCTION
        function filterDashboard() {
            let input = document.getElementById('globalSearch').value.toLowerCase();
            
            // Filter Pesanan
            let tablePesanan = document.querySelectorAll('#tabel-pesanan tbody tr');
            tablePesanan.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });

            // Filter Produk
            let tableProduk = document.querySelectorAll('#daftar-produk tbody tr');
            tableProduk.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        }

        // 5. SWEETALERT CONFIRM DELETE
        function confirmDelete(button) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            })
        }

        // 6. CHART.JS CONFIGURATION (INIT GRAFIK)
        document.addEventListener("DOMContentLoaded", function() {
            // Periksa apakah elemen canvas ada sebelum melanjutkan
            var canvas = document.getElementById('salesChart');
            if (!canvas) return; // Keluar jika tidak ada elemen

            const ctx = canvas.getContext('2d');
            
            // Data dari Controller
            const labels = @json($grafikBulan ?? []); // Default ke array kosong jika null
            const data = @json($grafikPesanan ?? []); // Default ke array kosong jika null

            new Chart(ctx, {
                type: 'line', // Bisa diganti 'bar' jika suka grafik batang
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pesanan Masuk',
                        data: data,
                        borderColor: '#D4A373', // Warna Accent (Gold)
                        backgroundColor: 'rgba(212, 163, 115, 0.2)', // Warna Accent transparan
                        borderWidth: 3,
                        pointBackgroundColor: '#2C3E50', // Warna Primary (Navy)
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#D4A373',
                        fill: true,
                        tension: 0.4 // Membuat garis melengkung halus (curved)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, position: 'top' },
                        tooltip: { 
                            mode: 'index', 
                            intersect: false,
                            backgroundColor: 'rgba(44, 62, 80, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#D4A373',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 } // Agar sumbu Y bilangan bulat (1, 2, 3...)
                        },
                        x: {
                            grid: { display: false } // Hilangkan grid vertikal biar bersih
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>