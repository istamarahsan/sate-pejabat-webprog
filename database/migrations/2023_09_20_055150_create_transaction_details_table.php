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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('transaction_id');
            $table->integer('number');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->double('price_per_unit');
            $table->primary(['transaction_id', 'number']);
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
        Schema::dropIfExists('transaction_details');
    }
};
