<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AuthController;

// Route Authentication
Route::middleware([])->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/', 'login')->name('login');
        Route::get('/login', 'login')->name('login');
        Route::post('/authentication', 'auth')->name('auth');
        Route::get('/registrasi', 'registrasi')->name('registrasi');
        Route::post('/registrasi', 'signup')->name('signup');
    });
});

// Route Admin 
Route::middleware(['auth', 'checkrole:1'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard', 'index');
        });
    });
});

// Route Kasir
Route::middleware(['auth', 'checkrole:2'])->group(function(){
    Route::prefix('kasir')->group(function(){
        Route::controller(KasirController::class)->group(function(){
            Route::get('/dashboard', 'index');
        });
    });
});