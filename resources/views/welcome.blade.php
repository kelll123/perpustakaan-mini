<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Mini - Jelajahi Dunia Ilmu</title>

    {{-- Font Google Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- PANGGIL FILE CSS KITA DISINI --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"
        style="background: rgba(13, 110, 253, 0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-book-reader me-2"></i>PerpusMini
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item">
                            <span class="text-white me-3 fw-light">Halo, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/home') }}"
                                class="btn btn-light rounded-pill px-4 fw-bold text-primary shadow-sm">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="nav-link text-white fw-bold">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}"
                                class="btn btn-warning rounded-pill px-4 fw-bold text-dark shadow-sm">Daftar Sekarang</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section d-flex align-items-center">
        <div class="hero-bg-circle" style="top: -50px; left: -50px;"></div>
        <div class="hero-bg-circle" style="bottom: 50px; right: -50px; width: 200px; height: 200px;"></div>

        <div class="container position-relative z-1 text-center mt-5">
            <h1 class="display-4 fw-bold mb-3">Temukan Buku Favoritmu</h1>
            <p class="lead mb-5 opacity-75">Akses ribuan koleksi buku digital dan fisik dengan mudah,<br>kapan saja dan
                di mana saja.</p>
                <h1>TES</h1>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('welcome') }}" method="GET">
                        <div class="search-box d-flex align-items-center">

                            <select name="category_id" class="form-select search-select w-auto d-none d-md-block"
                                onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="search" class="form-control search-input"
                                placeholder="Judul buku, penulis..." value="{{ request('search') }}">

                            <button class="btn btn-primary rounded-circle ms-2" style="width: 50px; height: 50px;"
                                type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <div class="mt-3 text-white small">
                        <span class="opacity-75 me-2">Pencarian Populer:</span>
                        @foreach ($categories->take(4) as $cat)
                            <a href="{{ route('welcome', ['category_id' => $cat->id]) }}"
                                class="text-white text-decoration-none border border-light rounded-pill px-3 py-1 me-1 hover-effect"
                                style="font-size: 0.8rem;">
                                {{ $cat->nama_kategori }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1 text-dark">
                    @if (request('search') || request('category_id'))
                        🔍 Hasil Pencarian
                    @else
                        🔥 Koleksi Terbaru
                    @endif
                </h3>
                <p class="text-muted small mb-0">Update buku-buku terbaru minggu ini</p>
            </div>

            @if (request('search') || request('category_id'))
                <a href="{{ route('welcome') }}" class="btn btn-outline-danger btn-sm rounded-pill">
                    <i class="fas fa-times me-1"></i> Reset Filter
                </a>
            @endif
        </div>

        <div class="row g-4">
            @forelse($books as $book)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card book-card shadow-sm h-100">
                        <div class="book-cover-container">
                            <span class="category-badge">
                                {{ $book->category->nama_kategori ?? 'Umum' }}
                            </span>
                            <a href="{{ route('book.detail', $book->id) }}">
                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" class="book-cover"
                                        alt="{{ $book->title }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                        <i class="fas fa-image fa-3x opacity-25"></i>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold mb-1 text-truncate">
                                <a href="{{ route('book.detail', $book->id) }}" class="text-decoration-none text-dark">
                                    {{ $book->title }}
                                </a>
                            </h6>
                            <p class="card-text text-muted small mb-3 text-truncate">
                                <i class="fas fa-pen-nib me-1"></i> {{ $book->author->nama_author ?? '-' }}
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span
                                        class="badge {{ $book->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill px-3">
                                        {{ $book->stock > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                    <small class="text-muted"><i class="fas fa-star text-warning"></i> 4.5</small>
                                </div>
                                <a href="{{ route('book.detail', $book->id) }}"
                                    class="btn btn-outline-primary w-100 rounded-pill btn-sm fw-bold">
                                    Detail Buku
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="150" alt="Empty"
                        class="mb-3 opacity-50">
                    <h5 class="text-muted">Buku tidak ditemukan :(</h5>
                    <p class="text-muted small">Coba cari dengan kata kunci lain.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $books->appends(request()->query())->links() }}
        </div>

        <div class="row mt-5 py-5 border-top">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <div class="bg-primary bg-opacity-10 d-inline-block p-4 rounded-circle mb-3">
                    <i class="fas fa-bolt fa-2x text-primary"></i>
                </div>
                <h5 class="fw-bold">Akses Cepat</h5>
                <p class="text-muted small px-4">Pinjam buku hanya dengan sekali klik tanpa antri.</p>
            </div>
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <div class="bg-success bg-opacity-10 d-inline-block p-4 rounded-circle mb-3">
                    <i class="fas fa-book-open fa-2x text-success"></i>
                </div>
                <h5 class="fw-bold">Koleksi Lengkap</h5>
                <p class="text-muted small px-4">Ribuan judul dari berbagai genre tersedia untukmu.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="bg-warning bg-opacity-10 d-inline-block p-4 rounded-circle mb-3">
                    <i class="fas fa-shield-alt fa-2x text-warning"></i>
                </div>
                <h5 class="fw-bold">Aman & Terpercaya</h5>
                <p class="text-muted small px-4">Data peminjaman tersimpan aman dalam sistem kami.</p>
            </div>
        </div>

    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>PerpusMini</h5>
                    <p class="small">Perpustakaan digital masa depan yang memudahkan akses literasi bagi semua
                        kalangan. Pinjam, baca, dan kembalikan dengan mudah.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white opacity-50 hover-opacity-100"><i
                                class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white opacity-50 hover-opacity-100"><i
                                class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white opacity-50 hover-opacity-100"><i
                                class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Beranda</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Koleksi</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Tentang
                                Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Kategori Populer</h5>
                    <ul class="list-unstyled small">
                        @foreach ($categories->take(4) as $cat)
                            <li class="mb-2"><a href="{{ route('welcome', ['category_id' => $cat->id]) }}"
                                    class="text-decoration-none text-secondary">{{ $cat->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Pendidikan No. 123</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@perpusmini.id</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (021) 555-0123</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top border-secondary">
                <p class="small mb-0">&copy; {{ date('Y') }} PerpusMini. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
