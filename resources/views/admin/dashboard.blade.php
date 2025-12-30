@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h1 class="fw-800" style="letter-spacing: -1px;">Ringkasan Statistik</h1>
    <p class="text-muted">Pantau pertumbuhan dan aktivitas perpustakaan Anda secara komprehensif.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="stat-card grad-blue shadow-sm">
            <div class="icon-circle"><i class="fas fa-book"></i></div>
            <div class="small fw-bold opacity-75 text-uppercase">Total Buku</div>
            <div class="display-5 fw-bold my-1 text-white">{{ $totalBuku }}</div> <a href="{{ route('admin.books.index') }}" class="text-white text-decoration-none small mt-2 d-flex align-items-center opacity-75 hover-opacity-100">
                Lihat Detail <i class="fas fa-arrow-right ms-2" style="font-size: 0.7rem;"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card grad-teal shadow-sm">
            <div class="icon-circle"><i class="fas fa-feather-pointed"></i></div>
            <div class="small fw-bold opacity-75 text-uppercase">Penulis</div>
            <div class="display-5 fw-bold my-1 text-dark">{{ $totalAuthor }}</div> <a href="{{ route('admin.authors.index') }}" class="text-dark text-decoration-none small mt-2 d-flex align-items-center opacity-75 hover-opacity-100">
                Lihat Detail <i class="fas fa-arrow-right ms-2" style="font-size: 0.7rem;"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card grad-orange shadow-sm">
            <div class="icon-circle"><i class="fas fa-tags"></i></div>
            <div class="small fw-bold opacity-75 text-uppercase">Kategori</div>
            <div class="display-5 fw-bold my-1 text-dark">{{ $totalCategory }}</div> <a href="{{ route('admin.categories.index') }}" class="text-dark text-decoration-none small mt-2 d-flex align-items-center opacity-75 hover-opacity-100">
                Lihat Detail <i class="fas fa-arrow-right ms-2" style="font-size: 0.7rem;"></i>
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card grad-indigo shadow-sm">
            <div class="icon-circle"><i class="fas fa-user-astronaut"></i></div>
            <div class="small fw-bold opacity-75 text-uppercase">Total Member</div>
            <div class="display-5 fw-bold my-1 text-white">{{ $totalMembers }}</div> <a href="{{ route('members.index') }}" class="text-white text-decoration-none small mt-2 d-flex align-items-center opacity-75 hover-opacity-100">
                Lihat Detail <i class="fas fa-arrow-right ms-2" style="font-size: 0.7rem;"></i>
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="premium-card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold m-0"><i class="fas fa-exchange-alt text-primary me-2"></i>Verifikasi Pengembalian</h4>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill">{{ $ongoingBorrows->count() }} Perlu Verifikasi</span>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr class="small text-muted text-uppercase fw-bold">
                            <th>Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ongoingBorrows as $borrow)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $borrow->user->name }}</div>
                                <div class="text-muted small">ID #{{ $borrow->user->id }}</div>
                            </td>
                            <td>{{ $borrow->book->title }}</td>
                            <td class="small text-muted">{{ $borrow->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.book.return', $borrow->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                        <i class="fas fa-check-circle me-1"></i> Terima
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25">
                                <h6 class="text-muted">Tidak ada pengembalian yang perlu diverifikasi.</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="premium-card shadow-sm p-4">
            <h4 class="fw-bold mb-4">Statistik Lainnya</h4>
            <div class="d-flex align-items-center mb-4 p-3 rounded-4 bg-primary bg-opacity-10">
                <div class="text-primary me-3"><i class="fas fa-user-tie fa-lg"></i></div>
                <div>
                    <div class="fw-bold small">Total Staff</div>
                    <div class="h5 m-0 fw-bold">{{ $totalUser }}</div>
                </div>
            </div>
            <div class="d-flex align-items-center p-3 rounded-4 bg-success bg-opacity-10">
                <div class="text-success me-3"><i class="fas fa-book-open fa-lg"></i></div>
                <div>
                    <div class="fw-bold small">Buku Terbaru</div>
                    <div class="text-muted small">Update Terakhir: {{ $books->first()->created_at->diffForHumans() ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection