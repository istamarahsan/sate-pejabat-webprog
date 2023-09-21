<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')->get('me', function () {
    return '<h1>Horeee</h1>';
});