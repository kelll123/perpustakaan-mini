<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Detail Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .cover-img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .badge-category {
            font-size: 0.9rem;
            padding: 0.5em 1em;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">📚 Perpustakaan Mini</a>
            <div class="ms-auto">
                @auth
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ url('/home') }}" class="btn btn-light btn-sm fw-bold text-primary">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm fw-bold">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm fw-bold text-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm fw-bold">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        <a href="{{ url('/') }}" class="text-decoration-none text-secondary mb-3 d-inline-block">
            <i class="fa fa-arrow-left"></i> Kembali ke Daftar Buku
        </a>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body p-0">
                <div class="row g-0">

                    <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-4">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                class="cover-img">
                        @else
                            <div class="text-center text-muted">
                                <i class="fa fa-book fa-5x mb-3"></i>
                                <p>Tidak ada cover</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8 p-5">
                        <div class="mb-2">
                            <span
                                class="badge bg-secondary badge-category">{{ $book->category->nama_kategori ?? 'Umum' }}</span>
                            <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>

                        <h1 class="fw-bold mb-3 text-dark">{{ $book->title }}</h1>

                        <h5 class="text-muted mb-4">
                            <i class="fa fa-user-edit me-2"></i>Penulis:
                            <span
                                class="text-dark fw-bold">{{ $book->author->nama_author ?? 'Tidak diketahui' }}</span>
                        </h5>

                        <hr>

                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase text-primary">Sinopsis / Deskripsi</h6>
                            <p class="text-secondary" style="line-height: 1.8;">
                                {{ $book->deskripsi ?? 'Belum ada deskripsi untuk buku ini.' }}
                            </p>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <small class="text-muted d-block">Stok Tersedia</small>
                                <span class="fs-4 fw-bold text-dark">{{ $book->stock }} <small
                                        class="fs-6 text-muted">Buku</small></span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Tahun Terbit</small>
                                <span class="fs-4 fw-bold text-dark">{{ $book->tahun_terbit ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            @if ($book->stock > 0)
                                @auth
                                    <form action="{{ route('borrow.store', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg w-100"
                                            onclick="return confirm('Apakah Anda yakin ingin meminjam buku {{ $book->title }}?')">
                                            <i class="fa fa-book-reader me-2"></i> Pinjam Buku Ini
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                                        <i class="fa fa-sign-in-alt me-2"></i> Login untuk Pinjam
                                    </a>
                                @endauth
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>
                                    <i class="fa fa-ban me-2"></i> Stok Habis
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center py-4 text-muted small">
        &copy; {{ date('Y') }} Perpustakaan Mini
    </div>

    {{-- Script Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
