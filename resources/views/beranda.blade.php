<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Usaha - Percetakan & ATK</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- 1. VARIABEL WARNA --- */
        :root {
            --bg-color: #FDFBF7;       /* Cream Background */
            --primary: #2C3E50;        /* Navy Blue (Text) */
            --accent: #D4A373;         /* Gold/Brown (Button/Highlight) */
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); color: var(--primary); overflow-x: hidden; }

        /* --- 2. NAVBAR --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 50px; position: sticky; top: 0;
            background: rgba(253, 251, 247, 0.98); backdrop-filter: blur(10px);
            z-index: 1000; box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .logo { font-weight: 800; font-size: 1.5rem; letter-spacing: 1px; color: var(--primary); }
        
        /* Menu Desktop */
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { text-decoration: none; color: var(--primary); font-weight: 500; transition: 0.3s; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--accent); }
        
        .nav-icons { display: flex; align-items: center; gap: 20px; }
        .nav-icons i { cursor: pointer; font-size: 1.2rem; transition: 0.3s; color: var(--primary); }
        .nav-icons i:hover { color: var(--accent); transform: scale(1.1); }

        /* Hamburger Menu */
        .hamburger { display: none; font-size: 1.5rem; cursor: pointer; margin-left: 15px; }
        
        /* Mobile Menu Overlay */
        .mobile-menu {
            display: none; flex-direction: column; background: var(--white);
            position: absolute; top: 60px; left: 0; width: 100%;
            padding: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center; gap: 20px; z-index: 999; border-top: 1px solid #eee;
        }
        .mobile-menu.active { display: flex; animation: slideDown 0.3s ease; }
        .mobile-menu a { text-decoration: none; color: var(--primary); font-weight: 600; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        /* --- 3. HERO SECTION --- */
        #home {
            display: flex; align-items: center; justify-content: space-between;
            min-height: 85vh; padding: 0 50px; position: relative;
        }
        .hero-text { max-width: 50%; z-index: 2; }
        .hero-text h1 { font-size: 3.5rem; line-height: 1.1; margin-bottom: 20px; font-weight: 700; }
        .hero-text p { font-size: 1.1rem; color: #666; margin-bottom: 30px; line-height: 1.6; }
        
        /* Tombol */
        .btn {
            padding: 12px 35px; border-radius: 50px; text-decoration: none;
            font-weight: 600; border: none; cursor: pointer; transition: 0.3s;
            display: inline-block; font-size: 0.9rem; text-align: center;
        }
        .btn-primary { background-color: var(--primary); color: var(--white); box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3); }
        .btn-secondary { background-color: var(--accent); color: var(--white); box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3); }
        .btn:hover { transform: translateY(-3px); }

        .hero-image { position: relative; width: 45%; display: flex; justify-content: center; height: 400px; align-items: center; }
        
        /* Card Stack */
        .card-stack {
            width: 250px; height: 320px; background: #e0e0e0;
            background-size: cover; background-position: center;
            position: absolute; transform: rotate(-8deg); border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card-stack.top {
            background-size: cover; background-position: center;
            transform: rotate(6deg); z-index: 2;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2); 
            top: 20px; left: 80px; 
            border: 4px solid #fff;
        }

        /* --- 4. KATALOG SLIDER --- */
        #katalog { padding: 60px 50px; background: #fff; }
        .catalog-header { display: flex; justify-content: space-between; margin-bottom: 30px; align-items: center; gap: 15px; flex-wrap: wrap; }
        
        .search-bar { background: #f0f0f0; padding: 10px 20px; border-radius: 30px; display: flex; align-items: center; width: 350px; transition:0.3s; }
        .search-bar:focus-within { background: #fff; box-shadow: 0 0 0 2px var(--accent); }
        .search-bar input { border: none; background: transparent; outline: none; width: 100%; margin-left: 10px; font-family: inherit; color:var(--primary); }
        
        .sort-dropdown {
            padding: 10px 15px; border-radius: 30px; border: 1px solid #ccc; 
            color: var(--primary); outline: none; cursor: pointer; font-family: inherit;
            background-color: #fff; font-size: 0.9rem; min-width: 150px;
        }
        .sort-dropdown:hover { border-color: var(--accent); }

        .slider-container { position: relative; display: flex; align-items: center; gap: 15px; min-height: 400px; }
        
        /* Area Scroll Horizontal */
        .product-scroll-wrapper {
            display: flex; overflow-x: auto; scroll-behavior: auto; 
            gap: 25px; padding: 20px 5px; width: 100%;
            scrollbar-width: none; 
        }
        .product-scroll-wrapper::-webkit-scrollbar { display: none; } 

        /* Kartu Produk */
        .product-card {
            background: var(--bg-color); border-radius: 15px;
            min-width: 260px; max-width: 260px; flex: 0 0 auto;
            transition: 0.3s; cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03); border: 1px solid #eee;
            display: flex; flex-direction: column; overflow: hidden;
        }
        .product-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: var(--accent); }

        .product-img { height: 180px; background-color: #f4f4f4; overflow: hidden; position: relative; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-img img { transform: scale(1.1); }

        .product-info { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cat-label { font-size: 0.7rem; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .product-info h3 { font-size: 1.05rem; margin-bottom: 5px; color: var(--primary); line-height: 1.4; font-weight: 600; }
        
        .price-info { margin-top: 15px; padding-top: 10px; border-top: 1px dashed #ddd; }
        .price { font-weight: 700; color: var(--primary); font-size: 1.1rem; }
        .price span { font-size: 0.8rem; font-weight: 400; color: #999; }
        .min-order { font-size: 0.75rem; color: #999; margin-top: 2px; }

        .scroll-btn {
            background-color: var(--primary); color: white; border: none;
            width: 45px; height: 45px; border-radius: 50%;
            cursor: pointer; z-index: 5; display: flex; align-items: center; justify-content: center;
            transition: 0.2s; box-shadow: 0 4px 10px rgba(0,0,0,0.15); flex-shrink: 0; font-size: 1.1rem;
        }
        .scroll-btn:active { transform: scale(0.9); background-color: var(--accent); }

        #noResults {
            position: absolute; width: 100%; text-align: center; top: 50%; transform: translateY(-50%);
            color: #999; display: none;
        }

        /* --- 5. MODAL UMUM --- */
        .modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(44, 62, 80, 0.7); z-index: 2000;
            justify-content: center; align-items: center; padding: 20px;
            opacity: 0; transition: opacity 0.3s ease;
        }
        .modal.show { display: flex; opacity: 1; }
        
        .modal-close { position: absolute; top: 20px; right: 25px; font-size: 1.8rem; cursor: pointer; z-index: 20; color: #999; transition: 0.3s; }
        .modal-close:hover { color: var(--accent); transform: rotate(90deg); }

        /* --- MODAL DETAIL PRODUK --- */
        #modalProduk .modal-content {
            background: var(--white); padding: 40px; border-radius: 20px;
            width: 90%; max-width: 850px; position: relative;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2); animation: slideUp 0.4s ease;
            display: flex; align-items: center; min-height: 450px; 
        }

        #modalBody {
            display: flex; gap: 40px; width: 100%;
            transition: all 0.3s ease-in-out; 
            opacity: 1; transform: scale(1);
        }
        .animating-out { opacity: 0; transform: scale(0.95) translateX(-10px); }

        .modal-nav-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 50px; height: 50px; border-radius: 50%;
            background-color: var(--white); color: var(--primary);
            border: 1px solid #eee; font-size: 1.2rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1); z-index: 10;
        }
        .modal-nav-btn:hover { background-color: var(--primary); color: var(--white); }
        .modal-nav-btn.prev { left: -25px; }
        .modal-nav-btn.next { right: -25px; }

        /* --- MODAL CEK PESANAN (Redesign) --- */
        #modalCekPesanan .modal-content {
            background: var(--white); padding: 40px 30px; border-radius: 25px;
            width: 100%; max-width: 450px; display: flex; flex-direction: column; gap: 20px; 
            text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: slideUp 0.4s ease; position: relative;
        }

        .modal-title { font-size: 1.3rem; font-weight: 700; color: var(--primary); margin-bottom: 5px; }
        .modal-subtitle { font-size: 0.9rem; color: #888; margin-bottom: 20px; }

        .search-wrapper { display: flex; gap: 10px; width: 100%; margin-bottom: 10px; }
        .search-input { 
            flex-grow: 1; background: #f0f4f8; border: none; border-radius: 12px;
            padding: 15px 20px; font-size: 1rem; color: var(--primary); outline: none; transition: 0.3s;
        }
        .search-input:focus { box-shadow: 0 0 0 2px var(--accent); background: #fff; }
        
        .search-btn {
            background: var(--primary); color: white; border: none; border-radius: 12px;
            width: 55px; height: 55px; cursor: pointer; transition: 0.3s;
            display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
        }
        .search-btn:hover { background: var(--accent); }

        /* Result Card */
        .result-card {
            background: #f9f9f9; border-radius: 15px; padding: 25px; text-align: left;
            display: none; border: 1px solid #eee;
        }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 15px; border-bottom: 1px dashed #ddd; padding-bottom: 10px; }
        .info-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; align-items: center; }
        .label { font-size: 0.9rem; color: #888; }
        .value { font-size: 0.95rem; font-weight: 600; color: var(--primary); text-align: right; }
        .badge { padding: 8px 20px; border-radius: 30px; font-size: 0.85rem; font-weight: 600; color: white; display: inline-block; }


        /* --- 7. FOOTER / CONTACT --- */
        #contact { padding: 80px 50px; background: var(--bg-color); border-top: 1px solid #eee; margin-top: 50px; }
        .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; align-items: start; }
        .contact-item { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .icon-circle { width: 40px; height: 40px; background: #e0e0e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); }

        @keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* --- MEDIA QUERIES (MOBILE RESPONSIVE) --- */
        @media (max-width: 768px) {
            nav { padding: 15px 20px; }
            .nav-links { display: none; }
            .hamburger { display: block; }
            
            #home { 
                flex-direction: column-reverse; text-align: center; 
                padding: 40px 20px; gap: 20px; justify-content: center;
                min-height: auto; margin-top: 20px;
            }
            .hero-text { max-width: 100%; z-index: 10; }
            .hero-text h1 { font-size: 2rem; margin-bottom: 15px; }
            
            /* Tombol Hero Full Width */
            .hero-text div { display: flex; flex-direction: column; gap: 10px; }
            .btn { width: 100%; margin: 0; }

            .hero-image { width: 100%; height: 320px; margin-bottom: 20px; }
            .card-stack { 
                width: 220px; height: 280px; left: 50%; top: 50%; 
                transform: translate(-50%, -50%) rotate(-8deg); 
            }
            .card-stack.top { 
                left: 50%; top: 50%;
                transform: translate(-40%, -60%) rotate(6deg); 
            }
            
            #katalog { padding: 40px 20px; }
            .catalog-header { flex-direction: column; align-items: stretch; gap: 15px; }
            .search-bar { width: 100%; }
            .sort-dropdown { width: 100%; margin-right: 0; }
            .slider-container { gap: 0; }
            .scroll-btn { display: none; } 
            
            #contact { padding: 40px 20px; }
            .contact-grid { grid-template-columns: 1fr; } /* 1 Kolom di HP */
            
            /* Modal Responsif */
            #modalProduk .modal-content { width: 95%; padding: 20px; flex-direction: column; height: auto; max-height: 85vh; overflow-y: auto; min-height: auto; }
            #modalBody { flex-direction: column; gap: 20px; }
            .modal-nav-btn.prev { left: 5px; }
            .modal-nav-btn.next { right: 5px; }
            
            /* Modal Cek Pesanan Mobile */
            #modalCekPesanan .modal-content { width: 95%; padding: 30px 20px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">ANEKA USAHA</div>
        
        <!-- Desktop Menu -->
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#katalog">Katalog</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="nav-icons">
            <i class="fas fa-receipt" onclick="openModal('modalCekPesanan')" title="Lacak Pesanan"></i>
            <div class="hamburger" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#home" onclick="toggleMenu()">Home</a>
        <a href="#katalog" onclick="toggleMenu()">Katalog</a>
        <a href="#contact" onclick="toggleMenu()">Contact</a>
    </div>

    <!-- HERO SECTION -->
    <section id="home">
        <div class="hero-text">
            <h1>PERCETAKAN<br>UNDANGAN & ATK</h1>
            <p>Solusi percetakan modern dengan kualitas terbaik. Kami melayani pembuatan undangan kustom, spanduk, hingga ATK lengkap.</p>
            <div style="margin-top: 30px; display: flex; gap: 15px; flex-wrap: wrap; justify-content: center;">
                <a href="#katalog" class="btn btn-primary">Lihat Katalog</a>
                <a href="#contact" class="btn btn-secondary">Hubungi Kami</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="card-stack" style="background-image: url('https://resourceboy.com/wp-content/uploads/2021/11/top-view-of-wedding-invitations-mockup-scene-creator.jpg');"></div>
            <div class="card-stack top" style="background-image: url('https://cdn.psdrepo.com/images/2x/invitation-card-mockup-with-vellum-wrap-i3.jpg');"></div>
        </div>
    </section>

    <!-- KATALOG SECTION -->
    <section id="katalog">
        <div class="catalog-header">
            <div class="search-bar">
                <i class="fas fa-search" style="color: #999;"></i>
                <input type="text" id="searchInput" onkeyup="searchProduct()" placeholder="Cari produk (Undangan, Spanduk)...">
            </div>

            <div style="display:flex; gap:10px; width:100%; justify-content: space-between; flex-wrap: wrap;">
                <select id="sortSelect" onchange="sortProducts()" class="sort-dropdown" style="flex:1;">
                    <option value="default">Urutan Default</option>
                    <option value="price_asc">Harga: Rendah ke Tinggi</option>
                    <option value="price_desc">Harga: Tinggi ke Rendah</option>
                    <option value="name_asc">Nama: A - Z</option>
                </select>

                <button class="btn btn-secondary" onclick="openModal('modalCekPesanan')" style="flex:1; min-width: 150px;">
                    Cek Pesanan
                </button>
            </div>
        </div>

        <div class="slider-container" id="sliderContainer">
            <button class="scroll-btn left" onmousedown="startScrolling('left')" onmouseup="stopScrolling()" onmouseleave="stopScrolling()"><i class="fas fa-chevron-left"></i></button>

            <div class="product-scroll-wrapper" id="katalogScroll">
                @foreach($produk as $key => $item)
                <div class="product-card" 
                     onclick="openProductModal({{ $key }})"
                     data-harga="{{ $item->harga }}" 
                     data-nama="{{ strtolower($item->nama_produk) }}">
                     
                    <div class="product-img">
                        <img src="{{ asset('img/'.$item->foto_produk) }}" alt="{{ $item->nama_produk }}">
                    </div>
                    <div class="product-info">
                        <div>
                            <p class="cat-label">{{ $item->kategori }}</p>
                            <h3>{{ $item->nama_produk }}</h3>
                        </div>
                        <div class="price-info">
                            <p class="price">
                                Rp {{ number_format($item->harga, 0, ',', '.') }} <span>/pcs</span>
                            </p>
                            <p class="min-order">Min. Order: {{ $item->min_order }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div id="noResults">
                <i class="fas fa-search-minus fa-3x" style="opacity: 0.3; margin-bottom: 15px;"></i>
                <p>Maaf, produk tidak ditemukan.</p>
            </div>

            <button class="scroll-btn right" onmousedown="startScrolling('right')" onmouseup="stopScrolling()" onmouseleave="stopScrolling()"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact">
        <div class="contact-grid">
            <div>
                <h3 style="margin-bottom: 20px;">Hubungi Kami</h3>
                <div class="contact-item">
                    <div class="icon-circle"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <p style="font-size: 0.8rem; color:#888;">WhatsApp</p>
                        <p style="font-weight: 600;">0815-2728-0817</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                    <div>
                        <p style="font-size: 0.8rem; color:#888;">Email</p>
                        <p style="font-weight: 600;">muhammadhamzah.study@gmail.com</p>
                    </div>
                </div>
            </div>
            <div>
                <h3 style="margin-bottom: 20px;">Lokasi</h3>
                <div class="contact-item">
                    <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <p style="font-weight: 600;">Jln. In aja dulu No.333</p>
                        <p style="font-size: 0.9rem; color:#666;">(Dekat Pusat Kota)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL DETAIL PRODUK -->
    <div id="modalProduk" class="modal">
        <div class="modal-content">
            <button class="modal-nav-btn prev" onclick="switchProduct('prev')"><i class="fas fa-chevron-left"></i></button>
            <span class="modal-close" onclick="closeModal('modalProduk')">&times;</span>
            
            <div id="modalBody">
                <div style="width: 50%; background: #f4f4f4; border-radius: 15px; overflow: hidden; min-height: 300px;">
                    <img id="modalImg" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                
                <div style="width: 50%; display: flex; flex-direction: column; justify-content: center;">
                    <p id="modalCat" style="color: var(--accent); font-weight: 700; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">KATEGORI</p>
                    <h2 id="modalTitle" style="margin-bottom: 15px; color:var(--primary); line-height: 1.2;">Nama Produk</h2>
                    
                    <div id="modalDesc" style="color: #666; margin-bottom: 25px; line-height: 1.6; white-space: pre-line;">Deskripsi...</div>
                    
                    <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid #eee;">
                        <h3 id="modalPrice" style="color: var(--primary); font-size: 1.5rem;">Rp 0</h3>
                        <p id="modalMinOrder" style="font-size: 0.9rem; color: #888; margin-bottom: 20px;">Min Order: -</p>
                        
                        <a href="{{ url('/pesan') }}" class="btn btn-primary" style="width: 100%; text-align: center; display:block;">
                            Pesan Sekarang <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <button class="modal-nav-btn next" onclick="switchProduct('next')"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <!-- MODAL CEK PESANAN (REFINED) -->
    <div id="modalCekPesanan" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('modalCekPesanan')">&times;</span>
            
            <h3 class="modal-title">Lacak Pesanan Anda</h3>
            <p class="modal-subtitle">Masukkan Kode Pesanan (ID) atau No. WhatsApp</p>
            
            <div class="search-wrapper">
                <input type="text" id="inputKode" class="search-input" placeholder="Contoh: 1 atau 0812...">
                <button class="search-btn" onclick="cekPesanan()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <!-- Hasil Pencarian -->
            <div id="resultArea" class="result-card">
                <div class="info-row">
                    <span class="label">Customer</span>
                    <span class="value" id="resNama">-</span>
                </div>
                <div class="info-row">
                    <span class="label">Kode Pesan</span>
                    <span class="value" id="resId">-</span>
                </div>
                <div class="info-row">
                    <span class="label">Tgl Pesan</span>
                    <span class="value" id="resTgl">-</span>
                </div>
                <div class="info-row">
                    <span class="label">Detail</span>
                    <span class="value" id="resDetail">-</span>
                </div>
                <div class="info-row" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                    <span class="label" style="font-weight: 700; color: var(--primary);">Status</span>
                    <span class="badge" id="resStatus">-</span>
                </div>
            </div>

            <!-- Pesan Error -->
            <div id="notFoundMsg" style="display: none; margin-top: 20px; color: #e74c3c; font-weight: 500;">
                <i class="fas fa-times-circle"></i> Data tidak ditemukan.
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('active'); }

        const allProducts = @json($produk);
        let currentIndex = 0;
        let scrollInterval;
        const baseUrl = "{{ asset('img') }}"; 

        function searchProduct() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.getElementsByClassName('product-card');
            let hasResults = false;

            for (let i = 0; i < cards.length; i++) {
                let title = cards[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
                let cat = cards[i].getElementsByClassName('cat-label')[0].innerText.toLowerCase();
                if (title.includes(input) || cat.includes(input)) {
                    cards[i].style.display = ""; hasResults = true;
                } else { cards[i].style.display = "none"; }
            }
            document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
            document.getElementById('katalogScroll').style.display = hasResults ? 'flex' : 'none';
        }

        function sortProducts() {
            const sortType = document.getElementById('sortSelect').value;
            const container = document.getElementById('katalogScroll');
            let cards = Array.from(container.getElementsByClassName('product-card'));
            cards.sort((a, b) => {
                const pA = parseInt(a.getAttribute('data-harga'));
                const pB = parseInt(b.getAttribute('data-harga'));
                const nA = a.getAttribute('data-nama');
                const nB = b.getAttribute('data-nama');
                if (sortType === 'price_asc') return pA - pB;
                if (sortType === 'price_desc') return pB - pA;
                if (sortType === 'name_asc') return nA.localeCompare(nB);
                return 0;
            });
            cards.forEach(c => container.appendChild(c));
        }

        function startScrolling(dir) {
            const c = document.getElementById('katalogScroll'); stopScrolling();
            scrollInterval = setInterval(() => { c.scrollLeft += (dir==='left'?-20:20); }, 15);
        }
        function stopScrolling() { clearInterval(scrollInterval); }

        function openModal(id) { document.getElementById(id).classList.add('show'); }
        function closeModal(id) { document.getElementById(id).classList.remove('show'); }
        window.onclick = function(e) { if(e.target.classList.contains('modal')) e.target.classList.remove('show'); }

        function openProductModal(idx) { currentIndex = idx; updateModal(); openModal('modalProduk'); }

        function switchProduct(dir) {
            const mb = document.getElementById('modalBody');
            mb.classList.add('animating-out');
            setTimeout(() => {
                if(dir==='next') currentIndex = (currentIndex+1)%allProducts.length;
                else currentIndex = (currentIndex-1+allProducts.length)%allProducts.length;
                updateModal();
                mb.classList.remove('animating-out');
            }, 300);
        }

        function updateModal() {
            const item = allProducts[currentIndex];
            document.getElementById('modalTitle').innerText = item.nama_produk;
            document.getElementById('modalCat').innerText = item.kategori;
            document.getElementById('modalDesc').innerText = item.deskripsi_produk;
            document.getElementById('modalPrice').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga) + ' /pcs';
            document.getElementById('modalMinOrder').innerText = 'Minimal Order: ' + item.min_order;
            document.getElementById('modalImg').src = baseUrl + '/' + item.foto_produk;
        }

        async function cekPesanan() {
            let kode = document.getElementById('inputKode').value;
            let resultArea = document.getElementById('resultArea');
            let notFoundMsg = document.getElementById('notFoundMsg');

            if(!kode) { alert("Mohon isi data!"); return; }

            try {
                let response = await fetch(`/cek-status?kode=${kode}`);
                let data = await response.json();

                if (data.status === 'found') {
                    document.getElementById('resNama').innerText = data.data.nama_pelanggan;
                    
                    // PERBAIKAN UTAMA: Ganti id_pesanan menjadi kode_pesanan
                    document.getElementById('resId').innerText = data.data.kode_pesanan;
                    
                    let tgl = new Date(data.data.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                    document.getElementById('resTgl').innerText = tgl;
                    document.getElementById('resDetail').innerText = data.data.detail_pesanan;
                    
                    let badge = document.getElementById('resStatus');
                    let st = data.data.status;
                    badge.innerText = st;
                    if(st === 'Selesai') badge.style.backgroundColor = '#2e7d32';
                    else if(st === 'Proses') badge.style.backgroundColor = '#ef6c00';
                    else badge.style.backgroundColor = '#c62828';

                    resultArea.style.display = 'block';
                    notFoundMsg.style.display = 'none';
                } else {
                    resultArea.style.display = 'none';
                    notFoundMsg.style.display = 'block';
                }
            } catch (error) { alert("Gagal menghubungi server."); }
        }
    </script>
</body>
</html>