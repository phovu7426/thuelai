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
        Schema::create('stone_product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stone_product_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->string('alt')->nullable();
            $table->boolean('is_main')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_product_images');
    }
}; 