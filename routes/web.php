<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);


Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

// admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
    });

    // balita
    Route::controller(BalitaController::class)->group(function () {
        Route::get('/balita', 'index')->name('admin.balita.index');
        Route::get('/balita/create', 'create')->name('admin.balita.create');
        Route::post('/balita/store', 'store')->name('admin.balita.store');
        Route::delete('/balita/destroy/{id}', 'destroy')->name('admin.balita.destroy');
        Route::get('/balita/edit/{id}', 'edit')->name('admin.balita.edit');
        Route::put('/balita/update/{id}', 'update')->name('admin.balita.update');
        Route::get('/balita/view/{id}', 'view')->name('admin.balita.view');

        Route::get('/balita/pemeriksaan/create', 'create_pemeriksaan')->name('admin.balita.pemeriksaan.create');
        Route::post('/balita/pemeriksaan/store', 'store_pemeriksaan')->name('admin.balita.pemeriksaan.store');
    });

    // ibu hamil
    Route::controller(IbuHamilController::class)->group(function () {
        Route::get('/ibuhamil', 'index')->name('admin.ibu.index');
        Route::get('/ibuhamil/create', 'create')->name('admin.ibu.create');
        Route::post('/ibuhamil/store', 'store')->name('admin.ibu.store');
        Route::delete('/ibuhamil/destroy/{id}', 'destroy')->name('admin.ibu.destroy');
        Route::get('/ibuhamil/edit/{id}', 'edit')->name('admin.ibu.edit');
        Route::put('/ibuhamil/update/{id}', 'update')->name('admin.ibu.update');
        Route::get('/ibuhamil/view/{id}', 'view')->name('admin.ibu.view');

        Route::get('/ibuhamil/pemeriksaan/create', 'create_pemeriksaan')->name('admin.ibu.pemeriksaan.create');
        Route::post('/ibuhamil/pemeriksaan/store', 'store_pemeriksaan')->name('admin.ibu.pemeriksaan.store');

        Route::get('/ibuhamil/tensi/create', 'create_tensi')->name('admin.ibu.tensi.create');
        Route::post('/ibuhamil/tensi/store', 'store_tensi')->name('admin.ibu.tensi.store');
    });

    // imunisasi
    Route::controller(ImunisasiController::class)->group(function () {
        Route::get('/imunisasi', 'index')->name('admin.imunisasi.index');
        Route::post('/imunisasi', 'store')->name('admin.imunisasi.store');
        Route::put('/imunisasi/{id}', 'update')->name('admin.imunisasi.update');
        Route::delete('/imunisasi/destroy/{id}', 'destroy')->name('admin.imunisasi.destroy');
    });

    // pegawai
    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/pegawai', 'index')->name('admin.pegawai.index');
        Route::get('/pegawai/create', 'create')->name('admin.pegawai.create');
        Route::post('/pegawai/store', 'store')->name('admin.pegawai.store');
        Route::delete('/pegawai/destroy/{id}', 'destroy')->name('admin.pegawai.destroy');
        Route::get('/pegawai/edit/{id}', 'edit')->name('admin.pegawai.edit');
        Route::put('/pegawai/update/{id}', 'update')->name('admin.pegawai.update');
        Route::get('/pegawai/view/{id}', 'view')->name('admin.pegawai.view');
    });

    // jadwal
    Route::controller(JadwalController::class)->group(function () {
        Route::get('/layanan', 'index')->name('admin.layanan.index');
        Route::get('/layanan/create', 'create')->name('admin.layanan.create');
        Route::post('/layanan/store', 'store')->name('admin.layanan.store');
        Route::delete('/layanan/destroy/{id}', 'destroy')->name('admin.layanan.destroy');
        Route::get('/layanan/edit/{id}', 'edit')->name('admin.layanan.edit');
        Route::put('/layanan/update/{id}', 'update')->name('admin.layanan.update');
        Route::get('/layanan/view/{id}', 'view')->name('admin.layanan.view');
        Route::post('/layanan/status/{id}', 'change_status')->name('admin.layanan.change_status');
    });

    // pengumuman
    Route::controller(PengumumanController::class)->group(function () {
        Route::get('/pengumuman', 'index')->name('admin.pengumuman.index');
        Route::post('/pengumuman', 'store')->name('admin.pengumuman.store');
        Route::put('/pengumuman/{id}', 'update')->name('admin.pengumuman.update');
        Route::delete('/pengumuman/destroy/{id}', 'destroy')->name('admin.pengumuman.destroy');
        Route::post('/pengumuman/status/{id}', 'change_status')->name('admin.pengumuman.change_status');
    });
});

// kader
Route::prefix('kader')->middleware(['auth', 'role:kader'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard_kader')->name('kader.dashboard');
    });

    Route::controller(BalitaController::class)->group(function () {
        Route::get('/balita', 'index')->name('kader.balita.index');
        Route::get('/balita/view/{id}', 'view')->name('kader.balita.view');
        Route::get('/balita/pemeriksaan/create', 'create_pemeriksaan')->name('kader.balita.pemeriksaan.create');
        Route::post('/balita/pemeriksaan/store', 'store_pemeriksaan')->name('kader.balita.pemeriksaan.store');
    });

    Route::controller(IbuHamilController::class)->group(function () {
        Route::get('/ibuhamil', 'index')->name('kader.ibu.index');
        Route::get('/ibuhamil/view/{id}', 'view')->name('kader.ibu.view');
        Route::get('/ibuhamil/pemeriksaan/create', 'create_pemeriksaan')->name('kader.ibu.pemeriksaan.create');
        Route::post('/ibuhamil/pemeriksaan/store', 'store_pemeriksaan')->name('kader.ibu.pemeriksaan.store');
    });
});
