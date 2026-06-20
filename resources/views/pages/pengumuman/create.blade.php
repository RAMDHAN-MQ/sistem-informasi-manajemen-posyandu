@extends('layouts.master')

@section('title', 'Pengumuman')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Layanan</li>
<li class="breadcrumb-item text-muted">Pengumuman</li>
<li class="breadcrumb-item fw-bold">Tambah Data</li>
@endsection

@section('content')

<a href="{{ route('admin.layanan.index') }}" class="btn btn-light border">
    <i class="bi bi-arrow-left-short"></i>
    Kembali
</a>

<div class="row my-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-primary text-white fw-bold">
                Tambah Data Pengumuman
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengumuman.store') }}" method="POST" id="formPengumuman">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="keterangan" id="editor"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<!-- konfirmasi simpan data -->
<script>
    const form = document.getElementById('formPengumuman');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Simpan Data?',
            text: 'Data balita akan disimpan.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush