@extends('layouts.master')

@section('title', 'Ibu Hamil')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Data Master</li>
<li class="breadcrumb-item text-muted">Ibu Hamil</li>
<li class="breadcrumb-item text-muted">Data Ibu Hamil</li>
<li class="breadcrumb-item fw-bold">View Data</li>
@endsection

@section('content')

@php
$role = auth()->user()->role;
@endphp

<a href="{{ route($role.'.ibu.index') }}" class="btn btn-light border">
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


<div class="row my-4">
    <div class="col-12">
        <div class="card p-4">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>NO</th>
                        <th>HPHT</th>
                        <th>HPL</th>
                        <th>Tensi</th>
                        <th>Berat</th>
                        <th>PEMERIKSAAN DARAH</th>
                        <th>TANGGAL PERIKSA</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeriksaan as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->hpht }}</td>
                        <td>{{ $data->hpl }}</td>
                        <td>{{ $data->tensi }} mmHg</td>
                        <td>{{ $data->berat }} kg</td>
                        <td>{{ $data->pemeriksaan_darah }}</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Belum ada data pemeriksaan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection