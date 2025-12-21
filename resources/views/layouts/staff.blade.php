<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Staff Panel - Perpustakaan</title>
    {{-- Pastikan path CSS ini benar sesuai project Anda --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Tambahkan Bootstrap jika tabel Anda memerlukannya --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="admin-container">

    <aside class="sidebar">
        <div class="logo">📚 Staff Panel</div>
        <ul>
            <li>
                <a href="{{ route('staff.dashboard') }}" class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                {{-- Menu Buku --}}
                <a href="{{ route('staff.books.index') }}" class="{{ request()->routeIs('staff.books.*') ? 'active' : '' }}">
                    <i class="fa fa-book-open"></i> Data Buku
                </a>
            </li>
        </ul>
    </aside>

    <div class="main-content">

        <div class="topbar">
            <h3>Staff Area</h3>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" style="background:none; border:none; cursor:pointer; color:inherit;">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <div class="content" style="padding: 20px;">
            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Disini konten index/create/edit akan muncul --}}
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>