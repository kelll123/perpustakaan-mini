@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <h2 class="mt-4 mb-4 fw-bold text-dark">
            <i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard Overview
        </h2>

        <div class="row g-4 mb-4">

            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4 shadow h-100 border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="small text-white-50 text-uppercase fw-bold">Total Buku</div>
                            <div class="display-6 fw-bold">{{ $totalBuku }}</div>
                        </div>
                        <i class="fas fa-book fa-3x opacity-25"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between border-0"
                        style="background-color: rgba(0,0,0, 0.1);">
                        <a class="small text-white stretched-link text-decoration-none"
                            href="{{ route('admin.books.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4 shadow h-100 border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="small text-white-50 text-uppercase fw-bold">Total Penulis</div>
                            <div class="display-6 fw-bold">{{ $totalAuthor }}</div>
                        </div>
                        <i class="fas fa-pen-nib fa-3x opacity-25"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between border-0"
                        style="background-color: rgba(0,0,0, 0.1);">
                        <a class="small text-white stretched-link text-decoration-none"
                            href="{{ route('admin.authors.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4 shadow h-100 border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="small text-white-50 text-uppercase fw-bold">Total Kategori</div>
                            <div class="display-6 fw-bold">{{ $totalCategory }}</div>
                        </div>
                        <i class="fas fa-tags fa-3x opacity-25"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between border-0"
                        style="background-color: rgba(0,0,0, 0.1);">
                        <a class="small text-white stretched-link text-decoration-none"
                            href="{{ route('admin.categories.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">

            <div class="col-xl-6 col-md-6">
                <div class="card bg-info text-white shadow h-100 border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="small text-white-50 text-uppercase fw-bold">Total Member</div>
                            <div class="display-6 fw-bold">{{ $totalMembers }}</div>
                        </div>
                        <i class="fas fa-users fa-3x opacity-25"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between border-0"
                        style="background-color: rgba(0,0,0, 0.1);">
                        <a class="small text-white stretched-link text-decoration-none"
                            href="{{ route('members.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="card bg-secondary text-white shadow h-100 border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <div class="small text-white-50 text-uppercase fw-bold">Total Staff Admin</div>
                            <div class="display-6 fw-bold">{{ $totalUser }}</div>
                        </div>
                        <i class="fas fa-user-shield fa-3x opacity-25"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between border-0"
                        style="background-color: rgba(0,0,0, 0.1);">
                        <a class="small text-white stretched-link text-decoration-none"
                            href="{{ route('admin.staff.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-0">
            <div class="card-header py-3 bg-white border-bottom-0">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="fas fa-book-open me-2"></i>Koleksi Buku Terbaru
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($book->cover)
                                            <img src="{{ asset('storage/' . $book->cover) }}" class="rounded shadow-sm"
                                                style="width: 50px; height: 75px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted small"
                                                style="width: 50px; height: 75px;">No img</div>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">{{ $book->title }}</td>
                                    <td>{{ $book->author->nama_author ?? '-' }}</td>
                                    <td><span
                                            class="badge bg-light text-dark border">{{ $book->category->nama_kategori ?? '-' }}</span>
                                    </td>
                                    <td>{{ $book->stock }}</td>
                                    <td>
                                        <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($book->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">Belum ada data buku.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary btn-sm">
                        Lihat Semua Buku <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
