<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use jcubic\Expression;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Expression::class, fn() => new Expression());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
