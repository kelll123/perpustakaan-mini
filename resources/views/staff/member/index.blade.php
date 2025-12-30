@extends('layouts.staff')

@section('content')
<div class="mb-5">
    <h1 class="fw-800" style="color: #065f46; letter-spacing: -1.5px;">Manajemen Member</h1>
    <p class="text-muted">Daftar anggota perpustakaan yang dapat dipantau oleh Staff.</p>
</div>

<div class="premium-card p-4 shadow-sm border-0 mb-4" style="border-radius: 20px; max-width: 280px; background: white;">
    <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 p-3 rounded-4 me-3 text-success">
            <i class="fas fa-users-cog fa-lg"></i>
        </div>
        <div>
            <div class="small text-muted fw-bold text-uppercase" style="font-size: 0.7rem;">Total Member</div>
            <div class="h3 fw-bold m-0 text-dark">{{ $totalMembers }}</div>
        </div>
    </div>
</div>

<div class="premium-card p-4 shadow-sm border-0" style="border-radius: 24px; background: white;">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr class="text-muted small fw-bold">
                    <th class="ps-3">NAMA LENGKAP</th>
                    <th>EMAIL</th>
                    <th>TANGGAL BERGABUNG</th>
                    <th class="text-center">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td class="ps-3">
                        <div class="fw-bold text-dark">{{ $member->name }}</div>
                        <div class="text-muted small">ID: #MBR-{{ $member->id }}</div>
                    </td>
                    <td>{{ $member->email }}</td>
                    <td class="small text-muted">{{ $member->created_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Aktif</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted small">Belum ada member terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection