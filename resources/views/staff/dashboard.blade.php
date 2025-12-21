@extends('layouts.staff') {{-- Menggunakan Master Layout --}}

@section('content')
    <div class="cards">
        <div class="card">
            <h4>Total Buku</h4>
            <p>{{ $totalBuku }}</p>
        </div>

        <div class="card">
            <h4>Buku Aktif</h4>
            {{-- Jika ingin hitung yang statusnya aktif saja: {{ $totalBukuAktif ?? $totalBuku }} --}}
            <p>{{ $totalBuku }}</p> 
        </div>

        <div class="card">
            <h4>Status Sistem</h4>
            <p>Aktif</p>
        </div>

        <div class="card">
            <h4>Hak Akses</h4>
            <p>Staff</p>
        </div>
    </div>

    <div class="table-box">
        <h4>Data Buku Terbaru</h4>

        <table>
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author->nama_author ?? 'Tidak diketahui' }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            {{-- Badge Status --}}
                            <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($book->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">Belum ada data buku</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection