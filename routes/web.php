<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/test', function () {
    return view('components.test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/tinker', function () {
    dd();
});
