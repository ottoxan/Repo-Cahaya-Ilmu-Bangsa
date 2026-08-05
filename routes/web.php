<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/login-redirect', '/admin/login')->name('login');
Route::redirect('/register-redirect', '/admin/register')->name('register');