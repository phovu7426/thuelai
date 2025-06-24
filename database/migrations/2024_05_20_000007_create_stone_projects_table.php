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
        Schema::create('stone_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->string('province')->nullable(); // Tỉnh/thành phố
            $table->string('region')->nullable(); // Miền: Bắc, Trung, Nam
            $table->decimal('budget', 15, 2)->nullable();
            $table->date('completed_date')->nullable();
            $table->string('main_image')->nullable();
            $table->text('gallery')->nullable(); // Lưu JSON
            $table->tinyInteger('status')->default(1); // 1: active, 0: inactive
            $table->tinyInteger('is_featured')->default(0); // Dự án nổi bật
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_projects');
    }
}; 