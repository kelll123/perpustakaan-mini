@extends('layouts.admin')

@section('content')
    <div class="mb-4">
        <h2>Dashboard Overview</h2>
    </div>

    <div class="cards mb-5">
        <div class="card">
            <h4>Total Buku</h4>
            <p>{{ $totalBuku }}</p>
        </div>
        <div class="card">
            <h4>Total Penulis</h4>
            <p>{{ $totalAuthor }}</p>
        </div>
        <div class="card">
            <h4>Total Kategori</h4>
            <p>{{ $totalCategory }}</p>
        </div>
        <div class="card">
            <h4>Total Staff</h4>
            <p>{{ $totalUser }}</p>
        </div>
    </div>

    <div class="table-section" style="margin-top: 50px;">

        <h2 class="mb-3" style="font-weight: bold; border-bottom: 3px solid #333; padding-bottom: 10px;">
            📚 DATA BUKU PERPUSTAKAAN
        </h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
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
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->nama_author ?? 'Tidak diketahui' }}</td>
                                <td>{{ $book->category->nama_kategori ?? '-' }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>
                                    <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($book->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data buku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-primary btn-sm">
                        Lihat Selengkapnya <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
