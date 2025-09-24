<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? to_route('dashboard') : view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'create'])->middleware(['guest'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware(['guest'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');

    Route::view('/orders', 'orders')->name('orders');
    Route::view('/companyorders', 'companyorders')->name('companyorders');
    Route::view('/invoices', 'invoices')->name('invoices');
    Route::view('/suppliers', 'suppliers')->name('suppliers');

    Route::view('/products', 'products')->name('products');
});

Route::get('/tinker', function () {

    dd();
});
