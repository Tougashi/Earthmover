<?php

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;

// Route Authentication
Route::middleware(['guest'])->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/', 'signin')->name('signin');
        Route::get('/signin', 'signin')->name('signin');
        Route::post('/authentication', 'auth')->name('auth');
        Route::get('/signup', 'registration')->name('registration');
        Route::post('/signup', 'signup')->name('signup');
    });
    Route::controller(ForgotPasswordController::class)->group(function(){
        Route::get('/forgot-password', 'showLinkRequestForm')->name('password.request');
        Route::post('/forgot-password', 'sendResetLinkEmail');
        Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
        Route::post('/reset-password', 'reset')->name('password.update');
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
        Route::prefix('orders')->group(function(){
            Route::controller(OrderController::class)->group(function(){
                Route::get('/{id}/destroy', 'destroy')->name('order.destroy');
            });
        });
        Route::prefix('customers')->group(function(){
            Route::controller(CustomerController::class)->group(function(){
                Route::put('/{id}/update', 'update')->name('customer.update');
                Route::get('/{id}/destroy', 'destroy')->name('customer.destroy');
            });
        }); 
        Route::controller(ViewController::class)->group(function(){
            Route::get('/invoice/{code}', 'invoice')->name('invoice');
            Route::get('/invoice/{code}/mail', 'invoiceMail')->name('invoice.mail');

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
                Route::put('/{id}/update', 'updateRole')->name('role.update');
                Route::get('/{id}/destroy', 'destroy')->name('user.destroy');
            });
        });
        Route::prefix('orders')->group(function(){
            Route::controller(OrderController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('admin.order.store');
                Route::get('/edit/{code}', 'store')->name('order.edit');
            });
        });
        Route::prefix('transactions')->group(function(){
            Route::controller(TransactionController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::get('/order/details', 'getOrderDetails')->name('getorderAdmin');
                Route::post('/add/store', 'store')->name('transaction.add');
                Route::get('/{id}/destroy', 'destroy')->name('transaction.destroy');
            });
        });
        Route::prefix('categories')->group(function(){
            Route::controller(CategoryController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('categories.add');
                Route::put('/update/{id}', 'update')->name('category.update');
                Route::get('/{id}/destroy', 'destroy')->name('category.destroy');
            });
        });
        Route::prefix('customers')->group(function(){
            Route::controller(CustomerController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('admin.customers.add');
            });
        }); 
        Route::prefix('suppliers')->group(function(){
            Route::controller(SupplierController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('supplier.add');
                Route::put('/{id}/update', 'update')->name('supplier.update');
                Route::get('/{id}/destroy', 'destroy')->name('supplier.destroy');
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
        Route::prefix('orders')->group(function(){
            Route::controller(OrderController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('cashier.order.store');
            });
        });
        Route::prefix('transactions')->group(function(){
            Route::controller(TransactionController::class)->group(function(){
                Route::get('/', 'index');
                 Route::get('/order/details', 'getOrderDetails')->name('getorderCashier');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('transaction.add');
                Route::get('/{id}/destroy', 'destroy')->name('transaction.destroy');
            });
        });
        Route::prefix('customers')->group(function(){
            Route::controller(CustomerController::class)->group(function(){
                Route::get('/', 'index');
                Route::get('/add', 'create');
                Route::post('/add/store', 'store')->name('cashier.customers.add');
            });
        }); 
    });
});