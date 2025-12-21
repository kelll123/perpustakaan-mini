<div class="col-md-3 mb-4">
    <div class="card h-100 shadow-sm border-0 hover-effect">
        
        <a href="{{ route('book.detail', $book->id) }}">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 300px; object-fit: cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <i class="fa fa-book fa-3x text-secondary"></i>
                </div>
            @endif
        </a>

        <div class="card-body d-flex flex-column">
            
            <div class="mb-2">
                <span class="badge bg-info text-dark" style="font-size: 0.7em;">
                    {{ $book->category->nama_kategori ?? 'Umum' }}
                </span>
            </div>

            <h5 class="card-title text-truncate">
                <a href="{{ route('book.detail', $book->id) }}" class="text-decoration-none text-dark">
                    {{ $book->title }}
                </a>
            </h5>
            
            <p class="card-text text-muted small mb-3">
                Penulis: {{ $book->author->nama_author ?? '-' }}
            </p>

            <div class="mt-auto d-grid gap-2">
                <a href="{{ route('book.detail', $book->id) }}" class="btn btn-outline-primary btn-sm">
                    Lihat Detail
                </a>
                
                {{-- <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login untuk Pinjam</a> --}}
            </div>
        </div>
    </div>
</div>