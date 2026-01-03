@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Buku (Admin)</h1>

        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-edit me-1"></i> Form Edit Buku</div>
            <div class="card-body">

                {{-- Form dengan enctype & method PUT --}}
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Judul Buku</label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $book->title) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" class="form-control" name="stock"
                                value="{{ old('stock', $book->stock) }}" min="0" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Penulis</label>
                            <input type="text" class="form-control" name="nama_author"
                                value="{{ old('nama_author', $book->author->nama_author ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kategori</label>
                            <select class="form-select" name="id_category" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $book->id_category == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}"
                                placeholder="Contoh: 2024" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cover Buku</label>

                        @if ($book->cover)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover Saat Ini" width="100"
                                    class="img-thumbnail">
                                <small class="d-block text-muted">Cover saat ini</small>
                            </div>
                        @endif

                        <input type="file" name="cover" class="form-control" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti cover.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
