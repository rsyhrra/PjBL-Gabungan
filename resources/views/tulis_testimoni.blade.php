<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($existingTestimoni) ? 'Edit Ulasan' : 'Beri Ulasan' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdfbf7; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .container { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 500px; text-align: center; }
        input, textarea, select { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { background: #2c3e50; color: white; padding: 12px; width: 100%; border: none; border-radius: 50px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

    <div class="container">
        <h2 style="color:#2C3E50;">{{ isset($existingTestimoni) ? 'Edit Ulasan Anda' : 'Beri Ulasan Pesanan' }}</h2>
        <p style="color:#777; margin-bottom:20px;">Kode: <strong>{{ $kode_pesanan }}</strong></p>

        @if($errors->any())
            <div style="color:red; margin-bottom:10px;">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('kirim.testimoni') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_pesanan" value="{{ $kode_pesanan }}">

            <label style="display:block; text-align:left; font-weight:600;">Nama Anda</label>
            <input type="text" name="nama" required 
                   value="{{ isset($existingTestimoni) ? $existingTestimoni->nama_pelanggan : $pesanan->nama_pelanggan }}">

            <label style="display:block; text-align:left; font-weight:600;">Kota</label>
            <input type="text" name="kota" required placeholder="Contoh: Makassar"
                   value="{{ isset($existingTestimoni) ? $existingTestimoni->kota : '' }}">

            <label style="display:block; text-align:left; font-weight:600;">Rating</label>
            @php $val = isset($existingTestimoni) ? $existingTestimoni->rating : 5; @endphp
            <select name="rating">
                <option value="5" {{ $val == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (Sempurna)</option>
                <option value="4" {{ $val == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (Bagus)</option>
                <option value="3" {{ $val == 3 ? 'selected' : '' }}>⭐⭐⭐ (Cukup)</option>
                <option value="2" {{ $val == 2 ? 'selected' : '' }}>⭐⭐ (Kurang)</option>
                <option value="1" {{ $val == 1 ? 'selected' : '' }}>⭐ (Buruk)</option>
            </select>

            <label style="display:block; text-align:left; font-weight:600;">Ulasan</label>
            <textarea name="isi" rows="4" required placeholder="Ceritakan pengalaman Anda...">{{ isset($existingTestimoni) ? $existingTestimoni->isi_testimoni : '' }}</textarea>

            <button type="submit" class="btn-submit">
                {{ isset($existingTestimoni) ? 'Simpan Perubahan' : 'Kirim Ulasan' }}
            </button>
        </form>
        
        <a href="{{ url('/') }}" style="display:block; margin-top:20px; color:#999; text-decoration:none;">Kembali</a>
    </div>

</body>
</html>