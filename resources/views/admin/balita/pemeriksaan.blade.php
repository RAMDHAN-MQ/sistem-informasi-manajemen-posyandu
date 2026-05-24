@extends('layouts.master')

@section('title', 'Input Pemeriksaan Balita')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Data Master</li>
<li class="breadcrumb-item text-muted">Balita</li>
<li class="breadcrumb-item fw-bold">Pemeriksaan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white fw-bold">
                Form Pemeriksaan Balita
            </div>
            <div class="card-body p-4">
                <form id="formPemeriksaanBalita" action="{{ route('admin.balita.pemeriksaan.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pilih Balita <span class="text-danger">*</span></label></label>
                            <select class="form-select select2" name="balita_id" required>
                                <option value="">-- Cari Nama Balita --</option>
                                @foreach($balita as $b)
                                <option value="{{ $b->id }}">{{ $b->nama }} (NIK: {{ $b->nik }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Berat Badan <span class="text-danger">*</span></label></label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control" name="berat" placeholder="Contoh: 12.5" required>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tinggi / Panjang Badan <span class="text-danger">*</span></label></label>
                            <div class="input-group">
                                <input type="number" step="0.1" class="form-control" name="tinggi" placeholder="Contoh: 85.5" required>
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Riwayat Kesehatan</label>
                        <textarea class="form-control" name="riwayat_kesehatan" rows="3" placeholder="Masukkan catatan imunisasi, pemberian vitamin A..."></textarea>
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
    const form = document.getElementById('formPemeriksaanBalita');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Simpan Data?',
            text: 'Data pemeriksaan balita akan disimpan.',
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