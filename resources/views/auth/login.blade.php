<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PerpusMini</title>
    {{-- Fonts & Bootstrap --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS Auth --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-card">
        <div class="auth-image-side">
            <div class="auth-image-content">
                <i class="fas fa-book-reader fa-3x mb-3"></i>
                <h2 class="fw-bold">PerpusMini</h2>
                <p class="opacity-75 mt-3">Masuk untuk mengakses ribuan koleksi buku digital dan fisik secara gratis.
                </p>
            </div>
        </div>

        <div class="auth-form-side">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Selamat Datang! 👋</h3>
                <p class="text-muted small">Silakan masukkan akun Anda untuk melanjutkan.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    <label for="email">Alamat Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Password" required>
                    <label for="password">Kata Sandi</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 small">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="remember">Ingat Saya</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-secondary">Lupa
                            Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Masuk Sekarang <i class="fas fa-arrow-right ms-2"></i>
                </button>

                <div class="text-center small text-muted">
                    Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar disini</a>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="text-decoration-none text-secondary small">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
