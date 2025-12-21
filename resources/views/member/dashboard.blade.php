<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - PerpusMini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">📚 PerpusMini</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center">

                    <a href="{{ route('welcome') }}" class="btn btn-light btn-sm fw-bold text-primary me-3 shadow-sm">
                        <i class="fas fa-search me-1"></i> Cari / Lihat Buku
                    </a>

                    <span class="text-white me-3 d-none d-md-inline">Halo, {{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="alert alert-success shadow-sm mb-4 border-0 border-start border-5 border-success">
            <h4 class="alert-heading fw-bold"><i class="fas fa-smile-beam me-2"></i>Selamat Datang!</h4>
            <p class="mb-0">Ini adalah area khusus member untuk memantau peminjaman buku.</p>
        </div>

        <div class="card shadow-sm mb-5 border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="fas fa-book-reader me-2"></i>Sedang Dipinjam
                </h5>
            </div>
            <div class="card-body">
                @if ($activeBorrows->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Wajib Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeBorrows as $borrow)
                                    <tr>
                                        <td>
                                            <img src="{{ $borrow->book->cover ? asset('storage/' . $borrow->book->cover) : 'https://via.placeholder.com/50' }}"
                                                alt="Cover" width="50" class="rounded shadow-sm">
                                        </td>
                                        <td class="fw-bold">{{ $borrow->book->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}</td>
                                        <td class="text-danger fw-bold">
                                            {{ \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark">Sedang Dipinjam</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-book-open fa-3x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted mb-3">Tidak ada buku yang sedang dipinjam.</p>
                        <a href="{{ route('welcome') }}" class="btn btn-primary shadow-sm">
                            <i class="fas fa-plus me-1"></i> Pinjam Buku Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-secondary fw-bold">
                    <i class="fas fa-history me-2"></i>Riwayat Pengembalian
                </h5>
            </div>
            <div class="card-body">
                @if ($historyBorrows->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historyBorrows as $history)
                                    <tr>
                                        <td>
                                            <img src="{{ $history->book->cover ? asset('storage/' . $history->book->cover) : 'https://via.placeholder.com/50' }}"
                                                alt="Cover" width="40" class="rounded opacity-75">
                                        </td>
                                        <td>{{ $history->book->title }}</td>
                                        <td class="text-muted small">
                                            {{ \Carbon\Carbon::parse($history->borrow_date)->format('d M Y') }}
                                        </td>
                                        <td class="text-success fw-bold">
                                            {{ $history->updated_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Dikembalikan</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-3 text-muted">
                        <p>Belum ada riwayat peminjaman.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
