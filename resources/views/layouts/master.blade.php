<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables CSS Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f4f8;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-radius: 10px;
            color: #6c757d;
            text-decoration: none;
            transition: 0.2s;
            font-weight: 500;
        }

        .sidebar-link i {
            font-size: 18px;
            margin-right: 10px;
        }

        .sidebar-link:hover {
            background: #f1f5ff;
            color: #0d6efd;
        }

        .sidebar-link.active {
            background: #e7f1ff;
            color: #0d6efd;
            border-left: 4px solid #0d6efd;
            padding-left: 8px;
        }

        .sidebar-section {
            font-size: 11px;
            letter-spacing: 1px;
            margin-top: 20px;
            margin-bottom: 8px;
            color: #9aa4b2;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-4 bg-white vh-100 border-end" style="width: 260px;">
            <div href="#" class="d-flex align-items-center text-dark fw-bold pb-2 border-bottom">
                <img src="{{ asset('storage/images/Logo_Posyandu.png') }}"
                    alt=""
                    width="35"
                    height="35"
                    class="me-2">
                <div class="">
                    <span class="fs-5 fw-bold">{{ auth()->user()->role == 'admin' ? 'Admin' : 'Kader' }}</span>
                    <div class="text-muted" style="font-size: 11px;">SIMANDU</div>
                </div>
            </div>
            <ul class="nav flex-column">
                <!-- section main menu -->
                <li class="sidebar-section">MAIN MENU</li>
                <li>
                    <a href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : route('kader.dashboard') }}"
                        class="sidebar-link active">
                        <i class="bi bi-house"></i>
                        Dashboard
                    </a>
                </li>

                <!-- section data master -->
                <li class="sidebar-section">DATA MASTER</li>
                <li>
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-people"></i>
                        Data Balita
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-person-walking"></i>
                        Ibu Hamil
                    </a>
                </li>

                <!-- section layanan -->
                <li class="sidebar-section">LAYANAN</li>
                <li>
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-calendar-event"></i>
                        Jadwal
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-graph-up"></i>
                        Laporan
                    </a>
                </li>

            </ul>
            <hr>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>

        </div>

        <div class="flex-grow-1 p-4">

            @yield('content')

        </div>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables js -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- cdn js chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- cdn js chart.js plugin persenan -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    @stack('scripts')
</body>

</html>