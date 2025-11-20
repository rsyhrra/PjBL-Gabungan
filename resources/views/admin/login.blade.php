<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Aneka Usaha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5; display: flex; align-items: center; justify-content: center;
            height: 100vh; font-family: 'Poppins', sans-serif; margin: 0;
        }
        .login-card {
            background: white; padding: 40px; border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 400px;
            text-align: center;
        }
        h2 { color: #2C3E50; margin-bottom: 10px; }
        p { color: #888; margin-bottom: 30px; font-size: 0.9rem; }
        input {
            width: 100%; padding: 15px; margin-bottom: 15px; border: 1px solid #ddd;
            border-radius: 8px; box-sizing: border-box; outline: none; transition: 0.3s;
        }
        input:focus { border-color: #2C3E50; }
        button {
            width: 100%; padding: 15px; background: #2C3E50; color: white;
            border: none; border-radius: 8px; font-weight: 600; cursor: pointer;
        }
        button:hover { background: #1a252f; }
        .error { color: red; font-size: 0.85rem; margin-bottom: 15px; display: block; text-align: left; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Admin Panel</h2>
        <p>Silakan masuk untuk mengelola sistem</p>
        
        <form action="{{ route('admin.login.proses') }}" method="POST">
            @csrf
            @if($errors->any())
                <span class="error">{{ $errors->first() }}</span>
            @endif

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>