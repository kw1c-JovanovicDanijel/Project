<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::logout();

        return to_route('home');
    }
}
