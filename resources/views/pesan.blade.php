<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan - Aneka Usaha</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- COPY STYLE LAMA (SAMA) --- */
        :root { --bg-color: #FDFBF7; --primary: #2C3E50; --accent: #D4A373; --white: #ffffff; --shadow: 0 20px 50px rgba(0,0,0,0.1); }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); color: var(--primary); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .main-card { background: var(--white); width: 100%; max-width: 1000px; border-radius: 25px; box-shadow: var(--shadow); overflow: hidden; display: flex; min-height: 600px; }
        .left-side { width: 40%; background-color: var(--primary); color: var(--white); padding: 50px; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden; }
        .circle-deco { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.05); }
        .circle-1 { width: 200px; height: 200px; top: -50px; left: -50px; }
        .circle-2 { width: 300px; height: 300px; bottom: -100px; right: -50px; }
        .left-content { z-index: 2; }
        .brand-title { font-size: 1.5rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 10px;}
        .steps-container { margin-top: 40px; }
        .step-item { display: flex; align-items: center; margin-bottom: 25px; opacity: 0.8; }
        .step-num { width: 35px; height: 35px; background: var(--accent); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 15px; flex-shrink: 0; }
        .step-text h4 { font-size: 1rem; font-weight: 600; }
        .step-text p { font-size: 0.8rem; opacity: 0.8; }
        .back-link { color: var(--white); text-decoration: none; display: flex; align-items: center; gap: 10px; font-size: 0.9rem; transition: 0.3s; opacity: 0.7; z-index: 2; }
        .back-link:hover { opacity: 1; transform: translateX(-5px); }
        .right-side { width: 60%; padding: 50px; display: flex; flex-direction: column; justify-content: center; }
        .form-header h2 { font-size: 2rem; font-weight: 700; margin-bottom: 10px; color: var(--primary); }
        .form-header p { color: #888; margin-bottom: 30px; font-size: 0.95rem; }
        .input-group { margin-bottom: 20px; position: relative; }
        .input-label { font-size: 0.9rem; font-weight: 600; margin-bottom: 8px; display: block; color: var(--primary); }
        .form-control { width: 100%; padding: 15px 20px 15px 45px; border: 2px solid #eee; border-radius: 12px; background: #f9f9f9; font-family: inherit; font-size: 0.95rem; transition: 0.3s; outline: none; }
        .form-control:focus { border-color: var(--accent); background: #fff; box-shadow: 0 5px 15px rgba(212, 163, 115, 0.1); }
        .input-icon { position: absolute; left: 15px; top: 42px; color: #bbb; transition: 0.3s; }
        .form-control:focus + .input-icon { color: var(--accent); }
        .file-upload-wrapper { border: 2px dashed #ddd; padding: 20px; border-radius: 12px; text-align: center; cursor: pointer; transition: 0.3s; background: #fafafa; position: relative; }
        .file-upload-wrapper:hover { border-color: var(--accent); background: #fff; }
        .file-upload-wrapper input[type="file"] { position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .btn-submit { width: 100%; padding: 15px; background-color: var(--primary); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: 0.3s; margin-top: 10px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-submit:hover { background-color: var(--accent); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        @media (max-width: 768px) {
            .main-card { flex-direction: column; min-height: auto; }
            .left-side { width: 100%; padding: 30px; height: auto; }
            .right-side { width: 100%; padding: 30px; }
            .circle-deco { display: none; }
        }
        /* Style Tambahan untuk Preview Keranjang */
        .cart-summary { background: #fff8e1; border: 1px dashed var(--accent); padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; }
        .cart-summary ul { padding-left: 20px; margin-top: 5px; }
        .cart-summary li { margin-bottom: 5px; color: #555; }
        .cart-total-label { font-weight: 700; margin-top: 10px; display: block; text-align: right; color: var(--primary); }
    </style>
</head>
<body>

    <div class="main-card">
        <div class="left-side">
            <div class="circle-deco circle-1"></div>
            <div class="circle-deco circle-2"></div>
            <div class="left-content">
                <h3 class="brand-title">ANEKA USAHA</h3>
                <div class="steps-container">
                    <div class="step-item"><div class="step-num">1</div><div class="step-text"><h4>Isi Formulir</h4><p>Lengkapi data diri dan detail pesanan.</p></div></div>
                    <div class="step-item" style="opacity: 1;"><div class="step-num">2</div><div class="step-text"><h4>Simpan & Kirim</h4><p>Pesanan otomatis tersimpan.</p></div></div>
                    <div class="step-item"><div class="step-num"><i class="fab fa-whatsapp"></i></div><div class="step-text"><h4>Lanjut WhatsApp</h4><p>Konfirmasi harga ke Admin.</p></div></div>
                </div>
            </div>
            <a href="{{ url('/') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>

        <div class="right-side">
            <div class="form-header">
                <h2>Pesan Sekarang</h2>
                <p>Silakan isi form di bawah ini.</p>
            </div>

            <form id="orderForm" action="{{ route('pesanan.kirim') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- INPUT HIDDEN UNTUK MENAMPUNG DATA JSON CART -->
                <input type="hidden" name="keranjang_json" id="inputKeranjang">
                
                <div class="cart-summary" id="cartPreview" style="display:none;">
                    <strong><i class="fas fa-shopping-cart"></i> Item yang akan dipesan:</strong>
                    <ul id="cartPreviewList"></ul>
                    <span class="cart-total-label" id="cartPreviewTotal"></span>
                </div>

                <div class="input-group">
                    <label class="input-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                    <i class="fas fa-user input-icon"></i>
                </div>

                <div class="input-group">
                    <label class="input-label">Nomor WhatsApp</label>
                    <input type="number" name="no_wa" class="form-control" placeholder="Contoh: 08123456789" required>
                    <i class="fab fa-whatsapp input-icon"></i>
                </div>

                <!-- Diganti jadi Catatan Tambahan (Bukan Detail Utama lagi) -->
                <div class="input-group">
                    <label class="input-label">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2" style="height:auto;" placeholder="Contoh: Mohon dikirim sore hari..."></textarea>
                    <i class="fas fa-edit input-icon"></i>
                </div>

                <div class="input-group">
                    <label class="input-label">Upload Contoh Desain (Opsional)</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="file_desain" onchange="updateFileName(this)">
                        <i class="fas fa-cloud-upload-alt fa-2x" style="color: var(--accent); margin-bottom: 10px;"></i>
                        <p id="fileName" style="font-size: 0.9rem; color: #666;">Klik untuk upload file (JPG/PNG/PDF)</p>
                    </div>
                </div>

                <button type="submit" class="btn-submit" onclick="prepareSubmission()">
                    Kirim Pesanan & Lanjut WA <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        // 1. Tampilkan Preview Keranjang saat Load
        window.onload = function() {
            const rawCart = localStorage.getItem('myCart');
            if(rawCart) {
                const cart = JSON.parse(rawCart);
                if(cart.length > 0) {
                    document.getElementById('cartPreview').style.display = 'block';
                    const list = document.getElementById('cartPreviewList');
                    let total = 0;
                    
                    cart.forEach(item => {
                        let li = document.createElement('li');
                        let subtotal = item.harga * item.qty;
                        total += subtotal;
                        li.innerText = `${item.qty}x ${item.nama} - Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}`;
                        list.appendChild(li);
                    });
                    
                    document.getElementById('cartPreviewTotal').innerText = "Est. Total: Rp " + new Intl.NumberFormat('id-ID').format(total);
                    
                    // Masukkan data JSON ke Input Hidden
                    document.getElementById('inputKeranjang').value = rawCart;
                }
            }
        };

        // 2. Fungsi Upload File Name
        function updateFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById('fileName').innerText = "File terpilih: " + fileName;
            document.getElementById('fileName').style.color = "var(--primary)";
            document.getElementById('fileName').style.fontWeight = "bold";
        }
        
        // 3. Bersihkan Keranjang setelah Submit (Opsional)
        document.getElementById('orderForm').onsubmit = function() {
            // Kita biarkan localStorage agar user masih bisa lihat history di beranda kalau mau,
            // atau dihapus: localStorage.removeItem('myCart');
            // Untuk flow ini, biasanya dihapus agar keranjang kosong kembali.
            localStorage.removeItem('myCart');
        };
    </script>

</body>
</html>