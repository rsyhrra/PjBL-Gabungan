<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - Aneka Usaha</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #FDFBF7;
            --primary: #2C3E50;
            --accent: #D4A373;
            --white: #ffffff;
        }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bg-color); 
            color: var(--primary);
            margin: 0; padding: 0;
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%; max-width: 500px;
            padding: 20px;
        }

        .card {
            background: var(--white);
            padding: 40px 30px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 { margin-bottom: 10px; color: var(--primary); font-size: 1.5rem; }
        p.subtitle { color: #666; margin-bottom: 30px; font-size: 0.9rem; }

        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 8px; color: var(--primary); }
        
        input[type="text"], textarea {
            width: 100%; padding: 12px 15px;
            border: 2px solid #eee; border-radius: 12px;
            font-family: inherit; outline: none; transition: 0.3s;
            box-sizing: border-box;
        }
        input:focus, textarea:focus { border-color: var(--accent); background: #fff; }
        input[readonly] { background-color: #f9f9f9; color: #888; cursor: not-allowed; }

        /* Star Rating */
        .rating-input { display: flex; flex-direction: row-reverse; justify-content: center; gap: 10px; margin: 10px 0 20px 0; }
        .rating-input input { display: none; }
        .rating-input label { font-size: 2.5rem; color: #ddd; cursor: pointer; transition: 0.2s; }
        .rating-input input:checked ~ label, .rating-input label:hover, .rating-input label:hover ~ label { color: #ffc107; transform: scale(1.1); }

        .btn-submit {
            width: 100%; padding: 15px;
            background: linear-gradient(135deg, var(--primary) 0%, #34495e 100%);
            color: white; border: none; border-radius: 50px;
            font-weight: 600; cursor: pointer; transition: 0.3s;
            box-shadow: 0 10px 20px rgba(44, 62, 80, 0.2);
            font-size: 1rem;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(44, 62, 80, 0.3); }

        .back-link { display: block; margin-top: 20px; text-decoration: none; color: #888; font-size: 0.9rem; }
        .back-link:hover { color: var(--primary); }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h2>Tulis Pengalamanmu</h2>
            <p class="subtitle">Bagikan cerita kepuasan Anda berbelanja di Aneka Usaha.</p>

            <form action="{{ route('testimoni.kirim') }}" method="POST">
                @csrf
                <!-- Kode Pesanan Otomatis Terisi & Readonly -->
                <div class="form-group">
                    <label>Kode Pesanan</label>
                    <input type="text" name="kode_pesanan" value="{{ $kode_pesanan }}" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Anda</label>
                    <input type="text" name="nama" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label>Kota Asal</label>
                    <input type="text" name="kota" placeholder="Contoh: Makassar" required>
                </div>

                <div class="form-group" style="text-align:center;">
                    <label style="margin-bottom:5px;">Beri Bintang</label>
                    <div class="rating-input">
                        <input type="radio" name="rating" id="st5" value="5" checked><label for="st5" title="Sangat Puas"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="st4" value="4"><label for="st4" title="Puas"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="st3" value="3"><label for="st3" title="Cukup"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="st2" value="2"><label for="st2" title="Kurang"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="st1" value="1"><label for="st1" title="Sangat Kurang"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ulasan Lengkap</label>
                    <textarea name="isi" rows="4" placeholder="Ceritakan pengalaman kualitas produk & pelayanan kami..." required></textarea>
                </div>

                <button type="submit" class="btn-submit">Kirim Ulasan <i class="fas fa-paper-plane"></i></button>
            </form>

            <a href="{{ url('/') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>