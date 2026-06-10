@extends('layouts.master')

@section('title', 'Balita')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Data Master</li>
<li class="breadcrumb-item text-muted">Balita</li>
<li class="breadcrumb-item fw-bold">Data Balita</li>
@endsection

@section('content')

@php
$role = auth()->user()->role;
@endphp

<div class="d-flex justify-content-between align-items-center">
    <h2 class="fw-bold">Data Balita</h2>
    <div class="d-flex">
        <button class="btn btn-light me-2 border"><i class="bi bi-download me-2"></i>Export</button>
        <a href="{{ route('admin.balita.create') }}" class="btn btn-primary"><i class="bi bi-plus me-2"></i>Tambah</a>
    </div>
</div>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4 table-responsive">
            <table id="balitaTable" class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>NAMA ORANG TUA</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($balita as $data)
                    <tr>
                        <td>{{$data->nik}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->nama_ortu}}</td>
                        <td class="text-center">
                            <a href="{{ route($role.'.balita.view', $data->id) }}"><i class="bi bi-eye me-2"></i></a>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.balita.edit', $data->id) }}"><i class="bi bi-pencil me-2"></i></a>
                            <form action="{{ route('admin.balita.destroy', $data->id) }}"
                                method="POST"
                                class="d-inline formDelete">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="border-0 bg-transparent text-primary p-0 m-0">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- datatable -->
<script>
    $(document).ready(function() {
        $('#balitaTable').DataTable({
            order: [],
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

<!-- konfirmasi hapus -->
<script>
    $('.formDelete').submit(function(e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
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
@endpush