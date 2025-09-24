<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // TODO: replace first home with dashboard
    return Auth::check() ? view('home') : view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/test', function () {
    return view('components.test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/tinker', function () {
    dd();
});
