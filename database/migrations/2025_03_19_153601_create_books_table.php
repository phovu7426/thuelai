<?php

use App\Enums\BasicStatus;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('series_id')->constrained('series')->onDelete('cascade');
            $table->string('code')->unique(); // Mã
            $table->string('title'); // Tên
            $table->integer('volume')->nullable(); // Số tập
            $table->string('isbn')->unique(); // Mã isbn
            $table->date('published_at')->nullable(); // Ngày xuất bản
            $table->foreignId('publisher_id')->constrained('publishers')->onDelete('cascade'); // Nhà xuất bản
            $table->string('language')->nullable(); // Ngôn ngữ sách
            $table->integer('page_count')->nullable(); // Số trang
            $table->text('summary')->nullable(); // Mô tả ngắn nội dung sách
            $table->string('image')->nullable(); // Ảnh bìa sách
            $table->enum('status', BasicStatus::values())->default(BasicStatus::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
