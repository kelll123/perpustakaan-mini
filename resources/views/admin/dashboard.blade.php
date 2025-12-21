@extends('layouts.admin')
{{-- 👆 PERINGATAN: Baris @extends ini WAJIB ada di paling atas file! Jangan taruh apapun di atasnya. --}}

@section('content')
    {{-- Taruh CSS khusus dashboard di sini, DI DALAM section content --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container-fluid px-4">

        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h2 class="page-title text-dark fw-bold">Dashboard Overview</h2>
                <p class="page-subtitle text-muted">Ringkasan statistik dan aktivitas perpustakaan hari ini.</p>
            </div>
            <div>
                <span class="badge bg-white text-dark shadow-sm px-3 py-2 border rounded-pill">
                    <i class="far fa-calendar-alt me-2"></i> {{ date('d F Y') }}
                </span>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card border-left-primary h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-icon-wrapper bg-light-primary mb-3">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="stat-number h2 fw-bold mb-1">{{ $totalBooks ?? 0 }}</div>
                            <div class="stat-label text-uppercase text-muted small">Total Buku</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.books.index') }}"
                        class="stat-link text-primary mt-3 d-inline-block text-decoration-none fw-bold small">
                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card border-left-success h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-icon-wrapper bg-light-success mb-3">
                                <i class="fas fa-pen-nib"></i>
                            </div>
                            <div class="stat-number h2 fw-bold mb-1">{{ $totalAuthors ?? 0 }}</div>
                            <div class="stat-label text-uppercase text-muted small">Total Penulis</div>
                        </div>
                    </div>
                    <a href="#" class="stat-link text-success mt-3 d-inline-block text-decoration-none fw-bold small">
                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card border-left-warning h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-icon-wrapper bg-light-warning mb-3">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="stat-number h2 fw-bold mb-1">{{ $totalCategories ?? 0 }}</div>
                            <div class="stat-label text-uppercase text-muted small">Total Kategori</div>
                        </div>
                    </div>
                    <a href="#" class="stat-link text-warning mt-3 d-inline-block text-decoration-none fw-bold small">
                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card border-left-info h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-icon-wrapper bg-light-info mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number h2 fw-bold mb-1">{{ $totalMembers ?? 4 }}</div>
                            <div class="stat-label text-uppercase text-muted small">Member Aktif</div>
                        </div>
                    </div>
                    <a href="#" class="stat-link text-info mt-3 d-inline-block text-decoration-none fw-bold small">
                        Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-table shadow-sm border-0 mb-5">
            <div class="card-header-custom d-flex justify-content-between align-items-center bg-white p-3 border-bottom">
                <h5 class="m-0 fw-bold text-dark">
                    <i class="fas fa-clipboard-check me-2 text-primary"></i> Verifikasi Pengembalian Buku
                </h5>
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua</button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-secondary small text-uppercase fw-bold">Peminjam</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase fw-bold">Buku yang Dikembalikan
                                </th>
                                <th class="px-4 py-3 text-secondary small text-uppercase fw-bold">Tgl Pinjam</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase fw-bold">Tenggat</th>
                                <th class="px-4 py-3 text-secondary small text-uppercase fw-bold text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-small bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-secondary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">Reyvano Varezy</div>
                                            <small class="text-muted" style="font-size: 0.8em;">Member</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <span class="fw-bold text-dark">Tokyo Revengers vol.20</span>
                                </td>
                                <td class="px-4 text-muted">21 Dec 2025</td>
                                <td class="px-4 text-danger fw-bold">28 Dec 2025</td>
                                <td class="px-4 text-end">
                                    <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold">
                                        <i class="fas fa-check me-1"></i> Terima
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-small bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-secondary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">Reyvano Varezy</div>
                                            <small class="text-muted" style="font-size: 0.8em;">Member</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <span class="fw-bold text-dark">Malin Kundang</span>
                                </td>
                                <td class="px-4 text-muted">21 Dec 2025</td>
                                <td class="px-4 text-danger fw-bold">28 Dec 2025</td>
                                <td class="px-4 text-end">
                                    <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold">
                                        <i class="fas fa-check me-1"></i> Terima
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
