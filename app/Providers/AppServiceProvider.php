<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('customPassword', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/(?=.*[A-Z])(?=.*[0-9\W]).+/', $value);
        });
        Validator::replacer('customPassword', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Password must be 8 in length and have Capital Letters and at least 1 Number or Symbol');
        });
    }
}
