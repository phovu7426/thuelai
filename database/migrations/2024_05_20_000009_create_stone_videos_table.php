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
        Schema::create('stone_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('video_url'); // URL YouTube hoặc đường dẫn video
            $table->string('thumbnail')->nullable(); // Ảnh đại diện
            $table->tinyInteger('status')->default(1); // 1: active, 0: inactive
            $table->tinyInteger('is_featured')->default(0); // Video nổi bật
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_videos');
    }
}; 