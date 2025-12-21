<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - PerpusMini</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{-- Bootstrap & FontAwesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS CUSTOM MEMBER --}}
    <link rel="stylesheet" href="{{ asset('css/member.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                <i class="fas fa-book-reader me-2"></i>PerpusMini
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center gap-3">
                    <a href="{{ route('welcome') }}"
                        class="btn btn-light btn-sm fw-bold text-primary rounded-pill px-3 shadow-sm">
                        <i class="fas fa-search me-1"></i> Cari Buku Baru
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="stat-card">
                    <div>
                        <h6 class="text-muted mb-1">Sedang Dipinjam</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $activeBorrows->count() }} <small
                                class="fs-6 fw-normal text-muted">Buku</small></h3>
                    </div>
                    <div class="stat-icon bg-icon-warning">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div>
                        <h6 class="text-muted mb-1">Total Riwayat</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $historyBorrows->count() }} <small
                                class="fs-6 fw-normal text-muted">Buku</small></h3>
                    </div>
                    <div class="stat-icon bg-icon-green">
                        <i class="fas fa-history"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div>
                        <h6 class="text-muted mb-1">Status Akun</h6>
                        <h5 class="fw-bold mb-0 text-primary">Member Aktif</h5>
                    </div>
                    <div class="stat-icon bg-icon-blue">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="member-card">
                    <div class="member-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                    <p class="opacity-75 mb-3">{{ Auth::user()->email }}</p>

                    <hr>

                    <div class="d-flex justify-content-between px-3 text-start small opacity-75">
                        <span>Bergabung:</span>
                        <span class="fw-bold">{{ Auth::user()->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('welcome') }}"
                            class="btn btn-light w-100 fw-bold text-primary rounded-pill shadow-sm">
                            <i class="fas fa-plus me-1"></i> Pinjam Buku Lagi
                        </a>
                    </div>
                </div>

                {{-- Info Tambahan --}}
                <div class="alert alert-info mt-3 border-0 shadow-sm rounded-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <small>Pastikan mengembalikan buku tepat waktu untuk menghindari denda.</small>
                </div>
            </div>

            <div class="col-lg-8">

                <div class="custom-card">
                    <div class="custom-card-header">
                        <i class="fas fa-clock text-warning me-2"></i> Sedang Dipinjam
                    </div>
                    <div class="card-body p-0">
                        @if ($activeBorrows->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>Buku</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tenggat</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeBorrows as $borrow)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $borrow->book->cover ? asset('storage/' . $borrow->book->cover) : 'https://via.placeholder.com/50' }}"
                                                            alt="Cover" class="book-cover-thumb me-3">
                                                        <div>
                                                            <div class="fw-bold text-dark">
                                                                {{ Str::limit($borrow->book->title, 30) }}</div>
                                                            <small
                                                                class="text-muted">{{ $borrow->book->author->nama_author ?? '-' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                                                </td>
                                                <td>
                                                    <span class="text-danger fw-bold">
                                                        {{ \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($borrow->return_date), false) }}
                                                        hari lagi
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="status-badge status-active">Dipinjam</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80"
                                    class="opacity-25 mb-3">
                                <p class="text-muted">Tidak ada buku yang sedang dipinjam.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="custom-card">
                    <div class="custom-card-header">
                        <i class="fas fa-history text-success me-2"></i> Riwayat Pengembalian Terakhir
                    </div>
                    <div class="card-body p-0">
                        @if ($historyBorrows->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>Buku</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Dikembalikan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($historyBorrows->take(5) as $history)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $history->book->cover ? asset('storage/' . $history->book->cover) : 'https://via.placeholder.com/50' }}"
                                                            alt="Cover" class="book-cover-thumb me-3 opacity-75">
                                                        <span
                                                            class="fw-bold text-secondary">{{ Str::limit($history->book->title, 30) }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    {{ \Carbon\Carbon::parse($history->borrow_date)->format('d M Y') }}
                                                </td>
                                                <td class="fw-bold text-dark">
                                                    {{ $history->updated_at->format('d M Y') }}</td>
                                                <td>
                                                    <span class="status-badge status-returned">Selesai</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-4 text-center text-muted">Belum ada riwayat peminjaman.</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
