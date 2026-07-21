<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {\Illuminate\Support\Facades\Auth::logout();dd(auth()->check());
    return view('welcome');
});

Route::middleware('guest')->group(function (){
    Route::livewire('/login', 'auth.login')->name('login');
    Route::livewire('/verify', 'auth.verify')->name('verify');
});

Route::livewire('/dashboard', 'dashboard.index')->name('dashboard.index');
