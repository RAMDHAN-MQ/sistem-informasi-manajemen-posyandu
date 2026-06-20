<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $edukasi->judul }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .artikel-card {
            overflow: hidden;
        }

        .artikel-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            display: block;
        }

        .artikel-content {
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
            white-space: pre-line;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card artikel-card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5">
                        <a href="{{ url('/') }}#informasi"
                            class="btn btn-outline-secondary btn-sm mb-3">
                            ← Kembali
                        </a>
                        @if($edukasi->kategori)
                        <span class="badge bg-primary mb-3">
                            {{ $edukasi->kategori }}
                        </span>
                        @endif
                        <h1 class="fw-bold">
                            {{ $edukasi->judul }}
                        </h1>
                        <hr>
                        <img
                            src="{{ asset('storage/' . $edukasi->gambar) }}"
                            alt="{{ $edukasi->judul }}"
                            class="artikel-image rounded-4 mb-4">
                        <div class="artikel-content fs-5 text-secondary">
                            {{ $edukasi->isi }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>