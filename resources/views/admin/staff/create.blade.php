@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Tambah Staff Baru</h3>

        <div class="card mt-3" style="max-width: 600px;">
            <div class="card-body">

                {{-- PERBAIKAN: Tambahkan Bagian Ini Untuk Menampilkan Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- Batas Akhir Perbaikan --}}

                <form action="{{ route('admin.staff.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Nama staff..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email (untuk Login)</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="staff@sekolah.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter"
                            required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
