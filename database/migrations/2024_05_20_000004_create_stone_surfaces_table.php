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
        Schema::create('stone_surfaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1); // 1: active, 0: inactive
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Thêm khóa ngoại cho stone_products
        Schema::table('stone_products', function (Blueprint $table) {
            $table->foreign('stone_surface_id')
                ->references('id')
                ->on('stone_surfaces')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stone_products', function (Blueprint $table) {
            $table->dropForeign(['stone_surface_id']);
        });
        
        Schema::dropIfExists('stone_surfaces');
    }
}; 