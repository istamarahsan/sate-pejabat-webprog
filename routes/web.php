<?php

use App\Http\Controllers\AddReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AddStaffController;
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

Route::prefix('auth')->group(function() {
    Route::get('login', [LoginController::class, 'get'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login');
});

Route::middleware('auth')->get('admin', function (Request $request) {
    $defaultBranch = DB::table('branches')
        ->select('id')
        ->first()
        ->id;

    return redirect('/admin' . '/' . $defaultBranch);
});

Route::prefix('admin/{branchId}')
    ->group(function () {
        Route::get('', function(Request $request) {
            $branchId = $request->route('branchId') ?? 1;
            return redirect('admin/' . (string)$branchId . '/manage-staff');
        });

        Route::get('add-staff', [AddStaffController::class, 'get']);
        Route::post('add-staff', [AddStaffController::class, 'post']);
        Route::get('manage-staff', [ManageStaffController::class, 'get']);
        Route::post('delete/{staffId}', [ManageStaffController::class, 'delete']);
        Route::get('edit-staff/{staffId}', [EditStaffController::class, 'get']);
        Route::post('edit-staff/{staffId}', [EditStaffController::class, 'post']);

        Route::get('products', [ProductController::class, "get"]);
    }
);

Route::get('/review', [AddReviewController::class, 'get']);
Route::post('/review', [AddReviewController::class, 'post']);

Route::get('/reviews', [ReviewsController::class, 'get']);