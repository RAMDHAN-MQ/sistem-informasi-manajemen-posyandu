@extends('layouts.master')

@section('title', 'Ibu Hamil')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">
    Data Master
</li>
<li class="breadcrumb-item text-muted">
    Ibu Hamil
</li>
<li class="breadcrumb-item text-muted">
    Data Ibu Hamil
</li>
<li class="breadcrumb-item fw-bold">
    View Data
</li>
@endsection

@section('content')

<a href="{{ route('admin.ibu.index') }}" class="btn btn-light border">
    <i class="bi bi-arrow-left-short"></i>
    Kembali
</a>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4">
            <h2 class="fw-bold">{{ $ibuhamil->nama }}</h2>
            <table class="table">
                <tr>
                    <th style="width: 200px;">NIK</th>
                    <td class="fw-bold">{{ $ibuhamil->nik }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td class="fw-bold">{{ $ibuhamil->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td class="fw-bold">{{ $ibuhamil->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td class="fw-bold">{{ $ibuhamil->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
