<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PerpusMini | Premium Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --sidebar-bg: #ffffff;
            --bg-main: #f8f9fd;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: #2b2d42;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
        }

        /* Sidebar Modern Premium */
        #sidebar {
            min-width: 280px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            border-right: 1px solid #edf2f7;
            position: sticky;
            top: 0;
        }

        .sidebar-brand {
            padding: 40px 30px;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            letter-spacing: -0.5px;
        }

        .nav-link {
            padding: 14px 25px;
            color: #718096;
            font-weight: 500;
            border-radius: 16px;
            margin: 5px 20px;
            display: flex;
            align-items: center;
            transition: 0.3s;
            text-decoration: none;
        }

        .nav-link i {
            width: 30px;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .nav-link:hover {
            background: #f0f4ff;
            color: var(--primary);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.25);
        }

        .nav-link.active i {
            color: white;
        }

        /* Content Area */
        #content {
            flex-grow: 1;
        }

        .navbar-top {
            padding: 20px 45px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid #edf2f7;
        }

        .main-container {
            padding: 40px 45px;
        }

        /* Stat Cards Glassmorphism */
        .stat-card {
            border: none;
            border-radius: 28px;
            padding: 30px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .icon-circle {
            background: rgba(255, 255, 255, 0.25);
            width: 45px;
            height: 45px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 20px;
        }

        /* Gradients */
        .grad-blue {
            background: linear-gradient(135deg, #4361ee, #4895ef);
        }

        .grad-teal {
            background: linear-gradient(135deg, #2ec4b6, #80ffdb);
            color: #004d4a;
        }

        .grad-orange {
            background: linear-gradient(135deg, #ff9f1c, #ffbf69);
            color: #4d3000;
        }

        .grad-indigo {
            background: linear-gradient(135deg, #4cc9f0, #4361ee);
        }

        /* Components */
        .premium-card {
            background: white;
            border: none;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.02);
            padding: 35px;
            height: 100%;
        }

        .btn-premium {
            border-radius: 14px;
            padding: 10px 24px;
            font-weight: 600;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav id="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-layer-group me-3"></i> PerpusMini
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}">
                    <i class="fas fa-book-bookmark"></i> Katalog Buku
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i class="fas fa-shapes"></i> Kategori
                </a>

                <a href="{{ route('members.index') }}" class="nav-link {{ request()->is('members*') ? 'active' : '' }}">
                    <i class="fas fa-user-astronaut"></i> Member
                </a>
                <a href="{{ route('admin.authors.index') }}"
                    class="nav-link {{ request()->is('admin/authors*') ? 'active' : '' }}">
                    <i class="fas fa-pen-nib"></i> Penulis
                </a>
                <a href="{{ route('admin.staff.index') }}"
                    class="nav-link {{ request()->is('admin/staff*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> Data Staff
                </a>
                <div class="px-5 mt-5 mb-2 small text-uppercase fw-bold text-muted"
                    style="font-size: 0.7rem; letter-spacing: 1px;">Sistem</div>
                <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-rocket"></i> Web Utama</a>
            </div>
        </nav>

        <div id="content">
            <div class="navbar-top d-flex justify-content-between align-items-center">
                <div class="fw-600 text-muted">Selamat Datang, <span class="text-dark fw-bold">Admin Utama</span></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-premium btn-outline-danger border-0"><i
                            class="fas fa-power-off me-2"></i>Logout</button>
                </form>
            </div>
            <div class="main-container">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
