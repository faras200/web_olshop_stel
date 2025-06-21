<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductReviewController;

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
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', [DashboardController::class, 'index'])->name('home');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    //category
    Route::resource('category', \App\Http\Controllers\CategoryController::class);
    //product
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    //order
    Route::resource('order', \App\Http\Controllers\OrderController::class);

    Route::resource('product-review', ProductReviewController::class);

    Route::get('alamat/{user}', [AddressController::class, 'showOrForm'])->name('address.form');
    Route::post('alamat/{user}', [AddressController::class, 'storeOrUpdate'])->name('address.save');
});
