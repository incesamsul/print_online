<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\General;
use App\Http\Controllers\Home;
use App\Http\Controllers\Payment\TripayCallbackController;
use App\Http\Controllers\Payment\TripayController;
use App\Http\Controllers\Penilai;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::post('/postRegistrasi', [LoginController::class, 'postRegistrasi']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/', [Home::class, 'beranda']);
Route::get('/detail/{id_produk}', [Admin::class, 'detailProduk']);
Route::get('/cart', [Home::class, 'cart']);

Route::get('/tentang_aplikasi', [Home::class, 'tentangAplikasi']);

Route::post('/callback', [TripayCallbackController::class, 'handle']);

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/registrasi', [LoginController::class, 'registrasi']);
});

// GENERAL CONTROLLER ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator,user']], function () {

    Route::get('/dashboard', [General::class, 'dashboard']);
    Route::get('/profile', [General::class, 'profile']);
    Route::get('/bantuan', [General::class, 'bantuan']);

    Route::post('/ubah_foto_profile', [General::class, 'ubahFotoProfile']);
    Route::post('/ubah_role', [General::class, 'ubahRole']);
});

// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:user']], function () {
    Route::post('/add-to-cart/{id_produk}', [UserController::class, 'addToCart']);
    Route::get('/remove-from-cart/{id_cart}', [UserController::class, 'removeFromCart']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/detail_transaksi/{reference}', [TransaksiController::class, 'detailTransaksi']);
});


// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator']], function () {
    Route::group(['prefix' => 'admin'], function () {
        // GET REQUEST
        Route::get('/pengguna', [Admin::class, 'pengguna']);
        Route::get('/fetch_data', [Admin::class, 'fetchData']);
        Route::get('/kategori', [Admin::class, 'kategori']);
        Route::get('/transaksi', [Admin::class, 'transaksi']);
        Route::get('/produk', [Admin::class, 'produk']);

        // CRUD PRODUK
        Route::post('/simpan_produk', [Admin::class, 'simpanProduk']);
        Route::post('/delete_produk', [Admin::class, 'deleteProduk']);

        // CRUD PENGGUNA
        Route::post('/create_pengguna', [Admin::class, 'createPengguna']);
        Route::post('/update_pengguna', [Admin::class, 'updatePengguna']);
        Route::post('/delete_pengguna', [Admin::class, 'deletePengguna']);
    });
});
