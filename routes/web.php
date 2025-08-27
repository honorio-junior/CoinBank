<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');

Route::get('/login', [LoginController::class, 'showView'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/register', [RegisterController::class, 'showView'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [HomeController::class, 'showView'])->name('home');
    Route::get('/home/new-account', [HomeController::class, 'newAccount'])->name('new-account');

    Route::post('/home/transfer', [TransferController::class, 'transfer'])->name('transfer');
});
