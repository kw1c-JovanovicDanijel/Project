<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? to_route('dashboard') : view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/test', function () {
    return view('components.test');
})->name('test');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/companyorders', function () {
    return view('companyorders');
})->name('companyorders');

Route::get('/invoices', function () {
    return view('invoices');
})->name('invoices');

Route::get('/suppliers', function () {
    return view('suppliers');
})->name('suppliers');

Route::get('/customers', function () {
    return view('customers');
})->name('customers');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::view('/dashboard','dashboard')->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tinker', function () {
    dd();
});
