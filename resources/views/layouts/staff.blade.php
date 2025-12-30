<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffPanel | PerpusMini</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        #sidebar {
            min-width: 280px;
            max-width: 280px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            transition: all 0.3s;
        }

        .main-content {
            margin-left: 280px;
            padding: 40px;
            width: calc(100% - 280px);
        }

        .nav-link {
            color: #64748b;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 10px;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: #10b981;
        }

        .nav-link.active {
            background: #ecfdf5;
            color: #059669;
            font-weight: 700;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.1);
        }

        .stat-card {
            border: none;
            border-radius: 24px;
            padding: 30px;
            color: white;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .premium-card {
            background: white;
            border-radius: 24px;
            border: none;
        }

        .fw-800 {
            font-weight: 800;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <nav id="sidebar" class="p-4">
            <div class="d-flex align-items-center mb-5 px-3">
                <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 text-success">
                    <i class="fas fa-user-shield fa-lg"></i>
                </div>
                <span class="h5 fw-bold mb-0 text-dark">StaffPanel</span>
            </div>

            <div class="small text-uppercase fw-bold text-muted mb-3 ps-3"
                style="font-size: 0.65rem; letter-spacing: 1px;">Menu Utama</div>
            <a href="{{ route('staff.dashboard') }}"
                class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <i class="fas fa-house-user"></i> Dashboard
            </a>
            <a href="{{ route('staff.books.index') }}"
                class="nav-link {{ request()->is('staff/books*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i> Kelola Buku
            </a>
            <a href="{{ route('staff.members.index') }}"
                class="nav-link {{ request()->routeIs('staff.members.index') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Data Member
            </a>

            <div class="mt-auto pt-5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
