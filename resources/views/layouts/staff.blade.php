<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Staff Panel - Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="admin-container">
        <aside class="sidebar bg-dark text-white">
            <div class="logo p-3 fw-bold border-bottom border-secondary">👤 Staff Area</div>
            <ul class="list-unstyled p-2">
                <li class="mb-2">
                    <a href="{{ route('staff.dashboard') }}"
                        class="text-decoration-none text-white d-block p-2 rounded {{ request()->routeIs('staff.dashboard') ? 'bg-primary' : '' }}">
                        <i class="fa fa-home me-2"></i> Dashboard
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('staff.books.index') }}"
                        class="text-decoration-none text-white d-block p-2 rounded {{ request()->routeIs('staff.books.*') ? 'bg-primary' : '' }}">
                        <i class="fa fa-book me-2"></i> Data Buku
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('members.index') }}"
                        class="text-decoration-none text-white d-block p-2 rounded {{ request()->routeIs('members.*') ? 'bg-primary' : '' }}">
                        <i class="fa fa-users me-2"></i> Data Member
                    </a>
                </li>
            </ul>
        </aside>

        <div class="main-content w-100">
            <div class="topbar bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0">Halo, {{ Auth::user()->name }}</h5>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>

            <div class="content p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
