@extends('layouts.master')

@section('title', 'Balita')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Data Master</li>
<li class="breadcrumb-item text-muted">Balita</li>
<li class="breadcrumb-item text-muted">Data Balita</li>
<li class="breadcrumb-item fw-bold">View Data</li>
@endsection

@section('content')

@php
$role = auth()->user()->role;
@endphp

<a href="{{ route($role.'.balita.index') }}" class="btn btn-light border">
    <i class="bi bi-arrow-left-short"></i>
    Kembali
</a>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4">
            <h2 class="fw-bold">{{ $balita->nama }}</h2>
            <table class="table">
                <tr>
                    <th style="width: 200px;">NIK</th>
                    <td class="fw-bold">{{ $balita->nik }}</td>
                </tr>
                <tr>
                    <th>Nama Ortu</th>
                    <td class="fw-bold">{{ $balita->nama_ortu }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td class="fw-bold">{{ $balita->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td class="fw-bold">{{ $balita->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td class="fw-bold">{{ $balita->alamat }}</td>
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
                        <th>BERAT</th>
                        <th>TINGGI</th>
                        <th>RIWAYAT KESEHATAN (IMUNISASI)</th>
                        <th>TANGGAL PERIKSA</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeriksaan as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->berat }} kg</td>
                        <td>{{ $data->tinggi }} cm</td>
                        <td>
                            @if($data->riwayat_kesehatan == 'Tidak ada' || empty($data->riwayat_kesehatan))
                            <span class="text-muted small">Tidak ada</span>
                            @else
                            {{-- Memecah string menjadi array berdasarkan koma untuk dijadikan badge --}}
                            @foreach(explode(', ', $data->riwayat_kesehatan) as $imun)
                            <span class="badge bg-info text-dark mb-1">{{ $imun }}</span>
                            @endforeach
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_pemeriksaan)->translatedFormat('d F Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
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