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
            background: rgba(253, 251, 247, 0.95); backdrop-filter: blur(10px);
            z-index: 1000; box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .logo { font-weight: 800; font-size: 1.5rem; letter-spacing: 1px; color: var(--primary); }
        .nav-links a { margin-left: 30px; text-decoration: none; color: var(--primary); font-weight: 500; transition: 0.3s; font-size: 0.95rem; }
        .nav-links a:hover { color: var(--accent); }
        .nav-icons i { margin-left: 20px; cursor: pointer; font-size: 1.2rem; transition: 0.3s; color: var(--primary); }
        .nav-icons i:hover { color: var(--accent); transform: scale(1.1); }

        /* --- 3. HERO SECTION --- */
        #home {
            display: flex; align-items: center; justify-content: space-between;
            min-height: 85vh; padding: 0 50px; position: relative;
        }
        .hero-text { max-width: 50%; z-index: 2; }
        .hero-text h1 { font-size: 3.5rem; line-height: 1.1; margin-bottom: 20px; font-weight: 700; }
        .hero-text p { font-size: 1.1rem; color: #666; margin-bottom: 30px; line-height: 1.6; }
        
        .btn {
            padding: 12px 35px; border-radius: 50px; text-decoration: none;
            font-weight: 600; border: none; cursor: pointer; transition: 0.3s;
            display: inline-block; font-size: 0.9rem;
        }
        .btn-primary { background-color: var(--primary); color: var(--white); box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3); }
        .btn-secondary { background-color: var(--accent); color: var(--white); margin-left: 10px; box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3); }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }

        .hero-image { position: relative; width: 45%; display: flex; justify-content: center; }
        .card-stack {
            width: 280px; height: 340px; background: #e0e0e0;
            position: absolute; transform: rotate(-8deg); border-radius: 20px;
        }
        .card-stack.top {
            background: linear-gradient(135deg, #f5f5f5, #dcdcdc);
            transform: rotate(6deg); z-index: 2;
            box-shadow: var(--shadow); top: -40px; left: 60px;
        }

        /* --- 4. KATALOG SLIDER --- */
        #katalog { padding: 60px 50px; background: #fff; }
        .catalog-header { display: flex; justify-content: space-between; margin-bottom: 30px; align-items: center; }
        .search-bar { background: #f0f0f0; padding: 10px 20px; border-radius: 30px; display: flex; align-items: center; width: 350px; transition: 0.3s; }
        .search-bar:focus-within { box-shadow: 0 0 0 2px var(--accent); background: #fff; }
        .search-bar input { border: none; background: transparent; outline: none; width: 100%; margin-left: 10px; font-family: inherit; color: var(--primary); }

        .slider-container { position: relative; display: flex; align-items: center; gap: 15px; min-height: 400px; } /* Min-height agar tidak gepeng saat kosong */
        
        /* Area Scroll Horizontal */
        .product-scroll-wrapper {
            display: flex; overflow-x: auto; scroll-behavior: auto; 
            gap: 25px; padding: 20px 5px; width: 100%;
            scrollbar-width: none; /* Firefox */
        }
        .product-scroll-wrapper::-webkit-scrollbar { display: none; } /* Chrome */

        /* Kartu Produk */
        .product-card {
            background: var(--bg-color); border-radius: 15px;
            min-width: 260px; max-width: 260px; flex: 0 0 auto;
            transition: 0.3s; cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03); border: 1px solid #eee;
            display: flex; flex-direction: column; overflow: hidden;
        }
        .product-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: var(--accent); }

        /* Gambar di Kartu */
        .product-img { height: 180px; background-color: #f4f4f4; overflow: hidden; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .product-card:hover .product-img img { transform: scale(1.1); }

        .product-info { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cat-label { font-size: 0.7rem; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .product-info h3 { font-size: 1.05rem; margin-bottom: 5px; color: var(--primary); line-height: 1.4; font-weight: 600; }
        
        .price-info { margin-top: 15px; padding-top: 10px; border-top: 1px dashed #ddd; }
        .price { font-weight: 700; color: var(--primary); font-size: 1.1rem; }
        .price span { font-size: 0.8rem; font-weight: 400; color: #999; }
        .min-order { font-size: 0.75rem; color: #999; margin-top: 2px; }

        /* Tombol Scroll Bulat */
        .scroll-btn {
            background-color: var(--primary); color: white; border: none;
            width: 45px; height: 45px; border-radius: 50%;
            cursor: pointer; z-index: 5; display: flex; align-items: center; justify-content: center;
            transition: 0.2s; box-shadow: 0 4px 10px rgba(0,0,0,0.15); flex-shrink: 0; font-size: 1.1rem;
        }
        .scroll-btn:active { transform: scale(0.9); background-color: var(--accent); }

        /* Pesan No Result */
        #noResults {
            position: absolute; width: 100%; text-align: center; top: 50%; transform: translateY(-50%);
            color: #999; display: none;
        }

        /* --- 5. MODAL & ANIMASI --- */
        .modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(44, 62, 80, 0.7); z-index: 2000;
            justify-content: center; align-items: center;
            opacity: 0; transition: opacity 0.3s ease;
        }
        .modal.show { display: flex; opacity: 1; }
        
        .modal-content {
            background: var(--white); padding: 40px; border-radius: 20px;
            width: 90%; max-width: 850px; position: relative;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2); animation: slideUp 0.4s ease;
            display: flex; align-items: center; min-height: 450px; 
        }

        /* Wadah Konten Animasi */
        #modalBody {
            display: flex; gap: 40px; width: 100%;
            transition: all 0.3s ease-in-out; 
            opacity: 1; transform: scale(1);
        }
        
        /* Class saat animasi keluar */
        .animating-out { opacity: 0; transform: scale(0.95) translateX(-10px); }

        .modal-close { position: absolute; top: 20px; right: 25px; font-size: 1.8rem; cursor: pointer; z-index: 20; color: #999; transition: 0.3s; }
        .modal-close:hover { color: var(--accent); transform: rotate(90deg); }

        /* Tombol Navigasi Modal (Next/Prev) */
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

        /* --- 6. TRACKING MODAL --- */
        .order-input { width: 100%; padding: 15px; border: 2px solid #eee; border-radius: 10px; margin: 20px 0; font-size: 1rem; outline: none; transition: 0.3s; }
        .order-input:focus { border-color: var(--accent); }
        .result-box { margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid var(--accent); text-align: left; display: none; }
        .status-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; background: var(--accent); color: white; font-size: 0.85rem; margin-top: 5px; font-weight: 600; }

        /* --- 7. FOOTER / CONTACT --- */
        #contact { padding: 80px 50px; background: var(--bg-color); border-top: 1px solid #eee; margin-top: 50px; }
        .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .contact-item { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .icon-circle { width: 40px; height: 40px; background: #e0e0e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); }

        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* --- MOBILE RESPONSIVE --- */
        @media (max-width: 768px) {
            nav { padding: 15px 20px; }
            .nav-links { display: none; }
            #home { flex-direction: column-reverse; justify-content: center; text-align: center; gap: 40px; padding: 20px; }
            .hero-text { max-width: 100%; }
            .hero-text h1 { font-size: 2.5rem; }
            .hero-image { width: 100%; }
            #katalog { padding: 40px 20px; }
            .catalog-header { flex-direction: column; gap: 15px; }
            .search-bar { width: 100%; }
            .scroll-btn { display: none; } /* Hide button di HP */
            .modal-content { width: 95%; padding: 20px; flex-direction: column; }
            #modalBody { flex-direction: column; gap: 20px; }
            .modal-nav-btn.prev { left: 5px; }
            .modal-nav-btn.next { right: 5px; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">ANEKA USAHA</div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#katalog">Katalog</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="nav-icons">
            <i class="fas fa-receipt" onclick="openModal('modalCekPesanan')" title="Lacak Pesanan"></i>
        </div>
    </nav>

    <section id="home">
        <div class="hero-text">
            <h1>PERCETAKAN<br>UNDANGAN & ATK</h1>
            <p>Solusi percetakan modern dengan kualitas terbaik. Kami melayani pembuatan undangan kustom, spanduk, hingga ATK lengkap.</p>
            <div style="margin-top: 30px;">
                <a href="#katalog" class="btn btn-primary">Lihat Katalog</a>
                <a href="#contact" class="btn btn-secondary">Hubungi Kami</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="card-stack"></div>
            <div class="card-stack top"></div>
        </div>
    </section>

    <section id="katalog">
        <div class="catalog-header">
            <div class="search-bar">
                <i class="fas fa-search" style="color: #999;"></i>
                <input type="text" id="searchInput" onkeyup="searchProduct()" placeholder="Cari produk (Undangan, Spanduk)...">
            </div>
            <button class="btn btn-secondary" onclick="openModal('modalCekPesanan')">Cek Pesanan</button>
        </div>

        <div class="slider-container" id="sliderContainer">
            
            <button class="scroll-btn left" 
                onmousedown="startScrolling('left')" 
                onmouseup="stopScrolling()" 
                onmouseleave="stopScrolling()"
                ontouchstart="startScrolling('left')" 
                ontouchend="stopScrolling()">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="product-scroll-wrapper" id="katalogScroll">
                @foreach($produk as $key => $item)
                <div class="product-card" onclick="openProductModal({{ $key }})">
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

            <button class="scroll-btn right" 
                onmousedown="startScrolling('right')" 
                onmouseup="stopScrolling()" 
                onmouseleave="stopScrolling()"
                ontouchstart="startScrolling('right')" 
                ontouchend="stopScrolling()">
                <i class="fas fa-chevron-right"></i>
            </button>

        </div>
    </section>

    <section id="contact">
        <div class="contact-grid">
            <div>
                <h3 style="margin-bottom: 20px;">Hubungi Kami</h3>
                <div class="contact-item">
                    <div class="icon-circle"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <p style="font-size: 0.8rem; color:#888;">WhatsApp</p>
                        <p style="font-weight: 600;">0813-4113-6423</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                    <div>
                        <p style="font-size: 0.8rem; color:#888;">Email</p>
                        <p style="font-weight: 600;">anekausaha.gmail.com</p>
                    </div>
                </div>
            </div>
            <div>
                <h3 style="margin-bottom: 20px;">Lokasi</h3>
                <div class="contact-item">
                    <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <p style="font-weight: 600;">Jln. Pappa, Pattalassang, Kota Takalar, Sulawesi Selatan.</p>
                        <p style="font-size: 0.9rem; color:#666;">(Dekat Pusat Kota)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="modalProduk" class="modal">
        <div class="modal-content">
            
            <button class="modal-nav-btn prev" onclick="switchProduct('prev')">
                <i class="fas fa-chevron-left"></i>
            </button>

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

            <button class="modal-nav-btn next" onclick="switchProduct('next')">
                <i class="fas fa-chevron-right"></i>
            </button>

        </div>
    </div>

    <div id="modalCekPesanan" class="modal">
        <div class="modal-content" style="max-width: 500px; display: block; min-height: auto;">
            <span class="modal-close" onclick="closeModal('modalCekPesanan')">&times;</span>
            
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Lacak Pesanan Anda</h3>
                <p style="font-size: 0.9rem; color: #888;">Masukkan Kode Pesanan (ID) atau No. WhatsApp Anda</p>
                
                <input type="text" id="inputKode" class="order-input" placeholder="Contoh: 1 atau 0812...">
                <button class="btn btn-primary" onclick="cekPesanan()" style="width: 100%;">
                    Cari Pesanan <i class="fas fa-search" style="margin-left: 5px;"></i>
                </button>
                
                <div id="resultArea" class="result-box">
                    <p><strong>Atas Nama:</strong> <span id="resNama">-</span></p>
                    <p><strong>Tanggal:</strong> <span id="resTgl">-</span></p>
                    <p style="margin-top: 10px;"><strong>Detail Pesanan:</strong></p>
                    <p id="resDetail" style="color: #666; font-size: 0.9rem;">-</p>
                    <div class="status-badge" id="resStatus">Proses</div>
                </div>
                <p id="notFoundMsg" style="color: #e74c3c; margin-top: 15px; display: none; font-weight: 500;">
                    <i class="fas fa-exclamation-circle"></i> Data pesanan tidak ditemukan.
                </p>
            </div>
        </div>
    </div>

    <script>
        // 1. DATA DARI CONTROLLER
        const allProducts = @json($produk);
        let currentIndex = 0;
        let scrollInterval;
        const baseUrl = "{{ asset('img') }}"; 

        // 2. SEARCH FUNCTION (REAL-TIME)
        function searchProduct() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.getElementsByClassName('product-card');
            let hasResults = false;

            for (let i = 0; i < cards.length; i++) {
                let title = cards[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
                let cat = cards[i].getElementsByClassName('cat-label')[0].innerText.toLowerCase();

                if (title.includes(input) || cat.includes(input)) {
                    cards[i].style.display = ""; // Show
                    hasResults = true;
                } else {
                    cards[i].style.display = "none"; // Hide
                }
            }

            // Tampilkan Pesan jika Kosong
            const noResDiv = document.getElementById('noResults');
            const scrollWrapper = document.getElementById('katalogScroll');
            const btns = document.querySelectorAll('.scroll-btn');

            if (!hasResults) {
                noResDiv.style.display = "block";
                scrollWrapper.style.display = "none";
                btns.forEach(b => b.style.display = "none");
            } else {
                noResDiv.style.display = "none";
                scrollWrapper.style.display = "flex";
                if(window.innerWidth > 768) btns.forEach(b => b.style.display = "flex");
            }
        }

        // 3. HOLD TO SCROLL LOGIC
        function startScrolling(direction) {
            const container = document.getElementById('katalogScroll');
            const speed = 20; 
            const interval = 15;

            stopScrolling();
            scrollInterval = setInterval(() => {
                container.scrollLeft += (direction === 'left' ? -speed : speed);
            }, interval);
        }

        function stopScrolling() {
            clearInterval(scrollInterval);
        }

        // 4. MODAL LOGIC (OPEN/CLOSE)
        function openModal(id) { document.getElementById(id).classList.add('show'); }
        function closeModal(id) { document.getElementById(id).classList.remove('show'); }
        window.onclick = function(e) { if(e.target.classList.contains('modal')) e.target.classList.remove('show'); }

        // 5. PRODUCT MODAL LOGIC
        function openProductModal(index) {
            currentIndex = index;
            updateModalContent();
            document.getElementById('modalBody').classList.remove('animating-out');
            openModal('modalProduk');
        }

        function switchProduct(direction) {
            const modalBody = document.getElementById('modalBody');
            modalBody.classList.add('animating-out');

            setTimeout(() => {
                if (direction === 'next') {
                    currentIndex = (currentIndex + 1) % allProducts.length;
                } else {
                    currentIndex = (currentIndex - 1 + allProducts.length) % allProducts.length;
                }
                updateModalContent();
                modalBody.classList.remove('animating-out');
            }, 300);
        }

       function updateModalContent() {
            const item = allProducts[currentIndex];
            let formattedPrice = new Intl.NumberFormat('id-ID').format(item.harga);

            // Sesuaikan dengan nama kolom database
            document.getElementById('modalTitle').innerText = item.nama_produk;
            document.getElementById('modalCat').innerText = item.kategori;
            document.getElementById('modalDesc').innerText = item.deskripsi_produk; // Bedanya disini
            document.getElementById('modalPrice').innerText = 'Rp ' + formattedPrice + ' /pcs';
            document.getElementById('modalMinOrder').innerText = 'Minimal Order: ' + item.min_order;
            document.getElementById('modalImg').src = baseUrl + '/' + item.foto_produk; // Bedanya disini
        }

        // 6. AJAX CEK PESANAN
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
                    let tgl = new Date(data.data.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                    document.getElementById('resTgl').innerText = tgl;
                    document.getElementById('resDetail').innerText = data.data.detail_pesanan;
                    document.getElementById('resStatus').innerText = data.data.status;
                    
                    resultArea.style.display = 'block';
                    notFoundMsg.style.display = 'none';
                } else {
                    resultArea.style.display = 'none';
                    notFoundMsg.style.display = 'block';
                }
            } catch (error) {
                console.error(error);
                alert("Gagal menghubungi server.");
            }
        }
    </script>
</body>
</html>