<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Aneka Usaha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --bg-color: #FDFBF7; --primary: #2C3E50; --accent: #D4A373; --white: #ffffff; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); color: var(--primary); height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 20px; }
        .card { background: var(--white); padding: 50px; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); max-width: 500px; width: 100%; }
        .icon-box { width: 80px; height: 80px; background: #e8f5e9; color: #2e7d32; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 20px; }
        h1 { margin-bottom: 10px; }
        p { color: #666; margin-bottom: 30px; }
        .btn { display: block; width: 100%; padding: 15px; border-radius: 50px; text-decoration: none; font-weight: 600; margin-bottom: 10px; transition: 0.3s; }
        .btn-wa { background-color: #25D366; color: white; }
        .btn-wa:hover { background-color: #1ebe57; box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4); }
        .btn-home { background-color: #eee; color: var(--primary); }
        .btn-home:hover { background-color: #ddd; }
    </style>
</head>
<body>

    <div class="card">
        <div class="icon-box">
            <i class="fas fa-check"></i>
        </div>
        <h1>Pesanan Diterima!</h1>
        <p>Data Anda telah tersimpan di sistem kami.<br>Silakan selesaikan pemesanan via WhatsApp.</p>

        <a href="{{ $linkWA }}" class="btn btn-wa" target="_blank">
            <i class="fab fa-whatsapp"></i> Lanjut ke WhatsApp
        </a>

        <a href="{{ url('/') }}" class="btn btn-home">
            Kembali ke Beranda
        </a>
        
        <p style="font-size: 0.8rem; margin-top: 20px; color: #999;">
            *WhatsApp akan terbuka otomatis dalam 3 detik...
        </p>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "{{ $linkWA }}";
        }, 3000); // Redirect setelah 3 detik
    </script>

</body>
</html>