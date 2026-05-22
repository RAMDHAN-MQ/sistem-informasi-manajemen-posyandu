@extends('layouts.master')

@section('title', 'Ibu Hamil')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">
    Data Master
</li>
<li class="breadcrumb-item fw-bold">
    Ibu Hamil
</li>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h2 class="fw-bold">Data Ibu Hamil</h2>
    <div class="d-flex">
        <button class="btn btn-light me-2 border">Export</button>
        <button class="btn btn-primary">+ Tambah</button>
    </div>
</div>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4">
            <div class="row mb-4">
                <div class="col-4">
                    <select name="" id="" class="form-select">
                        <option value="">asd</option>
                    </select>
                </div>
                <div class="col-4">
                    <select name="" id="" class="form-select">
                        <option value="">asd</option>
                    </select>
                </div>
                <div class="col-4">
                    <select name="" id="" class="form-select">
                        <option value="">asd</option>
                    </select>
                </div>
            </div>
            <table id="ibuTable" class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>coba</th>
                        <th>coba</th>
                        <th>coba</th>
                        <th>coba</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#ibuTable').DataTable({
            pagingType: "simple_numbers",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: "›",
                    previous: "‹"
                },
                zeroRecords: "Data tidak ditemukan",
                emptyTable: "Belum ada data"
            }
        });
    });
</script>
@endpush