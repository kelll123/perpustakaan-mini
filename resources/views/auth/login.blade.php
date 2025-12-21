<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Perpustakaan Mini</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="login-wrapper">

        <!-- BAGIAN GAMBAR -->
        <div class="login-image">
            <div class="login-image-content">
                <h3>Perpustakaan Mini</h3>
                <p>Sistem Informasi Peminjaman & Manajemen Buku</p>
            </div>
        </div>

        <!-- BAGIAN FORM -->
        <div class="login-form">
            <h2>Login</h2>

            @if (session('success'))
                <div
                    style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" placeholder="Masukkan email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
            <div class="text-center mt-3">
                <small>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar
                        disini</a></small>
            </div>
            <br>
            <div class="text-center mt-2">
                <a href="{{ url('/') }}" style="text-decoration: none; color: #6c757d; font-size: 0.9em;">
                    <i class="fa fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

            <div class="footer-text">
                © {{ date('Y') }} Perpustakaan Mini
            </div>
        </div>
    </div>
</body>

</html>
