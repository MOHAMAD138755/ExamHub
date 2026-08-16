<?php

use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;

Route::prefix('/')->group(function () {
    Route::livewire('/', 'home.home-page')->name('home');
    Route::middleware('auth')->group(function () {
        Route::livewire('/exams', 'exams.exam-list')->name('exams.list');
        Route::livewire('/exams/my-exams', 'exams.my-exams')->name('exams.my-exams');
        Route::get('/user-logout', [LogoutController::class,'logout'])->name('user_logout');
    });
});

Route::middleware('guest')->group(function (){
    Route::livewire('/login', 'auth.login')->name('login');
    Route::livewire('/verify', 'auth.verify')->name('verify');
});

Route::middleware('auth')->group(function (){
    Route::middleware(AdminCheck::class)->prefix('dashboard')->group(function (){
        Route::livewire('/', 'dashboard.index')->name('dashboard.index');
        Route::livewire('/users', 'dashboard.user.user-list')->name('dashboard.users');
        Route::livewire('/tests', 'dashboard.tests.tests-list')->name('dashboard.tests.list');
        Route::livewire('tests/{exam}/questions', 'dashboard.questions.questions-list')->name('dashboard.questions.list');
        Route::livewire('/question-bank', 'dashboard.questions.bank-list')->name('dashboard.questions.bank');
    });
    Route::livewire('/logout', 'auth.logout')->name('logout');
});

