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
        Schema::create('user_eaten_recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('recipe_id');
            $table->timestamps('create_at');
            $table->timestamps('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_eaten_recipes');
    }
};
