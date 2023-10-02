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
        if (DB::getDriverName() == "mysql") {
            DB::statement('SET SESSION sql_require_primary_key=0');
        }
        Schema::create('staff', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('user_id')->primary();
            $table->string('name');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('address');
        });
        if (DB::getDriverName() == "mysql") {
            DB::statement('SET SESSION sql_require_primary_key=1');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
