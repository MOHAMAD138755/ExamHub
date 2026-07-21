<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (){
    Route::livewire('/login', 'auth.login')->name('login');
    Route::livewire('/verify', 'auth.verify')->name('verify');
});

Route::middleware('auth')->group(function (){
    Route::livewire('/dashboard', 'dashboard.index')->name('dashboard.index');
    Route::livewire('/logout', 'auth.logout')->name('logout');
});

