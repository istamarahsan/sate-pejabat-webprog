<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class SeederServiceProvider extends ServiceProvider
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
        if (App::runningInConsole()) {
            return;
        }

        if (DB::table('users')->where('user_type', 'admin')->count() == 0) {
            $now = Date::now();
            DB::table('users')->insert([
                'id' => 1,
                'password' => Hash::make('admin'),
                'user_type' => 'admin',
                'created_at' => $now,
            ]);
        }

        if (DB::table('branches')->count() == 0) {
            DB::table('branches')->insert([
                'id' => 0,
                'name' => 'Null Branch'
            ]);
        }

        if (DB::table('staff_roles')->count() == 0) {
            DB::table('staff_roles')->insert([
                'id' => 0,
                'name' => 'Null Role'
            ]);
        }
    }
}
