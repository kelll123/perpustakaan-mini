<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar | Perpustakaan Mini</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="login-wrapper">

        <div class="login-image">
            <div class="login-image-content">
                <h3>Perpustakaan Mini</h3>
                <p>Bergabunglah menjadi member kami</p>
            </div>
        </div>

        <div class="login-form">
            <h2>Daftar Akun</h2>

            @if ($errors->any())
                <div class="error" style="color: red; font-size: 0.9em; margin-bottom: 15px;">
                    <ul style="list-style: none; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password (min. 8 karakter)" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input type="password" name="password_confirmation" placeholder="Ulangi Password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">Daftar Sekarang</button>
            </form>

            <div class="text-center mt-3" style="text-align: center; margin-top: 15px;">
                <small>Sudah punya akun? <a href="{{ route('login') }}" style="text-decoration: none;">Login
                        disini</a></small>
            </div>

            <div class="text-center mt-2" style="text-align: center;">
                <a href="{{ url('/') }}" style="text-decoration: none; color: #6c757d; font-size: 0.9em;">
                    <i class="fa fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>

</body>

</html>
