<?php

use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (){
    Route::livewire('/login', 'auth.login')->name('login');
    Route::livewire('/verify', 'auth.verify')->name('verify');
});

Route::middleware('auth')->group(function (){
    Route::middleware(AdminCheck::class)->prefix('dashboard')->group(function (){
        Route::livewire('/', 'dashboard.index')->name('dashboard.index');
        Route::livewire('/users', 'dashboard.user.user-list')->name('dashboard.users');
    });
    Route::livewire('/logout', 'auth.logout')->name('logout');
});

