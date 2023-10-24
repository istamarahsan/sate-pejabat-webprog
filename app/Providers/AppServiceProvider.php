<?php

namespace App\Providers;

use App\Lib\CashflowService;
use App\Lib\StaffService;
use App\Lib\ReviewService;
use App\Lib\ProductService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('staffService', function () {
            return new StaffService();
        });
        $this->app->singleton('reviewService', function () {
            return new ReviewService();
        });
        $this->app->singleton('productService', function () {
            return new ProductService();
        });
        $this->app->singleton('cashflowService', function () {
            return new CashflowService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
