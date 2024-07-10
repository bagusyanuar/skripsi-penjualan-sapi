<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Member\HomeController::class, 'index'])->name('member.home');
Route::match(['post', 'get'], '/login', [\App\Http\Controllers\Member\AuthController::class, 'login'])->name('member.login');
Route::get( '/logout', [\App\Http\Controllers\Member\AuthController::class, 'logout'])->name('member.logout');
Route::match(['post', 'get'], '/register', [\App\Http\Controllers\Member\AuthController::class, 'register'])->name('member.register');

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [\App\Http\Controllers\Member\ProductController::class, 'index'])->name('member.product');
    Route::get('/{id}', [\App\Http\Controllers\Member\ProductController::class, 'detail'])->name('member.product.detail');
});

Route::group(['prefix' => 'keranjang'], function () {
    Route::match(['post', 'get'], '/', [\App\Http\Controllers\Member\CartController::class, 'index'])->name('member.cart');
    Route::post('/checkout', [\App\Http\Controllers\Member\CartController::class, 'checkout'])->name('member.checkout');
    Route::post('/{id}/delete', [\App\Http\Controllers\Member\CartController::class, 'delete'])->name('member.delete');
});

Route::group(['prefix' => 'pesanan'], function () {
    Route::match(['post', 'get'], '/', [\App\Http\Controllers\Member\PesananController::class, 'index'])->name('member.order');
    Route::get('/{id}', [\App\Http\Controllers\Member\PesananController::class, 'detail'])->name('member.order.detail');
    Route::match(['post', 'get'],'/{id}/pembayaran', [\App\Http\Controllers\Member\PesananController::class, 'pembayaran'])->name('member.order.payment');
});

Route::group(['prefix' => 'admin'], function () {
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
    Route::get( '/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'pengguna'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('admin.pengguna');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\PenggunaController::class, 'add'])->name('admin.pengguna.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'delete'])->name('admin.pengguna.delete');
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.category');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\KategoriController::class, 'add'])->name('admin.category.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('admin.category.edit');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\ProductController::class, 'add'])->name('admin.product.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    });

    Route::group(['prefix' => 'pesanan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\PesananController::class, 'index'])->name('admin.order');
        Route::match(['post', 'get'],'/{id}/pesanan-baru', [\App\Http\Controllers\Admin\PesananController::class, 'detail_new'])->name('admin.order.new');
        Route::match(['post', 'get'],'/{id}/pesanan-check', [\App\Http\Controllers\Admin\PesananController::class, 'detail_check'])->name('admin.order.check');
        Route::match(['post', 'get'],'/{id}/pesanan-proses', [\App\Http\Controllers\Admin\PesananController::class, 'detail_process'])->name('admin.order.process');
        Route::match(['post', 'get'],'/{id}/pesanan-dikirim', [\App\Http\Controllers\Admin\PesananController::class, 'detail_delivery'])->name('admin.order.delivery');
        Route::match(['post', 'get'],'/{id}/pesanan-selesai', [\App\Http\Controllers\Admin\PesananController::class, 'detail_finish'])->name('admin.order.finish');
    });

    Route::group(['prefix' => 'laporan-penjualan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.report');
        Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'pdf'])->name('admin.report.print');
    });
});
