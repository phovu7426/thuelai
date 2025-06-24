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
        Schema::create('stone_project_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stone_project_id')->constrained()->onDelete('cascade');
            $table->foreignId('stone_product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Đảm bảo không có sự trùng lặp
            $table->unique(['stone_project_id', 'stone_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_project_products');
    }
}; 