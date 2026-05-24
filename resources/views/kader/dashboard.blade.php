@extends('layouts.master')

@section('title', 'Dashboard Kader')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Main Menu</li>
<li class="breadcrumb-item fw-bold">Dashboard Kader</li>
@endsection

@section('content')

<h2 class="fw-bold mb-4">Selamat Datang, <span class="text-primary">{{ auth()->user()->name }}</span></h2>

<div class="row my-4">
    <div class="col-md-3">
        <div class="card p-4 shadow-sm border-0 border-start border-primary border-4 rounded-3 h-100">
            <p class="text-muted fw-bold mb-1">Total Balita</p>
            <h2 class="fw-bold mb-0 text-primary">{{ $jumlahBalita }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 shadow-sm border-0 border-start border-success border-4 rounded-3 h-100">
            <p class="text-muted fw-bold mb-1">Total Ibu Hamil</p>
            <h2 class="fw-bold mb-0 text-success">{{ $jumlahIbuHamil }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 shadow-sm border-0 border-start border-warning border-4 rounded-3 h-100">
            <p class="text-muted fw-bold mb-1">Kegiatan Akan Datang</p>
            <h2 class="fw-bold mb-0 text-warning">{{ $kegiatanAkanDatang }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 shadow-sm border-0 border-start border-info border-4 rounded-3 h-100">
            <p class="text-muted fw-bold mb-1">Kegiatan Selesai</p>
            <h2 class="fw-bold mb-0 text-info">{{ $kegiatanSelesai }}</h2>
        </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4 shadow-sm border-0 rounded-3">
            <h5 class="fw-bold mb-4">Grafik Status Gizi Balita</h5>
            <canvas id="grafikGiziBalita" height="80"></canvas>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('grafikGiziBalita');
        if(ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Balita Sehat',
                            data: @json($dataSehat),
                            backgroundColor: 'rgba(25, 135, 84, 0.8)',
                            borderRadius: 4
                        },
                        {
                            label: 'Stunting / Risiko',
                            data: @json($dataStunting),
                            backgroundColor: 'rgba(220, 53, 69, 0.8)',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }
    });
</script>
@endpush