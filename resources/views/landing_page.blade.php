<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMANDU - Posyandu Gerbangmas Siaga Euphorbia</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link {
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #0d6efd !important;
        }

        section {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        /* Warna Custom Terang */
        .bg-light-blue {
            background-color: #e9f2fb;
            transition: background-color 0.3s ease;
        }

        /* Warna Custom Gelap */
        [data-bs-theme="dark"] .bg-light-blue {
            background-color: #0d1b2a;
        }

        [data-bs-theme="dark"] .navbar {
            border-bottom: 1px solid #2b3035 !important;
        }

        .transition-link {
            transition: 0.3s;
        }

        .transition-link:hover {
            color: #25D366 !important;
            opacity: 1 !important;
        }

        /* wa */
        .wa-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: transform 0.2s ease;
        }

        .wa-float img {
            width: 35px;
            height: 35px;
        }

        .wa-float:hover {
            transform: scale(1.1);
        }

        /* responsive */
        @media (max-width: 768px) {

            h3 {
                font-size: 1.2rem;
            }

            .card-body {
                padding: 1rem !important;
            }

            table {
                font-size: 13px;
            }

            th, td {
                white-space: nowrap;
            }

            .bg-primary.text-white {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body class="bg-body">
    <nav class="navbar navbar-expand-lg bg-body shadow-sm sticky-top">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('storage/images/Logo_Posyandu.png') }}" alt="" width="35" height="35" class="me-2">
                SIMANDU EUPHORBIA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jadwal">Jadwal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jadwal">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#informasi">Edukasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
                <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0 align-items-center">
                    <!-- Tombol Dark Mode -->
                    <button class="btn btn-outline-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" id="themeToggle" style="width: 40px; height: 40px;" title="Ubah Tema">
                        <i class="bi bi-moon-fill" id="themeIcon"></i>
                    </button>
                    <!-- Tombol Login -->
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
                    <input type="text"
                        name="username"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}">

                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0">Password</label>
                        <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none" onclick="togglePassword()">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </button>
                    </div>
                    <input type="password"
                        id="passwordInput"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror">

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
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
                    <p class="text-body-secondary mt-3 fs-5">
                        SIMANDU hadir untuk mempermudah pencatatan, pelaporan, dan akses informasi kesehatan masyarakat secara digital.
                    </p>
                    <a href="#jadwal" class="btn btn-primary rounded-pill px-4 mt-3 py-2 me-2 shadow-sm">Lihat Jadwal</a>
                    <a href="#profil" class="btn btn-outline-primary rounded-pill px-4 mt-3 py-2 shadow-sm bg-body">Profil Kami</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('storage/images/posyandu2.png') }}"
                        alt="Ilustrasi Posyandu Ibu dan Anak"
                        class="img-fluid rounded-4 shadow border border-3 border-white"
                        style="width: 100%; height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <section id="profil" class="bg-body">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold text-primary">Profil Posyandu</h2>
                    <div style="width: 60px; height: 4px; background-color: #0d6efd; margin: 0 auto;"></div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div id="profilCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#profilCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#profilCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#profilCarousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#profilCarousel" data-bs-slide-to="3"></button>
                        </div>
                        <div class="carousel-inner rounded-4 shadow">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/images/a (1).jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="Profil Posyandu 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/images/a (2).jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="Profil Posyandu 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/images/a (3).jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="Profil Posyandu 3">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('storage/images/a (4).jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="Profil Posyandu 4">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#profilCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#profilCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h4 class="fw-bold text-body">Posyandu Gerbangmas Siaga Euphorbia Kunir</h4>
                    <p class="text-danger mb-2 fw-semibold"><i class="bi bi-geo-alt me-2"></i> Kabupaten Lumajang</p>
                    <p class="text-body-secondary mt-3">
                        Kami berkomitmen untuk meningkatkan kesehatan ibu dan anak di lingkungan kami melalui pelayanan yang terpadu dan rutin. Melalui SIMANDU, kami mendigitalisasi pencatatan pelayanan guna meningkatkan akurasi data balita dan ibu hamil serta mempermudah masyarakat mengakses jadwal dan edukasi kesehatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="jadwal" class="bg-body-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 mb-4">
                    <h3 class="fw-bold text-primary mb-4 text-center text-lg-start">Jadwal Posyandu Terdekat</h3>
                    @foreach($jadwal as $j)
                    <div class="card border-0 shadow-sm rounded-4 mb-3 bg-body">
                        <div class="card-body p-4" style="min-height: 130px;">
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $j->judul_kegiatan }}</h5>
                                    <p class="text-body-secondary mb-0 small"><i class="bi bi-clock me-1"></i> {{ $j->waktu_mulai }} - {{ $j->waktu_selesai }} WIB | <i class="bi bi-geo-alt ms-2 me-1"></i> {{ $j->lokasi }}</p>
                                </div>
                                <div class="bg-primary text-white text-center rounded-3 p-2 px-3 align-self-start">
                                    <span class="d-block fw-bold fs-5">{{ $j->hari }}</span>
                                    <span class="d-block small">{{ $j->bulan_tahun }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="text-center mt-3">
                        <a href=""
                        class="btn btn-outline-primary rounded-3 px-4">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-5 mb-4">
                    <h3 class="fw-bold text-primary mb-4 text-center text-lg-start">Pengumuman Kegiatan</h3>
                    @php
                    $colors = [
                    'text-bg-primary',
                    'text-bg-success',
                    'text-bg-warning',
                    'text-bg-danger',
                    'text-bg-info',
                    ];
                    @endphp

                    @foreach($pengumuman as $p)
                    <a href="{{ route('landing.pengumuman', $p->id) }}" style="text-decoration: none;">
                        <div class="card {{ $colors[$p->id % count($colors)] }} border-0 shadow-sm rounded-4 p-4 mb-3 bg-opacity-75" style="min-height: 130px;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="card-title fw-bold">
                                    <i class="bi bi-megaphone me-2"></i>Pengumuman
                                </span>
                                <small class="text-muted">
                                    {{ $p->created_at->format('d M Y') }}
                                </small>
                            </div>
                            <h5 class="fw-bold mb-2">
                                "{{ $p->judul }}"
                            </h5>
                        </div>
                    </a>
                    @endforeach
                    <div class="text-center mt-3">
                        <a href=""
                        class="btn btn-outline-primary rounded-3 px-4">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card border-0 shadow-sm rounded-4 mb-3 bg-body">
                        <div class="card-body p-4">
                            <form action="{{ route('landing') }}#jadwal" method="GET">
                                <div class="d-flex">
                                    <input
                                        type="text"
                                        name="nik"
                                        class="form-control"
                                        placeholder="Masukkan NIK..."
                                        required>
                                    <button
                                        class="btn btn-primary ms-2">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div id="hasilCari">
                                @if($error)
                                    <div class="alert alert-danger mt-4">
                                        {{ $error }}
                                    </div>
                                @elseif($jenis=='Balita')
                                    <h4 class="mt-4">Data Diri Balita</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width: 250px;">Nama</th>
                                                <td>{{ $data->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>{{ $data->nik }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td>{{ \Carbon\Carbon::parse($data->tgl_lahir)->translatedFormat('d F Y') }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <h4>Riwayat Pemeriksaan Balita</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Berat</th>
                                                    <th>Tinggi</th>
                                                    <th>Riwayat Kesehatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($hasil as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pemeriksaan)->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $item->berat }} kg</td>
                                                    <td>{{ $item->tinggi }} cm</td>
                                                    <td>
                                                        {{ $item->imunisasi->imunisasi }} <br>
                                                        <small>catatan: {{$item->catatan}}</small>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @elseif($jenis=='Ibu Hamil')
                                    <h4 class="mt-4">Data Diri Ibu Hamil</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width: 250px;">Nama</th>
                                                <td>{{ $data->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>{{ $data->nik }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td>{{ \Carbon\Carbon::parse($data->tgl_lahir)->translatedFormat('d F Y') }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <h4 class="mt-4">Riwayat Pemeriksaan</h4>
                                    @if ($hasil)
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width: 250px;">HPHT</th>
                                                    <td>{{ $hasil->hpht }}</td>
                                                </tr>
                                                <tr>
                                                    <th>HPL</th>
                                                    <td>{{ $hasil->hpl }}</td>
                                                </tr>
                                                <tr>
                                                    <th>berat</th>
                                                    <td>{{ $hasil->berat }} kg</td>
                                                </tr>
                                                <tr>
                                                    <th>Pemeriksaan darah</th>
                                                    <td>{{ $hasil->pemeriksaan_darah }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Pemeriksaan</th>
                                                    <td>{{ \Carbon\Carbon::parse($hasil->tanggal_pemeriksaan)->translatedFormat('d F Y') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @else
                                        Belum ada data
                                    @endif

                                    <h4 class="mt-4">Riwayat Tensi</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tensi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tensi as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_periksa)->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $item->tensi }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="informasi" class="bg-body">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold text-primary">Informasi & Edukasi Kesehatan</h2>
                    <div style="width: 60px; height: 4px; background-color: #0d6efd; margin: 0 auto;"></div>
                </div>
            </div>

            <div class="row">
                @forelse($edukasi as $e)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 bg-body">
                        <img src="{{ asset('storage/' . $e->gambar) }}"
                            class="card-img-top rounded-top-4"
                            alt="{{ $e->judul }}"
                            style="height: 180px; object-fit: cover;">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="badge bg-primary bg-opacity-25 text-primary mb-2 align-self-start">{{ $e->kategori }}</span>
                            <h5 class="card-title fw-bold">{{ $e->judul }}</h5>
                            <p class="card-text text-body-secondary small">{{ Str::limit($e->isi, 100) }}</p>
                            <a href="{{ route('edukasi.show', $e->id) }}" class="btn btn-link px-0 text-decoration-none fw-bold mt-auto align-self-start">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-body-secondary">
                    <p>Belum ada artikel edukasi kesehatan yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>


    <section id="komentar" class="bg-body-tertiary">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="fw-bold me-3">{{ $jumlah }} Komentar</h5>
            </div>
            <div class="card h-100 border-0 shadow-sm rounded-4 bg-body">
                <div class="card-body p-4">
                    <div class="kirim-komentar border-bottom">
                        <form action="{{ route('landing.kirim_komentar') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama..." maxlength="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="komentar">Komentar <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="komentar" id="komentar" rows="6" maxlength="500" required></textarea>
                            </div>
                            <div class="mb-2">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <div id="listKomentar" class="komentar pt-4">
                        @foreach ($komentar as $k)
                        <div class="mb-4">
                            <span class="fw-bold">{{ $k->nama }}</span>
                            <span class="text-muted">· {{ $k->created_at->diffForHumans() }}</span>
                            <p class="mb-2">
                                {{ $k->komentar }}
                            </p>
                            @if($k->balasan_admin)
                            <div class="ms-4 border-start ps-3">
                                <span class="fw-bold text-primary">Admin Posyandu</span>
                                <span class="text-muted">· {{ $k->dibalas_pada?->diffForHumans() }}</span>
                                <p class="mb-0">
                                    {{ $k->balasan_admin }}
                                </p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @if($jumlah > 5)
                    <div class="text-center">
                        <button
                            id="showMoreBtn"
                            class="btn btn-outline-primary">
                            Lihat Lebih Banyak
                        </button>
                    </div>
                    @endif
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
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Posyandu Gerbangmas Siaga Euphorbia, Ds. Kunir Lor, Kab. Lumajang</li>
                        <li class="mb-2">
                            <a href="https://wa.me/6282232799979" target="_blank" class="text-light text-opacity-75 text-decoration-none transition-link">
                                <i class="bi bi-whatsapp me-2"></i> +62 822-3279-9979 (Kader)
                            </a>
                        </li>
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

    <a href="https://wa.me/6282232799979" class="wa-float" target="_blank">
        <img src="{{ asset('storage/images/whatsapp.png') }}" alt="WhatsApp">
    </a>

    <!-- SweetAlert2 js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

        const themeToggleBtn = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;


        const savedTheme = localStorage.getItem('simanduTheme') || 'light';
        setTheme(savedTheme);

        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });

        function setTheme(theme) {
            htmlElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('simanduTheme', theme);


            if (theme === 'dark') {
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
                themeToggleBtn.classList.replace('btn-outline-secondary', 'btn-outline-light');
            } else {
                themeIcon.classList.remove('bi-sun-fill');
                themeIcon.classList.add('bi-moon-fill');
                themeToggleBtn.classList.replace('btn-outline-light', 'btn-outline-secondary');
            }
        }
    </script>

    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const offcanvasElement = document.getElementById('loginSidebar');
            const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.show();
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    <script>
        let offset = 5;
        const total = {{ $jumlah }};
        const btn = document.getElementById('showMoreBtn');
        btn?.addEventListener('click', async function () {
            try {
                const response = await fetch(
                    `{{ route('landing.load_komentar') }}?offset=${offset}`
                );
                const data = await response.json();
                const container = document.getElementById('listKomentar');
                data.forEach(item => {
                    container.innerHTML += `
                    <div class="mb-4">
                        <span class="fw-bold">
                            ${item.nama}
                        </span>
                        <span class="text-muted">
                            · ${item.created_at}
                        </span>
                        <p class="mb-2">
                            ${item.komentar}
                        </p>
                        ${item.balasan_admin ?
                        `<div class="ms-4 border-start ps-3">
                            <span class="fw-bold text-primary">
                                Admin Posyandu
                            </span>
                            <span class="text-muted">
                                · ${item.dibalas_pada}
                            </span>
                            <p class="mb-0">
                                ${item.balasan_admin}
                            </p>
                        </div>`
                        : ''}
                    </div>
                    `;
                });
                offset += data.length;
                if (data.length === 0) {
                    btn.style.display = 'none';
                    return;
                }
            } catch (error) {
                console.error(error);
            }
        });
    </script>
</body>

</html>