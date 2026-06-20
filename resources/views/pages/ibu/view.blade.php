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
    <div class="col-12 col-lg-5 mb-4">
        <div class="card p-4 h-100">
            <div class="d-flex flex-column align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 80px; height: 80px; background-color: #ff69b4;">
                    <i class="fa-solid fa-person-pregnant text-white fs-1"></i>
                </div>

                <h4 class="fw-bold mt-3">{{ $ibuhamil->nama }}</h4>

                <h5 class="text-muted">
                    <i class="bi bi-person-fill"></i> {{$umur}} Tahun
                </h5>
            </div>
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

    <div class="col-md-7">
        <div class="card p-4 h-100">
            <h5 class="fw-bold mb-3">Data Pemeriksaan Terakhir</h5>
            @if($pemeriksaan)
            <table class="table">
                <tr>
                    <th>HPHT</th>
                    <td class="fw-bold">{{ \Carbon\Carbon::parse($pemeriksaan->hpht)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th>HPL</th>
                    <td class="fw-bold">{{ \Carbon\Carbon::parse($pemeriksaan->hpl)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Berat</th>
                    <td class="fw-bold">{{ $pemeriksaan->berat }} kg</td>
                </tr>
                <tr>
                    <th>Pemeriksaan Darah</th>
                    <td class="fw-bold">{{ $pemeriksaan->pemeriksaan_darah ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Periksa</th>
                    <td class="fw-bold">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->translatedFormat('d F Y') }}</td>
                </tr>
            </table>
            @else
            <div class="d-flex flex-column justify-content-center align-items-center text-center"
                style="min-height: 300px;">
                <i class="fa-solid fa-file-medical fs-1 text-muted mb-3"></i>

                <h6 class="fw-bold">Belum Ada Data Pemeriksaan</h6>

                <a href="{{ route($role.'.ibu.pemeriksaan.create', $ibuhamil->id) }}"
                    class="btn btn-primary">
                    <i class="fa-solid fa-plus me-1"></i>
                    Tambah Pemeriksaan
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="fw-bold mb-3">Tensi</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-center">Tensi</th>
                        <th class="text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tensi as $t)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td class="text-center">{{ $t->tensi  }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($t->tanggal_periksa)->translatedFormat('d F Y')  }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-muted text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection