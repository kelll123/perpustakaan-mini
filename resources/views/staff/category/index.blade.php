@extends('layouts.staff')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-5 mt-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-800 mb-1" style="letter-spacing: -1.5px;">Kategori Buku</h1>
                <p class="text-muted">Kelola pengelompokan buku perpustakaan.</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-2"></i> Tambah Kategori
            </button>
        </div>

        {{-- Notifikasi --}}
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
                            <th class="ps-3">NAMA KATEGORI</th>
                            <th class="text-center">JUMLAH BUKU</th>
                            <th class="text-end pe-3">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="ps-3 fw-bold text-dark">{{ $category->nama_kategori }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">
                                        {{ $category->books_count }} Judul
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    {{-- Tombol Edit --}}
                                    <button class="btn btn-sm btn-warning rounded-circle me-1 text-white shadow-sm"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit{{ $category->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('staff.categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    {{-- MODAL EDIT: Diletakkan di dalam TD agar struktur tabel tidak rusak --}}
                                    <div class="modal fade text-start" id="modalEdit{{ $category->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="{{ route('staff.categories.update', $category->id) }}"
                                                method="POST" class="modal-content border-0 shadow"
                                                style="border-radius: 20px;">
                                                @csrf @method('PUT')
                                                <div class="modal-header border-0">
                                                    <h5 class="fw-bold m-0">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="small fw-bold text-muted mb-2 d-block">Nama
                                                            Kategori</label>
                                                        <input type="text" name="nama_kategori"
                                                            class="form-control rounded-3"
                                                            value="{{ $category->nama_kategori }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light rounded-pill px-4"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit"
                                                        class="btn btn-primary rounded-pill px-4">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('staff.categories.store') }}" method="POST" class="modal-content border-0 shadow"
                style="border-radius: 20px;">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="fw-bold m-0">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2 d-block">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control rounded-3"
                            placeholder="Misal: Teknologi, Novel, Religi" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
@endsection
