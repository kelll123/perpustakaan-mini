@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Edit Kategori</h3>
    
    <div class="card mt-3" style="max-width: 600px;">
        <div class="card-body">
            {{-- Form Update --}}
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- PENTING: Untuk update data --}}
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" 
                           {{-- Mengambil data lama ($category->nama_kategori) --}}
                           value="{{ old('nama_kategori', $category->nama_kategori ?? $category->name) }}" 
                           required>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection