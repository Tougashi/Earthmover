<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrasactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

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
        Route::controller(UserController::class)->group(function(){
            Route::get('/profile', 'edit')->name('user.profile');
            Route::put('/{id}/update', 'update')->name('user.update');
        });
});

// Route Admin 
Route::middleware(['auth', 'checkrole:1'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(ViewController::class)->group(function(){
            Route::get('/dashboard', 'index');
        });
        Route::prefix('products')->group(function(){
            Route::controller(ProductController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('products.add');
                Route::get('/{id}', 'show')->name('product.show');
                Route::get('/{id}/edit', 'edit')->name('product.edit');
                Route::put('/{id}/update', 'update')->name('product.update');
                Route::get('/{id}/destroy', 'destroy')->name('product.destroy');
            });
        });
        Route::prefix('users')->group(function(){
            Route::controller(UserController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('users.add');
                // Route::put('/{id}/update', 'update')->name('user.update');
                Route::put('/{id}/update', 'updateRole')->name('role.update');
                Route::get('/{id}/destroy', 'destroy')->name('user.destroy');
            });
        });
    });
});

// Route Kasir
Route::middleware(['auth', 'checkrole:2'])->group(function(){
    Route::prefix('cashier')->group(function(){
        Route::controller(ViewController::class)->group(function(){
            Route::get('/dashboard', 'index');
        });
        Route::prefix('products')->group(function(){
            Route::controller(ProductController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
            });
        });
    });
});