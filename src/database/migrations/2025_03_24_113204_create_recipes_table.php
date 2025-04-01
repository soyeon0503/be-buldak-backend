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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->text('description');
            $table->string('ingredient');
            $table->text('recipe');
            $table->integer('servings');
            $table->integer('cooking_time');
            $table->integer('spicy');
            $table->integer('saved');
            $table->integer('views');
            $table->integer('rate');
            $table->integer('recommend_side_dishes');
            $table->integer('writers');
            $table->integer('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
