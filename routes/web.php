<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/article/{slug?}', function ($slug = null) {
    return view('articles.show', ['slug' => $slug]);
})->name('article.show');

Route::redirect('/login-redirect', '/admin/login')->name('login');
Route::redirect('/register-redirect', '/admin/register')->name('register');