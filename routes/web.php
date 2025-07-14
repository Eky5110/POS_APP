<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Guest;

Route::get('/', function () {
    return view ('auth.login');
})->middleware('guest');
Route::post('/login', [LoginController::class, 'handleLogin'])->name('login')->middleware();

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/Logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('get-data')->as('get-data.')->group(function()
    {
        Route::get('/produk', [ProductController::class, 'getData'])->name('produk');
        Route::get('cek-stok-produk', [ProductController::class, 'cekStok'])->name('cek-stok');
    });

    Route::prefix('users')->as('users.')->controller(UserController::class)->group(function()
    {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        Route::post('/ganti-password', 'gantiPassword')->name('ganti-password');
        Route::post('/reset-password', 'resetPassword')->name('reset-password');

    });

    Route::prefix('master-data')->as('master-data.')->group(function(){
        Route::prefix('kategori')->as('kategori.')->controller(KategoriController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });
        Route::prefix('produk')->as('produk.')->controller(ProductController::class)->group(function(){
            Route::get('/','index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}/destroy','destroy')->name('destroy');
        });
    });

    Route::prefix('penerimaan-barang')->as('penerimaan-barang.')->controller(PenerimaanBarangController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

    Route::prefix('laporan')->as('laporan.')->group(function(){
        Route::prefix('penerimaan-barang')->as('penerimaan-barang.')->controller(PenerimaanBarangController::class)->group(function(){
            Route::get('/laporan','laporan')->name('laporan');
            Route::get('/lapran/{nomor_penerimaan}', 'detailLaporan')->name('detail-laporan');
        });
    });
});
