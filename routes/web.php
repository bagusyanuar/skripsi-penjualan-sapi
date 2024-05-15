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

Route::get('/', function () {
    return view('member.beranda');
});

Route::group(['prefix' => 'admin'], function () {
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
        Route::get('/add', [\App\Http\Controllers\Admin\ProductController::class, 'add'])->name('admin.product.add');
    });
});
