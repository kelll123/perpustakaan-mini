@extends('layouts.staff')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4 fw-bold text-dark">
            <i class="fas fa-chart-line me-2 text-primary"></i>Staff Dashboard
        </h2>

        <div class="row g-4 mb-5">

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white shadow h-100 border-0">
                    <div class="card-body">
                        <div class="small text-white-50 fw-bold">TOTAL BUKU</div>
                        <div class="display-6 fw-bold">{{ $totalBuku }}</div>
                    </div>
                    <div class="card-footer bg-primary border-0">
                        <a href="{{ route('staff.books.index') }}" class="text-white text-decoration-none small">Lihat
                            Detail <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white shadow h-100 border-0">
                    <div class="card-body">
                        <div class="small text-white-50 fw-bold">TOTAL PENULIS</div>
                        <div class="display-6 fw-bold">{{ $totalAuthor }}</div>
                    </div>
                    <div class="card-footer bg-success border-0">
                        <span class="small text-white-50">Data Penulis</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-dark shadow h-100 border-0">
                    <div class="card-body">
                        <div class="small text-dark-50 fw-bold">TOTAL KATEGORI</div>
                        <div class="display-6 fw-bold">{{ $totalCategory }}</div>
                    </div>
                    <div class="card-footer bg-warning border-0">
                        <span class="small text-dark-50">Data Kategori</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white shadow h-100 border-0">
                    <div class="card-body">
                        <div class="small text-white-50 fw-bold">TOTAL MEMBER</div>
                        <div class="display-6 fw-bold">{{ $totalMembers }}</div>
                    </div>
                    <div class="card-footer bg-info border-0">
                        <a href="{{ route('members.index') }}" class="text-white text-decoration-none small">Kelola Member
                            <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-dark">📚 Buku Terbaru</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->nama_author ?? '-' }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>
                                    <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $book->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
