<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>OBE System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (breadcrumb & UI) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 260px;
            min-height: 100vh;
        }
        .sidebar a {
            text-decoration: none;
        }
        .submenu a:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .toggle-icon {
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="bg-dark text-white p-3 sidebar">
        <h5 class="mb-4">OBE System</h5>

        <!-- DROPDOWN PENGATURAN -->
        <button
            class="btn btn-primary w-100 d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse"
            data-bs-target="#menuPengaturan"
            aria-expanded="true"
        >
            <span>
                <i class="bi bi-gear-fill me-1"></i> Pengaturan
            </span>
            <span class="toggle-icon">🔽</span>
        </button>

        <!-- SUBMENU -->
        <div id="menuPengaturan" class="collapse show submenu mt-2">
            <a href="{{ route('users.index') }}" class="d-block text-white ps-4 py-2 rounded">
                <i class="bi bi-people me-1"></i> Daftar Pengguna
            </a>
            <a href="{{ route('data-master.index') }}" class="d-block text-white ps-4 py-2 rounded">
                <i class="bi bi-database me-1"></i> Data Master
            </a>
            <a href="#" class="d-block text-white ps-4 py-2 rounded">
                <i class="bi bi-calendar-check me-1"></i> Set Prodi & Tahun Aktif
            </a>
        </div>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="flex-fill p-4">
        @yield('content')
    </div>

</div>

<!-- jQuery (WAJIB untuk DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
 <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<!-- SCRIPT DARI HALAMAN -->
@stack('scripts')

<script>
    // Toggle icon dropdown Pengaturan
    const pengaturanBtn = document.querySelector('[data-bs-target="#menuPengaturan"]');
    const icon = pengaturanBtn.querySelector('.toggle-icon');
    const menu = document.getElementById('menuPengaturan');

    menu.addEventListener('shown.bs.collapse', function () {
        icon.textContent = '🔽'; // turun
    });

    menu.addEventListener('hidden.bs.collapse', function () {
        icon.textContent = '🔼'; // naik / tertutup
    });
</script>

</body>
</html>
