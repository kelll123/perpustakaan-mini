@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <h1 class="mt-4 mb-4">Manajemen Data Buku</h1>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">

                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-book me-2"></i>Daftar Buku</h5>

                <div class="d-flex align-items-center gap-2">

                    <form action="{{ route('admin.books.index') }}" method="GET" class="d-flex">
                        <div class="input-group">

                            <select name="category_id" class="form-select" style="max-width: 200px;"
                                onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="search" class="form-control" placeholder="Cari judul buku..."
                                value="{{ request('search') }}">

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('admin.books.create') }}" class="btn btn-success text-nowrap">
                        <i class="fas fa-plus me-1"></i> Tambah Buku
                    </a>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle table-hover">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Cover</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th width="8%">Tahun</th> 
                                <th width="8%">Stok</th>
                                <th width="10%">Status</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>

                                    {{-- MENAMPILKAN GAMBAR --}}
                                    <td class="text-center">
                                        @if ($book->cover)
                                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover"
                                                class="rounded shadow-sm"
                                                style="width: 50px; height: 75px; object-fit: cover; border: 1px solid #ddd;">
                                        @else
                                            <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mx-auto"
                                                style="width: 50px; height: 75px; font-size: 10px;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    <td class="fw-bold text-dark">{{ $book->title }}</td>
                                    <td>{{ $book->author->nama_author ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $book->category->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    {{-- DATA TAHUN TERBIT --}}
                                    <td class="text-center text-secondary fw-bold">
                                        {{ $book->tahun_terbit ?? '-' }}
                                    </td>
                                    <td class="text-center fw-bold">{{ $book->stock }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($book->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.books.edit', $book->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus buku ini? Data tidak bisa dikembalikan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted"> {{-- Colspan jadi 9 --}}
                                        <i class="fas fa-folder-open fa-3x mb-3 opacity-50"></i>
                                        <p>Tidak ada data buku yang ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
