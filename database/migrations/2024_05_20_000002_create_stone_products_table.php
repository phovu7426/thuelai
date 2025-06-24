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
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('specifications')->nullable(); // Thông số kỹ thuật
            $table->string('main_image')->nullable(); // Ảnh chính
            $table->text('gallery')->nullable(); // Nhiều ảnh khác, lưu dạng JSON
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->unsignedBigInteger('stone_category_id')->nullable();
            $table->unsignedBigInteger('stone_material_id')->nullable(); // Chất liệu đá
            $table->unsignedBigInteger('stone_surface_id')->nullable(); // Bề mặt đá
            $table->tinyInteger('is_featured')->default(0); // Sản phẩm nổi bật
            $table->tinyInteger('status')->default(1); // 1: active, 0: inactive
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('stone_category_id')
                ->references('id')
                ->on('stone_categories')
                ->onDelete('set null');
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