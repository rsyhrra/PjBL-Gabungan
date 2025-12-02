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

        /* --- 3. HERO SECTION --- */
        #home {
            display: flex; align-items: center; justify-content: space-between;
            min-height: 90vh; padding: 0 5%; position: relative;
        }
        .hero-text { max-width: 50%; z-index: 2; }
        .hero-text h1 { font-size: 3.5rem; line-height: 1.1; margin-bottom: 20px; font-weight: 700; }
        .hero-text p { font-size: 1.1rem; color: #666; margin-bottom: 30px; line-height: 1.6; }
        
        .btn {
            padding: 12px 35px; border-radius: 50px; text-decoration: none;
            font-weight: 600; border: none; cursor: pointer; transition: 0.3s;
            display: inline-block; font-size: 0.9rem; text-align: center;
        }
        .btn-primary { background-color: var(--primary); color: var(--white); box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3); }
        .btn-secondary { background-color: var(--accent); color: var(--white); box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3); }
        .btn:hover { transform: translateY(-3px); }

        .hero-image { position: relative; width: 45%; display: flex; justify-content: center; height: 400px; align-items: center; }
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
            top: 20px; left: 80px; border: 4px solid #fff;
        }

        /* --- 4. KATALOG SLIDER --- */
        #katalog { padding: 60px 50px; background: #fff; }
        .catalog-header { display: flex; justify-content: space-between; margin-bottom: 30px; align-items: center; gap: 15px; flex-wrap: wrap; }
        
        /* Product Search Box Styles */
        .product-search-box { 
            background: #f0f0f0; 
            padding: 10px 20px; 
            border-radius: 30px; 
            display: flex; 
            align-items: center; 
            width: 350px; 
            transition: 0.3s;
            border: 1px solid transparent; 
        }
        .product-search-box:focus-within { 
            background: #fff; 
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(212, 163, 115, 0.1); 
        }
        .product-search-box i { color: #999; margin-right: 10px; }
        .product-search-box input { 
            border: none; background: transparent; outline: none; width: 100%; 
            font-family: inherit; color: var(--primary); font-size: 0.95rem;
        }
        
        .sort-dropdown {
            padding: 10px 15px; border-radius: 30px; border: 1px solid #ccc; 
            color: var(--primary); outline: none; cursor: pointer; font-family: inherit;
            background-color: #fff; font-size: 0.9rem; min-width: 150px;
        }
        .sort-dropdown:hover { border-color: var(--accent); }

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

        .product-img { height: 180px; background-color: #f4f4f4; overflow: hidden; position: relative; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
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
        .scroll-btn:active { transform: scale(0.9); background-color: var(--accent); }

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

        /* --- 6. FLOATING CART --- */
        .cart-floating-btn {
            position: fixed; bottom: 30px; right: 30px;
            width: 65px; height: 65px; background: var(--accent); color: white;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; cursor: pointer; box-shadow: 0 10px 25px rgba(212, 163, 115, 0.5);
            z-index: 1000; transition: 0.3s;
        }
        .cart-floating-btn:hover { transform: scale(1.1); }
        .cart-badge {
            position: absolute; top: -5px; right: -5px;
            background: #c62828; color: white; width: 25px; height: 25px;
            border-radius: 50%; font-size: 0.75rem; font-weight: bold;
            display: flex; align-items: center; justify-content: center; border: 2px solid white;
        }

        /* Cart List Style */
        .cart-item { display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px dashed #eee; background: #fdfdfd; }
        .cart-item-title { font-weight: 600; color: var(--primary); font-size: 0.95rem; }
        .cart-item-price { font-size: 0.85rem; color: #888; }
        .btn-remove { color: #e74c3c; cursor: pointer; font-size: 1.1rem; margin-left: 10px; }
        .cart-total { margin-top: 20px; padding: 15px; background: #f0f0f0; border-radius: 10px; display: flex; justify-content: space-between; font-weight: 700; color: var(--primary); }

        /* --- 7. MODAL STYLES --- */
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
            box-shadow: var(--shadow-lg); display: flex;
            /* HAPUS OVERFLOW HIDDEN AGAR TOMBOL KELUAR */
            /* overflow: hidden; */
            min-height: 450px;
        }
        
        #modalBody { display: flex; width: 100%; transition: all 0.3s ease-in-out; opacity: 1; transform: scale(1); }
        
        .modal-left { 
            width: 50%; background: #f9f9f9; display: flex; align-items: center; justify-content: center;
            /* Tambahkan border radius manual karena overflow hidden dihapus */
            border-top-left-radius: 20px; border-bottom-left-radius: 20px;
        }
        .modal-left img { width: 100%; height: 100%; object-fit: cover; border-top-left-radius: 20px; border-bottom-left-radius: 20px; }
        
        .modal-right { width: 50%; padding: 40px; display: flex; flex-direction: column; justify-content: center; }
        .modal-cat { color: var(--accent); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .modal-title { font-size: 1.8rem; font-weight: 700; color: var(--primary); margin-bottom: 15px; line-height: 1.2; }
        .modal-desc { color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 30px; }
        
        .modal-price-box { margin-top: auto; padding-top: 20px; border-top: 1px solid #eee; }
        .modal-price { font-size: 1.5rem; font-weight: 700; color: var(--primary); }
        .modal-min-order { font-size: 0.85rem; color: #999; margin-bottom: 15px; display: block; }

        .modal-close { position: absolute; top: 20px; right: 20px; font-size: 1.8rem; cursor: pointer; z-index: 10; color: #333; }
        
        /* STYLE TOMBOL NAVIGASI MODAL */
        .modal-nav-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 50px; height: 50px; border-radius: 50%;
            background-color: var(--white); color: var(--primary);
            border: 1px solid #eee; font-size: 1.2rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1); z-index: 20;
        }
        .modal-nav-btn:hover { background-color: var(--primary); color: var(--white); }
        /* Posisi Tombol Keluar Sedikit */
        .modal-nav-btn.prev { left: -25px; }
        .modal-nav-btn.next { right: -25px; }
        
        /* Input Quantity di Modal */
        .qty-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }
        .qty-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
        }
        .qty-input {
            width: 80px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            outline: none;
        }
        .qty-input:focus {
            border-color: var(--accent);
        }

        /* Modal Cek Pesanan & Keranjang */
        #modalCekPesanan .modal-content, #modalKeranjang .modal-content {
            background: var(--white); padding: 40px 30px; border-radius: 25px;
            width: 100%; max-width: 480px; display: flex; flex-direction: column; gap: 20px; 
            text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: slideUp 0.4s ease; position: relative;
        }

        .modal-title-small { font-size: 1.3rem; font-weight: 700; color: var(--primary); margin-bottom: 5px; }
        .modal-subtitle-small { font-size: 0.9rem; color: #888; margin-bottom: 20px; }

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

        .order-input { width: 100%; padding: 12px; border: 2px solid #eee; border-radius: 10px; font-size: 1rem; outline: none; transition: 0.3s; margin-bottom: 10px; }
        .order-input:focus { border-color: var(--accent); }

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

        /* ANIMATION */
        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes slideDown { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .animating-out { opacity: 0; transform: scale(0.95) translateX(-10px); }

        /* --- MEDIA QUERIES (MOBILE RESPONSIVE) --- */
        @media (max-width: 768px) {
            /* Navbar */
            nav { padding: 15px 20px; }
            .nav-links { display: none; }
            .hamburger { display: block; }
            
            /* Hero */
            #home { 
                flex-direction: column-reverse; text-align: center; 
                padding: 40px 20px; gap: 20px; justify-content: center;
                min-height: auto; margin-top: 20px;
            }
            .hero-text { max-width: 100%; z-index: 10; }
            .hero-text h1 { font-size: 2rem; margin-bottom: 15px; }
            
            .hero-text div { display: flex; flex-direction: column; gap: 10px; }
            .btn { width: 100%; margin: 0; }

            .hero-image { width: 100%; height: 320px; margin-bottom: 20px; }
            .card-stack { width: 220px; height: 280px; left: 50%; top: 50%; transform: translate(-50%, -50%) rotate(-8deg); }
            .card-stack.top { left: 50%; top: 50%; transform: translate(-40%, -60%) rotate(6deg); }
            
            /* Katalog */
            #katalog { padding: 40px 20px; }
            .catalog-header { flex-direction: column; align-items: stretch; gap: 15px; }
            
            /* Fix for search bar width in mobile */
            .product-search-box { width: 100%; }
            
            .sort-dropdown { width: 100%; margin-right: 0; }
            .slider-container { gap: 0; }
            .scroll-btn { display: none; } 
            
            /* Contact */
            #contact { padding: 40px 20px; }
            .contact-grid { grid-template-columns: 1fr; }
            
            /* Modal Responsif */
            #modalProduk .modal-content { width: 95%; padding: 20px; flex-direction: column; height: auto; max-height: 85vh; overflow-y: auto; min-height: auto; }
            #modalBody { flex-direction: column; gap: 20px; }
            
            /* Di Mobile, Gambar Radius atas saja */
            .modal-left { width: 100%; height: 250px; border-radius: 10px; }
            .modal-left img { border-radius: 10px; }
            .modal-right { width: 100%; padding: 0; }

            /* Posisi Tombol Navigasi di Mobile */
            .modal-nav-btn { top: 50%; transform: translateY(-50%); }
            .modal-nav-btn.prev { left: 5px; }
            .modal-nav-btn.next { right: 5px; }
            
            /* Modal Cek & Cart Mobile */
            #modalCekPesanan .modal-content, #modalKeranjang .modal-content { width: 95%; padding: 30px 20px; min-height: auto; }
            .cart-floating-btn { bottom: 20px; right: 20px; width: 55px; height: 55px; }
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
            <a href="#contact">Hubungi Kami</a>
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
            <h1>Percetakan <span>Modern</span> & <br>Terpercaya</h1>
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
        <div class="section-title">
            <h2>Produk Unggulan</h2>
            <p>Pilih kategori produk yang Anda butuhkan</p>
        </div>

        <div class="catalog-header">
            <div class="product-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" onkeyup="searchProduct()" placeholder="Cari produk...">
            </div>

            <div style="display:flex; gap:10px; width:100%; justify-content: space-between; flex-wrap: wrap;">
                <select id="sortSelect" onchange="sortProducts()" class="sort-dropdown" style="flex:1;">
                    <option value="default">Urutan Default</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                    <option value="name_asc">Nama A-Z</option>
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
                <i class="fas fa-search-minus fa-3x" style="opacity: 0.3; margin-bottom: 15px;"></i>
                <p>Maaf, produk tidak ditemukan.</p>
            </div>

            <button class="scroll-btn right" onmousedown="startScrolling('right')" onmouseup="stopScrolling()" onmouseleave="stopScrolling()"><i class="fas fa-chevron-right"></i></button>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.057892699999!2d119.423!3d-5.147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMDgnNDkuMiJTIDExOcKwMjUnMjIuOCJF!5e0!3m2!1sen!2sid!4v1630000000000!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- TOMBOL KERANJANG MELAYANG -->
    <div class="cart-floating-btn" onclick="openModal('modalKeranjang')">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-badge" id="cartCount">0</span>
    </div>

    <!-- MODAL DETAIL PRODUK -->
    <div id="modalProduk" class="modal">
        <div class="modal-content">
            <button class="modal-nav-btn prev" onclick="switchProduct('prev')"><i class="fas fa-chevron-left"></i></button>
            <span class="modal-close" onclick="closeModal('modalProduk')">&times;</span>
            
            <div id="modalBody">
                <div class="modal-left">
                    <img id="modalImg" src="" alt="Preview">
                </div>
                <div class="modal-right">
                    <div>
                        <p id="modalCat" class="modal-cat">KATEGORI</p>
                        <h2 id="modalTitle" class="modal-title">Nama Produk</h2>
                        <div id="modalDesc" class="modal-desc">Deskripsi...</div>
                    </div>
                    <div class="modal-price-box">
                        <h3 id="modalPrice" class="modal-price">Rp 0</h3>
                        <small id="modalMinOrder" class="modal-min-order">Min Order: -</small>
                        
                        <!-- Update: Input Quantity -->
                        <div class="qty-wrapper">
                            <label class="qty-label">Jumlah Pesan:</label>
                            <input type="number" id="modalQty" class="qty-input" value="1" min="1">
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-secondary" onclick="addToCartCurrent()" style="flex:1;">
                                <i class="fas fa-plus"></i> Keranjang
                            </button>
                            <button class="btn btn-primary" onclick="buyNow()" style="flex:1;">Beli Langsung</button>
                        </div>
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
            
            <h3 class="modal-title-small">Lacak Pesanan Anda</h3>
            <p class="modal-subtitle-small">Masukkan Kode Pesanan (ID) atau No. WhatsApp</p>
            
            <div class="search-wrapper">
                <input type="text" id="inputKode" class="search-input" placeholder="Contoh: AU-2511...">
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
                    <span class="label">No Pesan</span>
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

            <div id="notFoundMsg" style="display: none; margin-top: 20px; color: #e74c3c; font-weight: 500;">
                <i class="fas fa-times-circle"></i> Data tidak ditemukan.
            </div>
        </div>
    </div>

    <!-- MODAL KERANJANG (CHECKOUT VIA REDIRECT) -->
    <div id="modalKeranjang" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('modalKeranjang')">&times;</span>
            <h3 class="modal-title-small">Keranjang Belanja</h3>
            
            <div id="cartList" style="max-height: 200px; overflow-y: auto; margin-bottom: 15px; border: 1px solid #eee; border-radius: 10px;"></div>

            <div class="cart-total">
                <span>Total Estimasi:</span><span id="cartTotalPrice">Rp 0</span>
            </div>
            <p style="font-size:0.75rem; color:#999; margin-bottom:20px; text-align:right;">*Lanjut ke halaman pemesanan untuk mengisi data diri</p>

            <!-- TOMBOL LANJUT PEMESANAN (REDIRECT) -->
            <!-- PERBAIKAN: Tidak ada form di sini, hanya link ke halaman pesan -->
            <a href="{{ url('/pesan') }}" class="btn btn-primary" style="width:100%; display:block; text-align:center;">
                Lanjut ke Pemesanan (<span id="btnTotalItem">0</span> Item) <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('active'); }

        const allProducts = @json($produk);
        let currentIndex = 0;
        let scrollInterval;
        const baseUrl = "{{ asset('img') }}"; 
        
        // --- CART LOGIC ---
        let cart = JSON.parse(localStorage.getItem('myCart')) || [];
        updateCartUI();

        function addToCartCurrent() {
            const item = allProducts[currentIndex];
            // Ambil qty dari input
            const qtyInput = document.getElementById('modalQty');
            const qty = parseInt(qtyInput.value);
            
            // Validasi min order
            const minOrderText = item.min_order || "";
            // Mencoba mengekstrak angka dari string "400 lbr" -> 400. Default 1 jika gagal.
            const minOrderValue = parseInt(minOrderText.replace(/\D/g, '')) || 1; 

            if (qty < minOrderValue) {
                 Swal.fire({ icon: 'warning', title: 'Minimal Order!', text: `Minimal pesan ${minOrderValue} untuk produk ini.` });
                 return;
            }

            const existingItem = cart.find(c => c.id === item.id_produk);
            if(existingItem) { existingItem.qty += qty; } // Tambah sesuai input qty
            else { 
                cart.push({ id: item.id_produk, nama: item.nama_produk, harga: item.harga, qty: qty }); 
            }
            saveCart();
            closeModal('modalProduk');
            Swal.fire({ icon: 'success', title: 'Masuk Keranjang!', timer: 1000, showConfirmButton: false });
        }

        function buyNow() {
            addToCartCurrent();
            // Pastikan modal keranjang terbuka setelah produk ditambahkan
            setTimeout(() => { openModal('modalKeranjang'); }, 500);
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            saveCart();
        }

        function saveCart() {
            localStorage.setItem('myCart', JSON.stringify(cart));
            updateCartUI();
        }

        function updateCartUI() {
            const listDiv = document.getElementById('cartList');
            let totalQty = 0;
            let totalPrice = 0;
            let detailString = "";

            listDiv.innerHTML = "";
            if (cart.length === 0) {
                listDiv.innerHTML = '<p style="text-align:center; padding: 20px; color:#999;">Keranjang kosong.</p>';
            }

            cart.forEach((item, index) => {
                totalQty += item.qty;
                totalPrice += (item.harga * item.qty);
                detailString += `- ${item.qty}x ${item.nama} (@ ${item.harga})\n`;

                let div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `<div><div class="cart-item-title">${item.nama}</div><div class="cart-item-price">${item.qty} x Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</div></div><i class="fas fa-trash-alt btn-remove" onclick="removeFromCart(${index})"></i>`;
                listDiv.appendChild(div);
            });

            document.getElementById('cartCount').innerText = totalQty;
            document.getElementById('btnTotalItem').innerText = totalQty;
            document.getElementById('cartTotalPrice').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
            // document.getElementById('finalDetail').value = detailString; // Removed since input is gone
        }

        // --- COMMON ---
        function searchProduct() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.getElementsByClassName('product-card');
            let hasResults = false;

            for (let i = 0; i < cards.length; i++) {
                let title = cards[i].getAttribute('data-nama');
                let cat = cards[i].querySelector('.cat-label').innerText.toLowerCase();
                if (title.includes(input) || cat.includes(input)) {
                    cards[i].style.display = ""; hasResults = true;
                } else { cards[i].style.display = "none"; }
            }
            document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
            document.getElementById('katalogScroll').style.display = hasResults ? 'flex' : 'none';
        }

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
            document.getElementById('modalPrice').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga);
            document.getElementById('modalMinOrder').innerText = 'Min Order: ' + item.min_order;
            document.getElementById('modalImg').src = baseUrl + '/' + item.foto_produk;
            
            // Set nilai input qty
            const qtyInput = document.getElementById('modalQty');
            const minOrderText = item.min_order || "";
            // Ekstrak angka dari string min_order, misal "400 lbr" jadi 400. Default 1.
            const minOrderValue = parseInt(minOrderText.replace(/\D/g, '')) || 1;
            
            qtyInput.value = minOrderValue;
            qtyInput.min = minOrderValue;
        }

        async function cekPesanan() {
            let kode = document.getElementById('inputKode').value;
            if(!kode) { alert("Masukkan kode dulu!"); return; }

            try {
                let response = await fetch(`/cek-status?kode=${kode}`);
                let data = await response.json();

                if (data.status === 'found') {
                    document.getElementById('resNama').innerText = data.data.nama_pelanggan;
                    document.getElementById('resId').innerText = data.data.kode_pesanan; // BENAR: Gunakan kode_pesanan
                    let tgl = new Date(data.data.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                    document.getElementById('resTgl').innerText = tgl;
                    document.getElementById('resDetail').innerText = data.data.detail_pesanan;
                    
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
            } catch (error) { alert("Gagal menghubungi server."); }
        }
    </script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>