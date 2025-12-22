<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($existingTestimoni) ? 'Edit Ulasan' : 'Tulis Ulasan' }} - Aneka Usaha</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #FDFBF7;
            --primary: #2C3E50;
            --accent: #D4A373;
            --white: #ffffff;
            --text-gray: #64748b;
            --shadow: 0 10px 40px -10px rgba(0,0,0,0.1);
            --danger: #e74c3c;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--primary);
        }

        /* Container Card Animation */
        .wrapper {
            width: 100%;
            max-width: 550px;
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        /* Decoration Top Bar */
        .top-bar {
            height: 8px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            width: 100%;
        }

        .content {
            padding: 40px;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: var(--accent);
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--primary);
        }

        .subtitle {
            font-size: 0.95rem;
            color: var(--text-gray);
        }

        .order-badge {
            display: inline-block;
            background: #ecf0f1;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--primary);
            margin-top: 10px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: var(--primary);
        }

        .input-box {
            position: relative;
        }

        .input-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #bdc3c7;
            transition: 0.3s;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 14px 15px 14px 45px; /* Space for icon */
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
            background: #fcfcfc;
            color: var(--primary);
            font-family: inherit;
        }

        textarea {
            padding: 15px; /* No icon for textarea usually */
            resize: vertical;
            min-height: 120px;
        }

        input:focus, textarea:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.1);
        }

        .input-box input:focus + i {
            color: var(--accent);
        }

        /* Star Rating Modern */
        .rating-container {
            background: #fffdf9;
            border: 2px dashed #ececec;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin-bottom: 25px;
        }

        .rating-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .rating {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 8px;
        }

        .rating input { display: none; }

        .rating label {
            font-size: 2.2rem;
            color: #e2e8f0;
            cursor: pointer;
            transition: all 0.2s;
        }

        /* Efek Hover & Checked: Warna Kuning Emas */
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffc107;
            transform: scale(1.1);
            text-shadow: 0 2px 5px rgba(255, 193, 7, 0.3);
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 20px rgba(44, 62, 80, 0.2);
        }

        .btn-submit:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(212, 163, 115, 0.3);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* Back Link */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            text-decoration: none;
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 500;
            transition: 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        /* Error Message */
        .error-msg {
            background: #fff5f5;
            color: var(--danger);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            border-left: 4px solid var(--danger);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .content { padding: 30px 20px; }
            h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="top-bar"></div>
        
        <div class="content">
            
            <div class="header">
                <div class="icon-wrapper">
                    <i class="fas fa-edit"></i>
                </div>
                <h2>{{ isset($existingTestimoni) ? 'Edit Ulasan' : 'Beri Ulasan' }}</h2>
                <p class="subtitle">Bagaimana pengalaman belanja Anda?</p>
                <div class="order-badge">
                    <i class="fas fa-receipt"></i> #{{ $kode_pesanan }}
                </div>
            </div>

            @if($errors->any())
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('testimoni.kirim') }}" method="POST">
                @csrf
                <input type="hidden" name="kode_pesanan" value="{{ $kode_pesanan }}">

                <div class="rating-container">
                    <span class="rating-title">Beri Bintang Kepuasan</span>
                    <div class="rating">
                        @php $val = isset($existingTestimoni) ? $existingTestimoni->rating : 5; @endphp
                        <input type="radio" name="rating" id="star5" value="5" {{ $val == 5 ? 'checked' : '' }}><label for="star5" title="Sempurna"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="star4" value="4" {{ $val == 4 ? 'checked' : '' }}><label for="star4" title="Puas"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="star3" value="3" {{ $val == 3 ? 'checked' : '' }}><label for="star3" title="Biasa"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="star2" value="2" {{ $val == 2 ? 'checked' : '' }}><label for="star2" title="Kurang"><i class="fas fa-star"></i></label>
                        <input type="radio" name="rating" id="star1" value="1" {{ $val == 1 ? 'checked' : '' }}><label for="star1" title="Kecewa"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-box">
                        <input type="text" name="nama" required 
                               value="{{ isset($existingTestimoni) ? $existingTestimoni->nama_pelanggan : $pesanan->nama_pelanggan }}" 
                               placeholder="Masukkan nama Anda">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Kota Domisili</label>
                    <div class="input-box">
                        <input type="text" name="kota" required 
                               value="{{ isset($existingTestimoni) ? $existingTestimoni->kota : '' }}"
                               placeholder="Contoh: Makassar">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ceritakan Pengalamanmu</label>
                    <textarea name="isi" placeholder="Produknya bagus, pengiriman cepat..." required>{{ isset($existingTestimoni) ? $existingTestimoni->isi_testimoni : '' }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> 
                    {{ isset($existingTestimoni) ? 'Simpan Perubahan' : 'Kirim Ulasan' }}
                </button>

            </form>

            <a href="{{ url('/') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>