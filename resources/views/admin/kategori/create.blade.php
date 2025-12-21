@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Tambah Kategori Baru</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Kategori</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
    
    <div class="card mt-3" style="max-width: 600px;">
        <div class="card-header">
            <i class="fas fa-tags me-1"></i> Form Input Kategori
        </div>
        <div class="card-body">
            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Novel, Sains, dll" required>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection