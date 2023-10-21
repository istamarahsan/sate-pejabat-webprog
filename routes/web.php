<?php

use App\Http\Controllers\AddReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AddStaffController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\EditStaffController;
use App\Http\Controllers\ManageStaffController;
use App\Http\Controllers\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('admin', function (Request $request) {
    $defaultBranch = getDefaultBranch();
    return redirect($defaultBranch . '/admin');
});

Route::get('review', function (Request $request) {
    $defaultBranch = getDefaultBranch();
    return redirect($defaultBranch . '/review');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'get'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login');
});

Route::prefix('{branchId}')
    ->group(function () {
        Route::middleware('auth')
            ->prefix('admin')
            ->group(function () {
                Route::get('', function (Request $request) {
                    $branchId = $request->route('branchId') ?? 1;
                    return redirect((string)$branchId . '/admin' . '/managestaff');
                });
                Route::get('reviews', [ReviewsController::class, 'get']);
                Route::get('addstaff', [AddStaffController::class, 'get']);
                Route::post('addstaff', [AddStaffController::class, 'post']);
                Route::get('managestaff', [ManageStaffController::class, 'get']);
                Route::post('delete/{staffId}', [ManageStaffController::class, 'delete']);
                Route::get('editstaff/{staffId}', [EditStaffController::class, 'get']);
                Route::post('editstaff/{staffId}', [EditStaffController::class, 'post']);
                Route::get('products', [ProductController::class, 'get']);
                Route::get('cashflow', [CashflowController::class, 'get']);
            });
        Route::prefix('review')
            ->group(function () {
                Route::get('/', [AddReviewController::class, 'get']);
                Route::post('/', [AddReviewController::class, 'post']);
            });
    });

function getDefaultBranch()
{
    return DB::table('branches')
        ->select('id')
        ->first()
        ->id;
}
