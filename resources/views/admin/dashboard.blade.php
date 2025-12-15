<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Aneka Usaha</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            transition: transform 0.3s ease;
        }
        
        .logo-area {
            text-align: center; margin-bottom: 50px;
            font-size: 1.5rem; font-weight: 700; letter-spacing: 1px;
            color: var(--accent); border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
            display: flex; flex-direction: column; align-items: center; gap: 10px;
        }
        
        .logo-img {
            max-width: 80px; height: auto; display: block; border-radius: 10px;
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

        .sidebar-overlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 999;
        }
        
        /* --- 3. MAIN CONTENT --- */
        .main-content { margin-left: 280px; flex: 1; display: flex; flex-direction: column; width: calc(100% - 280px); transition: margin-left 0.3s ease, width 0.3s ease; }
        
        .topbar {
            background: var(--white); padding: 15px 40px; 
            display: flex; justify-content: space-between; align-items: center; gap: 20px;
            box-shadow: var(--shadow); position: sticky; top: 0; z-index: 90;
        }

        .menu-toggle { display: none; font-size: 1.5rem; cursor: pointer; color: var(--primary); }
        
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

        .content-area { padding: 40px; }

        /* --- 4. CARDS & CHARTS --- */
        .cards-grid { 
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 30px; 
        }
        .card {
            background: var(--white); padding: 30px; border-radius: 20px; 
            box-shadow: var(--shadow); position: relative; overflow: hidden;
            transition: 0.3s; border: 1px solid #f0f0f0;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); border-color: var(--accent); }
        
        .card h3 { font-size: 0.9rem; margin-bottom: 10px; color: var(--text-grey); font-weight: 500; }
        .card .val { font-size: 2.2rem; font-weight: 700; color: var(--primary); }
        .card-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 3.5rem; color: var(--accent); opacity: 0.15; }

        .chart-section {
            background: var(--white); border-radius: 20px; padding: 30px;
            box-shadow: var(--shadow); border: 1px solid #f0f0f0; margin-bottom: 40px;
            height: 400px; position: relative;
        }
        .chart-title {
            font-size: 1.1rem; font-weight: 700; color: var(--primary);
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }

        /* --- 5. TABLES --- */
        .table-section { margin-bottom: 50px; background: var(--white); border-radius: 20px; box-shadow: var(--shadow); padding: 30px; }
        .section-header { 
            font-size: 1.3rem; font-weight: 700; margin-bottom: 20px; 
            color: var(--primary); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;
        }
        .table-scroll-frame {
            max-height: 500px; overflow-y: auto; border-radius: 10px; border: 1px solid #eee;
        }
        table { width: 100%; border-collapse: separate; border-spacing: 0; min-width: 800px; }
        thead th { 
            position: sticky; top: 0; background: var(--white); z-index: 5;
            text-align: left; padding: 15px; color: var(--text-grey); font-size: 0.85rem; 
            text-transform: uppercase; letter-spacing: 1px; font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        td { background: #fff; padding: 15px; vertical-align: middle; border-bottom: 1px solid #f5f5f5; }
        tr:hover td { background: #fafafa; }

        /* --- FIX PAGINATION (MENGATASI TAMPILAN BERANTAKAN) --- */
        
        /* 1. Reset List Style untuk Pagination Bootstrap */
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            gap: 5px;
            margin: 0;
            justify-content: flex-end; /* Posisikan ke kanan */
        }
        
        /* 2. Style untuk Item Halaman */
        .page-item .page-link {
            padding: 8px 14px;
            border: 1px solid #eee;
            border-radius: 8px;
            color: var(--primary);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            min-width: 35px;
        }

        /* 3. Style Halaman Aktif */
        .page-item.active .page-link {
            background-color: var(--accent);
            color: white;
            border-color: var(--accent);
            font-weight: 600;
        }

        /* 4. Style Disabled */
        .page-item.disabled .page-link {
            color: #ccc;
            pointer-events: none;
            background-color: #f9f9f9;
        }

        /* 5. Hover Effect */
        .page-item .page-link:hover {
            background-color: #f0f0f0;
            border-color: #ddd;
        }

        /* 6. Fix untuk Laravel Default (Tailwind) jika muncul SVG besar */
        nav[role="navigation"] svg { 
            width: 12px !important; 
            height: 12px !important; 
            display: inline-block;
        }
        nav[role="navigation"] > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            flex-wrap: wrap;
            gap: 10px;
        }
        /* Sembunyikan teks 'Showing x to y' jika mengganggu di mobile */
        p.text-sm.text-gray-700 {
            margin: 0;
            font-size: 0.85rem;
            color: #666;
        }
        
        /* --- 6. BUTTONS & STATUS --- */
        .btn { padding: 8px 15px; border-radius: 8px; border: none; cursor: pointer; color: white; font-size: 0.85rem; transition: 0.3s; }
        .btn-edit { background: var(--primary); } .btn-edit:hover { background: var(--primary-light); }
        .btn-delete { background: #e74c3c; } .btn-delete:hover { background: #c0392b; }
        .btn-view { background: #3498db; color: white; display: inline-flex; align-items: center; gap: 5px; } 
        .btn-reply { background: var(--accent); color: white; } 
        .btn-toggle-on { background: #2ecc71; color: white; }
        .btn-toggle-off { background: #95a5a6; color: white; }
        .btn-add { 
            background: var(--accent); padding: 12px 25px; font-size: 0.95rem; 
            font-weight: 600; box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
            color: white; border: none; cursor: pointer; border-radius: 8px;
        }
        .btn-add:hover { transform: translateY(-2px); background: #b0855b; }

        .status-select { padding: 8px 12px; border-radius: 20px; border: 1px solid #eee; font-weight: 600; font-size: 0.85rem; }
        .status-baru { background-color: #ffebee; color: #c62828; border-color: #ef9a9a; }
        .status-proses { background-color: #fff3e0; color: #ef6c00; border-color: #ffcc80; }
        .status-selesai { background-color: #e8f5e9; color: #2e7d32; border-color: #a5d6a7; }

        /* --- 7. MODALS --- */
        .modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(44, 62, 80, 0.7); z-index: 9999; 
            justify-content: center; align-items: center; backdrop-filter: blur(3px); overflow-y: auto;
        }
        .modal-content {
            background: var(--white); padding: 35px; border-radius: 20px; 
            width: 500px; max-width: 90%; position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3); animation: slideUp 0.4s ease;
        }
        .detail-table { width: 100%; margin-top: 0; border-collapse: separate; border-spacing: 0; }
        .detail-table th { background: var(--primary) !important; color: white !important; font-size: 0.85rem; padding: 12px 15px; border: none; }
        .detail-table td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 0.9rem; vertical-align: top; }
        .detail-table tr:last-child td { border-bottom: none; }

        .close-modal { position: absolute; top: 20px; right: 25px; font-size: 1.5rem; cursor: pointer; color: #ccc; }
        @keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.9rem; color: var(--primary); }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 10px; outline: none; transition: 0.3s; }
        .form-control:focus { border-color: var(--accent); background: #fff; }
        .btn-submit { width: 100%; background: var(--accent); color: white; padding: 15px; border: none; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 1rem; margin-top: 10px; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); }
            .sidebar-overlay.active { display: block; } .main-content { margin-left: 0; width: 100%; }
            .topbar { padding: 15px 20px; } .menu-toggle { display: block; }
            .cards-grid { grid-template-columns: 1fr; } 
            .section-header { flex-direction: column; align-items: flex-start; }
            .section-header .btn-add { width: 100%; margin-top: 10px; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="sidebar" id="sidebar">
        <div class="logo-area">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Usaha" class="logo-img">
            <span>ANEKA USAHA</span>
        </div>
        <a href="#" class="nav-item"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="#tabel-pesanan" class="nav-item"><i class="fas fa-shopping-cart"></i> Pesanan Masuk</a>
        <a href="#daftar-produk" class="nav-item"><i class="fas fa-box-open"></i> Manajemen Produk</a>
        <a href="#manajemen-portofolio" class="nav-item"><i class="fas fa-images"></i> Galeri Portofolio</a>
        <a href="#manajemen-ulasan" class="nav-item"><i class="fas fa-comments"></i> Ulasan</a>
        <a href="{{ url('/') }}" class="nav-item" target="_blank" style="margin-top: auto;"><i class="fas fa-home"></i> Home</a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
            <input type="text" id="globalSearch" class="search-box" placeholder="Cari pesanan atau ulasan..." onkeyup="filterDashboard()">
            <a href="{{ route('admin.logout') }}" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
        </div>

        <div class="content-area">
            
            @if(session('success'))
            <script>
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#2C3E50', timer: 2000 });
            </script>
            @endif

            @if($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: '<ul style="text-align:left;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    confirmButtonColor: '#e74c3c'
                });
            </script>
            @endif

            <!-- 2. KARTU STATISTIK -->
            <div class="cards-grid">
                <div class="card">
                    <h3>Pesanan Diproses</h3><div class="val">{{ $totalProses }}</div><i class="fas fa-spinner card-icon"></i>
                </div>
                <div class="card">
                    <h3>Pesanan Selesai</h3><div class="val">{{ $totalSelesai }}</div><i class="fas fa-check-circle card-icon"></i>
                </div>
                <div class="card">
                    <h3>Total Produk</h3><div class="val">{{ $totalDesain }}</div><i class="fas fa-layer-group card-icon"></i>
                </div>
                <div class="card">
                    <h3>Total Pendapatan</h3><div class="val money">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div><i class="fas fa-wallet card-icon"></i>
                </div>
            </div>

            <!-- 3. GRAFIK -->
            <div class="chart-section">
                <div class="chart-title"><i class="fas fa-chart-line" style="color: var(--accent);"></i> Tren Penjualan ({{ date('Y') }})</div>
                <canvas id="salesChart"></canvas>
            </div>

            <!-- 4. TABEL PESANAN -->
            <div class="table-section" id="tabel-pesanan">
                <div class="section-header"><span><i class="fas fa-list-alt" style="color:var(--accent); margin-right:10px;"></i> Pesanan Masuk</span></div>
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
                                <td style="font-weight:700; color:var(--primary);">{{ $p->kode_pesanan }}</td>
                                <td>{{ $p->nama_pelanggan }}</td>
                                <td><a href="https://wa.me/{{ $p->no_whatsapp }}" target="_blank" style="color:#25D366; text-decoration:none;"><i class="fab fa-whatsapp"></i> {{ $p->no_whatsapp }}</a></td>
                                <td>
                                    <form action="{{ route('admin.pesanan.update', $p->id_pesanan) }}" method="POST">
                                        @csrf @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="status-select {{ $p->status == 'Baru Masuk' ? 'status-baru' : ($p->status == 'Proses' ? 'status-proses' : 'status-selesai') }}">
                                            <option value="Baru Masuk" {{ $p->status == 'Baru Masuk' ? 'selected' : '' }}>Baru Masuk</option>
                                            <option value="Proses" {{ $p->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td><button class="btn btn-view" onclick='showDetailPesanan(@json($p))'><i class="fas fa-eye"></i> Lihat</button></td>
                                <td>
                                    <form action="{{ route('admin.pesanan.delete', $p->id_pesanan) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-delete" onclick="confirmDelete(this)"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 5. TABEL PRODUK (UPDATED: Fix Pagination) -->
            <div class="table-section" id="daftar-produk">
                <div class="section-header" style="align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <span><i class="fas fa-box-open" style="color:var(--accent); margin-right:5px;"></i> Manajemen Produk ({{ $produkTerbaru->total() }})</span>
                        <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; align-items: center;">
                            <input type="text" name="cari_produk" class="form-control" placeholder="Cari nama produk..." value="{{ request('cari_produk') }}" style="padding: 8px 15px; width: 200px; border-radius: 20px 0 0 20px; border-right: none;">
                            <button type="submit" class="btn" style="background: var(--primary); border-radius: 0 20px 20px 0; padding: 9px 15px;">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('cari_produk'))
                                <a href="{{ route('admin.dashboard') }}#daftar-produk" class="btn btn-delete" style="margin-left: 5px; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="Reset Pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                    <button class="btn btn-add" onclick="openModal('modalAdd')">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="table-scroll-frame">
                    <table>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort_by' => 'nama_produk', 'order_by' => (request('order_by') == 'asc' ? 'desc' : 'asc'), 'cari_produk' => request('cari_produk')]) }}#daftar-produk" style="color: inherit; text-decoration: none;">
                                        Nama Produk <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort_by' => 'harga', 'order_by' => (request('order_by') == 'asc' ? 'desc' : 'asc'), 'cari_produk' => request('cari_produk')]) }}#daftar-produk" style="color: inherit; text-decoration: none;">
                                        Harga <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th>Min. Order</th><th>Deskripsi</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerbaru as $prod)
                            <tr>
                                <td><img src="{{ asset('img/'.$prod->foto_produk) }}" width="50" height="50" style="border-radius: 8px; object-fit: cover; border: 1px solid #eee;"></td>
                                <td style="font-weight: 600;">{{ $prod->nama_produk }}</td>
                                <td style="color: var(--accent); font-weight: 600;">Rp {{ number_format($prod->harga, 0, ',', '.') }}</td>
                                <td>{{ $prod->min_order }}</td>
                                <td>{{ Str::limit($prod->deskripsi_produk, 30) }}</td>
                                <td>
                                    <button class="btn btn-edit" onclick="editProduk('{{ $prod->id_produk }}','{{ $prod->nama_produk }}','{{ $prod->harga }}','{{ $prod->deskripsi_produk }}')"><i class="fas fa-pen"></i></button>
                                    <form action="{{ route('admin.produk.delete', $prod->id_produk) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-delete" onclick="confirmDelete(this)"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align: center; padding: 30px; color: #999;">Produk tidak ditemukan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
                    {{ $produkTerbaru->appends(request()->query())->fragment('daftar-produk')->links() }}
                </div>
            </div>

            <!-- 6. MANAJEMEN PORTOFOLIO -->
            <div class="table-section" id="manajemen-portofolio">
                <div class="section-header">
                    <span><i class="fas fa-images" style="color:var(--accent); margin-right:10px;"></i> Galeri Portofolio</span>
                    <button class="btn btn-add" onclick="openModal('modalAddPorto')"><i class="fas fa-plus"></i> Upload Karya</button>
                </div>
                <div class="cards-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-top:20px;">
                    @forelse($portofolio as $porto)
                    <div class="card" style="padding: 10px; min-height: auto;">
                        <img src="{{ asset('img/portfolio/'.$porto->foto) }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 10px;">
                        <h4 style="font-size: 0.9rem; margin-bottom: 2px;">{{ $porto->judul }}</h4>
                        <span class="badge" style="background: #eee; color: #666; padding: 2px 8px; font-size: 0.75rem; border-radius: 4px;">{{ $porto->kategori }}</span>
                        <form action="{{ route('admin.portofolio.delete', $porto->id) }}" method="POST" style="margin-top: 10px;">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-delete" style="width: 100%; font-size: 0.8rem;" onclick="confirmDelete(this)"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                    @empty
                    <p style="grid-column: 1/-1; text-align: center; color: #999;">Belum ada portofolio.</p>
                    @endforelse
                </div>
            </div>

            <!-- 7. MANAJEMEN ULASAN -->
            <div class="table-section" id="manajemen-ulasan">
                <div class="section-header"><span><i class="fas fa-comments" style="color:var(--accent); margin-right:10px;"></i> Ulasan Pelanggan</span></div>
                <div class="table-scroll-frame">
                    <table>
                        <thead><tr><th>Pelanggan</th><th>Rating</th><th>Ulasan</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @forelse($ulasan as $u)
                            <tr>
                                <td>{{ $u->nama_pelanggan }}<br><small>{{ $u->kode_pesanan }}</small></td>
                                <td style="color:#ffc107;">{{ $u->rating }} <i class="fas fa-star"></i></td>
                                <td>"{{ Str::limit($u->isi_testimoni, 50) }}"<br>
                                    @if($u->admin_reply)<small style="color:blue;">Replied</small>@endif
                                </td>
                                <td>
                                    @if($u->is_visible) <span class="badge" style="color:green;">Tampil</span> 
                                    @else <span class="badge" style="color:red;">Hidden</span> @endif
                                </td>
                                <td>
                                    <button class="btn btn-reply" onclick="openReplyModal('{{ $u->id }}', '{{ $u->nama_pelanggan }}', '{{ addslashes($u->isi_testimoni) }}', '{{ addslashes($u->admin_reply ?? '') }}')"><i class="fas fa-reply"></i></button>
                                    <a href="{{ route('admin.testimoni.toggle', $u->id) }}" class="btn {{ $u->is_visible ? 'btn-toggle-off' : 'btn-toggle-on' }}"><i class="fas {{ $u->is_visible ? 'fa-eye-slash' : 'fa-eye' }}"></i></a>
                                    <form action="{{ route('admin.testimoni.delete', $u->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-delete" onclick="confirmDelete(this)"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" style="text-align:center;">Belum ada ulasan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div style="margin-top:20px; display:flex; justify-content:flex-end;">{{ $ulasan->links() }}</div>
            </div>

        </div>
    </div>

    <!-- MODAL ADD PORTOFOLIO -->
    <div id="modalAddPorto" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalAddPorto')">&times;</span>
            <h3 class="modal-title">Upload Portofolio</h3>
            <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Karya</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Contoh: Undangan Hardcover">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="Undangan">Undangan</option>
                        <option value="Spanduk">Spanduk</option>
                        <option value="Kemasan">Kemasan</option>
                        <option value="Kartu Nama">Kartu Nama</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto (Max 2MB)</label>
                    <input type="file" name="foto" class="form-control" required accept="image/*">
                </div>
                <button type="submit" class="btn-submit">Upload Sekarang</button>
            </form>
        </div>
    </div>

    <!-- MODAL LAINNYA (Detail Pesanan, Add Produk, Edit Produk, Reply) -->
    
    <div id="modalDetailPesanan" class="modal">
        <div class="modal-content" style="width:600px;">
            <span class="close-modal" onclick="closeModal('modalDetailPesanan')">&times;</span>
            <h3>Detail Pesanan</h3>
            <div style="background:#f9f9f9; padding:10px; margin-bottom:10px;">
                Kode: <span id="detKode" style="font-weight:bold;"></span><br>
                Nama: <span id="detNama"></span><br>
                Tgl: <span id="detTgl"></span>
            </div>
            <table class="detail-table">
                <thead><tr><th>Item</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
                <tbody id="detTabelBody"></tbody>
            </table>
            <div id="detCatatan" style="margin-top:10px; font-style:italic;"></div>
            <div class="detail-total"><span>Total</span><span id="detTotal"></span></div>
        </div>
    </div>

    <div id="modalAdd" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalAdd')">&times;</span>
            <h3>Tambah Produk</h3>
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" required style="margin-bottom:10px;">
                <input type="number" name="harga" class="form-control" placeholder="Harga" required style="margin-bottom:10px;">
                <input type="text" name="min_order" class="form-control" placeholder="Min Order" required style="margin-bottom:10px;">
                <select name="kategori" class="form-control" style="margin-bottom:10px;"><option>Undangan</option><option>Spanduk</option><option>ATK</option></select>
                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" style="margin-bottom:10px;"></textarea>
                <input type="file" name="foto" class="form-control" required>
                <button type="submit" class="btn-submit">Simpan</button>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalEdit')">&times;</span>
            <h3>Edit Produk</h3>
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="text" id="editNama" name="nama_produk" class="form-control" required style="margin-bottom:10px;">
                <input type="number" id="editHarga" name="harga" class="form-control" required style="margin-bottom:10px;">
                <textarea id="editDeskripsi" name="deskripsi" class="form-control" style="margin-bottom:10px;"></textarea>
                <label>Ganti Foto (Opsional)</label>
                <input type="file" name="foto" class="form-control">
                <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </div>

    <div id="modalReply" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalReply')">&times;</span>
            <h3>Balas Ulasan</h3>
            <form id="formReply" action="" method="POST">
                @csrf
                <div style="background:#f9f9f9; padding:10px; margin-bottom:10px; font-style:italic;" id="replyContent"></div>
                <textarea name="admin_reply" id="replyInput" class="form-control" rows="4" required placeholder="Balasan Anda..."></textarea>
                <button type="submit" class="btn-submit">Kirim</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).style.display='flex'; document.body.style.overflow='hidden'; }
        function closeModal(id) { document.getElementById(id).style.display='none'; document.body.style.overflow='auto'; }
        window.onclick = function(e) { if(e.target.className==='modal') { e.target.style.display='none'; document.body.style.overflow='auto'; } }
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); document.querySelector('.sidebar-overlay').classList.toggle('active'); }
        
        function confirmDelete(btn) {
            Swal.fire({ title:'Yakin hapus?', icon:'warning', showCancelButton:true, confirmButtonColor:'#d33', confirmButtonText:'Ya, Hapus!' }).then((res)=>{ if(res.isConfirmed) btn.closest('form').submit(); });
        }

        function editProduk(id, nama, harga, desc) {
            document.getElementById('editNama').value = nama;
            document.getElementById('editHarga').value = harga;
            document.getElementById('editDeskripsi').value = desc;
            document.getElementById('formEdit').action = "{{ route('admin.produk.update', ':id') }}".replace(':id', id);
            openModal('modalEdit');
        }

        function openReplyModal(id, name, content, reply) {
            document.getElementById('replyContent').innerHTML = `<b>${name}:</b> "${content}"`;
            document.getElementById('replyInput').value = reply;
            document.getElementById('formReply').action = "{{ route('admin.testimoni.reply', ':id') }}".replace(':id', id);
            openModal('modalReply');
        }

        function showDetailPesanan(data) {
            document.getElementById('detKode').innerText=data.kode_pesanan;
            document.getElementById('detNama').innerText=data.nama_pelanggan;
            document.getElementById('detTgl').innerText=new Date(data.created_at).toLocaleDateString();
            let tbody = document.getElementById('detTabelBody'); tbody.innerHTML="";
            let total=0;
            try {
                let detail = JSON.parse(data.detail_pesanan);
                if(detail.items) {
                    detail.items.forEach(i => {
                        let sub = i.harga*i.qty; total+=sub;
                        tbody.innerHTML += `<tr><td>${i.nama}</td><td style="text-align:center;">${i.qty}</td><td style="text-align:right;">Rp ${new Intl.NumberFormat('id-ID').format(i.harga)}</td><td style="text-align:right; font-weight:600;">Rp ${new Intl.NumberFormat('id-ID').format(sub)}</td></tr>`;
                    });
                    document.getElementById('detCatatan').innerText = detail.catatan ? "Catatan: "+detail.catatan : "";
                }
            } catch(e) { tbody.innerHTML=`<tr><td colspan="4">${data.detail_pesanan}</td></tr>`; }
            document.getElementById('detTotal').innerText = "Rp "+total.toLocaleString('id-ID');
            openModal('modalDetailPesanan');
        }

        // CHART JS
        document.addEventListener("DOMContentLoaded", function() {
            var canvas = document.getElementById('salesChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const labels = @json($grafikBulan ?? []);
            const data = @json($grafikPesanan ?? []);
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pesanan', data: data,
                        borderColor: '#D4A373', backgroundColor: 'rgba(212, 163, 115, 0.2)',
                        borderWidth: 3, fill: true, tension: 0.4
                    }]
                },
                options: { responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true}} }
            });
        });

        function filterDashboard() {
            let input = document.getElementById('globalSearch').value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
            });
        }
    </script>
</body>
</html>