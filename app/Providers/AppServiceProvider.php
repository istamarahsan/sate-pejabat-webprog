<?php

namespace App\Providers;

use App\Lib\Branch\BranchService;
use App\Lib\Staff\StaffService;
use App\Lib\Customer\ReviewService;
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
        $this->app->singleton('branchService', function () {
            return new BranchService();
        });
        $this->app->singleton('reviewService', function () {
            return new ReviewService();
        });
        $this->app->singleton('productService', function() {
            return new ProductService();
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
