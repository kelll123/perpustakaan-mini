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
                <div
                    class="stat-card border-0 shadow-sm rounded-4 p-3 bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase">Sedang Dipinjam</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $activeBorrows->count() }} <small
                                class="fs-6 fw-normal text-muted">Buku</small></h3>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                        <i class="fas fa-book-open fa-lg"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div
                    class="stat-card border-0 shadow-sm rounded-4 p-3 bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase">Total Riwayat</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $historyBorrows->count() }} <small
                                class="fs-6 fw-normal text-muted">Buku</small></h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i class="fas fa-history fa-lg"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div
                    class="stat-card border-0 shadow-sm rounded-4 p-3 bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase">Status Akun</h6>
                        <h5 class="fw-bold mb-0 text-primary">Member Aktif</h5>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                        <i class="fas fa-user-check fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="member-card text-center p-4 bg-white shadow-sm rounded-4">
                    <div class="member-avatar bg-primary text-white d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                        style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4 class="fw-bold mb-1 text-dark">{{ Auth::user()->name }}</h4>
                    <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between px-2 text-start small">
                        <span class="text-muted">Bergabung:</span>
                        <span class="fw-bold text-dark">{{ Auth::user()->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('welcome') }}"
                            class="btn btn-primary w-100 fw-bold rounded-pill shadow-sm py-2">
                            <i class="fas fa-plus me-1"></i> Pinjam Buku Lagi
                        </a>
                    </div>
                </div>

                <div class="alert alert-info mt-3 border-0 shadow-sm rounded-4">
                    <div class="d-flex">
                        <i class="fas fa-info-circle me-2 mt-1"></i>
                        <small>Pastikan mengembalikan buku tepat waktu untuk menghindari denda.</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="custom-card border-0 shadow-sm rounded-4 bg-white overflow-hidden mb-4">
                    <div class="custom-card-header p-3 border-bottom bg-light fw-bold text-dark">
                        <i class="fas fa-clock text-warning me-2"></i> Sedang Dipinjam
                    </div>
                    <div class="card-body p-0">
                        @if ($activeBorrows->count() > 0)
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr class="small text-muted">
                                            <th class="ps-3">Buku</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tenggat</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeBorrows as $borrow)
                                            <tr>
                                                <td class="ps-3">
                                                    <div class="d-flex align-items-center py-2">
                                                        <img src="{{ $borrow->book->cover ? asset('storage/' . $borrow->book->cover) : 'https://via.placeholder.com/50' }}"
                                                            alt="Cover" class="rounded-2 me-3"
                                                            style="width: 45px; height: 60px; object-fit: cover;">
                                                        <div>
                                                            <div class="fw-bold text-dark small">
                                                                {{ Str::limit($borrow->book->title, 30) }}</div>
                                                            <small class="text-muted"
                                                                style="font-size: 0.75rem;">{{ $borrow->book->author->nama_author ?? '-' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="small">
                                                    {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                                                </td>
                                                <td>
                                                    <span class="text-danger fw-bold small">
                                                        {{ \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted" style="font-size: 0.75rem;">
                                                        @php
                                                            $tenggat = \Carbon\Carbon::parse($borrow->return_date);
                                                            $sisaHari = now()
                                                                ->startOfDay()
                                                                ->diffInDays($tenggat, false);
                                                        @endphp

                                                        @if ($sisaHari > 0)
                                                            {{ $sisaHari }} hari lagi
                                                        @elseif($sisaHari == 0)
                                                            <span class="text-warning">Hari terakhir!</span>
                                                        @else
                                                            <span class="text-danger">Terlambat {{ abs($sisaHari) }}
                                                                hari</span>
                                                        @endif
                                                    </small>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Dipinjam</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60"
                                    class="opacity-25 mb-3">
                                <p class="text-muted small">Tidak ada buku yang sedang dipinjam.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="custom-card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                    <div class="custom-card-header p-3 border-bottom bg-light fw-bold text-dark">
                        <i class="fas fa-history text-success me-2"></i> Riwayat Pengembalian Terakhir
                    </div>
                    <div class="card-body p-0">
                        @if ($historyBorrows->count() > 0)
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr class="small text-muted">
                                            <th class="ps-3">Buku</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Dikembalikan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($historyBorrows->take(5) as $history)
                                            <tr>
                                                <td class="ps-3">
                                                    <div class="d-flex align-items-center py-2">
                                                        <img src="{{ $history->book->cover ? asset('storage/' . $history->book->cover) : 'https://via.placeholder.com/50' }}"
                                                            alt="Cover" class="rounded-2 me-3 opacity-75"
                                                            style="width: 45px; height: 60px; object-fit: cover;">
                                                        <span
                                                            class="fw-bold text-secondary small">{{ Str::limit($history->book->title, 30) }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-muted small">
                                                    {{ \Carbon\Carbon::parse($history->borrow_date)->format('d M Y') }}
                                                </td>
                                                <td class="fw-bold text-dark small">
                                                    {{ $history->updated_at->format('d M Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Selesai</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-4 text-center text-muted small">Belum ada riwayat peminjaman.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
