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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path')->nullable();
            $table->text('description');
            $table->json('ingredients');
            $table->json('steps');
            $table->integer('servings')->default(0);
            $table->integer('cooking_time')->default(0);
            $table->integer('spicy')->default(1);
            $table->integer('saved')->default(0);
            $table->integer('views')->default(0);
            $table->integer('rate')->default(0);
            $table->json('recommend_side_menus')->nullable();
            $table->foreignId('writer')->constrained('users')->onDelete('cascade');
            $table->foreignId('comments')->nullable()->constrained('comments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
