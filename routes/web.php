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

Route::group(['prefix' => 'admin'], function () {
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
        Route::match(['post', 'get'],'/add', [\App\Http\Controllers\Admin\ProductController::class, 'add'])->name('admin.product.add');
        Route::match(['post', 'get'],'/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    });
});
