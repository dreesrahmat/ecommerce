<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\TestimoniController;
use App\Http\Controllers\Api\SubKategoriController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function() {
    Route::post('admin', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group([
    'middleware' => 'api',
], function() {
    Route::resource('kategori', KategoriController::class);

    Route::resource('subkategori', SubKategoriController::class);

    Route::resource('slider', SliderController::class);

    Route::resource('produk', ProdukController::class);

    Route::resource('member', MemberController::class);

    Route::resource('testimoni', TestimoniController::class);

    Route::resource('review', ReviewController::class);

    Route::resource('payment', PaymentController::class);

    Route::resource('order', OrderController::class);
    Route::get('pesanan/baru', [OrderController::class, 'baru']);
    Route::get('pesanan/dikonfirmasi', [OrderController::class, 'pesanan_dikonfirmasi']);
    Route::get('pesanan/dikemas', [OrderController::class, 'pesanan_dikemas']);
    Route::get('pesanan/dikirim', [OrderController::class, 'pesanan_dikirim']);
    Route::get('pesanan/diterima', [OrderController::class, 'pesanan_diterima']);
    Route::get('pesanan/selesai', [OrderController::class, 'pesanan_selesai']);
    Route::post('pesanan/status/{order}', [OrderController::class, 'ubah_status']);

    Route::get('report', [ReportController::class, 'index']);
});
