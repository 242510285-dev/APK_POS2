<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [Authcontroller::class, 'index'])->name('login');
    Route::post('/auth', [Authcontroller::class, 'auth'])->name('auth');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/logout', [Authcontroller::class, 'logout'])
        ->name('logout');


    // =========================================================
    // KHUSUS ADMIN
    // =========================================================

    Route::middleware('role:admin')->group(function () {

        // =========================
        // USER
        // =========================

        Route::get('/admin/users', [UserController::class, 'index'])
            ->name('admin.users');

        Route::get('/admin/users/create', [UserController::class, 'create'])
            ->name('admin.users.create');

        Route::post('/admin/users/store', [UserController::class, 'store'])
            ->name('admin.users.store');

        Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])
            ->name('admin.users.edit');

        // UPDATE USER
        Route::put('/admin/users/update/{user}', [UserController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('/admin/users/destroy/{user}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');


        // =========================
        // PRODUK
        // =========================
        //
        // HANYA ADMIN YANG BOLEH:
        // - melihat daftar produk
        // - membuka form tambah produk
        // - menyimpan produk baru
        // - melihat detail produk
        // - membuka form edit produk
        // - mengupdate produk
        // - menghapus produk
        //
        // Route::resource ini menghasilkan:
        //
        // produk.index
        // produk.create
        // produk.store
        // produk.show
        // produk.edit
        // produk.update
        // produk.destroy
        //
        // Jadi route('produk.create') yang ada di
        // resources/views/produk/index.blade.php
        // tetap tersedia.
        //

        Route::resource('/produk', ProdukController::class);

    });


    // =========================================================
    // ADMIN DAN KASIR
    // =========================================================
    //
    // BAGIAN INI DIGUNAKAN UNTUK:
    // - melihat produk
    // - transaksi penjualan
    // - item penjualan
    //
    // KASIR TIDAK MENDAPATKAN AKSES:
    // - produk.create
    // - produk.store
    // - produk.show
    // - produk.edit
    // - produk.update
    // - produk.destroy
    //
    // Karena route tersebut sudah berada di middleware role:admin
    // di atas.
    //

    Route::middleware('role:admin,kasir')->group(function () {

        // =========================
        // PRODUK
        // =========================
        //
        // Admin dan kasir hanya dapat membuka
        // halaman daftar produk.
        //
        // Route ini tidak boleh menggunakan
        // Route::resource lagi karena akan membuat
        // route produk menjadi duplikat.
        //

        Route::get('/produk', [ProdukController::class, 'index'])
            ->name('produk.index');


        // =========================
        // PENJUALAN
        // =========================

        Route::resource('/penjualan', PenjualanController::class);


        // =========================
        // ITEM PENJUALAN
        // =========================

        Route::resource('/itempenjualan', ItemPenjualanController::class);

    });

});