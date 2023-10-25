<?php

use App\Http\Controllers\AddReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AddStaffController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\EditStaffController;
use App\Http\Controllers\ManageStaffController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'review');

Route::prefix('auth')
    ->name('login')
    ->group(function () {
        Route::get('login', [LoginController::class, 'get']);
        Route::post('login', [LoginController::class, 'authenticate']);
    });

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::name('reviews')->group(function () {
            Route::get('reviews', [ReviewsController::class, 'get']);
        });
        Route::name('staff.')
            ->group(function () {
                Route::name('add')
                    ->group(function () {
                        Route::get('addstaff', [AddStaffController::class, 'get']);
                        Route::post('addstaff', [AddStaffController::class, 'post']);
                    });
                Route::name('manage')
                    ->group(function () {
                        Route::get('managestaff', [ManageStaffController::class, 'get']);
                    });
                Route::name('delete')
                    ->group(function () {
                        Route::post('deletestaff/{staffId}', [ManageStaffController::class, 'delete']);
                    });
                Route::name('edit')
                    ->group(function () {
                        Route::get('editstaff/{staffId}', [EditStaffController::class, 'get']);
                        Route::post('editstaff/{staffId}', [EditStaffController::class, 'post']);
                    });
            });
        Route::resource('products', ProductController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);
        Route::get('cashflow', [CashflowController::class, 'get'])->name('cashflow');
        Route::redirect('/', route('admin.staff.manage'))->name('dashboard');
    });

Route::prefix('review')
    ->name('review')
    ->group(function () {
        Route::get('/', [AddReviewController::class, 'get']);
        Route::post('/', [AddReviewController::class, 'post']);
    });
