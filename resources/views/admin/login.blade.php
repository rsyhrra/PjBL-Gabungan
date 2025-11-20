<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- VARIABEL WARNA --- */
        :root {
            --primary: #2C3E50;    /* Navy Blue */
            --accent: #D4A373;     /* Gold/Brown */
            --white: #ffffff;
            --bg-light: #FDFBF7;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary);
            /* Opsional: Tambahkan Background Image Pattern */
            background-image: linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)), url('https://i.pinimg.com/736x/36/80/cc/3680cc51ac4a5fd052e810722d853609.jpg');
            background-size: cover;
            background-position: center;
            padding: 20px;
        }

        .login-container {
            background: var(--white);
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }

        /* Hiasan Atas */
        .login-container::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 6px;
            background: linear-gradient(to right, var(--primary), var(--accent));
        }

        .logo-icon {
            width: 70px; height: 70px;
            background: var(--bg-light);
            color: var(--primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 { color: var(--primary); font-weight: 700; margin-bottom: 5px; letter-spacing: 1px; }
        p { color: #888; font-size: 0.9rem; margin-bottom: 30px; }

        /* Form Input */
        .input-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
            transition: 0.3s;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px; /* Space for icon */
            border: 2px solid #eee;
            border-radius: 12px;
            font-size: 0.95rem;
            outline: none;
            transition: 0.3s;
            background: #f9f9f9;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: #fff;
        }
        .form-control:focus + i { color: var(--accent); }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
        }

        .btn-login:hover {
            background: var(--accent);
            transform: translateY(-2px);
        }

        /* Error Message */
        .alert-danger {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            border: 1px solid #ef9a9a;
            text-align: left;
            display: flex;
            align-items: center; gap: 10px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container { padding: 40px 25px; }
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h2>ADMIN PANEL</h2>
        <p>Silakan masuk untuk mengelola sistem</p>

        @if($errors->any())
        <div class="alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ route('admin.login.proses') }}" method="POST">
            @csrf
            
            <div class="input-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                <i class="fas fa-user"></i>
            </div>

            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>

            <button type="submit" class="btn-login">
                LOGIN <i class="fas fa-sign-in-alt" style="margin-left:5px;"></i>
            </button>
        </form>

        <p style="margin-top: 30px; font-size: 0.8rem; color: #aaa; margin-bottom: 0;">
            &copy; {{ date('Y') }} Aneka Usaha Team
        </p>
    </div>

</body>
</html>