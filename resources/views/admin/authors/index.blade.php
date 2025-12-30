@extends('layouts.admin')

@section('content')
<div class="mb-5 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="fw-800" style="letter-spacing: -1px;">Daftar Penulis</h1>
        <p class="text-muted">Kelola data penulis buku yang tersedia di perpustakaan.</p>
    </div>
    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary btn-premium shadow-sm px-4">
        <i class="fas fa-plus-circle me-2"></i>Tambah Penulis
    </a>
</div>

<div class="premium-card p-0 overflow-hidden shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-muted fw-bold" style="font-size: 0.8rem;">NAMA PENULIS</th>
                    <th class="py-3 text-muted fw-bold" style="font-size: 0.8rem;">TANGGAL DITAMBAHKAN</th>
                    <th class="pe-4 py-3 text-muted fw-bold text-end" style="font-size: 0.8rem;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                <tr>
                    <td class="ps-4 py-3">
                        <div class="fw-bold text-dark">{{ $author->nama_author }}</div>
                        <div class="text-muted small" style="font-size: 0.7rem;">ID: #ATH-{{ $author->id }}</div>
                    </td>
                    <td class="text-muted small">
                        <i class="far fa-calendar-alt me-1"></i> {{ $author->created_at->format('d M Y') }}
                    </td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-sm btn-light rounded-pill text-primary shadow-sm border">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penulis ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light rounded-pill text-danger shadow-sm border">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted">Data penulis tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection