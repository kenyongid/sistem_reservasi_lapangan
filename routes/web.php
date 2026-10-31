<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LapanganController as AdminLapanganController;
use App\Http\Controllers\admin\ReservasiController;
use App\Http\Controllers\admin\ProdukController;

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('lapangan', AdminLapanganController::class);
        Route::resource('produk', ProdukController::class);

        Route::get('/reservasi', [ReservasiController::class, 'index'])
            ->name('reservasi.index');

        Route::get('/reservasi/{reservasi}', [ReservasiController::class, 'show'])
            ->name('reservasi.show');

        Route::put('/reservasi/{reservasi}/setujui', [ReservasiController::class, 'setujui'])
            ->name('reservasi.setujui');

        Route::put('/reservasi/{reservasi}/tolak', [ReservasiController::class, 'tolak'])
            ->name('reservasi.tolak');

        Route::get('/reservasi/{reservasi}/destroy', [ReservasiController::class, 'destroy'])
            ->name('reservasi.destroy');

        Route::get('/report', [DashboardController::class, 'report'])
            ->name('report');

        Route::get('/report/pdf', [DashboardController::class, 'exportPdf'])
            ->name('report.pdf');

        Route::get('/report/csv', [DashboardController::class, 'exportCsv'])
            ->name('report.csv');

        Route::get('/report/excel', [DashboardController::class, 'exportExcel'])
            ->name('report.excel');
    });


/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| LAPANGAN FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/lapangan', [LapanganController::class, 'index'])
    ->name('lapangan.index');

Route::get('/lapangan/{id}', [LapanganController::class, 'detail'])
    ->name('lapangan.detail');


/*
|--------------------------------------------------------------------------
| BOOKING / RESERVASI FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking.index');

Route::get('/booking/cari', [BookingController::class, 'cari'])
    ->name('booking.cari');

Route::get('/booking/{id}/tambahan', [BookingController::class, 'tambahan'])
    ->name('booking.tambahan');

Route::post('/booking/{id}/tambahan', [BookingController::class, 'simpantambahan'])
    ->name('booking.tambahan.simpan');

Route::get(
    '/booking/{lapangan}/slot-terpakai',
    [BookingController::class, 'slotTerpakai']
)->name('booking.slot.terpakai');

Route::get('/booking/{lapangan}', [BookingController::class, 'create'])
    ->name('booking.create');

Route::post('/booking', [BookingController::class, 'store'])
    ->name('booking.store');

Route::get('/booking/{id}/bukti', [BookingController::class, 'show'])
    ->name('booking.show');

Route::get('/booking/{id}/bukti/pdf', [BookingController::class, 'downloadPdf'])
    ->name('booking.pdf');
