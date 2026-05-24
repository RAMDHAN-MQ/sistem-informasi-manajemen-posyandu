@extends('layouts.master')

@section('title', 'Input Pemeriksaan Ibu Hamil')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Data Master</li>
<li class="breadcrumb-item text-muted">Ibu Hamil</li>
<li class="breadcrumb-item fw-bold">Pemeriksaan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white fw-bold">
                Form Pemeriksaan Ibu Hamil
            </div>
            <div class="card-body p-4">
                <form id="formPemeriksaanIbuHamil" action="{{ route('admin.ibu.pemeriksaan.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pilih Ibu Hamil</label>
                            <select class="form-select select2" name="ibuhamil_id" required>
                                <option value="">-- Cari Nama Ibu Hamil --</option>
                                @foreach($ibuhamil as $ibu)
                                <option value="{{ $ibu->id }}">{{ $ibu->nama }} (NIK: {{ $ibu->nik }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Hari Pertama Haid Terakhir</label>
                            <input type="date" class="form-control" name="hpht" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Hari Perkiraan Lahir</label>
                            <input type="date" class="form-control" name="hpl" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tekanan Darah (Tensi)</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="tensi" placeholder="Contoh: 120/80" required>
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Berat Badan</label>
                            <div class="input-group">
                                <input type="number" step="0.1" class="form-control" name="berat" placeholder="Contoh: 65.5" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Pemeriksaan Darah</label>
                        <textarea class="form-control" name="pemeriksaan_darah" rows="3" placeholder="Masukkan hasil pemeriksaan darah..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- konfirmasi simpan data -->
<script>
    const form = document.getElementById('formPemeriksaanIbuHamil');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Simpan Data?',
            text: 'Data pemeriksaan ibu hamil akan disimpan.',
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

<!-- notifikasi ketika ada data yang disimpan -->
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

<!-- select2 -->
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: '-- Cari Nama Ibu Hamil --',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush