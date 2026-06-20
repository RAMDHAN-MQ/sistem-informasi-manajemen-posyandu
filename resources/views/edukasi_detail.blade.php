<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $edukasi->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 bg-white p-5 rounded-4 shadow-sm">
                <a href="{{ url('/') }}#informasi" class="btn btn-outline-secondary btn-sm mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
                
                <span class="badge bg-primary mb-3">{{ $edukasi->kategori }}</span>
                <h1 class="fw-bold">{{ $edukasi->judul }}</h1>
                <hr>
                <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="img-fluid rounded-4 mb-4 w-100" style="max-height: 400px; object-fit: cover;">
                
                <div class="fs-5 text-secondary">
                    {!! nl2br(e($edukasi->isi)) !!}
                </div>
            </div>
        </div>
    </div>
</body>
</html>