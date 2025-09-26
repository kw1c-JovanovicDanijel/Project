<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? to_route('dashboard') : view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'create'])->middleware(['guest'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware(['guest'])->name('login');
Route::post('/logout', LogoutController::class)->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('/products', [ProductController::class, 'index'])->name('products');


    Route::view('/orders', 'orders')->name('orders');
    Route::view('/companyorders', 'companyorders')->name('companyorders');
    Route::view('/invoices', 'invoices')->name('invoices');
});

Route::get('/tinker', function () {

    dd();
});
