@extends('layouts.staff')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-5 mt-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-800 mb-1" style="letter-spacing: -1.5px;">Manajemen Penulis</h1>
                <p class="text-muted">Kelola daftar penulis yang berkontribusi dalam koleksi buku.</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modalTambahAuthor">
                <i class="fas fa-plus me-2"></i> Tambah Penulis
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-3">{{ session('error') }}</div>
        @endif

        <div class="premium-card p-4 shadow-sm border-0" style="border-radius: 24px; background: white;">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr class="text-muted small fw-bold">
                            <th class="ps-3">NAMA PENULIS</th>
                            <th class="text-center">KARYA BUKU</th>
                            <th class="text-end pe-3">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td class="ps-3 fw-bold text-dark">{{ $author->nama_author }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                                        {{ $author->books_count }} Judul
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <button class="btn btn-sm btn-warning rounded-circle me-1 text-white"
                                        data-bs-toggle="modal" data-bs-target="#modalEditAuthor{{ $author->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('staff.authors.destroy', $author->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus penulis ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditAuthor{{ $author->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('staff.authors.update', $author->id) }}" method="POST"
                                        class="modal-content border-0 shadow" style="border-radius: 20px;">
                                        @csrf @method('PUT')
                                        <div class="modal-header border-0">
                                            <h5 class="fw-bold">Edit Data Penulis</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <label class="small fw-bold text-muted mb-2">Nama Lengkap Penulis</label>
                                            <input type="text" name="nama_author" class="form-control rounded-3"
                                                value="{{ $author->nama_author }}" required>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahAuthor" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('staff.authors.store') }}" method="POST" class="modal-content border-0 shadow"
                style="border-radius: 20px;">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Tambah Penulis Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="small fw-bold text-muted mb-2">Nama Lengkap Penulis</label>
                    <input type="text" name="nama_author" class="form-control rounded-3"
                        placeholder="Masukkan nama penulis..." required>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
