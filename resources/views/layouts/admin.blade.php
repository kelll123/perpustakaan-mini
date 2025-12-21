<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Perpustakaan</title>

    {{-- CSS Custom Anda --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    {{-- FontAwesome (Ikon) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="admin-container">

        <aside class="sidebar">
            <div class="logo">📚 Admin Panel</div>
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-home"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.books.index') }}"
                        class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                        <i class="fa fa-book"></i> Data Buku
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fa fa-tags"></i> Kategori
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.staff.index') }}"
                        class="{{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                        <i class="fa fa-user-tie"></i> Data Staff
                    </a>
                </li>

                <li>
                    <a href="{{ route('members.index') }}"
                        class="{{ request()->routeIs('members.*') ? 'active' : '' }}">
                        <i class="fa fa-users"></i> Data Member
                    </a>
                </li>
            </ul>
        </aside>

        <div class="main-content">

            <div class="topbar">
                <h3>Admin Area</h3>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" style="background:none; border:none; cursor:pointer; color:inherit;">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <div class="content" style="padding: 20px;">
                @yield('content')
            </div>
        </div>
    </div>

</body>

</html>
