@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Buku (Admin)</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.books.index') }}">Data Buku</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book-open me-1"></i> Form Input Buku
        </div>
        <div class="card-body">
            
            {{-- Menampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM MULAI --}}
            {{-- Pastikan enctype ada untuk upload gambar --}}
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Baris 1: Judul & Stok --}}
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-bold">Judul Buku</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="stock" class="form-label fw-bold">Stok</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               name="stock" value="{{ old('stock', 0) }}" min="0" required>
                    </div>
                </div>

                {{-- Baris 2: Penulis & Kategori --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_author" class="form-label fw-bold">Penulis</label>
                        <input type="text" class="form-control @error('nama_author') is-invalid @enderror" 
                               name="nama_author" value="{{ old('nama_author') }}" placeholder="Nama Penulis" required>
                    </div>
                    <div class="col-md-6">
                        <label for="id_category" class="form-label fw-bold">Kategori</label>
                        <select class="form-select @error('id_category') is-invalid @enderror" name="id_category" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori ?? $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Baris 3: Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select" name="status">
                        <option value="aktif" selected>Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                {{-- Baris 4: Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Baris 5: COVER BUKU (Fitur Baru) --}}
                <div class="mb-3">
                    <label for="cover" class="form-label fw-bold">Cover Buku</label>
                    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                    @error('cover')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                </div>

                {{-- TOMBOL AKSI (Pastikan BERADA DI DALAM <form>) --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>

            </form> 
            {{-- FORM SELESAI (Tag penutup form harus DISINI, setelah tombol) --}}

        </div>
    </div>
</div>
@endsection