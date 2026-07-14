<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/login', 'auth.login')->name('login');
Route::livewire('/verify', 'auth.verify')->name('verify');
