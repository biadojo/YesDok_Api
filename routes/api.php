<?php

use App\Http\Controllers\Cashier\BarangCashierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Cashier\LoginCashierController;
use App\Http\Controllers\Staff\LoginStaffController;
use App\Http\Controllers\Staff\ProdukStaffController;
use App\Http\Controllers\Supervisor\LoginSupervisorController;
use App\Http\Controllers\Supervisor\ProdukSupervisorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Cashier */
Route::prefix('cashier')->group(function () {
    Route::post('/login',  [LoginCashierController::class, 'login']);

    Route::group([ 'middleware' => 'jwt.verify'], function () {
        Route::get('/list-produk',  [BarangCashierController::class, 'getproduk']);
        Route::get('/list-produk-ditolak',  [BarangCashierController::class, 'ListProdukTolak']);
        Route::get('/list-produk-verifikasi',  [BarangCashierController::class, 'ListProdukVerifikasi']);
        Route::post('/tambah-produk', [BarangCashierController::class, 'AddProduk']);
        Route::post('/ubah-produk/{id}', [BarangCashierController::class, 'UpdateProduk']);

    });
        
});

/* Supervisor */
Route::prefix('supervisor')->group(function () {
    Route::post('/login',  [LoginSupervisorController::class, 'login']);

    Route::group([ 'middleware' => 'jwt.verify'], function () {
        Route::get('/list-produk',  [ProdukSupervisorController::class, 'getproduk']);
        Route::get('/list-produk-terverifikasi',  [ProdukSupervisorController::class, 'ListprodukVerifikasi']);
        Route::post('/verifikasi-produk/{id}', [ProdukSupervisorController::class, 'VerikasiProduk']);
    });

});

/* Staff */
Route::prefix('staff')->group(function () {
    Route::post('/login',  [LoginStaffController::class, 'login']);

    Route::group([ 'middleware' => 'jwt.verify'], function () {
        Route::get('/list-produk',  [ProdukStaffController::class, 'getproduk']);

    });

});

