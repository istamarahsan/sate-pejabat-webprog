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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
