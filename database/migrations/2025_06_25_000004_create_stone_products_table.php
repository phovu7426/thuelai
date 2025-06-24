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
        Schema::create('stone_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->nullable();
            $table->foreignId('stone_category_id')->nullable()->constrained('stone_categories')->nullOnDelete();
            $table->foreignId('stone_material_id')->nullable()->constrained('stone_materials')->nullOnDelete();
            $table->foreignId('stone_surface_id')->nullable()->constrained('stone_surfaces')->nullOnDelete();
            $table->foreignId('stone_color_id')->nullable()->constrained('stone_colors')->nullOnDelete();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->integer('discount_percent')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('features')->nullable();
            $table->longText('applications')->nullable();
            $table->string('origin')->nullable();
            $table->string('size')->nullable();
            $table->string('thickness')->nullable();
            $table->string('hardness')->nullable();
            $table->string('water_absorption')->nullable();
            $table->string('heat_resistance')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_products');
    }
}; 