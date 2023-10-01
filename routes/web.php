<?php

use App\Http\Controllers\AddReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\Staff\AddStaffController;
use App\Http\Controllers\Staff\ManageStaffController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

Route::middleware('auth')->get('/', function () {
    return '<h1>Horeee</h1>';
});

Route::middleware('auth')
    ->prefix('admin/{branchId}')
    ->group(function () {
        Route::get('', function(Request $request) {
            $branchId = $request->route('branchId') ?? 0;
            return redirect('admin/' . (string)$branchId . '/manage-staff');
        });
        Route::get('add-staff', [AddStaffController::class, 'get']);
        Route::post('add-staff', [AddStaffController::class, 'post']);
        Route::get('manage-staff', [ManageStaffController::class, 'get']);
        Route::post('delete/{staffId}', function (Request $request) {
            $branchId = $request->route('branchId');
            $staffUserId = $request->route('staffId');

            DB::table('staff')
                ->where('user_id', '=', $staffUserId)
                ->delete();
                
            return redirect('admin/' . $branchId);
        });
        Route::get('edit-staff/{staffId}', function (Request $request) {
            $branchId = $request->route('branchId');
            $staffUserId = $request->route('staffId');

            $staff = DB::table('staff')
                ->selectRaw('staff.user_id AS id, staff.name AS full_name, staff.date_of_birth, staff.phone_number, staff.address')
                ->where('user_id', '=', $staffUserId)
                ->get()
                ->first();

            $staffRoles = DB::table('staff_roles')->select(['id', 'name'])->get();

            return view('admin.edit-staff', [
                'branchId' => $branchId,
                'user' => get_object_vars($staff),
                'staffRoles' => $staffRoles
            ]);
        });
        Route::post('edit-staff/{staffId}', function (Request $request) {
            $branchId = $request->route('branchId');
            $staffUserId = $request->route('staffId');

            $req = $request->validate([
                'full_name' => ['required', 'string'],
                'date_of_birth' => ['required', 'date'],
                'phone_number' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string'],
                'role' => ['required', 'integer']
            ]);

            DB::table('staff')
                ->where('user_id', '=', $staffUserId)    
                ->update([
                    'name' => $req['full_name'],
                    'date_of_birth' => $req['date_of_birth'],
                    'phone_number' => $req['phone_number'],
                    'address' => $req['address'],
                    'role_id' => $req['role']
            ]);

            return redirect('admin/' . $branchId);
        });
    }
);

Route::get('/review', [AddReviewController::class, 'get']);
Route::post('/review', [AddReviewController::class, 'post']);

Route::get('/reviews', [ReviewsController::class, 'get']);