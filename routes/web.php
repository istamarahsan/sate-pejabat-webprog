<?php

use App\Http\Controllers\AddReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AddStaffController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\EditStaffController;
use App\Http\Controllers\ManageStaffController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;
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

Route::redirect("/", "review");

Route::prefix("auth")
    ->name("auth.")
    ->group(function () {
        Route::get("login", [LoginController::class, "get"])->name("login");
        Route::post("login", [LoginController::class, "authenticate"])->name("login");
        Route::post("logout", [LoginController::class, "logout"])->name("logout");
    });

Route::middleware("auth.admin")
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::resource("reviews", ReviewsController::class)->only(['index']);
        Route::resource('staff', StaffController::class)->only([
            "index", "create", "store", "edit", "update", "destroy"
        ]);
        Route::resource("products", ProductController::class)->only([
            "index",
            "create",
            "store",
            "update",
            "destroy",
            "edit",
        ]);
        Route::get("cashflow", [CashflowController::class, "get"])->name("cashflow");
        Route::redirect("/", route("admin.staff.index"))->name("dashboard");

        Route::resource("transactions", TransactionController::class)->only("index");
        Route::get("transactions/debug", function () {
            return dd(app("transactionService")->getTransactions());
        });
    });

Route::middleware("auth.admin")
    ->prefix("staff")
    ->name("staff.")
    ->group(function () {
        Route::get("newtransaction", [TransactionController::class, "staffCreate"])->name(
            "createtransaction",
        );
        Route::post("newtransaction", [TransactionController::class, "staffStore"])->name(
            "storetransaction",
        );
    });

Route::prefix("review")
    ->name("review")
    ->group(function () {
        Route::get("/", [ReviewsController::class, "create"]);
        Route::post("/", [ReviewsController::class, "store"]);
    });
