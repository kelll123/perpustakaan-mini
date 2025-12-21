@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Edit Data Staff</h3>

        <div class="card mt-3" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $staff->name) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $staff->email) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Kosongkan jika tidak diganti">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
