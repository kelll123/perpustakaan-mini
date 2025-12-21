<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">📚 PerpusMini</a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="alert alert-success">
            Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Kamu berhasil login sebagai Member.
        </div>

        <div class="card">
            <div class="card-header">Status Peminjaman</div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($borrowings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Wajib Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowings as $item)
                                    <tr>
                                        <td style="width: 100px;">
                                            <img src="{{ $item->book->cover ? asset('storage/' . $item->book->cover) : 'https://via.placeholder.com/150' }}"
                                                class="img-fluid rounded" style="max-height: 80px;">
                                        </td>
                                        <td>{{ $item->book->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->borrow_date)->format('d M Y') }}</td>
                                        <td class="text-danger fw-bold">
                                            {{ \Carbon\Carbon::parse($item->return_date)->format('d M Y') }}</td>
                                        <td>
                                            @if ($item->status == 'dipinjam')
                                                <span class="badge bg-warning text-dark">Sedang Dipinjam</span>
                                            @elseif($item->status == 'dikembalikan')
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">Kamu belum meminjam buku apapun.</p>
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn btn-primary">Cari Buku Sekarang</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>

</html>
