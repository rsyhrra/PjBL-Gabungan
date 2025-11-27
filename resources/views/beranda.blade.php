<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aneka Usaha - Percetakan & ATK</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- 1. VARS & RESET --- */
        :root {
            --bg-color: #FDFBF7;
            --primary: #2C3E50;
            --accent: #D4A373;
            --white: #ffffff;
            --shadow-sm: 0 4px 6px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); color: var(--primary); overflow-x: hidden; }

        /* --- 2. NAVBAR --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 5%; position: sticky; top: 0;
            background: rgba(253, 251, 247, 0.95); backdrop-filter: blur(10px);
            z-index: 1000; box-shadow: var(--shadow-sm);
        }
        .logo { font-weight: 800; font-size: 1.4rem; letter-spacing: 1px; color: var(--primary); }
        
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { text-decoration: none; color: var(--primary); font-weight: 500; transition: 0.3s; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--accent); }
        
        .nav-icons { display: flex; align-items: center; gap: 20px; }
        .nav-icons i { cursor: pointer; font-size: 1.2rem; transition: 0.3s; color: var(--primary); }
        .nav-icons i:hover { color: var(--accent); transform: scale(1.1); }
        .hamburger { display: none; font-size: 1.5rem; cursor: pointer; }

        /* Mobile Menu */
        .mobile-menu {
            display: none; flex-direction: column; background: var(--white);
            position: absolute; top: 60px; left: 0; width: 100%;
            padding: 20px; box-shadow: var(--shadow-lg); z-index: 999; text-align: center; gap: 15px;
        }
        .mobile-menu.active { display: flex; animation: slideDown 0.3s ease; }
        .mobile-menu a { text-decoration: none; color: var(--primary); font-weight: 600; }

        /* --- 3. HERO SECTION (IMPROVED) --- */
        #home {
            display: flex; align-items: center; justify-content: space-between;
            min-height: 90vh; padding: 0 5%; position: relative;
            /* Background Pattern Halus */
            background-image: radial-gradient(#D4A373 1px, transparent 1px);
            background-size: 30px 30px; /* Jarak titik-titik */
            background-color: var(--bg-color);
        }
        /* Overlay gradasi agar pattern tidak terlalu ramai */
        #home::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(90deg, var(--bg-color) 0%, rgba(253,251,247,0.8) 50%, transparent 100%);
            z-index: 1;
        }

        .hero-text { max-width: 50%; z-index: 2; position: relative; }
        .hero-text h1 { font-size: 3.2rem; line-height: 1.2; margin-bottom: 15px; font-weight: 800; color: var(--primary); }
        .hero-text span { color: var(--accent); }
        .hero-text p { font-size: 1.05rem; color: #555; margin-bottom: 30px; line-height: 1.6; max-width: 90%; }
        
        .btn-group { display: flex; gap: 15px; }
        .btn {
            padding: 12px 30px; border-radius: 50px; text-decoration: none;
            font-weight: 600; border: none; cursor: pointer; transition: 0.3s;
            display: inline-block; font-size: 0.95rem; text-align: center;
        }
        .btn-primary { background-color: var(--primary); color: var(--white); box-shadow: 0 5px 15px rgba(44, 62, 80, 0.2); }
        .btn-secondary { background-color: var(--accent); color: var(--white); box-shadow: 0 5px 15px rgba(212, 163, 115, 0.2); }
        .btn:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }

        .hero-image { position: relative; width: 45%; display: flex; justify-content: center; z-index: 2; height: 450px; align-items: center; }
        
        /* Card Stack */
        .card-stack {
            width: 280px; height: 360px; background: #ddd;
            background-size: cover; background-position: center;
            position: absolute; transform: rotate(-6deg); border-radius: 20px;
            box-shadow: var(--shadow-lg); border: 6px solid var(--white);
        }
        .card-stack.top {
            transform: rotate(6deg); z-index: 2;
            top: 20px; left: 60px; /* Offset sedikit */
        }

        /* --- 4. KATALOG SLIDER --- */
        #katalog { padding: 80px 5%; background: var(--white); position: relative; z-index: 2; }
        .section-title { text-align: center; margin-bottom: 40px; }
        .section-title h2 { font-size: 2rem; font-weight: 700; color: var(--primary); }
        .section-title p { color: #888; margin-top: 5px; }

        .catalog-header { display: flex; justify-content: space-between; margin-bottom: 30px; align-items: center; flex-wrap: wrap; gap: 15px; }
        
        .search-wrapper { position: relative; width: 350px; }
        .search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #999; }
        .search-bar { 
            width: 100%; background: #f8f9fa; padding: 12px 12px 12px 40px; 
            border-radius: 30px; border: 1px solid #eee; outline: none; transition: 0.3s;
        }
        .search-bar:focus { border-color: var(--accent); background: #fff; }
        
        .filter-group { display: flex; gap: 10px; flex: 1; justify-content: flex-end; }
        .sort-dropdown { padding: 10px 15px; border-radius: 30px; border: 1px solid #eee; background: #fff; cursor: pointer; font-size: 0.9rem; color: var(--primary); outline: none; }

        /* Slider */
        .slider-container { position: relative; display: flex; align-items: center; gap: 20px; }
        .product-scroll-wrapper {
            display: flex; overflow-x: auto; scroll-behavior: smooth; 
            gap: 25px; padding: 10px 5px 30px 5px; width: 100%;
            scrollbar-width: none; 
        }
        .product-scroll-wrapper::-webkit-scrollbar { display: none; } 

        /* Product Card */
        .product-card {
            background: var(--white); border-radius: 15px;
            min-width: 260px; max-width: 260px; flex: 0 0 auto;
            transition: 0.3s; cursor: pointer; border: 1px solid #f0f0f0;
            display: flex; flex-direction: column; overflow: hidden;
            box-shadow: 0 5px 10px rgba(0,0,0,0.03);
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: var(--accent); }

        .product-img { height: 180px; background-color: #f4f4f4; overflow: hidden; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .product-card:hover .product-img img { transform: scale(1.05); }

        .product-info { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cat-label { font-size: 0.7rem; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .product-title { font-size: 1rem; margin: 5px 0; color: var(--primary); line-height: 1.3; font-weight: 600; }
        
        .price-box { margin-top: 15px; border-top: 1px dashed #eee; padding-top: 10px; display: flex; justify-content: space-between; align-items: center; }
        .price { font-weight: 700; color: var(--primary); font-size: 1.1rem; }
        .price small { font-size: 0.75rem; font-weight: 400; color: #999; }
        .min-order { font-size: 0.7rem; background: #f0f0f0; padding: 3px 8px; border-radius: 4px; color: #666; }

        .scroll-btn {
            background: var(--white); color: var(--primary); border: 1px solid #eee;
            width: 45px; height: 45px; border-radius: 50%;
            cursor: pointer; z-index: 5; display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm); transition: 0.2s; flex-shrink: 0;
        }
        .scroll-btn:hover { background: var(--primary); color: var(--white); }

        #noResults { width: 100%; text-align: center; padding: 40px; color: #999; display: none; }

        /* --- 5. CONTACT SECTION --- */
        #contact { padding: 80px 5%; background: var(--bg-color); }
        .contact-wrapper { 
            display: grid; grid-template-columns: 1fr 1fr; gap: 50px; 
            background: var(--white); padding: 40px; border-radius: 20px; box-shadow: var(--shadow-sm);
        }
        .contact-info h3 { font-size: 1.5rem; margin-bottom: 20px; color: var(--primary); }
        .contact-item { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; }
        .icon-box { 
            width: 45px; height: 45px; background: #f4f4f4; border-radius: 10px; 
            display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 1.2rem;
        }
        .contact-text h4 { font-size: 0.95rem; margin-bottom: 2px; color: var(--primary); }
        .contact-text p { font-size: 0.9rem; color: #666; line-height: 1.4; }

        .map-box { width: 100%; height: 100%; min-height: 250px; background: #eee; border-radius: 15px; overflow: hidden; }
        .map-box iframe { width: 100%; height: 100%; border: none; }

        /* --- 6. MODAL STYLES --- */
        .modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.6); z-index: 2000;
            justify-content: center; align-items: center; padding: 20px;
            backdrop-filter: blur(5px); opacity: 0; transition: opacity 0.3s ease;
        }
        .modal.show { display: flex; opacity: 1; }
        
        /* Modal Produk */
        #modalProduk .modal-content {
            background: var(--white); padding: 0; border-radius: 20px;
            width: 100%; max-width: 900px; position: relative;
            box-shadow: var(--shadow-lg); display: flex; overflow: hidden;
            min-height: 450px;
        }
        #modalBody { display: flex; width: 100%; }
        
        .modal-left { width: 50%; background: #f9f9f9; display: flex; align-items: center; justify-content: center; }
        .modal-left img { width: 100%; height: 100%; object-fit: cover; }
        
        .modal-right { width: 50%; padding: 40px; display: flex; flex-direction: column; justify-content: center; }
        .modal-cat { color: var(--accent); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .modal-title { font-size: 1.8rem; font-weight: 700; color: var(--primary); margin-bottom: 15px; line-height: 1.2; }
        .modal-desc { color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 30px; }
        
        .modal-price-box { margin-top: auto; padding-top: 20px; border-top: 1px solid #eee; }
        .modal-price { font-size: 1.5rem; font-weight: 700; color: var(--primary); }
        .modal-min-order { font-size: 0.85rem; color: #999; margin-bottom: 15px; display: block; }

        .modal-close { position: absolute; top: 20px; right: 20px; font-size: 1.8rem; cursor: pointer; z-index: 10; color: #333; }
        
        .nav-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 40px; height: 40px; background: rgba(255,255,255,0.8); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; cursor: pointer;
            z-index: 5; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: 0.2s;
        }
        .nav-arrow:hover { background: var(--white); transform: translateY(-50%) scale(1.1); }
        .nav-arrow.prev { left: 20px; }
        .nav-arrow.next { right: 20px; }

        /* Modal Cek Pesanan */
        #modalCekPesanan .modal-content {
            background: var(--white); padding: 40px; border-radius: 20px;
            width: 100%; max-width: 480px; text-align: center; position: relative;
        }
        .cek-input-group { display: flex; gap: 10px; margin-bottom: 20px; }
        .cek-input { flex: 1; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; }
        .cek-btn { padding: 12px 20px; background: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer; }
        
        /* Result Box */
        .result-card { background: #f8f9fa; border-radius: 12px; padding: 20px; text-align: left; margin-top: 20px; display: none; border: 1px solid #eee; }
        .res-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9rem; }
        .res-label { color: #888; }
        .res-val { font-weight: 600; color: var(--primary); }
        .badge { padding: 4px 12px; border-radius: 20px; color: white; font-size: 0.75rem; font-weight: 600; display: inline-block; }

        /* ANIMATION */
        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes slideDown { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* --- MEDIA QUERIES (MOBILE) --- */
        @media (max-width: 768px) {
            nav { padding: 15px 20px; }
            .nav-links { display: none; }
            .hamburger { display: block; }
            
            #home { 
                flex-direction: column-reverse; text-align: center; padding: 40px 20px; 
                justify-content: center; gap: 30px; margin-top: 0;
                background-image: none; /* Hapus pattern di HP agar bersih */
            }
            #home::before { display: none; } /* Hapus overlay di HP */

            .hero-text { max-width: 100%; }
            .hero-text h1 { font-size: 2.2rem; }
            .btn-group { justify-content: center; }
            .btn { width: 100%; } /* Tombol full width di HP */

            .hero-image { width: 100%; height: 320px; }
            .card-stack { width: 200px; height: 260px; left: 50%; top: 50%; transform: translate(-50%, -50%) rotate(-6deg); }
            .card-stack.top { left: 50%; top: 50%; transform: translate(-40%, -60%) rotate(6deg); }

            #katalog { padding: 50px 20px; }
            .catalog-header { flex-direction: column; align-items: stretch; }
            .search-wrapper { width: 100%; }
            .scroll-btn { display: none; } /* Swipe only */
            
            /* Kontak Grid */
            .contact-wrapper { grid-template-columns: 1fr; padding: 30px 20px; }
            
            /* Modal Responsif */
            #modalProduk .modal-content { 
                flex-direction: column; height: 85vh; overflow-y: auto; 
                width: 95%; padding-bottom: 20px; 
            }
            #modalBody { flex-direction: column; }
            .modal-left { width: 100%; height: 250px; }
            .modal-right { width: 100%; padding: 20px; }
            .nav-arrow { display: none; } /* Sembunyikan panah di modal HP */
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">ANEKA USAHA</div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#katalog">Katalog</a>
            <a href="#contact">Hubungi Kami</a>
        </div>
        <div class="nav-icons">
            <i class="fas fa-receipt" onclick="openModal('modalCekPesanan')" title="Lacak Pesanan"></i>
            <div class="hamburger" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        </div>
    </nav>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#home" onclick="toggleMenu()">Home</a>
        <a href="#katalog" onclick="toggleMenu()">Katalog</a>
        <a href="#contact" onclick="toggleMenu()">Hubungi Kami</a>
    </div>

    <!-- HERO SECTION -->
    <section id="home">
        <div class="hero-text">
            <h1>Percetakan <span>Modern</span> & <br>Terpercaya</h1>
            <p>Solusi cetak undangan, spanduk, dan kebutuhan ATK dengan kualitas terbaik dan harga bersahabat.</p>
            <div class="btn-group">
                <a href="#katalog" class="btn btn-primary">Lihat Katalog</a>
                <a href="#contact" class="btn btn-secondary">Konsultasi</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="card-stack" style="background-image: url('https://resourceboy.com/wp-content/uploads/2021/11/top-view-of-wedding-invitations-mockup-scene-creator.jpg');"></div>
            <div class="card-stack top" style="background-image: url('https://cdn.psdrepo.com/images/2x/invitation-card-mockup-with-vellum-wrap-i3.jpg');"></div>
        </div>
    </section>

    <!-- KATALOG SECTION -->
    <section id="katalog">
        <div class="section-title">
            <h2>Produk Unggulan</h2>
            <p>Pilih kategori produk yang Anda butuhkan</p>
        </div>

        <div class="catalog-header">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="search-bar" onkeyup="searchProduct()" placeholder="Cari produk...">
            </div>
            <div class="filter-group">
                <select id="sortSelect" onchange="sortProducts()" class="sort-dropdown">
                    <option value="default">Urutan Default</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                    <option value="name_asc">Nama A-Z</option>
                </select>
                <button class="btn btn-secondary" onclick="openModal('modalCekPesanan')" style="padding: 10px 20px; font-size: 0.85rem;">Cek Status</button>
            </div>
        </div>

        <div class="slider-container">
            <button class="scroll-btn left" onmousedown="startScrolling('left')" onmouseup="stopScrolling()"><i class="fas fa-chevron-left"></i></button>

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
                            <h3 class="product-title">{{ $item->nama_produk }}</h3>
                        </div>
                        <div class="price-box">
                            <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }} <small>/pcs</small></p>
                            <span class="min-order">Min: {{ $item->min_order }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div id="noResults">
                <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.3;"></i>
                <p>Produk tidak ditemukan.</p>
            </div>

            <button class="scroll-btn right" onmousedown="startScrolling('right')" onmouseup="stopScrolling()"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h3>Hubungi Kami</h3>
                <div class="contact-item">
                    <div class="icon-box"><i class="fab fa-whatsapp"></i></div>
                    <div class="contact-text">
                        <h4>WhatsApp</h4>
                        <p>0815-2728-0817</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                    <div class="contact-text">
                        <h4>Email</h4>
                        <p>admin@anekausaha.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-text">
                        <h4>Alamat</h4>
                        <p>Jln. In aja dulu No.333<br>(Dekat Pusat Kota)</p>
                    </div>
                </div>
            </div>
            <div class="map-box">
                <!-- Placeholder Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.057892699999!2d119.423!3d-5.147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMDgnNDkuMiJTIDExOcKwMjUnMjIuOCJF!5e0!3m2!1sen!2sid!4v1630000000000!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- MODAL DETAIL PRODUK -->
    <div id="modalProduk" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('modalProduk')">&times;</span>
            <div class="nav-arrow prev" onclick="switchProduct('prev')"><i class="fas fa-chevron-left"></i></div>
            
            <div id="modalBody">
                <div class="modal-left">
                    <img id="modalImg" src="" alt="Preview">
                </div>
                <div class="modal-right">
                    <div>
                        <p id="modalCat" class="modal-cat">KATEGORI</p>
                        <h2 id="modalTitle" class="modal-title">Judul Produk</h2>
                        <div id="modalDesc" class="modal-desc">Deskripsi...</div>
                    </div>
                    <div class="modal-price-box">
                        <h3 id="modalPrice" class="modal-price">Rp 0</h3>
                        <small id="modalMinOrder" class="modal-min-order">Min Order: -</small>
                        <a href="{{ url('/pesan') }}" class="btn btn-primary" style="width: 100%; display: block;">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="nav-arrow next" onclick="switchProduct('next')"><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>

    <!-- MODAL CEK PESANAN -->
    <div id="modalCekPesanan" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('modalCekPesanan')">&times;</span>
            <h3 style="margin-bottom: 10px;">Lacak Pesanan</h3>
            <p style="color:#888; font-size:0.9rem; margin-bottom:20px;">Masukkan Kode Pesanan atau No. WA</p>
            
            <div class="cek-input-group">
                <input type="text" id="inputKode" class="cek-input" placeholder="Contoh: AU-2511...">
                <button onclick="cekPesanan()" class="cek-btn"><i class="fas fa-search"></i></button>
            </div>
            
            <div id="resultArea" class="result-card">
                <div class="res-row"><span class="res-label">Nama</span><span class="res-val" id="resNama">-</span></div>
                <div class="res-row"><span class="res-label">Tanggal</span><span class="res-val" id="resTgl">-</span></div>
                <div class="res-row"><span class="res-label">Status</span><span class="badge" id="resStatus">-</span></div>
            </div>
            <p id="notFoundMsg" style="color:red; display:none; margin-top:10px;">Data tidak ditemukan.</p>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('active'); }

        // Data dari Controller
        const allProducts = @json($produk);
        let currentIndex = 0;
        let scrollInterval;
        const baseUrl = "{{ asset('img') }}"; 

        // --- SEARCH ---
        function searchProduct() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.getElementsByClassName('product-card');
            let hasResults = false;

            for(let i=0; i<cards.length; i++) {
                let title = cards[i].getAttribute('data-nama');
                let cat = cards[i].querySelector('.cat-label').innerText.toLowerCase();
                if(title.includes(input) || cat.includes(input)) {
                    cards[i].style.display = ""; hasResults = true;
                } else { cards[i].style.display = "none"; }
            }
            document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
        }

        // --- SORTING ---
        function sortProducts() {
            const type = document.getElementById('sortSelect').value;
            const container = document.getElementById('katalogScroll');
            let cards = Array.from(container.getElementsByClassName('product-card'));

            cards.sort((a, b) => {
                const pA = parseInt(a.getAttribute('data-harga'));
                const pB = parseInt(b.getAttribute('data-harga'));
                const nA = a.getAttribute('data-nama');
                const nB = b.getAttribute('data-nama');

                if (type === 'price_asc') return pA - pB;
                if (type === 'price_desc') return pB - pA;
                if (type === 'name_asc') return nA.localeCompare(nB);
                return 0;
            });
            cards.forEach(c => container.appendChild(c));
        }

        // --- SCROLL ---
        function startScrolling(dir) {
            const c = document.getElementById('katalogScroll'); stopScrolling();
            scrollInterval = setInterval(() => { c.scrollLeft += (dir==='left'?-20:20); }, 15);
        }
        function stopScrolling() { clearInterval(scrollInterval); }

        // --- MODAL ---
        function openModal(id) { document.getElementById(id).classList.add('show'); }
        function closeModal(id) { document.getElementById(id).classList.remove('show'); }
        window.onclick = function(e) { if(e.target.classList.contains('modal')) e.target.classList.remove('show'); }

        function openProductModal(idx) { currentIndex = idx; updateModal(); openModal('modalProduk'); }

        function switchProduct(dir) {
            if(dir==='next') currentIndex = (currentIndex+1)%allProducts.length;
            else currentIndex = (currentIndex-1+allProducts.length)%allProducts.length;
            updateModal();
        }

        function updateModal() {
            const item = allProducts[currentIndex];
            document.getElementById('modalTitle').innerText = item.nama_produk;
            document.getElementById('modalCat').innerText = item.kategori;
            document.getElementById('modalDesc').innerText = item.deskripsi_produk;
            document.getElementById('modalPrice').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga);
            document.getElementById('modalMinOrder').innerText = 'Min Order: ' + item.min_order;
            document.getElementById('modalImg').src = baseUrl + '/' + item.foto_produk;
        }

        // --- CEK PESANAN ---
        async function cekPesanan() {
            let kode = document.getElementById('inputKode').value;
            if(!kode) { alert("Masukkan kode dulu!"); return; }
            try {
                let res = await fetch(`/cek-status?kode=${kode}`);
                let data = await res.json();
                if(data.status === 'found') {
                    document.getElementById('resNama').innerText = data.data.nama_pelanggan;
                    let tgl = new Date(data.data.created_at).toLocaleDateString('id-ID');
                    document.getElementById('resTgl').innerText = tgl;
                    
                    let badge = document.getElementById('resStatus');
                    let st = data.data.status;
                    badge.innerText = st;
                    if(st === 'Selesai') badge.style.backgroundColor = '#2e7d32';
                    else if(st === 'Proses') badge.style.backgroundColor = '#ef6c00';
                    else badge.style.backgroundColor = '#c62828';

                    document.getElementById('resultArea').style.display = 'block';
                    document.getElementById('notFoundMsg').style.display = 'none';
                } else {
                    document.getElementById('resultArea').style.display = 'none';
                    document.getElementById('notFoundMsg').style.display = 'block';
                }
            } catch(e) { alert("Gagal koneksi server"); }
        }
    </script>
</body>
</html>