@extends('layouts.admin')

@section('content')
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-800" style="letter-spacing: -1px;">Edit Data Member</h1>
            <p class="text-muted">Perbarui informasi akun untuk member <strong>{{ $member->name }}</strong>.</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn btn-light btn-premium shadow-sm px-4">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="premium-card p-5">
                <form action="{{ route('members.update', $member->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-user text-primary"></i></span>
                                <input type="text" name="name" value="{{ $member->name }}"
                                    class="form-control bg-light border-0 p-3" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-envelope text-primary"></i></span>
                                <input type="email" name="email" value="{{ $member->email }}"
                                    class="form-control bg-light border-0 p-3" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-dark">Password Baru <small
                                    class="text-muted fw-normal">(Kosongkan jika tidak ingin ganti)</small></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i
                                        class="fas fa-lock text-primary"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0 p-3"
                                    placeholder="Masukkan password baru">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary btn-premium w-100 py-3 shadow">
                                <i class="fas fa-sync-alt me-2"></i>Perbarui Data Member
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
