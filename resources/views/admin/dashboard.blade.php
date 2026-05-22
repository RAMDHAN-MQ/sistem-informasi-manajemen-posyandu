@extends('layouts.master')

@section('title', 'Dashboard Admin')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">
    Main Menu
</li>
<li class="breadcrumb-item fw-bold">
    Dashboard
</li>
@endsection

@section('content')

<h2 class="fw-bold">Selamat Datang, <span class="text-primary">{{ auth()->user()->name }}</span></h2>
<div class="row my-4">
    <div class="col-3">
        <div class="card p-5 shadow-sm"></div>
    </div>
    <div class="col-3">
        <div class="card p-5 shadow-sm"></div>
    </div>
    <div class="col-3">
        <div class="card p-5 shadow-sm"></div>
    </div>
    <div class="col-3">
        <div class="card p-5 shadow-sm"></div>
    </div>
</div>
<div class="row my-4">
    <div class="col-12">
        <div class="card p-5 shadow-sm"></div>
    </div>
</div>
<div class="row my-4">
    <div class="col-6">
        <div class="card p-5 shadow-sm"></div>
    </div>
    <div class="col-6">
        <div class="card p-5 shadow-sm"></div>
    </div>
</div>

@endsection

@push('scripts')
@endpush