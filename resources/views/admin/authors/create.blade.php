@extends('layouts.admin')

@section('content')
<div class="mb-5 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="fw-800" style="letter-spacing: -1px;">Tambah Penulis</h1>
    </div>
    <a href="{{ route('admin.authors.index') }}" class="btn btn-light btn-premium shadow-sm px-4">Kembali</a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="premium-card p-5">
            <form action="{{ route('admin.authors.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Lengkap Penulis</label>
                    <input type="text" name="nama_author" class="form-control bg-light border-0 p-3" placeholder="Masukkan nama penulis..." required>
                </div>
                <button type="submit" class="btn btn-primary btn-premium w-100 py-3 shadow">Simpan Data</button>
            </form>
        </div>
    </div>
</div>
@endsection