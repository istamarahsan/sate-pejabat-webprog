<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');

        });
        Schema::table('staff', function (Blueprint $table) {
            $table->integer('branch_id');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer("branch_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('staff', ['branch_id']);
        Schema::dropColumns('reviews', ['branch_id']);
        Schema::dropIfExists('branches');
    }
};
