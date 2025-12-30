@extends('layouts.admin')

@section('content')
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-800" style="letter-spacing: -1px;">Manajemen Member</h1>
            <p class="text-muted">Kelola data pengguna dan pantau status keanggotaan mereka.</p>
        </div>
        <a href="{{ route('members.create') }}" class="btn btn-primary btn-premium shadow-sm px-4">
            <i class="fas fa-plus-circle me-2"></i>Tambah Member Baru
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="premium-card p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3 text-primary">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <div class="small fw-bold text-muted text-uppercase">Total Member</div>
                    <div class="h3 fw-bold m-0">{{ $members->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-card overflow-hidden p-0">
        <div class="p-4 border-bottom bg-light bg-opacity-50">
            <h5 class="fw-bold m-0">Daftar Member Aktif</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-bold" style="font-size: 0.8rem;">MEMBER</th>
                        <th class="py-3 text-muted fw-bold" style="font-size: 0.8rem;">EMAIL</th>
                        <th class="py-3 text-muted fw-bold" style="font-size: 0.8rem;">TANGGAL BERGABUNG</th>
                        <th class="py-3 text-muted fw-bold" style="font-size: 0.8rem;">STATUS</th>
                        <th class="pe-4 py-3 text-muted fw-bold text-end" style="font-size: 0.8rem;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                        style="width: 45px; height: 45px;">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $member->name }}</div>
                                        <div class="text-muted small">ID: #MBR-{{ $member->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted font-monospace small">{{ $member->email }}</td>
                            <td class="text-muted small">
                                <i class="far fa-calendar-alt me-1"></i> {{ $member->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                </span>
                            </td>

                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('members.edit', $member->id) }}"
                                        class="btn btn-sm btn-light rounded-pill text-primary shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus member ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-light rounded-pill text-danger shadow-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
        </div>
        </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-5">
                <div class="text-muted">
                    <i class="fas fa-user-slash fa-3x mb-3 opacity-25"></i>
                    <p>Belum ada member yang terdaftar.</p>
                </div>
            </td>
        </tr>
        @endforelse
        </tbody>
        </table>
    </div>
    </div>
@endsection
