<?php

namespace App\Providers;

use App\Lib\Staff\StaffService as StaffStaffService;
use Illuminate\Support\ServiceProvider;
use StaffService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('staffService', function () {
            return new StaffStaffService();
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
