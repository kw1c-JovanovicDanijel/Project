<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/tinker', function () {
    User::factory(5)->create();
    $users = User::get();
    dd($users);
});
