<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMANDU - Posyandu Gerbangmas Siaga Euphorbia</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: #f8f9fa;
        }

        .nav-link {
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #0d6efd;
        }

        section {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .bg-light-blue {
            background-color: #e9f2fb;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('storage/images/Logo_Posyandu.png') }}" alt="" width="35" height="35" class="me-2">
                SIMANDU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jadwal">Jadwal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#informasi">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pengumuman">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
                <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">
                    <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="offcanvas" data-bs-target="#loginSidebar">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="loginSidebar">
        <div class="offcanvas-header border-bottom">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/images/Logo_Posyandu.png') }}" width="80" class="mb-3" alt="Logo">
                <h4 class="fw-bold">Selamat Datang</h4>
                <p class="text-muted">Silakan login untuk mengakses sistem SIMANDU</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0">Password</label>
                        <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none" onclick="togglePassword()">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </button>
                    </div>
                    <input type="password" id="passwordInput" name="password" class="form-control">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50 rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <section id="beranda" class="bg-light-blue py-5">
        <div class="container mt-5">
            <div class="row align-items-center text-center text-lg-start">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="fw-bold display-5 text-primary">Sistem Informasi Manajemen Posyandu</h1>
                    <p class="text-muted mt-3 fs-5">
                        SIMANDU hadir untuk mempermudah pencatatan, pelaporan, dan akses informasi kesehatan masyarakat secara digital.
                    </p>
                    <a href="#jadwal" class="btn btn-primary rounded-pill px-4 mt-3 py-2 me-2 shadow-sm">Lihat Jadwal</a>
                    <a href="#profil" class="btn btn-outline-primary rounded-pill px-4 mt-3 py-2 shadow-sm">Profil Kami</a>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="bg-white p-5 rounded-4 shadow-sm border" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                        <span class="text-muted">Ilustrasi/Gambar Posyandu di sini</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="profil" class="bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold text-primary">Profil Posyandu</h2>
                    <div style="width: 60px; height: 4px; background-color: #0d6efd; margin: 0 auto;"></div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 text-center mb-4 mb-lg-0">
                    <div class="bg-light p-5 rounded-4 border" style="height: 250px;">
                        <span class="text-muted">Foto Kader / Kegiatan Posyandu</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h4 class="fw-bold">Posyandu Gerbangmas Siaga Euphorbia Kunir</h4>
                    <p class="text-muted mb-2"><i class="bi bi-geo-alt text-danger me-2"></i> Kabupaten Lumajang</p>
                    <p class="text-muted mt-3">
                        Kami berkomitmen untuk meningkatkan kesehatan ibu dan anak di lingkungan kami melalui pelayanan yang terpadu dan rutin. Melalui SIMANDU, kami mendigitalisasi pencatatan pelayanan guna meningkatkan akurasi data balita dan ibu hamil serta mempermudah masyarakat mengakses jadwal dan edukasi kesehatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="jadwal" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-4">
                    <h3 class="fw-bold text-primary mb-4">Jadwal Posyandu Terdekat</h3>
                    <div class="card border-0 shadow-sm rounded-4 mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h5 class="fw-bold mb-1">Penimbangan & Imunisasi Balita</h5>
                                <p class="text-muted mb-0 small"><i class="bi bi-clock me-1"></i> 08:00 - 11:00 WIB | <i class="bi bi-geo-alt ms-2 me-1"></i> Balai Desa Kunir</p>
                            </div>
                            <div class="bg-primary text-white text-center rounded-3 p-2 px-3">
                                <span class="d-block fw-bold fs-5">15</span>
                                <span class="d-block small">Jun 26</span>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h5 class="fw-bold mb-1">Pemeriksaan Ibu Hamil</h5>
                                <p class="text-muted mb-0 small"><i class="bi bi-clock me-1"></i> 09:00 - 12:00 WIB | <i class="bi bi-geo-alt ms-2 me-1"></i> Polindes</p>
                            </div>
                            <div class="bg-primary text-white text-center rounded-3 p-2 px-3">
                                <span class="d-block fw-bold fs-5">20</span>
                                <span class="d-block small">Jun 26</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" id="pengumuman">
                    <h3 class="fw-bold text-primary mb-4">Pengumuman Kegiatan</h3>
                    <div class="alert alert-warning border-0 shadow-sm rounded-4 p-4" role="alert">
                        <h6 class="alert-heading fw-bold"><i class="bi bi-info-circle me-2"></i>Pemberian Vitamin A</h6>
                        <p class="mb-0 small text-dark">Mohon kehadiran ibu balita pada bulan Agustus untuk penerimaan Vitamin A secara gratis.</p>
                    </div>
                    <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 mt-3" role="alert">
                        <h6 class="alert-heading fw-bold"><i class="bi bi-megaphone me-2"></i>Kelas Ibu Hamil Baru</h6>
                        <p class="mb-0 small text-dark">Pendaftaran kelas ibu hamil untuk trimester 1 sudah dibuka. Silakan hubungi kader.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="informasi" class="bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold text-primary">Informasi & Edukasi Kesehatan</h2>
                    <div style="width: 60px; height: 4px; background-color: #0d6efd; margin: 0 auto;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="bg-secondary bg-opacity-25 rounded-top-4" style="height: 180px;"></div>
                        <div class="card-body p-4">
                            <span class="badge bg-success bg-opacity-25 text-success mb-2">Gizi Balita</span>
                            <h5 class="card-title fw-bold">Mencegah Stunting Sejak Dini</h5>
                            <p class="card-text text-muted small">Pentingnya asupan gizi yang seimbang pada 1000 Hari Pertama Kehidupan (HPK)...</p>
                            <a href="#" class="btn btn-link px-0 text-decoration-none fw-bold">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="bg-secondary bg-opacity-25 rounded-top-4" style="height: 180px;"></div>
                        <div class="card-body p-4">
                            <span class="badge bg-danger bg-opacity-25 text-danger mb-2">Ibu Hamil</span>
                            <h5 class="card-title fw-bold">Tanda Bahaya Kehamilan</h5>
                            <p class="card-text text-muted small">Kenali beberapa tanda bahaya saat kehamilan yang memerlukan penanganan medis segera...</p>
                            <a href="#" class="btn btn-link px-0 text-decoration-none fw-bold">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="bg-secondary bg-opacity-25 rounded-top-4" style="height: 180px;"></div>
                        <div class="card-body p-4">
                            <span class="badge bg-primary bg-opacity-25 text-primary mb-2">Imunisasi</span>
                            <h5 class="card-title fw-bold">Jadwal Imunisasi Dasar Lengkap</h5>
                            <p class="card-text text-muted small">Pastikan balita Anda mendapatkan imunisasi dasar lengkap sesuai jadwal untuk kekebalan tubuhnya...</p>
                            <a href="#" class="btn btn-link px-0 text-decoration-none fw-bold">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="bg-dark text-white py-5">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <h4 class="fw-bold mb-3 d-flex align-items-center">
                        <img src="{{ asset('storage/images/Logo_Posyandu.png') }}" alt="" width="30" class="me-2 bg-white rounded-circle">
                        SIMANDU
                    </h4>
                    <p class="text-light text-opacity-75 small">
                        Sistem Informasi Manajemen Posyandu.<br>
                        Mempermudah pencatatan dan akses informasi kesehatan masyarakat tingkat desa.
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">Informasi Kontak</h5>
                    <ul class="list-unstyled text-light text-opacity-75 small">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Posyandu Gerbangmas Siaga Euphorbia, Ds. Kunir, Kab. Lumajang</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> +62 812-3456-7890 (Kader)</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> admin@simandu-kunir.desa.id</li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="fw-bold mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#beranda" class="text-light text-opacity-75 text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="#jadwal" class="text-light text-opacity-75 text-decoration-none">Jadwal Posyandu</a></li>
                        <li class="mb-2"><a href="#informasi" class="text-light text-opacity-75 text-decoration-none">Edukasi Kesehatan</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="text-center text-light text-opacity-50 small mt-3">
                &copy; {{ date('Y') }} SIMANDU
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