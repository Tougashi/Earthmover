<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\AuthController;

// Route Authentication
Route::middleware(['guest'])->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/', 'signin')->name('signin');
        Route::get('/signin', 'signin')->name('signin');
        Route::post('/authentication', 'auth')->name('auth');
        Route::get('/signup', 'registration')->name('registration');
        Route::post('/signup', 'signup')->name('signup');
    });
});

// Route auth
Route::middleware(['auth'])->group(function(){
        Route::controller(AuthController::class)->group(function(){
            Route::get('/signout', 'signout')->name('signout');
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
        Route::controller(CashierController::class)->group(function(){
            Route::get('/dashboard', 'index');
        });
    });
});