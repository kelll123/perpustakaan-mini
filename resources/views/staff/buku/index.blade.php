@extends('layouts.staff')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Buku (Staff Area)</h3>
    <a href="{{ route('staff.books.create') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Buku
    </a>
</div>

{{-- Pesan Sukses --}}
@if(session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Cover</th> {{-- KOLOM GAMBAR --}}
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    {{-- MENAMPILKAN GAMBAR --}}
                    <td class="text-center">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" 
                                 style="width: 50px; height: 75px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                        @else
                            <span class="badge bg-secondary">No Image</span>
                        @endif
                    </td>

                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->nama_author ?? '-' }}</td>
                    <td>{{ $book->category->nama_kategori ?? '-' }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <span class="badge {{ $book->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($book->status) }}
                        </span>
                    </td>
                    <td>
                        {{-- Tombol Edit (Arah ke Route Staff) --}}
                        <a href="{{ route('staff.books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        
                        {{-- Tombol Hapus (Arah ke Route Staff) --}}
                        <form action="{{ route('staff.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection