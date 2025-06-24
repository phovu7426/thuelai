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
        Schema::create('stone_materials', function (Blueprint $table) {
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
            $table->foreign('stone_material_id')
                ->references('id')
                ->on('stone_materials')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stone_products', function (Blueprint $table) {
            $table->dropForeign(['stone_material_id']);
        });
        
        Schema::dropIfExists('stone_materials');
    }
}; 