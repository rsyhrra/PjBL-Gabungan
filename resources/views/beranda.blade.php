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
            --danger: #e74c3c;
        }

        /* Hilangkan Scrollbar */
        ::-webkit-scrollbar { display: none; }
        
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        
        body { 
            font-family: 'Poppins', sans-serif; background-color: var(--bg-color); color: var(--primary); 
            overflow-x: hidden; scrollbar-width: none; -ms-overflow-style: none;  
        }

        .swal2-container {
            z-index: 9999 !important;
        }

        /* --- 2. NAVBAR --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 5%; position: sticky; top: 0;
            background: rgba(253, 251, 247, 0.95); backdrop-filter: blur(10px);
            z-index: 1000; box-shadow: var(--shadow-sm);
        }
        
        /* LOGO STYLE */
        .logo { 
            font-weight: 800; font-size: 1.4rem; letter-spacing: 1px; color: var(--primary);
            display: flex; align-items: center; gap: 10px; 
        }
        .logo img {
            height: 40px; 
            width: auto;
        }

        .nav-links { display: flex; gap: 30px; }
        .nav-links a { text-decoration: none; color: var(--primary); font-weight: 500; transition: 0.3s; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--accent); }
        .nav-icons { display: flex; align-items: center; gap: 20px; }
        .nav-icons i { cursor: pointer; font-size: 1.2rem; transition: 0.3s; color: var(--primary); }
        .nav-icons i:hover { color: var(--accent); transform: scale(1.1); }
        .hamburger { display: none; font-size: 1.5rem; cursor: pointer; }

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
        .catalog-header { 
            display: flex; flex-wrap: wrap; gap: 15px; 
            background: #fff; padding: 20px; border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); align-items: center; 
            margin-bottom: 40px; border: 1px solid #f0f0f0;
        }

        .search-container { flex: 2; min-width: 300px; position: relative; }
        .search-input-modern {
            width: 100%; padding: 15px 20px 15px 50px; border: 2px solid #f0f4f8;
            border-radius: 50px; background: #f9fbfd; font-size: 0.95rem;
            color: var(--primary); transition: all 0.3s ease; outline: none;
        }
        .search-input-modern:focus { background: #fff; border-color: var(--accent); box-shadow: 0 5px 20px rgba(212, 163, 115, 0.15); }
        .search-icon-float { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #bdc3c7; font-size: 1.1rem; transition: 0.3s; }
        .search-input-modern:focus + .search-icon-float { color: var(--accent); }

        .sort-container { flex: 1; min-width: 200px; position: relative; }
        .sort-select-modern {
            width: 100%; padding: 15px 20px; appearance: none; -webkit-appearance: none;
            background: #fff; border: 2px solid #f0f4f8; border-radius: 50px;
            font-size: 0.9rem; color: var(--primary); cursor: pointer;
            transition: all 0.3s ease; font-weight: 500; outline: none;
        }
        .sort-select-modern:focus { border-color: var(--accent); box-shadow: 0 5px 20px rgba(212, 163, 115, 0.15); background-color: #fff; }
        .sort-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: var(--primary); pointer-events: none; transition: 0.3s; }
        .sort-select-modern:focus + .sort-icon { color: var(--accent); transform: translateY(-50%) rotate(180deg); }

        .btn-check-modern {
            flex: 1; min-width: 180px; padding: 15px 25px;
            background: linear-gradient(135deg, var(--primary) 0%, #34495e 100%);
            color: white; border: none; border-radius: 50px; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            gap: 10px; box-shadow: 0 10px 20px rgba(44, 62, 80, 0.2); transition: 0.3s;
        }
        .btn-check-modern:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(44, 62, 80, 0.3); background: linear-gradient(135deg, #34495e 0%, var(--primary) 100%); }

        .slider-container { position: relative; display: flex; align-items: center; gap: 20px; }
        .product-scroll-wrapper {
            display: flex; overflow-x: auto; scroll-behavior: smooth; 
            gap: 25px; padding: 10px 5px 30px 5px; width: 100%;
            scrollbar-width: none; 
        }

        /* PRODUCT CARD */
        .product-card {
            background: var(--white); border-radius: 15px;
            min-width: 260px; max-width: 260px; flex: 0 0 auto;
            transition: 0.3s; cursor: pointer; border: 1px solid #f0f0f0;
            display: flex; flex-direction: column; overflow: hidden;
            box-shadow: 0 5px 10px rgba(0,0,0,0.03); position: relative; 
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: var(--accent); }
        .product-img { height: 180px; background-color: #f4f4f4; overflow: hidden; position: relative; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-img img { transform: scale(1.05); }
        
        .card-wishlist-btn {
            position: absolute; top: 15px; right: 15px;
            background: rgba(255,255,255,0.9); width: 35px; height: 35px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: #ccc; transition: 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1); z-index: 5;
        }
        .card-wishlist-btn:hover, .card-wishlist-btn.active { color: #e74c3c; transform: scale(1.1); }
        
        .product-info { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cat-label { font-size: 0.7rem; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .product-title { font-size: 1rem; margin: 5px 0; color: var(--primary); line-height: 1.3; font-weight: 600; }
        .price-box { margin-top: 15px; border-top: 1px dashed #eee; padding-top: 10px; display: flex; justify-content: space-between; align-items: center; }
        .price { font-weight: 700; color: var(--primary); font-size: 1.1rem; }
        .price small { font-size: 0.75rem; font-weight: 400; color: #999; }
        .min-order { font-size: 0.7rem; background: #f0f0f0; padding: 3px 8px; border-radius: 4px; color: #666; }
        
        /* Tombol Scroll */
        .scroll-btn {
            background: var(--white); color: var(--primary); border: 1px solid #eee;
            width: 45px; height: 45px; border-radius: 50%;
            cursor: pointer; z-index: 5; display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm); transition: 0.2s; flex-shrink: 0;
            user-select: none; -webkit-user-select: none;
        }
        .scroll-btn:active { transform: scale(0.9); background-color: var(--accent); }
        #noResults { width: 100%; text-align: center; padding: 40px; color: #999; display: none; }

        /* --- 5. PORTOFOLIO SECTION --- */
        #portfolio { padding: 60px 5%; background: var(--bg-color); }
        .portfolio-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .portfolio-item { 
            border-radius: 15px; overflow: hidden; position: relative; height: 250px; 
            box-shadow: var(--shadow-sm); cursor: pointer; transition: 0.3s;
        }
        .portfolio-item img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .portfolio-item:hover img { transform: scale(1.1); }
        .portfolio-overlay {
            position: absolute; bottom: 0; left: 0; width: 100%; padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white; transform: translateY(100%); transition: 0.3s;
        }
        .portfolio-item:hover .portfolio-overlay { transform: translateY(0); }

        /* --- LIGHTBOX (ZOOM) STYLE --- */
        #modalLightbox .modal-content {
            background: transparent; box-shadow: none; padding: 0; 
            width: auto; max-width: 90%; text-align: center;
        }
        #lightboxImg {
            max-height: 85vh; max-width: 100%; border-radius: 10px;
            box-shadow: 0 0 30px rgba(255,255,255,0.1);
        }
        #lightboxTitle {
            margin-top: 15px; color: white; font-size: 1.2rem; font-weight: 600; letter-spacing: 1px;
        }

        /* --- 6. TESTIMONI SECTION --- */
        #testimoni { padding: 60px 5%; background: white; }
        .testi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .testi-card { 
            background: #f9fbfd; padding: 30px; border-radius: 20px; 
            border: 1px solid #eee; position: relative;
        }
        .testi-quote { font-size: 2rem; color: var(--accent); opacity: 0.3; position: absolute; top: 20px; right: 20px; }
        .testi-text { font-style: italic; color: #555; margin-bottom: 20px; line-height: 1.6; }
        .testi-user { display: flex; align-items: center; gap: 15px; }
        .testi-avatar { width: 50px; height: 50px; background: #ddd; border-radius: 50%; object-fit: cover; }

        /* --- GAYA UNTUK BALASAN ADMIN --- */
        .admin-reply-box {
            background-color: #fff9f0; border-left: 3px solid var(--accent);
            padding: 10px 15px; margin-bottom: 20px; border-radius: 0 5px 5px 0; font-size: 0.9rem;
        }
        .reply-header { font-weight: 700; color: var(--accent); margin-bottom: 5px; display: flex; align-items: center; gap: 5px; }

        /* --- 7. FAQ SECTION --- */
        #faq { padding: 60px 5%; background: var(--bg-color); }
        .faq-item { background: white; border-radius: 15px; margin-bottom: 15px; box-shadow: var(--shadow-sm); overflow: hidden; }
        .faq-question { 
            padding: 20px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; 
            font-weight: 600; color: var(--primary);
        }
        .faq-answer { 
            padding: 0 20px 20px 20px; color: #666; display: none; line-height: 1.6; border-top: 1px solid #f0f0f0; margin-top: 0; padding-top: 15px;
        }
        .faq-item.active .faq-answer { display: block; }
        .faq-item.active .faq-question i { transform: rotate(180deg); }

        /* --- 8. CONTACT & FOOTER --- */
        #contact { padding: 80px 5%; background: white; }
        .contact-wrapper { 
            display: grid; grid-template-columns: 1fr 1fr; gap: 50px; 
            background: var(--bg-color); padding: 40px; border-radius: 20px; box-shadow: var(--shadow-sm);
        }
        .contact-item { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; }
        .icon-box { 
            width: 45px; height: 45px; background: white; border-radius: 10px; 
            display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 1.2rem;
        }
        .contact-info h3 { margin-bottom: 30px; font-size: 1.5rem; color: var(--primary); }
        
        .map-box { width: 100%; height: 100%; min-height: 250px; background: #eee; border-radius: 15px; overflow: hidden; }
        .map-box iframe { width: 100%; height: 100%; border: none; }

        /* Footer with Admin Access */
        footer { background: var(--primary); color: white; padding: 20px 5%; text-align: center; font-size: 0.8rem; margin-top: 50px; }
        
        /* --- 9. FLOATING BUTTONS --- */
        .floating-container { position: fixed; bottom: 30px; right: 30px; display: flex; flex-direction: column; gap: 15px; z-index: 1000; }
        .float-btn {
            width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; cursor: pointer; box-shadow: 0 5px 20px rgba(0,0,0,0.2); transition: 0.3s; position: relative;
        }
        .float-btn:hover { transform: scale(1.1); }
        .btn-wishlist { background: white; color: #e74c3c; border: 2px solid #f0f0f0; }
        .btn-cart { background: var(--accent); color: white; }
        .float-badge {
            position: absolute; top: -5px; right: -5px;
            background: #c62828; color: white; width: 22px; height: 22px;
            border-radius: 50%; font-size: 0.7rem; font-weight: bold;
            display: flex; align-items: center; justify-content: center; border: 2px solid white;
        }

        /* --- 10. MODAL GENERAL STYLES --- */
        .modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.7); z-index: 2000;
            justify-content: center; align-items: center; padding: 20px;
            backdrop-filter: blur(5px); opacity: 0; transition: opacity 0.3s ease;
        }
        .modal.show { display: flex; opacity: 1; }
        .close-modal { position: absolute; top: 20px; right: 25px; font-size: 1.8rem; cursor: pointer; z-index: 10; color: #333; transition: 0.3s; }
        .close-modal:hover { color: var(--accent); transform: rotate(90deg); }
        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .animating-out { opacity: 0; transform: scale(0.95) translateX(-10px); }

        /* --- CSS MODERN UNTUK LACAK PESANAN --- */
        #modalCekPesanan .modal-content {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            padding: 40px; 
            max-width: 550px;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        /* --- TYPOGRAPHY MODAL (FIX SPACING & CENTERING) --- */
        .modal-title-small {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px; /* Memberi jarak ke bawah */
            text-align: center;  /* MEMBUAT TEKS JUDUL DI TENGAH */
        }
        .modal-subtitle-small {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 30px; /* Memberi jarak lega ke input field */
            text-align: center;  /* MEMBUAT TEKS SUBJUDUL DI TENGAH */
        }

        #modalCekPesanan .search-wrapper {
            margin-bottom: 25px;
            position: relative;
        }
        #modalCekPesanan .search-input {
            width: 100%; padding: 15px 20px; border: 2px solid #eee; border-radius: 50px;
            background: #f9f9f9; font-size: 1rem; color: var(--primary); outline: none; transition: 0.3s;
        }
        #modalCekPesanan .search-input:focus { border-color: var(--accent); background: #fff; box-shadow: 0 5px 20px rgba(212, 163, 115, 0.1); }
        
        #modalCekPesanan .search-btn {
            position: absolute; right: 5px; top: 50%; transform: translateY(-50%);
            width: 45px; height: 45px; border-radius: 50%; background: var(--primary); color: white; border: none; cursor: pointer; font-size: 1.2rem; transition: 0.3s;
            display: flex; align-items: center; justify-content: center;
        }
        #modalCekPesanan .search-btn:hover { background: var(--accent); transform: translateY(-50%) rotate(10deg); }

        /* Kartu Hasil Lacak */
        .result-card {
            background: #fff; border: 1px solid #eee; border-radius: 20px; padding: 25px; text-align: left;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); display: none; animation: slideUp 0.4s ease;
        }
        .info-group { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #eee; }
        .info-group:last-child { border-bottom: none; }
        
        .info-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
        .label { font-size: 0.85rem; color: #888; font-weight: 500; }
        .value { font-size: 0.9rem; font-weight: 600; color: var(--primary); text-align: right; }

        /* FIX: Tambahan Style untuk Tabel agar tidak mepet */
        .mini-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .mini-table th {
            text-align: left;
            font-size: 0.85rem;
            color: #888;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .mini-table td {
            padding: 10px 5px; /* Memberikan jarak vertikal antar baris */
            font-size: 0.9rem;
            color: var(--primary);
            vertical-align: top;
        }
        .mini-table tr:last-child td {
            border-top: 2px solid #eee; /* Garis pemisah tegas untuk Total */
            padding-top: 15px;
            margin-top: 5px;
        }

        /* Status Badge */
        .status-badge-wrapper { display: flex; justify-content: space-between; align-items: center; margin-top: 5px; }
        .badge { padding: 6px 15px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: white; display: inline-block; }

        /* --- TOMBOL INVOICE MENARIK & TERPUSAT (FIXED) --- */
        .btn-invoice-link {
            display: flex; align-items: center; justify-content: center; /* Center Content */
            width: 80%; /* Tidak full agar tidak keluar batas */
            margin: 20px auto 0 auto; /* Tengah secara horizontal */
            padding: 12px 20px; 
            background: white; 
            border: 2px solid var(--primary); 
            border-radius: 50px; 
            color: var(--primary); 
            text-decoration: none; font-weight: 700; 
            transition: all 0.3s; gap: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
        }
        .btn-invoice-link:hover { 
            background: var(--primary); 
            color: white; 
            border-color: var(--primary);
            transform: translateY(-2px); 
            box-shadow: 0 10px 20px rgba(44, 62, 80, 0.15); 
        }

        /* Tombol Review Keren */
        .btn-review-action {
            display: flex; align-items: center; justify-content: center; width: 100%; padding: 14px; margin-top: 15px;
            background: var(--accent); border-radius: 50px; color: white; text-decoration: none; font-weight: 700; cursor: pointer; transition: all 0.3s; border: none; gap: 8px; box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3);
        }
        .btn-review-action:hover { background: #c59665; transform: translateY(-3px); }
        
        /* Not Found */
        .not-found-box { margin-top: 20px; padding: 15px; background: #fff5f5; border-radius: 10px; color: #e74c3c; font-weight: 500; border: 1px solid #ffebeb; display: none; animation: shake 0.3s ease; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }


        /* --- MODAL PRODUK --- */
        #modalProduk .modal-content {
            background: var(--white); padding: 0; border-radius: 20px;
            width: 100%; max-width: 1000px; position: relative;
            box-shadow: var(--shadow-lg); display: flex; min-height: 500px;
            overflow: visible;
        }
        #modalBody { display: flex; width: 100%; height: 100%; }
        .modal-left { width: 50%; background: #f0f2f5; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; border-top-left-radius: 20px; border-bottom-left-radius: 20px; }
        .modal-left img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .modal-left:hover img { transform: scale(1.05); }
        .modal-right { width: 50%; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; background: white; border-top-right-radius: 20px; border-bottom-right-radius: 20px; }
        .modal-cat { color: var(--accent); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .modal-title { font-size: 2rem; font-weight: 700; color: var(--primary); margin-bottom: 10px; line-height: 1.2; }
        .modal-desc { color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 25px; }
        .modal-price { font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 5px; }
        .modal-min-order { font-size: 0.9rem; color: #999; margin-bottom: 20px; display: block; }
        .qty-wrapper { margin-bottom: 25px; }
        .qty-label { font-size: 0.9rem; font-weight: 600; color: var(--primary); display: block; margin-bottom: 8px; }
        .qty-input { width: 100%; max-width: 150px; padding: 12px; border: 2px solid #eee; border-radius: 10px; text-align: center; font-weight: 600; color: var(--primary); outline: none; font-size: 1.1rem; transition: 0.3s; }
        .qty-input:focus { border-color: var(--accent); }
        .modal-actions { display: flex; gap: 15px; align-items: center; }
        .btn-action { flex: 1; padding: 15px 20px; border-radius: 50px; font-weight: 700; font-size: 1rem; border: none; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-cart-modal { background: var(--accent); color: white; } .btn-cart-modal:hover { background: #b0855b; transform: translateY(-2px); }
        .btn-buy-modal { background: var(--primary); color: white; } .btn-buy-modal:hover { background: #1a252f; transform: translateY(-2px); }
        .btn-icon-modal { width: 50px; height: 50px; border-radius: 12px; border: 2px solid #eee; background: white; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #ccc; cursor: pointer; transition: 0.3s; }
        .btn-icon-modal:hover { border-color: var(--primary); color: var(--primary); }
        .btn-wa-share { color: #25D366; border-color: #25D366; } .btn-wa-share:hover { background: #25D366; color: white; }
        .btn-fav-modal.active { color: #e74c3c; border-color: #e74c3c; background: #fff5f5; }
        .modal-nav-btn { position: absolute; top: 50%; transform: translateY(-50%); width: 60px; height: 60px; border-radius: 50%; background-color: var(--white); color: var(--primary); border: none; font-size: 1.2rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.3s; box-shadow: 0 5px 20px rgba(0,0,0,0.1); z-index: 20; }
        .modal-nav-btn:hover { background-color: var(--primary); color: var(--white); transform: translateY(-50%) scale(1.1); }
        .modal-nav-btn.prev { left: -30px; } .modal-nav-btn.next { right: -30px; }

        /* --- STANDARD MODALS (Small) --- */
        #modalKeranjang .modal-content, #modalWishlist .modal-content, #modalTulisTesti .modal-content {
            background: var(--white); padding: 40px 30px; border-radius: 25px;
            width: 100%; max-width: 480px; display: flex; flex-direction: column; gap: 20px; 
            text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: slideUp 0.4s ease; position: relative; min-height: auto;
        }

        /* --- STYLE BARU UNTUK ITEM KERANJANG (LEBIH MENARIK) --- */
        .cart-item {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            background: #f9fbfd; 
            padding: 15px; 
            border-radius: 15px;
            margin-bottom: 10px; 
            border: 1px solid #edf2f7; 
            transition: 0.3s;
        }
        .cart-item:hover { 
            border-color: var(--accent); 
            transform: translateX(5px); 
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }
        .cart-item-left { 
            text-align: left; 
            display: flex;
            align-items: center;
            gap: 12px;
        }
        /* Icon keranjang kecil untuk estetika */
        .cart-item-icon {
            width: 40px; height: 40px;
            background: #eef2f7; color: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }
        .cart-item-info {
            display: flex; flex-direction: column;
        }
        .cart-item-title { 
            font-weight: 600; 
            font-size: 0.95rem; 
            color: var(--primary); 
            margin-bottom: 2px; 
        }
        .cart-item-price { 
            font-size: 0.85rem; 
            color: #888; 
            font-weight: 500;
        }
        
        .cart-total { 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            font-weight: 700; 
            font-size: 1.1rem; 
            color: var(--primary);
            margin-top: 20px; 
            padding-top: 15px; 
            border-top: 2px dashed #eee;
        }
        
        .btn-remove { 
            color: #e74c3c; 
            cursor: pointer; 
            padding: 8px; 
            border-radius: 50%; 
            transition: 0.2s; 
            display: flex; align-items: center; justify-content: center;
            width: 35px; height: 35px;
        }
        .btn-remove:hover { 
            background: #fff5f5; 
            transform: scale(1.1);
        }

        /* --- STYLING MODAL TULIS TESTIMONI --- */
        #modalTulisTesti .form-group { text-align: left; margin-bottom: 15px; }
        #modalTulisTesti label { display: block; font-weight: 600; font-size: 0.9rem; color: var(--primary); margin-bottom: 5px; }
        #modalTulisTesti input[type="text"], #modalTulisTesti textarea {
            width: 100%; padding: 12px; border: 2px solid #eee; border-radius: 10px; font-family: inherit; outline: none; transition: 0.3s;
        }
        #modalTulisTesti input:focus, #modalTulisTesti textarea:focus { border-color: var(--accent); background: #fff; }
        
        /* Star Rating */
        .rating-input { display: flex; flex-direction: row-reverse; justify-content: center; gap: 8px; margin: 10px 0; }
        .rating-input input { display: none; }
        .rating-input label { font-size: 2rem; color: #ddd; cursor: pointer; transition: 0.2s; }
        .rating-input input:checked ~ label, .rating-input label:hover, .rating-input label:hover ~ label { color: #ffc107; transform: scale(1.1); }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            nav { padding: 15px 20px; } .nav-links { display: none; } .hamburger { display: block; }
            #home { flex-direction: column-reverse; padding: 40px 20px; text-align: center; min-height: auto; }
            .hero-text { max-width: 100%; } 
            
            /* FIX OVERLAP GAMBAR DAN TEKS PADA MOBILE */
            .hero-image { width: 100%; height: 400px; /* Ditambah tinggi agar kartu muat */ }
            .hero-text { margin-top: 30px; /* Ditambah margin agar tidak tertutup */ }
            
            .catalog-header { flex-direction: column; } .search-container, .sort-container, .btn-check-modern { width: 100%; }
            .contact-wrapper { grid-template-columns: 1fr; }
            #modalProduk .modal-content { width: 95%; flex-direction: column; height: auto; max-height: 90vh; overflow-y: auto; }
            .modal-left { width: 100%; height: 250px; border-radius: 20px 20px 0 0; } .modal-left img { border-radius: 20px 20px 0 0; }
            .modal-right { width: 100%; padding: 25px; }
            .modal-actions { flex-wrap: wrap; } .btn-action { width: 100%; flex: auto; }
            .testi-grid { grid-template-columns: 1fr; }
            .modal-nav-btn { display: none; }
            /* Mobile Adjustments for Tracking */
            #modalCekPesanan .modal-content { padding: 30px 20px; }
            .btn-invoice-link { font-size: 0.9rem; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <span>ANEKA USAHA</span>
        </div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#katalog">Katalog</a>
            <a href="#portfolio">Portofolio</a>
            <a href="#testimoni">Testimoni</a>
            <a href="#faq">FAQ</a>
            <a href="#contact">Kontak</a>
        </div>
        <div class="nav-icons">
            <i class="fas fa-receipt" onclick="openModal('modalCekPesanan')" title="Lacak Pesanan"></i>
            <div class="hamburger" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#home" onclick="toggleMenu()">Home</a>
        <a href="#katalog" onclick="toggleMenu()">Katalog</a>
        <a href="#portfolio" onclick="toggleMenu()">Portofolio</a>
        <a href="#testimoni" onclick="toggleMenu()">Testimoni</a>
        <a href="#contact" onclick="toggleMenu()">Kontak</a>
    </div>

    <!-- HERO -->
    <section id="home">
        <div class="hero-text">
            <h1>Percetakan <span>Modern</span> & <br>Terpercaya</h1>
            <p>Solusi percetakan modern dengan kualitas terbaik. Kami melayani pembuatan undangan kustom, spanduk, hingga ATK lengkap.</p>
            <a href="#katalog" class="btn btn-primary">Lihat Katalog</a>
        </div>
        <div class="hero-image">
            <div class="card-stack" style="background-image: url('https://resourceboy.com/wp-content/uploads/2021/11/top-view-of-wedding-invitations-mockup-scene-creator.jpg');"></div>
            <div class="card-stack top" style="background-image: url('https://cdn.psdrepo.com/images/2x/invitation-card-mockup-with-vellum-wrap-i3.jpg');"></div>
        </div>
    </section>

    <!-- KATALOG -->
    <section id="katalog">
        <div class="section-title" style="margin-bottom:30px;">
            <h2>Produk Unggulan</h2>
            <p>Pilih kategori produk yang Anda butuhkan</p>
        </div>

        <div class="catalog-header">
            <div class="search-container">
                <input type="text" id="searchInput" onkeyup="searchProduct()" class="search-input-modern" placeholder="Cari produk impianmu...">
                <i class="fas fa-search search-icon-float"></i>
            </div>
            <div class="sort-container">
                <select id="sortSelect" onchange="sortProducts()" class="sort-select-modern">
                    <option value="default">✨ Urutan Default</option>
                    <option value="price_asc">💰 Harga Terendah</option>
                    <option value="price_desc">💎 Harga Tertinggi</option>
                    <option value="name_asc">🔤 Nama A-Z</option>
                </select>
                <i class="fas fa-chevron-down sort-icon"></i>
            </div>
            <button class="btn-check-modern" onclick="openModal('modalCekPesanan')">
                <i class="fas fa-receipt"></i> Cek Status
            </button>
        </div>

        <div class="slider-container">
            <!-- 
                UPDATE: HAPUS onclick inline, TAMBAHKAN ID UNTUK EVENT LISTENER 
                Tombol Kiri 
            -->
            <button class="scroll-btn left" id="btnScrollLeft"><i class="fas fa-chevron-left"></i></button>
            
            <div class="product-scroll-wrapper" id="katalogScroll">
                @foreach($produk as $key => $item)
                <div class="product-card" onclick="openProductModal({{ $key }})" data-harga="{{ $item->harga }}" data-nama="{{ strtolower($item->nama_produk) }}">
                    <div class="card-wishlist-btn" id="cardHeart-{{ $item->id_produk }}" onclick="event.stopPropagation(); toggleWishlist({{ $item->id_produk }})">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="product-img"><img src="{{ asset('img/'.$item->foto_produk) }}" alt="{{ $item->nama_produk }}"></div>
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
            
            <!-- 
                UPDATE: HAPUS onclick inline, TAMBAHKAN ID UNTUK EVENT LISTENER 
                Tombol Kanan 
            -->
            <button class="scroll-btn right" id="btnScrollRight"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div id="noResults" style="display:none; text-align:center; padding:30px; color:#999;">Produk tidak ditemukan.</div>
    </section>

    <!-- PORTOFOLIO SECTION (UPDATED TAHAP 6) -->
    <section id="portfolio">
        <div class="section-title" style="margin-bottom:30px;">
            <h2>Galeri Portofolio</h2>
            <p>Hasil karya cetakan kami yang telah dipercaya pelanggan.</p>
        </div>
        <div class="portfolio-grid">
            {{-- DATA DINAMIS DARI DATABASE --}}
            @forelse($portofolio as $item)
            <div class="portfolio-item" onclick="openLightbox('{{ asset('img/portfolio/'.$item->foto) }}', '{{ $item->judul }}')">
                <img src="{{ asset('img/portfolio/'.$item->foto) }}" alt="{{ $item->judul }}">
                <div class="portfolio-overlay">
                    <span style="font-weight:700;">{{ $item->judul }}</span><br>
                    <small>{{ $item->kategori }}</small>
                </div>
            </div>
            @empty
            {{-- Fallback jika belum ada data --}}
            <div class="portfolio-item" style="cursor: default;">
                <img src="https://via.placeholder.com/400x300?text=Belum+Ada+Karya" style="opacity:0.5">
                <div class="portfolio-overlay" style="transform: translateY(0);">Segera Hadir</div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- LIGHTBOX MODAL (BARU - Untuk Zoom Gambar) -->
    <div id="modalLightbox" class="modal" onclick="if(event.target === this) closeModal('modalLightbox')">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalLightbox')" style="color:white; top:-40px; right:0;">&times;</span>
            <img id="lightboxImg" src="" alt="Zoom">
            <div id="lightboxTitle"></div>
        </div>
    </div>

    <!-- TESTIMONI SECTION -->
    <section id="testimoni">
        <div class="section-title" style="margin-bottom:30px;">
            <h2>Apa Kata Pelanggan?</h2>
            <p>Kepuasan pelanggan adalah prioritas kami.</p>
        </div>
        
        <div class="testi-grid">
            @forelse($testimoni as $testi)
            <div class="testi-card">
                <div class="testi-quote"><i class="fas fa-quote-right"></i></div>
                <p class="testi-text">"{{ $testi->isi_testimoni }}"</p>
                
                {{-- TAMBAHAN FITUR: TAMPILKAN BALASAN ADMIN JIKA ADA --}}
                @if($testi->admin_reply)
                <div class="admin-reply-box">
                    <div class="reply-header">
                        <i class="fas fa-store"></i> Tanggapan Admin
                    </div>
                    <p style="font-style: italic; color: #555;">"{{ $testi->admin_reply }}"</p>
                </div>
                @endif
                {{-- AKHIR FITUR BALASAN --}}

                <div class="testi-user">
                    <div class="testi-avatar" style="background: url('{{ $testi->foto_profil ? asset('img/testi/'.$testi->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($testi->nama_pelanggan) }}') center/cover;"></div>
                    <div>
                        <strong>{{ $testi->nama_pelanggan }}</strong><br>
                        <small>{{ $testi->kota }}</small>
                        <div style="color:gold; font-size:0.7rem;">
                            @for($i=0; $i<$testi->rating; $i++) <i class="fas fa-star"></i> @endfor
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p style="grid-column: 1/-1; text-align: center; color: #999;">Belum ada testimoni. Jadilah yang pertama memberikan ulasan!</p>
            @endforelse
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq">
        <div class="section-title" style="margin-bottom:30px;">
            <h2>Tanya Jawab (FAQ)</h2>
            <p>Pertanyaan yang sering diajukan oleh pelanggan.</p>
        </div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(this)">Berapa lama proses pengerjaan? <i class="fas fa-chevron-down"></i></div><div class="faq-answer">Undangan standar 3-5 hari kerja. Spanduk bisa 1 hari jadi.</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(this)">Bisa request desain custom? <i class="fas fa-chevron-down"></i></div><div class="faq-answer">Tentu saja! Konsultasi gratis via WhatsApp.</div></div>
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(this)">Metode pembayaran? <i class="fas fa-chevron-down"></i></div><div class="faq-answer">Transfer Bank atau E-Wallet (Dana/OVO). Minimal DP 50%.</div></div>
    </section>

    <!-- CONTACT -->
    <section id="contact">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h3>Hubungi Kami</h3>
                <div class="contact-item"><div class="icon-box"><i class="fab fa-whatsapp"></i></div><div class="contact-text"><h4>WhatsApp</h4><p>+62 813-4113-6423</p></div></div>
                <div class="contact-item"><div class="icon-box"><i class="fas fa-envelope"></i></div><div class="contact-text"><h4>Email</h4><p>anekausaha160370@gmail.com</p></div></div>
                <div class="contact-item"><div class="icon-box"><i class="fas fa-map-marker-alt"></i></div><div class="contact-text"><h4>Alamat</h4><p>HC2X+434, Pappa, Kec. Pattallassang, Kabupaten Takalar</p></div></div>
            </div>
            <div class="map-box">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d328.6166151517713!2d119.44777061955244!3d-5.449825626892442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbed7b00723386f%3A0xa5bfa049e4f6aa62!2sToko%20Aneka%20Usaha!5e1!3m2!1sid!2sid!4v1765176738010!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- FOOTER (WITH ADMIN ACCESS) -->
    <footer style="background: var(--primary); color: white; padding: 20px 5%; text-align: center; font-size: 0.8rem; margin-top: 50px;">
        <div style="margin-bottom: 10px;">
            <p><strong>Aneka Usaha</strong> &copy; {{ date('Y') }} • Solusi Percetakan Terpercaya</p>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px; margin-top: 10px; display: flex; justify-content: center; gap: 15px; opacity: 0.6;">
            <span><i class="fas fa-map-marker-alt"></i> Pusat Kota</span>
            <a href="{{ route('admin.login') }}" style="color: white; text-decoration: none;" title="Admin Area"><i class="fas fa-lock"></i></a>
        </div>
    </footer>

    <!-- FLOATING BUTTONS -->
    <div class="floating-container">
        <div class="float-btn btn-wishlist" onclick="openModal('modalWishlist')" title="Lihat Favorit"><i class="fas fa-heart"></i><span class="float-badge" id="wishlistCount">0</span></div>
        <div class="float-btn btn-cart" onclick="openModal('modalKeranjang')" title="Lihat Keranjang"><i class="fas fa-shopping-cart"></i><span class="float-badge" id="cartCount">0</span></div>
    </div>

    <!-- MODAL DETAIL PRODUK -->
    <div id="modalProduk" class="modal">
        <div class="modal-content">
            <button class="modal-nav-btn prev" onclick="switchProduct('prev')"><i class="fas fa-chevron-left"></i></button>
            <span class="modal-close" onclick="closeModal('modalProduk')">&times;</span>
            <div id="modalBody">
                <div class="modal-left"><img id="modalImg" src="" alt="Preview"></div>
                <div class="modal-right">
                    <div>
                        <p id="modalCat" class="modal-cat">KATEGORI</p>
                        <h2 id="modalTitle" class="modal-title">Nama Produk</h2>
                        <div id="modalDesc" class="modal-desc">Deskripsi...</div>
                    </div>
                    <div class="modal-price-box">
                        <h3 id="modalPrice" class="modal-price">Rp 0</h3>
                        <small id="modalMinOrder" class="modal-min-order">Min Order: -</small>
                        <div class="qty-wrapper">
                            <label class="qty-label">Jumlah:</label>
                            <input type="number" id="modalQty" class="qty-input" value="1" min="1">
                        </div>
                        <div class="modal-actions">
                            <button class="btn-action btn-cart-modal" onclick="addToCartCurrent()"><i class="fas fa-plus"></i> Keranjang</button>
                            <button class="btn-action btn-buy-modal" onclick="buyNow()">Beli</button>
                            <a id="shareBtn" href="#" target="_blank" class="btn-icon-modal btn-wa-share" title="Share ke WA"><i class="fab fa-whatsapp"></i></a>
                            <button id="modalFavBtn" class="btn-icon-modal btn-fav-modal" onclick="toggleWishlistCurrent()"><i class="fas fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="modal-nav-btn next" onclick="switchProduct('next')"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <!-- MODAL CEK PESANAN (CSS IMPROVED) -->
    <div id="modalCekPesanan" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalCekPesanan')">&times;</span>
            <h3 class="modal-title-small">Lacak Pesanan Anda</h3>
            <p class="modal-subtitle-small">Masukkan Kode Pesanan (ID) atau No. WhatsApp</p>
            
            <div class="search-wrapper">
                <input type="text" id="inputKode" class="search-input" placeholder="Contoh: AU-2511...">
                <!-- Tombol Search diperbaiki agar ikon di tengah -->
                <button class="search-btn" onclick="cekPesanan()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div id="resultArea" class="result-card">
                <div class="info-group">
                    <div class="info-row"><span class="label">Customer</span><span class="value" id="resNama">-</span></div>
                    <div class="info-row"><span class="label">No Pesan</span><span class="value" id="resId">-</span></div>
                    <div class="info-row"><span class="label">Tgl Pesan</span><span class="value" id="resTgl">-</span></div>
                </div>
                
                <div class="info-group">
                    <span class="label" style="display:block; margin-bottom:8px;">Detail Item:</span>
                    <div id="resDetailContainer"></div>
                </div>

                <div class="status-badge-wrapper">
                    <span class="label" style="font-weight:700; color:var(--primary);">Status Pesanan</span>
                    <span class="badge" id="resStatus">-</span>
                </div>
                
                <!-- TOMBOL INVOICE LENGKAP -->
                <a href="#" id="linkInvoiceFull" target="_blank" class="btn-invoice-link" style="display:none;">
                    <i class="fas fa-file-invoice"></i> Buka Invoice Lengkap
                </a>

                <div id="btnReviewContainer" style="display:none;">
                    <!-- MODIFIKASI: Langsung Link ke Form Testimoni -->
                    <a id="btnReviewAction" href="#" class="btn-review-action">
                        <i class="fas fa-star"></i> Beri Ulasan Pesanan
                    </a>
                </div>

                <!-- [BARU] TOMBOL BATALKAN PESANAN -->
                <div id="btnCancelContainer" style="display:none; margin-top: 15px;">
                    <button onclick="ajukanPembatalan()" class="btn" style="width:100%; background:white; color:#e74c3c; border:1px solid #e74c3c; padding:12px; border-radius:50px; font-weight:600; cursor:pointer; transition:0.3s;">
                        <i class="fas fa-times-circle"></i> Ajukan Pembatalan
                    </button>
                    <p style="font-size:0.75rem; color:#999; text-align:center; margin-top:5px;">
                        *Hanya bisa dilakukan jika status masih "Baru Masuk"
                    </p>
                </div>

            </div>
            
             <div id="notFoundMsg" class="not-found-box">
                <i class="fas fa-exclamation-circle"></i> Data pesanan tidak ditemukan. Cek kembali kode Anda.
            </div>
        </div>
    </div>

    <!-- MODAL KERANJANG -->
    <div id="modalKeranjang" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalKeranjang')">&times;</span>
            <h3 class="modal-title-small">Keranjang Belanja</h3>
            <div id="cartList" style="max-height:250px; overflow-y:auto; margin-bottom:15px; border:1px solid #eee; border-radius:10px; padding: 5px;"></div>
            <div class="cart-total"><span>Total Estimasi:</span><span id="cartTotalPrice">Rp 0</span></div>
            <p style="font-size:0.75rem; color:#999; margin-bottom:20px; text-align:right;">*Data hilang jika tab ditutup (Session)</p>
            <a href="{{ url('/pesan') }}" class="btn btn-primary" style="width:100%; display:block; text-align:center;">Lanjut ke Pemesanan (<span id="btnTotalItem">0</span> Item) <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>

    <!-- MODAL WISHLIST -->
    <div id="modalWishlist" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('modalWishlist')">&times;</span>
            <h3 class="modal-title-small">Produk Favorit ❤️</h3>
            <div id="wishlistList" style="max-height:250px; overflow-y:auto; margin-bottom:15px; border:1px solid #eee; border-radius:10px;"></div>
            <p style="font-size:0.75rem; color:#999;">*Disimpan di browser Anda</p>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('active'); }
        function toggleFaq(el) { el.parentElement.classList.toggle('active'); }

        const allProducts = @json($produk);
        let currentIndex = 0;
        const baseUrl = "{{ asset('img') }}"; 
        
        let cart = JSON.parse(sessionStorage.getItem('myCart')) || []; 
        let wishlist = JSON.parse(localStorage.getItem('myWishlist')) || []; 

        updateCartUI();
        updateWishlistUI();

        // ----------------------------------------------------
        // FITUR BARU: HOLD TO SCROLL (TEKAN TAHAN UNTUK GESER)
        // ----------------------------------------------------
        function initScrollLogic() {
            const container = document.getElementById('katalogScroll');
            const btnLeft = document.getElementById('btnScrollLeft');
            const btnRight = document.getElementById('btnScrollRight');
            
            let holdTimer;      // Timer untuk mendeteksi apakah ini klik biasa atau tahan
            let scrollInterval; // Interval untuk loop scroll saat ditahan
            let isLongPress = false; // Flag status

            // Fungsi memulai deteksi tekan
            const startAction = (direction) => {
                isLongPress = false;
                // Tunggu 200ms. Jika masih ditekan, anggap sebagai "Hold"
                holdTimer = setTimeout(() => {
                    isLongPress = true;
                    // Mulai scroll terus menerus
                    scrollInterval = setInterval(() => {
                        const step = 10; // Kecepatan geser (pixel)
                        if (direction === 'left') {
                            container.scrollLeft -= step;
                        } else {
                            container.scrollLeft += step;
                        }
                    }, 10); // Interval update setiap 10ms (smooth)
                }, 200);
            };

            // Fungsi saat lepas tombol
            const endAction = (direction) => {
                clearTimeout(holdTimer); // Batalkan timer deteksi hold
                clearInterval(scrollInterval); // Hentikan scroll otomatis
                
                // Jika bukan long press (berarti cuma klik cepat), lakukan scroll biasa (lompat)
                if (!isLongPress) {
                    scrollKatalog(direction);
                }
                isLongPress = false; // Reset flag
            };

            // Pasang Event Listener (Mouse & Touch)
            // KIRI
            ['mousedown', 'touchstart'].forEach(evt => 
                btnLeft.addEventListener(evt, (e) => { 
                    if(e.type === 'touchstart') e.preventDefault(); // Cegah ghost click di HP
                    startAction('left'); 
                })
            );
            ['mouseup', 'mouseleave', 'touchend'].forEach(evt => 
                btnLeft.addEventListener(evt, () => endAction('left'))
            );

            // KANAN
            ['mousedown', 'touchstart'].forEach(evt => 
                btnRight.addEventListener(evt, (e) => { 
                    if(e.type === 'touchstart') e.preventDefault(); 
                    startAction('right'); 
                })
            );
            ['mouseup', 'mouseleave', 'touchend'].forEach(evt => 
                btnRight.addEventListener(evt, () => endAction('right'))
            );
        }

        // Jalankan inisialisasi scroll saat halaman siap
        document.addEventListener("DOMContentLoaded", initScrollLogic);

        // Fungsi Scroll Biasa (Lompat per blok)
        function scrollKatalog(direction) {
            const container = document.getElementById('katalogScroll');
            const scrollAmount = 300; 
            if (direction === 'left') { container.scrollBy({ left: -scrollAmount, behavior: 'smooth' }); } 
            else { container.scrollBy({ left: scrollAmount, behavior: 'smooth' }); }
        }
        // ----------------------------------------------------

        function addToCartCurrent() {
            const item = allProducts[currentIndex];
            const qtyInput = document.getElementById('modalQty');
            const qty = parseInt(qtyInput.value);
            const minOrderText = item.min_order || "";
            const minOrderValue = parseInt(minOrderText.replace(/\D/g, '')) || 1; 

            if (qty < minOrderValue) {
                 Swal.fire({ icon: 'warning', title: 'Minimal Order!', text: `Minimal pesan ${minOrderValue} untuk produk ini.` });
                 return;
            }

            const existingItem = cart.find(c => c.id === item.id_produk);
            if(existingItem) { existingItem.qty += qty; } 
            else { cart.push({ id: item.id_produk, nama: item.nama_produk, harga: item.harga, qty: qty }); }
            saveCart(); closeModal('modalProduk'); Swal.fire({ icon: 'success', title: 'Masuk Keranjang!', timer: 1000, showConfirmButton: false });
        }

        function buyNow() { addToCartCurrent(); setTimeout(() => { openModal('modalKeranjang'); }, 500); }
        function removeFromCart(index) { cart.splice(index, 1); saveCart(); }
        function saveCart() { sessionStorage.setItem('myCart', JSON.stringify(cart)); updateCartUI(); }

        function updateCartUI() {
            const listDiv = document.getElementById('cartList');
            let totalQty = 0; let totalPrice = 0; listDiv.innerHTML = "";
            
            if (cart.length === 0) {
                listDiv.innerHTML = `
                    <div style="text-align:center; padding: 20px; color:#999;">
                        <i class="fas fa-shopping-cart" style="font-size: 2rem; margin-bottom: 10px; color:#eee;"></i>
                        <p>Keranjang masih kosong.</p>
                    </div>`;
            } else {
                cart.forEach((item, index) => {
                    totalQty += item.qty; 
                    totalPrice += (item.harga * item.qty);
                    
                    let div = document.createElement('div'); 
                    div.className = 'cart-item';
                    div.innerHTML = `
                        <div class="cart-item-left">
                            <div class="cart-item-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="cart-item-info">
                                <div class="cart-item-title">${item.nama}</div>
                                <div class="cart-item-price">${item.qty} x Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</div>
                            </div>
                        </div>
                        <i class="fas fa-trash-alt btn-remove" onclick="removeFromCart(${index})" title="Hapus"></i>
                    `;
                    listDiv.appendChild(div);
                });
            }
            
            document.getElementById('cartCount').innerText = cart.length; 
            document.getElementById('btnTotalItem').innerText = cart.length;
            document.getElementById('cartTotalPrice').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        }

        function toggleWishlist(id) {
            const idx = wishlist.indexOf(id);
            if (idx > -1) { wishlist.splice(idx, 1); } 
            else { wishlist.push(id); Swal.fire({toast:true, position:'top-end', icon:'success', title:'Disimpan ke Favorit', showConfirmButton:false, timer:1500}); }
            localStorage.setItem('myWishlist', JSON.stringify(wishlist));
            updateWishlistUI();
        }

        function toggleWishlistCurrent() {
            const item = allProducts[currentIndex]; toggleWishlist(item.id_produk); updateModal(); 
        }

        function updateWishlistUI() {
            allProducts.forEach(p => {
                const btn = document.getElementById(`cardHeart-${p.id_produk}`);
                if(btn) {
                    if(wishlist.includes(p.id_produk)) { btn.innerHTML = '<i class="fas fa-heart" style="color:#e74c3c;"></i>'; btn.classList.add('active'); } 
                    else { btn.innerHTML = '<i class="far fa-heart"></i>'; btn.classList.remove('active'); }
                }
            });
            document.getElementById('wishlistCount').innerText = wishlist.length;
            const listDiv = document.getElementById('wishlistList'); listDiv.innerHTML = "";
            if (wishlist.length === 0) { listDiv.innerHTML = '<p style="text-align:center; padding: 20px; color:#999;">Belum ada produk favorit.</p>'; } 
            else {
                wishlist.forEach(id => {
                    const item = allProducts.find(p => p.id_produk === id);
                    if(item) {
                        let div = document.createElement('div'); div.className = 'cart-item';
                        div.innerHTML = `<div style="display:flex; align-items:center; gap:10px;"><img src="${baseUrl}/${item.foto_produk}" width="40" height="40" style="border-radius:5px; object-fit:cover;"><div><div class="cart-item-title">${item.nama_produk}</div></div></div><div style="display:flex; gap:10px;"><i class="fas fa-eye btn-remove" style="color:var(--primary);" onclick="openProductModal(${allProducts.indexOf(item)}); closeModal('modalWishlist');"></i><i class="fas fa-trash-alt btn-remove" onclick="toggleWishlist(${id})"></i></div>`;
                        listDiv.appendChild(div);
                    }
                });
            }
        }

        // --- SEARCH & MODAL LOGIC ---
        async function cekPesanan() {
            let kode = document.getElementById('inputKode').value;
            if(!kode) { Swal.fire("Harap isi kode/nomor WA"); return; }
            document.getElementById('resultArea').style.display = 'none';
            document.getElementById('notFoundMsg').style.display = 'none';
            try {
                let response = await fetch(`/cek-status?kode=${kode}`);
                let data = await response.json();
                if (data.status === 'found') {
                    document.getElementById('resNama').innerText = data.data.nama_pelanggan;
                    document.getElementById('resId').innerText = data.data.kode_pesanan;
                    document.getElementById('resTgl').innerText = new Date(data.data.created_at).toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'});
                    
                    let detailHtml = "";
                    try {
                        let detailObj = JSON.parse(data.data.detail_pesanan);
                        if (detailObj.items) {
                            detailHtml = `<table class="mini-table"><thead><tr><th>Produk</th><th>Qty</th><th>Harga</th></tr></thead><tbody>`;
                            let total = 0;
                            detailObj.items.forEach(item => {
                                let sub = item.harga * item.qty; total += sub;
                                detailHtml += `<tr><td>${item.nama}</td><td style="text-align:center">${item.qty}</td><td class="price">Rp ${new Intl.NumberFormat('id-ID').format(sub)}</td></tr>`;
                            });
                            detailHtml += `<tr><td colspan="2" style="font-weight:bold;">Total Est.</td><td class="price" style="font-weight:bold;">Rp ${new Intl.NumberFormat('id-ID').format(total)}</td></tr></tbody></table>`;
                        }
                    } catch (e) { detailHtml = `<p style="color:#666;">${data.data.detail_pesanan}</p>`; }
                    document.getElementById('resDetailContainer').innerHTML = detailHtml;
                    
                    let badge = document.getElementById('resStatus');
                    let st = data.data.status; badge.innerText = st;
                    badge.style.backgroundColor = st === 'Selesai' ? '#2e7d32' : (st === 'Proses' ? '#ef6c00' : '#c62828');
                    
                    let btnInvoice = document.getElementById('linkInvoiceFull');
                    btnInvoice.href = data.data.link_invoice;
                    btnInvoice.style.display = 'block'; 
                    
                    // --- LOGIC TOMBOL REVIEW UPDATE (Direct Link) ---
                    let btnReview = document.getElementById('btnReviewContainer');
                    if(st === 'Selesai' && !data.data.is_reviewed) {
                        btnReview.style.display = 'block';
                        
                        // Set HREF langsung ke rute tulis_testimoni
                        let linkReview = document.getElementById('btnReviewAction');
                        // Pastikan URL digenerate dengan benar, bisa pakai base URL JS atau concat string sederhana
                        linkReview.href = "{{ url('tulis_testimoni') }}/" + data.data.kode_pesanan;
                        
                    } else {
                        btnReview.style.display = 'none';
                    }

                    // --- LOGIC CANCEL (BARU) ---
                    let btnCancel = document.getElementById('btnCancelContainer');
                    window.currentOrderData = {
                        kode: data.data.kode_pesanan,
                        nama: data.data.nama_pelanggan
                    };
                    
                    if (st === 'Baru Masuk') {
                        btnCancel.style.display = 'block';
                    } else {
                        btnCancel.style.display = 'none';
                    }
                    // ----------------------------

                    document.getElementById('resultArea').style.display = 'block';
                } else { document.getElementById('notFoundMsg').style.display = 'block'; }
            } catch (error) { Swal.fire("Gagal menghubungi server"); }
        }

        // FUNGSI PEMBATALAN (BARU)
        function ajukanPembatalan() {
            const data = window.currentOrderData;
            if (!data) return;

            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: "Anda akan diarahkan ke WhatsApp Admin untuk konfirmasi pembatalan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hubungi Admin',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    const nomorAdmin = "6281937536701"; 
                    const pesan = `Halo Admin Aneka Usaha,%0a%0aSaya ingin mengajukan pembatalan untuk pesanan:%0a*Kode: ${data.kode}*%0a*Atas Nama: ${data.nama}*%0a%0aMohon diproses pembatalannya. Terima kasih.`;
                    window.open(`https://api.whatsapp.com/send?phone=${nomorAdmin}&text=${pesan}`, '_blank');
                }
            });
        }

        function searchProduct() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.getElementsByClassName('product-card');
            let hasResults = false;
            for (let i = 0; i < cards.length; i++) {
                let title = cards[i].getAttribute('data-nama');
                if (title.includes(input)) { cards[i].style.display = ""; hasResults = true; } 
                else { cards[i].style.display = "none"; }
            }
            document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
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

        function openProductModal(idx) { currentIndex = idx; updateModal(); openModal('modalProduk'); }
        function openModal(id) { document.getElementById(id).classList.add('show'); document.body.style.overflow = 'hidden'; }
        function closeModal(id) { document.getElementById(id).classList.remove('show'); document.body.style.overflow = 'auto'; }
        window.onclick = function(e) { if(e.target.classList.contains('modal')) { e.target.classList.remove('show'); document.body.style.overflow = 'auto'; } }

        function switchProduct(dir) {
            const mb = document.getElementById('modalBody'); mb.classList.add('animating-out');
            setTimeout(() => {
                if(dir==='next') currentIndex = (currentIndex+1)%allProducts.length;
                else currentIndex = (currentIndex-1+allProducts.length)%allProducts.length;
                updateModal(); mb.classList.remove('animating-out');
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
            
            const qtyInput = document.getElementById('modalQty');
            const min = parseInt((item.min_order||"").replace(/\D/g, '')) || 1;
            qtyInput.value = min; qtyInput.min = min;

            const btnFav = document.getElementById('modalFavBtn');
            if(wishlist.includes(item.id_produk)) { btnFav.classList.add('active'); btnFav.innerHTML = '<i class="fas fa-heart"></i>'; }
            else { btnFav.classList.remove('active'); btnFav.innerHTML = '<i class="far fa-heart"></i>'; }

            const text = `Halo, saya tertarik dengan produk *${item.nama_produk}* (Rp ${item.harga}). Apakah tersedia?`;
            document.getElementById('shareBtn').href = `https://wa.me/?text=${encodeURIComponent(text)}`;
        }

        // FUNGSI LIGHTBOX PORTOFOLIO
        function openLightbox(src, title) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightboxTitle').innerText = title;
            document.getElementById('modalLightbox').classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    </script>

    <!-- SweetAlert & Error Handling -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success_testimoni'))
            Swal.fire({
                icon: 'success',
                title: 'Terima Kasih!',
                text: '{{ session('success_testimoni') }}',
                confirmButtonColor: '#2C3E50'
            });
        @endif

        @if(session('error_testimoni'))
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('error_testimoni') }}',
                confirmButtonColor: '#2C3E50'
            });
        @endif
    </script>
</body>
</html>