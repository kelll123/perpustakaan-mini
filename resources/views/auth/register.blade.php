<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - PerpusMini</title>
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
                <i class="fas fa-user-plus fa-3x mb-3"></i>
                <h2 class="fw-bold">Bergabunglah</h2>
                <p class="opacity-75 mt-3">Buat akun sekarang dan mulai petualangan membaca Anda bersama PerpusMini.</p>
            </div>
        </div>

        <div class="auth-form-side">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Buat Akun Baru 🚀</h3>
                <p class="text-muted small">Lengkapi data diri Anda untuk mendaftar.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                    <label for="name">Nama Lengkap</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
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

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                        placeholder="Confirm Password" required>
                    <label for="password-confirm">Konfirmasi Kata Sandi</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Daftar Sekarang
                </button>

                <div class="text-center small text-muted">
                    Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Login disini</a>
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
