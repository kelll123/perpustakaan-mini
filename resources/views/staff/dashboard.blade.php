@extends('layouts.staff')

@section('content')
<div class="mb-5">
    <h1 class="fw-800 mb-1" style="letter-spacing: -1.5px;">Dashboard Staff</h1>
    <p class="text-muted">Selamat bekerja, <strong>{{ auth()->user()->name }}</strong>.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card shadow-sm" style="background: linear-gradient(135deg, #059669, #10b981);">
            <div class="d-flex justify-content-between mb-3">
                <div class="opacity-75 small fw-bold text-uppercase">Koleksi Buku</div>
                <i class="fas fa-book opacity-50"></i>
            </div>
            <div class="h1 fw-bold mb-1">{{ $totalBuku }}</div>
            <div class="small opacity-75">Buku Terdata</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card shadow-sm" style="background: linear-gradient(135deg, #0284c7, #3b82f6);">
            <div class="d-flex justify-content-between mb-3">
                <div class="opacity-75 small fw-bold text-uppercase">Dipinjam</div>
                <i class="fas fa-exchange-alt opacity-50"></i>
            </div>
            <div class="h1 fw-bold mb-1">{{ $ongoingBorrows->count() }}</div>
            <div class="small opacity-75">Perlu Dipantau</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card shadow-sm" style="background: linear-gradient(135deg, #4f46e5, #6366f1);">
            <div class="d-flex justify-content-between mb-3">
                <div class="opacity-75 small fw-bold text-uppercase">Member</div>
                <i class="fas fa-id-card opacity-50"></i>
            </div>
            <div class="h1 fw-bold mb-1">{{ $totalMembers }}</div>
            <div class="small opacity-75">Member Aktif</div>
        </div>
    </div>
</div>

<div class="premium-card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0">Koleksi Buku Terbaru</h4>
        <a href="{{ route('staff.books.index') }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold">Lihat Semua</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr class="text-muted small fw-bold">
                    <th class="ps-3">JUDUL</th>
                    <th>PENULIS</th>
                    <th>STOK</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td class="ps-3">
                        <div class="fw-bold text-dark">{{ $book->title }}</div>
                        <div class="text-muted small">{{ $book->category->name ?? 'Umum' }}</div>
                    </td>
                    <td>{{ $book->author->nama_author ?? '-' }}</td>
                    <td><span class="fw-bold">{{ $book->stock }}</span> eks</td>
                    <td>
                        @if($book->stock > 0)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Tersedia</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Kosong</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection