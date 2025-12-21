<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Mini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">📚 PerpusMini</a>
            <div class="d-flex">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-light me-2">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-light">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="bg-light py-5 mb-4 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di Perpustakaan Mini</h1>
            <p class="lead">Temukan ribuan buku menarik untuk memperluas wawasanmu.</p>

            <form action="/" method="GET" class="d-flex justify-content-center mt-4">
                <div class="input-group w-50">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul buku..."
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container mb-5">
        <h3 class="mb-4 border-start border-4 border-primary ps-3">Koleksi Terbaru</h3>

        <div class="row">
            @forelse($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">

                        <a href="{{ route('book.detail', $book->id) }}">
                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://via.placeholder.com/150x220?text=No+Cover' }}"
                                class="card-img-top" alt="{{ $book->title }}"
                                style="height: 300px; object-fit: cover;">
                        </a>

                        <div class="card-body">
                            <span
                                class="badge bg-info text-dark mb-2">{{ $book->category->nama_kategori ?? 'Umum' }}</span>

                            <a href="{{ route('book.detail', $book->id) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                            </a>

                            <p class="card-text text-muted small">Penulis: {{ $book->author->nama_author ?? '-' }}</p>

                            <div class="d-grid">
                                @auth
                                    <form action="{{ route('borrow.store', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            onclick="return confirm('Yakin ingin meminjam buku ini?')">
                                            Pinjam Buku
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ url('/login') }}" class="btn btn-outline-primary btn-sm">Login untuk
                                        Pinjam</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada buku yang tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div>
    </div>

</body>

</html>
