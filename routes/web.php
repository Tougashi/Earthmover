<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware([])->group(function () {
    Route::controller(AuthController::class)->group( function(){
        Route::get('/', 'login')->name('login');
        Route::get('/login', 'login')->name('login');
        Route::post('/authentication', 'auth')->name('auth');
    });
});

Route::middleware(['auth', 'checkrole:1'])->group(function () {
    Route::controller(ViewController::class)->group(function(){
        Route::get('/dashboard', 'index');
        // Route::post('/orders', 'store');
    });
});