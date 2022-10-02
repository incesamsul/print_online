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
Route::get('/beranda', [Home::class, 'beranda']);
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/about_us', [Home::class, 'aboutUs']);
Route::get('/detail/{id_produk}', [Admin::class, 'detailProduk']);
Route::get('/cart', [Home::class, 'cart']);
Route::get('/like', [Home::class, 'like']);

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

    Route::post('/ubah_password', [General::class, 'ubahPassword']);
    Route::post('/ubah_foto_profile', [General::class, 'ubahFotoProfile']);
    Route::post('/ubah_role', [General::class, 'ubahRole']);
});

// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:user']], function () {
    Route::post('/add-to-cart/{id_produk}', [UserController::class, 'addToCart']);
    Route::get('/like/{id_produk}', [UserController::class, 'like']);
    Route::get('/unlike/{id_produk}', [UserController::class, 'unlike']);
    Route::get('/remove-from-cart/{id_cart}', [UserController::class, 'removeFromCart']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/detail_transaksi/{reference}', [TransaksiController::class, 'detailTransaksi']);
    Route::get('/my_account', [UserController::class, 'myAccount']);
    Route::get('/my_print', [UserController::class, 'myPrint']);
    Route::get('/print/{id_print_list}', [UserController::class, 'print']);
    Route::get('/my_transaksi', [UserController::class, 'myTransaksi']);
    Route::get('/hitung_total_pembayaran/{file}/{id_cart}', [UserController::class, 'hitungTotalPembayaran']);
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
        Route::get('/list_print/{id_produk}', [Admin::class, 'listPrint']);
        Route::get('/print_proses/{id_produk}', [Admin::class, 'printProses']);
        Route::get('/print_selesai/{id_produk}', [Admin::class, 'printSelesai']);
        Route::get('/get_data_antrian/{id_produk}', [Admin::class, 'getDataAntrian']);
        Route::get('/get_data_proses/{id_produk}', [Admin::class, 'getDataProses']);
        Route::get('/update_print_status/{id_print_list}', [Admin::class, 'updatePrintStatus']);
        Route::get('/update_print_status_selesai/{id_print_list}', [Admin::class, 'updatePrintStatusSelesai']);

        // CRUD PRODUK
        Route::post('/simpan_produk', [Admin::class, 'simpanProduk']);
        Route::post('/ubah_produk', [Admin::class, 'ubahProduk']);
        Route::post('/delete_produk', [Admin::class, 'deleteProduk']);

        // CRUD PENGGUNA
        Route::post('/create_pengguna', [Admin::class, 'createPengguna']);
        Route::post('/update_pengguna', [Admin::class, 'updatePengguna']);
        Route::post('/delete_pengguna', [Admin::class, 'deletePengguna']);
    });
});
