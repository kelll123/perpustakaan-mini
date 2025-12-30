@extends('layouts.admin')

@section('content')
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-800" style="letter-spacing: -1px;">Tambah Member Baru</h1>
            <p class="text-muted">Masukkan informasi lengkap untuk mendaftarkan member baru ke sistem.</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn btn-light btn-premium shadow-sm px-4">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="premium-card p-5">
                <form action="{{ route('members.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-user text-primary"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-0 p-3"
                                    placeholder="Contoh: Reyvano Varezy" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-envelope text-primary"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0 p-3"
                                    placeholder="email@contoh.com" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-lock text-primary"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0 p-3"
                                    placeholder="Minimal 8 karakter" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-shield-alt text-primary"></i></span>
                                <input type="password" name="password_confirmation"
                                    class="form-control bg-light border-0 p-3" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary btn-premium w-100 py-3 shadow">
                                <i class="fas fa-save me-2"></i>Simpan Data Member
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
