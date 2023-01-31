<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\SubKategoriController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('kategoris', KategoriController::class);

Route::resource('subkategoris', SubKategoriController::class);

Route::resource('members', MemberController::class);

Route::resource('sliders', SliderController::class);

Route::resource('produks', ProdukController::class);

Route::resource('testimonis', TestimoniController::class);

Route::resource('reviews', ReviewController::class);

Route::resource('orders', OrderController::class);
Route::get('order/dikonfirmasi', [OrderController::class, 'pesanan_dikonfirmasi'])->name('order.dikonfirmasi');
Route::get('order/dikemas', [OrderController::class, 'pesanan_dikemas'])->name('order.dikemas');
Route::get('order/dikirim', [OrderController::class, 'pesanan_dikirim'])->name('order.dikirim');
Route::get('order/diterima', [OrderController::class, 'pesanan_diterima'])->name('order.diterima');
Route::get('order/selesai', [OrderController::class, 'pesanan_selesai'])->name('order.selesai');
Route::post('order/status/{order}', [OrderController::class, 'ubah_status'])->name('order.ubah');

Route::resource('reports', ReportController::class);

Route::resource('pembayaran', PaymentController::class);


