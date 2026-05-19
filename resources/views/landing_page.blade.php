<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMANDU</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: #f0f8ff;
        }

        .nav-link {
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('storage/images/Logo_Posyandu.png') }}"
                    alt=""
                    width="35"
                    height="35"
                    class="me-2">
                SIMANDU
            </a>
            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse"
                id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profil">
                            Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jadwal">
                            Jadwal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#informasi">
                            Edukasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pengumuman">
                            Pengumuman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">
                            Kontak
                        </a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">
                    <a href="#"
                        class="btn btn-primary rounded-pill px-4 shadow-sm"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#loginSidebar">

                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR LOGIN -->
    <div class="offcanvas offcanvas-end"
        tabindex="-1"
        id="loginSidebar">

        <div class="offcanvas-header border-bottom">
            <button type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas">
            </button>
        </div>

        <div class="offcanvas-body p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/images/Logo_Posyandu.png') }}"
                    width="80"
                    class="mb-3"
                    alt="Logo">
                <h4 class="fw-bold">
                    Selamat Datang
                </h4>
                <p class="text-muted">
                    Silakan login untuk mengakses sistem SIMANDU
                </p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                        name="username"
                        class="form-control"
                        value="{{ old('username') }}">
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0">Password</label>
                        <button type="button"
                            class="btn btn-sm btn-link p-0 text-decoration-none"
                            onclick="togglePassword()">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </button>
                    </div>
                    <input type="password"
                        id="passwordInput"
                        name="password"
                        class="form-control">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="btn btn-primary w-50 rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SECTION BERANDA  -->
    <section class="beranda py-5">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <h1 class="fw-bold display-5">
                        Sistem Informasi Manajemen Posyandu
                    </h1>

                    <p class="text-muted mt-3">
                        SIMANDU membantu kader Posyandu dalam
                        pengelolaan data balita, ibu hamil,
                        jadwal layanan, dan informasi kesehatan
                        secara digital.
                    </p>

                    <a href="#profil" class="btn btn-primary rounded-pill px-4 mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <div class="col-lg-6 text-center">
                    <!-- <img src="{{ asset('storage/images/hero-posyandu.png') }}"
                        class="img-fluid"
                        alt="Hero SIMANDU"> -->
                </div>

            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const input = document.getElementById("passwordInput");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>

    @if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginSidebar = new bootstrap.Offcanvas('#loginSidebar');
            loginSidebar.show();
        });
    </script>
    @endif
</body>

</html>