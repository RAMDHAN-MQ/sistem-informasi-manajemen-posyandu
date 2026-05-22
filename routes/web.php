<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page');
});


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
        });

    // ibu hamil
    Route::controller(IbuHamilController::class)->group(function () {
        Route::get('/ibuhamil', 'index')->name('admin.ibu.index');
    });
});

// kader
Route::prefix('kader')->middleware(['auth', 'role:kader'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard_kader')->name('kader.dashboard');
    });
});
