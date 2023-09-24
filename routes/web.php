<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
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
        Route::get('add-staff', function (Request $request) {
            $branchId = $request->route('branchId');
            $dbRes = DB::table('branches')->select(['name'])->where('id', '=', $branchId)->get();
            if (count($dbRes) != 1) {
                return response('Not Found', 404);
            }
            $branchName = $dbRes[0]->name;

            $staffRoles = DB::table('staff_roles')->select(['id', 'name'])->get();

            return view('admin.add-staff', [
                'branch' => [
                    'id' => $branchId,
                    'name' => $branchName
                ],
                'staffRoles' => $staffRoles
            ]);
        });
        Route::post('add-staff', function (Request $request) {
            $branchId = $request->route('branchId');
            $req = $request->validate([
                'full_name' => ['required', 'string'],
                'date_of_birth' => ['required', 'date'],
                'phone_number' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string'],
                'role' => ['required', 'integer']
            ]);

            $userId = DB::table('users')->insertGetId([
                'password' => Hash::make(''),
                'user_type' => 'staff'
            ]);

            DB::table('users')->where('id', '=', $userId)->update([
                'password' => Hash::make('S' . ((string)$userId))
            ]);

            DB::table('staff')->insert([
                'user_id' => $userId,
                'name' => $req['full_name'],
                'date_of_birth' => $req['date_of_birth'],
                'phone_number' => $req['phone_number'],
                'address' => $req['address'],
                'role_id' => $req['role'],
                'branch_id' => $branchId
            ]);

            return redirect('/admin/' . $branchId);
        });
    }
);