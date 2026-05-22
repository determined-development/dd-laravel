<?php

use App\Http\Controllers\Auth;

Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'pages::auth.login')
        ->name('login');
    Route::livewire('/forgot-password', 'pages::auth.forgot-password')
        ->name('password.request');
    Route::livewire('/reset-password/{token}', 'pages::auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', Auth\LogoutController::class)
        ->name('logout');
    Route::livewire('/email/verify', 'pages::auth.verify-email')
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', Auth\VerifyEmailController::class)
        ->middleware('signed')
        ->name('verification.verify');
});
