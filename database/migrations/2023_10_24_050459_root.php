<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // DROP
        Schema::dropAllTables();

        // USERS
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->rememberToken();
            $table->string('password');
            $table->enum('user_type', ['admin', 'staff']);
        });

        // REVIEWS
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('reviewer_name');
            $table->integer('score_taste');
            $table->integer('score_atmosphere');
            $table->integer('score_cleanliness');
            $table->integer('score_service');
            $table->integer('score_price');
            $table->text('reviewer_comments');
            $table->text('reviewer_goals');
        });

        // STAFF
        if (DB::getDriverName() == "mysql") {
            DB::statement('SET SESSION sql_require_primary_key=0');
        }
        Schema::create('staff', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->string('name');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('address');
        });
        if (DB::getDriverName() == "mysql") {
            DB::statement('SET SESSION sql_require_primary_key=1');
        }

        // STAFF ROLES
        Schema::create('staff_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->integer('role_id');
        });

        // TRANSACTIONS
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('handler_id');
            $table->text('notes')->nullable();
            $table->date('date');
        });

        // TRANSACTION DETAILS
        if (DB::getDriverName() == "mysql") {
            DB::statement('SET SESSION sql_require_primary_key=0');
        }
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->integer('transaction_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->double('price_per_unit');
            $table->primary(['transaction_id', 'product_id']);
        });
        if (DB::getDriverName() == "mysql") {
            DB::statement('SET SESSION sql_require_primary_key=1');
        }

        // PRODUCTS
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->enum('category', ['FOOD', 'BEVERAGE', 'SNACK', 'OTHER']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
