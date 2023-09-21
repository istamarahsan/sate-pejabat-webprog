<?php

namespace App\Providers;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class DefaultAdminServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        if (DB::table('users')->where('user_type', 'admin')->count() == 0) {
            $now = Date::now();
            DB::table('users')->insert([
                'id' => 1,
                'password' => Hash::make('admin'),
                'user_type' => 'admin',
                'created_at' => $now,
            ]);
        }
    }
}
